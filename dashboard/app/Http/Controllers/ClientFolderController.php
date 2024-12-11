<?php

namespace App\Http\Controllers;

use App\Models\ClientFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientFolderController extends Controller
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
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array',
            'items.*.folder_id' => 'required|exists:folders,id',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        foreach ($request->items as $item) {
            // Guardar los datos (o actualizar las relaciones)
            ClientFolder::create(
                [
                    'client_id' => $request->client_id,
                    'folder_id' => $item['folder_id']
                ],
            );
        }

        return response()->json([
            "status" => true,
            'message' => 'Se han asociado Los tipos documentales.
            .'
        ], 200);
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
        $folder = ClientFolder::find($id);
        if ($folder) {
            $folder->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la carpeta.'
            ], 200); //
        } else {
            echo 'No se encontró la carpeta con ID' . $id;
        }
    }
}
