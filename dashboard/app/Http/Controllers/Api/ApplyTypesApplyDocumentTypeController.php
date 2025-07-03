<?php

namespace App\Http\Controllers\Api;

use App\Models\ApplyDocumentType;
use App\Models\ApplyType;
use App\Http\Controllers\Controller;
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
            'apply_type_id' => 'required|exists:apply_types,id',
            'items' => 'required|array',
            'items.*.document_type_id' => 'required|exists:apply_document_types,id',
            'items.*.is_required' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        foreach ($request->items as $item) {
            // Guardar los datos (o actualizar las relaciones)
            ApplyTypesApplyDocumentType::updateOrCreate(
                [
                    'apply_type_id' => $request->apply_type_id,
                    'apply_document_type_id' => $item['document_type_id']
                ],
                ['is_required' => $item['is_required']]
            );
        }

        return response()->json([
            "status" => true,
            'message' => 'Se han asociado Los tipos documentales.
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
    public function destroy(string $id)
    {
        // Buscar el registro por su ID
        $record = ApplyTypesApplyDocumentType::find($id);

        // Verificar si el registro existe
        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'El registro no existe.'
            ], 404);
        }

        // Intentar eliminar el registro
        try {
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar el registro.',
                'error' => $e->getMessage()
            ], 500);
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
        $applyDocumentTypeIds = ApplyTypesApplyDocumentType::where('apply_type_id', $validatedData['apply_type_id'])
            ->pluck('apply_document_type_id');
        $applyDocumentTypes = ApplyDocumentType::whereIn('id', $applyDocumentTypeIds)->get();
        return response()->json([
            "status" => true,
            'data' => $applyDocumentTypes
        ], 200);
    }
}
