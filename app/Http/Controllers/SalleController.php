<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = Salle::all();
        return response()->json(['data' => $salles], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'num_salle' => 'required|min:5|string|unique:salles,num_salle',
            'contenance' => 'required|integer|min:20',
            'status' => 'required|string|in:Disponible,Indisponible',
        ]);

        $salle = Salle::create($validateData);

        return response()->json([
            'message' => 'Salle créée avec succès',
            'data' => $salle
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $salle = Salle::find($id);

        if (!$salle) {
            return response()->json(['message' => 'Salle introuvable'], 404);
        }

        return response()->json(['data' => $salle], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $salle = Salle::find($id);

        if (!$salle) {
            return response()->json(['message' => 'Salle introuvable'], 404);
        }

        $validateData = $request->validate([
            'num_salle' => 'sometimes|string|min:5|unique:salles,num_salle,' . $id . ',id',
            'contenance' => 'sometimes|integer|min:20',
            'status' => 'sometimes|string|in:Disponible,Indisponible',
        ]);

        $salle->update($validateData);

        return response()->json([
            'message' => 'Salle mise à jour avec succès',
            'data' => $salle
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();

        return response()->json([
            'message' => 'Salle supprimée avec succès'
        ], 200);
    }
}
