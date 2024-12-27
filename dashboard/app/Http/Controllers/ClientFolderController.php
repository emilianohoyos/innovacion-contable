<?php

namespace App\Http\Controllers;

use App\Models\ClientFolder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usar el guard 'api' para obtener el usuario autenticado
        $client_id =  auth()->user()->contactInfo()->pluck('client_id');
        $folders = ClientFolder::with([
            'folder.applyDocumentTypes',
            'folder' => function ($query) use ($client_id) {
                $query->with([
                    'monthlyAccountingFolders' => function ($subQuery) use ($client_id) {
                        $subQuery->whereHas('monthlyAccounting', function ($monthlyAccountingQuery) use ($client_id) {
                            $monthlyAccountingQuery->where('year', Carbon::now()->year)
                                ->where('month', Carbon::now()->month)->where('client_id', $client_id);
                        })->with('monthlyAccounting');
                    }
                ]);
            },
            'folder.applyDocumentTypes',
            'folder.ApplyDocTypeFolders.monthlyAccountingFolderApplyDocTypeFolders'
        ])
            ->where('client_id', $client_id)
            ->get();

        if ($client_id) {
            return response()->json([
                'message' => 'Usuario autenticado',
                'client' => $client_id,
                'folders' => $folders
            ]);
        }

        return response()->json(['error' => 'No autenticado'], 401);
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
