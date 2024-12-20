<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocTypeFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyDocTypeFolderController extends Controller
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
            'folder_id' => 'required|exists:apply_types,id',
            'items' => 'required|array',
            'items.*.document_type_id' => 'required|exists:document_types,id',
            'items.*.is_required' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        foreach ($request->items as $item) {
            // Guardar los datos (o actualizar las relaciones)
            ApplyDocTypeFolder::updateOrCreate(
                [
                    'folder_id' => $request->folder_id,
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el registro por su ID
        $record = ApplyDocTypeFolder::find($id);

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
}