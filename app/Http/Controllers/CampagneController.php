<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\HistoriqueAction;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampagneController extends Controller
{
    public function index(Request $request)
    {
        $campagnes = Campagne::latest()->get();

        if ($request->wantsJson()) {
            return $campagnes;
        }

        return view('campagnes.index', compact('campagnes'));
    }

    public function create()
    {
        return view('campagnes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'objectif' => 'required|numeric',
        ]);

        $campagne = Campagne::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
            'beneficiaire_id' => Auth::id(),
        ]);

        $user = Auth::user();
        if ($user && !$user->hasRole('admin')) {
            $beneficiaireRoleId = Role::where('name', 'beneficiaire')->value('id');

            if ($beneficiaireRoleId && $user->role_id !== $beneficiaireRoleId) {
                $user->update(['role_id' => $beneficiaireRoleId]);
            }
        }

        HistoriqueAction::create([
            'action' => 'Creation campagne: ' . $campagne->titre,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne creee avec succes');
    }

    public function show(Request $request, $id)
    {
        $campagne = Campagne::with('dons')->findOrFail($id);

        if ($request->wantsJson()) {
            return $campagne;
        }

        return view('campagnes.show', compact('campagne'));
    }

    public function edit($id)
    {
        $campagne = Campagne::findOrFail($id);
        $this->ensureCampagneOwner($campagne);
        return view('campagnes.edit', compact('campagne'));
    }

    public function update(Request $request, $id)
    {
        $campagne = Campagne::findOrFail($id);
        $this->ensureCampagneOwner($campagne);

        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'objectif' => 'required|numeric',
        ]);

        $campagne->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
        ]);

        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne mise a jour avec succes');
    }

    public function destroy($id)
    {
        $campagne = Campagne::findOrFail($id);
        $this->ensureCampagneOwner($campagne);
        $campagne->delete();

        return redirect()->route('campagnes.index')
            ->with('success', 'Campagne supprimee avec succes');
    }

    private function ensureCampagneOwner(Campagne $campagne): void
    {
        if ($campagne->beneficiaire_id !== Auth::id()) {
            abort(403);
        }
    }
}
