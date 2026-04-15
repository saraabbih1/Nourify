<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campagne;
use App\Models\HistoriqueAction;

class CampagneController extends Controller
{
    // afficher tout les campagne  
    public function index()
    {
        return Campagne::all();
    }
    // creer une campagne
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'objectif' => 'required|numeric'
        ]);

        Campagne::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
            'beneficiaire_id' => Auth::id()
        ]);
        HistoriqueAction::create([
            'action' => 'Création campagne',
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard', ['view' => 'campaigns'])
            ->with('success', 'Campagne créée avec succès');
    }
    //afficher une campagne by id
    public function show($id)
    {
        return Campagne::findOrFail($id);
    }

    //update 
    public function update(Request $request, $id)
    {
        $campagne = Campagne::findOrFail($id);

        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'objectif' => 'required|numeric'
        ]);

        $campagne->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
        ]);

        return redirect()->route('dashboard', ['view' => 'campaigns'])
            ->with('success', 'Campagne mise à jour avec succès');
    }

    //supprimer 
    public function destroy($id)
    {
        Campagne::destroy($id);

        return redirect()->route('dashboard', ['view' => 'campaigns'])
            ->with('success', 'Campagne supprimée avec succès');
    }
}
