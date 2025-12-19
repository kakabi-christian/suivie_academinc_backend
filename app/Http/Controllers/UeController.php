<?php

namespace App\Http\Controllers;

use App\Models\Ue;
use Illuminate\Http\Request;

class UeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ues = Ue::all();

        return response()->json(['data' => $ues], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code_ue' => 'required|min:5|string|unique:ues,code_ue',
            'label_ue' => 'required|min:5|string',
            'desc_ue' => 'nullable|string',
            'code_niveau' => 'required|exists:niveaux,code_niveau'
        ]);

        $ue = Ue::create($validateData);

        return response()->json([
            'message' => 'UE créée avec succès',
            'data' => $ue
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ue = Ue::find($id);

        if (!$ue) {
            return response()->json(['message' => 'UE introuvable'], 404);
        }

        return response()->json(['data' => $ue], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ue = Ue::find($id);

        if (!$ue) {
            return response()->json(['message' => 'UE introuvable'], 404);
        }

        $validateData = $request->validate([
            'code_ue' => 'sometimes|string|min:5|unique:ues,code_ue,' . $id . ',id',
            'label_ue' => 'sometimes|string|min:5',
            'desc_ue' => 'nullable|string',
            'code_niveau' => 'sometimes|exists:niveaux,code_niveau'
        ]);

        $ue->update($validateData);

        return response()->json([
            'message' => 'UE mise à jour avec succès',
            'data' => $ue
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ue $ue)
    {
        $ue->delete();

        return response()->json([
            'message' => 'UE supprimée avec succès'
        ], 200);
    }
}
