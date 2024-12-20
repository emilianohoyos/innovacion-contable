<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAccountingFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
use App\Providers\GraphTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MonthlyAccountingFolderApplyDocTypeFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
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
        $validator = Validator::make(
            $request->all(),
            [
                'monthly_accounting_folder_id' => 'required',
                'year' => 'required|integer',
                'client_id' => 'required',
                'folder_id' => 'required',
                'attachments' => 'required|array',
                'attachments.*.apply_doc_type_folder_id' => 'required',
                'attachments.*.fileBase64' => 'required|string',
                'attachments.*.filename' => 'required|string'
            ]
        );

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                'message' => 'Error en la validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        try {
            foreach ($validatedData['attachments'] as $attachment) {
                // Crear registro en la base de datos
                $montlyData = MonthlyAccountingFolderApplyDocTypeFolder::create([
                    'monthly_accounting_folder_id' => $validatedData['monthly_accounting_folder_id'],
                    'apply_doc_type_folder_id' => $attachment['apply_doc_type_folder_id'],
                    'is_new' => true,
                    'status' => "PENDIENTE"
                ]);

                $fileData = $attachment["fileBase64"];
                $base64String = preg_replace('/^data:[^;]+;base64,/', '', $fileData);

                // Decodificar Base64
                $decodedData = base64_decode($base64String, true);

                // Verificar si la decodificación fue exitosa
                if ($decodedData === false) {
                    return response()->json([
                        "status" => false,
                        "message" => "Error al decodificar el archivo base64."
                    ], 400);
                }

                // Guardar el archivo temporalmente
                $tempFilePath = sys_get_temp_dir() . '/' . $attachment['filename'];
                file_put_contents($tempFilePath, $decodedData);

                // Construir la ruta para almacenar el archivo
                $filePath = "monthly_accounting/{$validatedData['client_id']}/{$validatedData['year']}/{$validatedData['folder_id']}/";

                // Usar putFileAs con el archivo temporal
                $this->disk->putFileAs($filePath, new \Illuminate\Http\File($tempFilePath), $attachment['filename']);

                // Eliminar el archivo temporal después de moverlo
                unlink($tempFilePath);


                // Guardar la URL del archivo en el registro
                $montlyData->path = $filePath . $attachment['filename'];
                $montlyData->save();
                MonthlyAccountingFolder::find($validatedData['monthly_accounting_folder_id'])
                    ->update([
                        'is_new' => true
                    ]);
            }

            return response()->json([
                "status" => true,
                'message' => 'Se ha registrado correctamente.',
            ], 200);
        } catch (\Exception $e) {
            // Manejo de errores generales
            return response()->json([
                "status" => false,
                'message' => 'Ocurrió un error al procesar la solicitud.',
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
