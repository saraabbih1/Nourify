<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'campagne_id' => 'required|exists:campagnes,id'
        ]);

        $don = Don::create([
            'montant' => $request->montant,
            'campagne_id' => $request->campagne_id,
            'donateur_id' => Auth::id(),
            'statut' => 'propose'
        ]);

        return response()->json($don, 201);
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
        $don->update($request->all());

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

   

    