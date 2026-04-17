<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HistoriqueAction;

class DonController extends Controller
{
    // afficher tout les don 
    public function index()
    {
        return Don::all();
    }

    //creaar ou bien proposer une don
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:1',
            'campagne_id' => 'required|exists:campagnes,id',
            'type' => 'required|string|in:argent,nourriture,vetements,autre',
        ]);

        $don = Don::create([
            'montant' => $request->montant,
            'type' => $request->type,
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

    // afficher seul don by id 
    public function show($id)
    {
        return Don::findOrFail($id);
    }

    // update don
    public function update(Request $request, $id)
    {
        $don = Don::findOrFail($id);
        if ($don->donateur_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $don->update($request->only('montant'));
        return response()->json($don);
    }

    // supprimer don
    public function destroy($id)
    {
        Don::destroy($id);

        return response()->json([
            'message' => 'Don supprimé'
        ]);
    }



    // accepter don beneficiaire
    public function accepter($id)
    {
        $don = Don::findOrFail($id);

        if (Auth::user()->role != 'beneficiaire') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $don->update(['statut' => 'accepte']);
        Notification::create([
            'message' => 'Votre don a été accepté',
            'user_id' => $don->donateur_id,
            'lu' => false
        ]);
        HistoriqueAction::create([
            'action' => 'Don accepté',
            'user_id' => Auth::id()
        ]);
        return $don;
    }

    // refuser don
    public function refuser($id)
    {
        $don = Don::findOrFail($id);

        if (Auth::user()->role != 'beneficiaire') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $don->update(['statut' => 'refuse']);
        Notification::create([
            'message' => 'Votre don a été refusé',
            'user_id' => $don->donateur_id,
            'lu' => false
        ]);
        HistoriqueAction::create([
            'action' => 'Don REFUSE',
            'user_id' => Auth::id()
        ]);
        return $don;
    }

    // distribuer don
    public function distribuer($id)
    {
        $don = Don::findOrFail($id);

        if (Auth::user()->role != 'beneficiaire') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($don->statut != 'accepte') {
            return response()->json(['error' => 'Don must be accepted first'], 400);
        }
        $don->update(['statut' => 'distribue']);
        Notification::create([
            'message' => 'Votre don a été distribué',
            'user_id' => $don->donateur_id,
            'lu' => false
        ]);
        HistoriqueAction::create([
            'action' => 'Don distribué',
            'user_id' => Auth::id()
        ]);
        return $don;
    }
}
