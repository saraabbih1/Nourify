<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $campagne = Campagne::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
            'beneficiaire_id' => Auth::id()
        ]);

        return response()->json($campagne, 201);
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

        $campagne->update($request->all());

        return response()->json($campagne);
    }
 
     //supprimer 
    public function destroy($id)
    {
        Campagne::destroy($id);

        return response()->json([
            'message' => 'Campagne supprimée'
        ]);
    }
}