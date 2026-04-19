<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\HistoriqueAction;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonController extends Controller
{
    public function index()
    {
        $user = $this->authUser();
        $query = Don::with('campagne')->latest();

        if ($user->hasRole('donateur') && !$user->hasRole('admin')) {
            $query->where('donateur_id', $user->id);
        } elseif ($user->hasRole('beneficiaire') && !$user->hasRole('admin')) {
            $query->whereHas('campagne', function ($q) use ($user) {
                $q->where('beneficiaire_id', $user->id);
            });
        }

        $dons = $query->get();

        return view('dons.index', compact('dons'));
    }

    public function create()
    {
        $campagnes = Campagne::latest()->get();
        return view('dons.create', compact('campagnes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'nullable|numeric|min:1',
            'campagne_id' => 'required|exists:campagnes,id',
            'type' => 'required|string|in:argent,nourriture,vetements,autre',
            'quantite' => 'nullable|numeric|min:0.01',
            'unite' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
        ]);

        $type = $request->input('type');
        $isMoney = $type === 'argent';

        if ($isMoney && !$request->filled('montant')) {
            return back()
                ->withErrors(['montant' => 'Le montant est obligatoire pour un don en argent.'])
                ->withInput();
        }

        if (!$isMoney && (!$request->filled('quantite') || !$request->filled('unite'))) {
            return back()
                ->withErrors([
                    'quantite' => 'Quantite et unite sont obligatoires pour un don en nature.',
                ])
                ->withInput();
        }

        $don = Don::create([
            'montant' => $isMoney ? $request->montant : null,
            'type' => $type,
            'quantite' => $isMoney ? null : $request->quantite,
            'unite' => $isMoney ? null : $request->unite,
            'description' => $request->description,
            'campagne_id' => $request->campagne_id,
            'donateur_id' => Auth::id(),
            'statut' => 'propose',
        ]);

        if ($request->wantsJson()) {
            return response()->json($don, 201);
        }

        return redirect()->route('dons.index')
            ->with('success', 'Don cree avec succes.');
    }

    public function show($id)
    {
        return Don::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $don = Don::findOrFail($id);
        if ($don->donateur_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $don->update($request->only('montant'));
        return response()->json($don);
    }

    public function destroy($id)
    {
        Don::destroy($id);

        return response()->json([
            'message' => 'Don supprime',
        ]);
    }

    public function accepter($id)
    {
        $don = Don::with('campagne')->findOrFail($id);
        $user = $this->authUser();

        if (
            !$user->hasRole('admin')
            && $don->campagne?->beneficiaire_id !== $user->id
        ) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $don->update(['statut' => 'accepte']);

        Notification::create([
            'message' => 'Votre don a ete accepte',
            'user_id' => $don->donateur_id,
            'lu' => false,
        ]);

        HistoriqueAction::create([
            'action' => 'Don accepte',
            'user_id' => Auth::id(),
        ]);

        if (request()->wantsJson()) {
            return $don;
        }

        return redirect()->route('dons.index')->with('success', 'Don accepte.');
    }

    public function refuser($id)
    {
        $don = Don::with('campagne')->findOrFail($id);
        $user = $this->authUser();

        if (
            !$user->hasRole('admin')
            && $don->campagne?->beneficiaire_id !== $user->id
        ) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $don->update(['statut' => 'refuse']);

        Notification::create([
            'message' => 'Votre don a ete refuse',
            'user_id' => $don->donateur_id,
            'lu' => false,
        ]);

        HistoriqueAction::create([
            'action' => 'Don refuse',
            'user_id' => Auth::id(),
        ]);

        if (request()->wantsJson()) {
            return $don;
        }

        return redirect()->route('dons.index')->with('success', 'Don refuse.');
    }

    public function distribuer($id)
    {
        $don = Don::with('campagne')->findOrFail($id);
        $user = $this->authUser();

        if (
            !$user->hasRole('admin')
            && $don->campagne?->beneficiaire_id !== $user->id
        ) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($don->statut !== 'accepte') {
            return response()->json(['error' => 'Don must be accepted first'], 400);
        }

        $don->update(['statut' => 'distribue']);

        Notification::create([
            'message' => 'Votre don a ete distribue',
            'user_id' => $don->donateur_id,
            'lu' => false,
        ]);

        HistoriqueAction::create([
            'action' => 'Don distribue',
            'user_id' => Auth::id(),
        ]);

        if (request()->wantsJson()) {
            return $don;
        }

        return redirect()->route('dons.index')->with('success', 'Don distribue.');
    }

    private function authUser(): User
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        return $user;
    }
}
