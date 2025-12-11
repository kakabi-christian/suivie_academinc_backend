<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();
        return response()->json($niveaux, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'label_niveau' => 'required|min:5|string|',
                'code_filiere' => 'required|min:5|string|exists:filieres,code_filiere'
            ]);

            $res = Niveau::create($request->all());

            return response()->json(["message" => "Niveau crée avec succès", 'data' => $res], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        try {
            $niveau = Niveau::findOrFail($niveau->code_niveau);
            $niveau->delete();
            return response()->json(["message" => "Suppression du niveau réussie"], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Niveau non trouvé"], 404);
        }
    }
}
