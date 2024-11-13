<?php

namespace App\Http\Controllers;

use App\Models\ApplyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'estimated_days' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        ApplyType::create($validator->validate());

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo de applicacion.'
        ], 200); //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyType $applyType)
    {
        return response()->json([
            "status" => true,
            'data' => $applyType
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplyType $applyType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'estimated_days' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $applyType->name = $validatedData['name'];
        $applyType->estimated_days = $validatedData['estimated_days'];
        $applyType->save();

        return response()->json([
            "status" => true,
            'message' => 'Se ha Editado el tipo de aplicacion.'
        ], 200); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $applyType = ApplyType::find($id);
        if ($applyType) {
            $applyType->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la informacion del Proveedor.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }

    public function listApplyType()
    {
        //todo joins relations
        $applyType = ApplyType::all();
        return response()->json([
            "status" => true,
            'data' => $applyType
        ], 200);
    }
}
