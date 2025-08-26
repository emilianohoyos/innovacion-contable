<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocTypeFolder;
use App\Models\Client;
use App\Models\ClientContactInfo;
use App\Models\ClientFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
use App\Providers\GraphTokenService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientFolderController extends Controller
{

    protected $disk;

    public function __construct(GraphTokenService $oneDriveService)
    {
        $this->disk = Storage::build([
            'driver' => config('filesystems.disks.onedrive.driver'),
            'root' => config('filesystems.disks.onedrive.root'),
            'directory_type' => config('filesystems.disks.onedrive.directory_type'),
            'access_token' => $oneDriveService->getAccessToken()
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        $folders = Client::with(['folders.applyDocTypeFolders.applyDocumentType'])
            ->findOrFail($client_id)
            ->folders
            ->unique('id') // Elimina folders duplicados
            ->map(function ($folder) {
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
                    })
                ];
            });

        // $results = [];


        // foreach ($folders as $folder) {
        //     $result = $folder;

        //     $documents = ApplyDocTypeFolder::select('apply_doc_type_folders.id as apply_doc_type_folders_id', 'apply_document_types.*')
        //         ->join(
        //             'apply_document_types',
        //             'apply_doc_type_folders.apply_document_type_id',
        //             '=',
        //             'apply_document_types.id'
        //         )
        //         ->where('folder_id', $folder->id)
        //         ->get();

        //     $result['documents'] = $documents;

        //     foreach ($documents as $key => $document) {
        //         $attachDoc = MonthlyAccountingFolderApplyDocTypeFolder::leftJoin(
        //             'users',
        //             'monthly_accounting_folder_apply_doc_type_folders.user_id',
        //             '=',
        //             'users.id'
        //         )
        //             ->where(
        //                 'monthly_accounting_folder_id',
        //                 $folder->monthly_accounting_folder_id
        //             )
        //             ->where('apply_doc_type_folder_id', $document->apply_doc_type_folders_id)->get();
        //         $result['documents'][$key]['attachments'] = $attachDoc;
        //     }
        //     $results[] = $result;
        // }

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
