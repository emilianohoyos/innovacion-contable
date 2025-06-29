<?php

namespace App\Http\Controllers\Api;

use App\Models\MonthlyAccountingFolder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyAccountingFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MonthlyAccountingFolder::with(['monthlyAccountingFolderApplyDocTypeFolders.applyDocTypeFolders.applyDocumentType'])->where('client_folder_id', $request->input('client_folder_id'))
            ->where('month_year', $request->input('month_year'))
            ->first();

        if ($query) {
            return response()->json([
                'message' => 'Folders obtenidos correctamente',
                'data' => $query
            ]);
        }

        return response()->json(['error' => 'No hay datos'], 401);
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

        try {
            $validate = $request->validate([
                'monthly_accounting_id' => 'required',
                'folder_id' => 'required',
            ]);

            $record = MonthlyAccountingFolder::create([
                'monthly_accounting_id' => $validate['monthly_accounting_id'],
                'folder_id' => $validate['folder_id'],
                'is_new' => true,
                'status' => 'PENDIENTE',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registro Creado',
                'data' => $record, // Incluye el registro recién creado en la respuesta
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el registro',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        //
    }
}
