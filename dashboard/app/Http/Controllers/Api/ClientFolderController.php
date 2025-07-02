<?php

namespace App\Http\Controllers\Api;

use App\Models\ApplyDocTypeFolder;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientContactInfo;
use App\Models\ClientFolder;
use App\Models\MonthConfig;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Usar el guard 'api' para obtener el usuario autenticado
        $user = auth('api')->user();
        $userId = $user->id;
        // Obtener el ID del cliente desde el usuario autenticado
        if ($userId) {
            $client_id = ClientContactInfo::where('user_id', $userId)
                ->value('client_id');
        } else {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        // $folders = ClientFolder::with('folder')->join('folders', 'client_folders.folder_id', '=', 'folders.id')
        //     ->leftJoin('monthly_accounting_folders', function ($join) {
        //         $join->on('monthly_accounting_folders.folder_id', '=', 'folders.id');
        //     })
        //     ->where('client_folders.client_id', $client_id)
        //     ->get();

        // Obtener el mes y año de la solicitud o usar el mes actual si no se proporciona
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        var_dump($request->input('month'));
        var_dump($request->input('year'));
        
        $folders = Client::with(['folders.applyDocTypeFolders.applyDocumentType'])
            ->findOrFail($client_id)
            ->folders
            ->unique('id') // Elimina folders duplicados
            ->map(function ($folder) use ($client_id, $month, $year) {
                // Buscar la configuración mensual para esta carpeta
                $monthlyConfig = \App\Models\MonthlyAccountingFolder::with(['monthlyAccountingFolderApplyDocTypeFolders.applyDocTypeFolders.applyDocumentType'])
                    ->where('client_folder_id', $folder->pivot->id) // Usar el ID de la relación pivot
                    ->where('month_year', $month)
                    ->where('year', $year)
                    ->get();
                
                return [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'periodicity' => $folder->periodicity,
                    'document_types' => $folder->applyDocTypeFolders->map(function ($docType) {
                        return [
                            'id' => $docType->applyDocumentType->id,
                            'name' => $docType->applyDocumentType->name,
                            'is_required' => $docType->is_required
                        ];
                    }),
                    'monthly_config' => $monthlyConfig ? [
                        'id' => $monthlyConfig->id,
                        'month_year' => $monthlyConfig->month_year,
                        'status' => $monthlyConfig->status,
                        'document_types' => $monthlyConfig->monthlyAccountingFolderApplyDocTypeFolders->map(function ($monthlyDocType) {
                            return [
                                'id' => $monthlyDocType->id,
                                'document_type_id' => $monthlyDocType->applyDocTypeFolders->applyDocumentType->id,
                                'document_type_name' => $monthlyDocType->applyDocTypeFolders->applyDocumentType->name,
                                'is_required' => $monthlyDocType->applyDocTypeFolders->is_required,
                                'status' => $monthlyDocType->status
                            ];
                        })
                    ] : null
                ];
            })
            ->toArray();
        $folders = array_values($folders); // Asegura que sea un array indexado

        $currentDate = date('Y-m-d'); // Fecha actual
        
        // Consultar la configuración del mes anterior en MonthConfig (sin filtrar por cliente)
        $previousMonthConfig = MonthConfig::where('month', $month)
            ->where('year', $year)
            ->first();
            
        // Verificar si la fecha actual es menor que el endate del mes anterior
        $isBeforeEndDate = false;
        $endDate = null;
        
        if ($previousMonthConfig && $previousMonthConfig->end_date) {
            $endDate = $previousMonthConfig->end_date;
            $isBeforeEndDate = $currentDate < $endDate;
        }
        
        if ($client_id) {
            return response()->json([
                'status' => true,
                'folders' => $folders,
                'previous_month' => [
                    'end_date' => $endDate,
                    'is_before_end_date' => $isBeforeEndDate
                ]
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
