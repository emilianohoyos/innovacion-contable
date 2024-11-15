<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocumentType;
use App\Models\ApplyTypesApplyDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyTypesApplyDocumentTypeController extends Controller
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
            'apply_type_id' => 'required|numeric',
            'apply_document_type_id' => 'required|numeric',
            'is_require' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        ApplyTypesApplyDocumentType::create($validator->validate());

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El registro
            .'
        ], 200); //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyTypesApplyDocumentType $applyTypesApplyDocumentType)
    {
        return response()->json([
            "status" => true,
            'data' => $applyTypesApplyDocumentType
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
    public function update(Request $request, ApplyTypesApplyDocumentType $applyTypesApplyDocumentType)
    {
        $validator = Validator::make($request->all(), [
            'apply_type_id' => 'required|numeric',
            'apply_document_type_id' => 'required|numeric',
            'is_require' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $applyTypesApplyDocumentType->apply_type_id = $validatedData['apply_type_id'];
        $applyTypesApplyDocumentType->apply_document_type_id = $validatedData['apply_document_type_id'];
        $applyTypesApplyDocumentType->is_require = $validatedData['is_require'];
        $applyTypesApplyDocumentType->save();

        return response()->json([
            "status" => true,
            'message' => 'Se ha Editado el registro.'
        ], 200); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $applyTypesApplyDocumentType = ApplyTypesApplyDocumentType::find($id);
        if ($applyTypesApplyDocumentType) {
            $applyTypesApplyDocumentType->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la informacion del Proveedor.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }

    public function listApplyTypesApplyDocumentTypes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apply_type_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();
        $applyDocumentTypeIds = ApplyTypesApplyDocumentType::where('apply_type_id', $request->apply_type_id)
            ->pluck('apply_document_type_id');

        $applyDocumentTypes = ApplyDocumentType::whereIn('id', $applyDocumentTypeIds)->get();
        return response()->json([
            "status" => true,
            'data' => $applyDocumentTypes
        ], 200);
    }
}
