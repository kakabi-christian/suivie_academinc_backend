<?php

namespace App\Http\Controllers;

use App\Models\Ec;
use Illuminate\Http\Request;

class EcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ecs = Ec::all();
        return response()->json(['data' => $ecs], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code_ec' => 'required|min:5|string|unique:ecs,code_ec',
            'label_ec' => 'required|string',
            'desc_ec' => 'nullable|string',
            'nbh_ec' => 'required|integer|min:1',
            'nbc_ec' => 'required|integer|min:1',
            'code_ue' => 'required|exists:ues,code_ue'
        ]);

        $res = Ec::create($validateData);

        return response()->json([
            "message" => "EC crée avec succès",
            "data" => $res
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ec = Ec::find($id);

        if (!$ec) {
            return response()->json(['message' => 'EC introuvable'], 404);
        }

        return response()->json(['data' => $ec], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ec = Ec::find($id);

        if (!$ec) {
            return response()->json(['message' => 'EC introuvable'], 404);
        }

        $validateData = $request->validate([
            'code_ec'  => 'sometimes|min:5|string|unique:ecs,code_ec,' . $id . ',id',
            'label_ec' => 'sometimes|string',
            'desc_ec'  => 'nullable|string',
            'nbh_ec'   => 'sometimes|integer|min:1',
            'nbc_ec'   => 'sometimes|integer|min:1',
            'code_ue'  => 'sometimes|exists:ues,code_ue'
        ]);

        $ec->update($validateData);

        return response()->json([
            "message" => "EC mis à jour avec succès",
            "data" => $ec
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ec = Ec::find($id);

        if (!$ec) {
            return response()->json(['message' => 'EC introuvable'], 404);
        }

        $ec->delete();

        return response()->json(['message' => 'EC supprimé avec succès'], 200);
    }
}
