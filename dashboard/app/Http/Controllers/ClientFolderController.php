<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocTypeFolder;
use App\Models\ClientFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
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
        $current_date = Carbon::now();
        $current_year = $current_date->year;
        $current_month = $current_date->month;

        if ($current_month == 1) {
            $current_month = 12;
            $current_year -= 1;
        }

        // Usar el guard 'api' para obtener el usuario autenticado
        $client_id =  3;

        $folders = ClientFolder::select(
            'folders.id',
            'folders.name',
            'monthly_accountings.id as monthly_accounting_id',
            'monthly_accountings.year',
            'monthly_accountings.month',
            'monthly_accountings.state',
            'monthly_accountings.end_date',
            'monthly_accounting_folders.id as monthly_accounting_folder_id',
            'monthly_accounting_folders.status',
            'monthly_accounting_folders.is_new'
        )
            ->join('folders', 'client_folders.folder_id', '=', 'folders.id')
            ->join('monthly_accountings', function ($join) use ($current_year, $current_month) {
                $join->on('monthly_accountings.client_id', '=', 'client_folders.client_id')
                    ->where('monthly_accountings.year', $current_year)
                    ->where('monthly_accountings.month', $current_month - 1);
            })
            ->leftJoin('monthly_accounting_folders', function ($join) {
                $join->on('monthly_accounting_folders.folder_id', '=', 'folders.id')
                    ->on('monthly_accounting_folders.monthly_accounting_id', '=', 'monthly_accountings.id');
            })
            ->where('client_folders.client_id', $client_id)
            ->get();

        $results = [];
        foreach ($folders as $folder) {
            $result = $folder;

            $documents = ApplyDocTypeFolder::select('apply_doc_type_folders.id as apply_doc_type_folders_id', 'apply_document_types.*')
                ->join(
                    'apply_document_types',
                    'apply_doc_type_folders.apply_document_type_id',
                    '=',
                    'apply_document_types.id'
                )
                ->where('folder_id', $folder->id)
                ->get();

            $result['documents'] = $documents;

            foreach ($documents as $key => $document) {
                $attachDoc = MonthlyAccountingFolderApplyDocTypeFolder::leftJoin(
                    'users',
                    'monthly_accounting_folder_apply_doc_type_folders.user_id',
                    '=',
                    'users.id'
                )
                    ->where(
                        'monthly_accounting_folder_id',
                        $folder->monthly_accounting_folder_id
                    )
                    ->where('apply_doc_type_folder_id', $document->apply_doc_type_folders_id)->get();
                $result['documents'][$key]['attachments'] = $attachDoc;
            }
            $results[] = $result;
        }

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
