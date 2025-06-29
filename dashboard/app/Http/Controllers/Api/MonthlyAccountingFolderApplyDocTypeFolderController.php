<?php

namespace App\Http\Controllers\Api;

use App\Models\MonthlyAccountingFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
use App\Providers\GraphTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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
                'monthly_accounting_folder_id' => 'nullable',
                'client_folder_id' => 'required',
                'month_year' => 'required|integer',
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
                if (!isset($validatedData['monthly_accounting_folder_id'])) {
                    // Si no se proporciona monthly_accounting_folder_id, buscar o crear la carpeta mensual
                    $monthlyAccountingFolder = MonthlyAccountingFolder::firstOrCreate(
                        [
                            'client_folder_id' => $validatedData['client_folder_id'],
                            'month_year' => $validatedData['month_year']
                        ],
                        [
                            'is_new' => true,
                            'status' => "PENDIENTE"
                        ]
                    );
                    $validatedData['monthly_accounting_folder_id'] = $monthlyAccountingFolder->id;
                }
                // Crear registro en la base de datos
                $montlyData = MonthlyAccountingFolderApplyDocTypeFolder::create([
                    'monthly_accounting_folder_id' => $validatedData['monthly_accounting_folder_id'],
                    'apply_doc_type_folder_id' => $attachment['apply_doc_type_folder_id'],
                    'is_new' => true,
                    'status' => "PENDIENTE",
                    'path' => '',
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
                $filePath = "monthly_accounting/{$validatedData['monthly_accounting_folder_id']}/{$validatedData['month_year']}/";

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

    public function detectMimeType($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'zip' => 'application/zip',
        ];
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }

    public function downloadFromOneDrive(Request $request)
    {
        $file = MonthlyAccountingFolderApplyDocTypeFolder::find($request->id);

        if (!$file) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }

        if (!$this->disk->exists($file->path)) {
            return response()->json(['error' => 'Archivo no encontrado en OneDrive'], 404);
        }

        $fileContent = $this->disk->get($file->path);
        $mimeType = $this->detectMimeType($file->path);

        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . basename($file->path) . '"');
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
