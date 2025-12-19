<?php

namespace App\Http\Controllers;

use App\Models\Enseigne;
use Illuminate\Http\Request;

class EnseigneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignes = Enseigne::with(['personnel', 'ec'])->get();
        return response()->json(['data' => $enseignes], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code_pers' => 'required|exists:personnels,code_pers',
            'code_ec'   => 'required|exists:ecs,code_ec',
            'date_ens'  => 'required|date',
        ]);

        // Vérifie si la combinaison existe déjà
        $exists = Enseigne::where('code_pers', $validateData['code_pers'])
                          ->where('code_ec', $validateData['code_ec'])
                          ->first();

        if ($exists) {
            return response()->json(['message' => 'Cette affectation existe déjà'], 409);
        }

        // Crée l'enseigne avec UUID généré automatiquement
        $enseigne = Enseigne::create($validateData);

        return response()->json([
            'message' => 'Enseigne créée avec succès',
            'data' => $enseigne
        ], 201);
    }

    /**
     * Display the specified resource by id.
     */
    public function show($id)
    {
        $enseigne = Enseigne::with(['personnel', 'ec'])->find($id);

        if (!$enseigne) {
            return response()->json(['message' => 'Enseigne introuvable'], 404);
        }

        return response()->json(['data' => $enseigne], 200);
    }

    /**
     * Update the specified resource in storage by id.
     */
    public function update(Request $request, $id)
    {
        $enseigne = Enseigne::find($id);

        if (!$enseigne) {
            return response()->json(['message' => 'Enseigne introuvable'], 404);
        }

        $validateData = $request->validate([
            'date_ens' => 'sometimes|date',
        ]);

        $enseigne->update($validateData);

        return response()->json([
            'message' => 'Enseigne mise à jour avec succès',
            'data' => $enseigne
        ], 200);
    }

    /**
     * Remove the specified resource from storage by id.
     */
    public function destroy($id)
    {
        $enseigne = Enseigne::find($id);

        if (!$enseigne) {
            return response()->json(['message' => 'Enseigne introuvable'], 404);
        }

        $enseigne->delete();

        return response()->json(['message' => 'Enseigne supprimée avec succès'], 200);
    }
}
