<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('applications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|string',
            'apply_type_id' => 'required|exists:apply_types,id',
            'observations' => 'required|string',
            'application_date' => 'required|date',
            'estimated_delevery_date' => 'required|date',
            'state_id' => 'required|exists:states,id',
            'priority_type_id' => 'required|exists:priority_types,id',
            'attachments' => 'required|array'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();
        $attachments = $validatedData['attachments'];
        unset($validatedData['attachments']);


        $apply = Application::create($validatedData);
        if ($request->has('attachments')) {
            foreach ($attachments as $attach) {
                $AtachId = Attachment::create([
                    'application_id' => $apply->id,
                    'apply_document_type_id' => $attach->apply_document_type_id ? $attach->apply_document_type_id : null,
                    'another_document_type' => $attach->another_document_type ? $attach->another_document_type : null,
                    'attachment_type' => $attach->attachment_type ? $attach->attachment_type : null,
                ]);

                $file = $this->decodeBase64($attach->base64);

                // Generar un nombre único para la imagen
                $fileName = uniqid() . '.' . $file['extension'];

                // Guardar la imagen en el almacenamiento público (public/storage/property_photos)
                $path = Storage::disk('public')->put("applications/{$apply->id}/{$fileName}", $file['file']);
                if ($path) {
                    // Construir la URL o ruta relativa manualmente
                    $fullPath = Storage::url("applications/{$apply->id}/{$file}");
                } else {
                    return response()->json(["status" => false, 'message' => 'Error al guardar el archivo'], 500);
                }
                $AtachId->url = $fullPath;
                $AtachId->save();
            }
        }
        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo de applicacion.'
        ], 200); //
    }

    public function edit(string $id)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return response()->json([
            "status" => true,
            'data' => $application
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|string',
            'apply_type_id' => 'required|exists:apply_types,id',
            'observations' => 'required|string',
            'application_date' => 'required|date',
            'estimated_delevery_date' => 'required|date',
            'state_id' => 'required|exists:states,id',
            'priority_type_id' => 'required|exists:priority_types,id',
            'attachments' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $application->created_by = $validatedData['created_by'];
        $application->apply_type_id = $validatedData['apply_type_id'];
        $application->observations = $validatedData['observations'];
        $application->application_date = $validatedData['application_date'];
        $application->estimated_delevery_date = $validatedData['estimated_delevery_date'];
        $application->state_id = $validatedData['state_id'];
        $application->priority_type_id = $validatedData['priority_type_id'];
        $application->save();

        return response()->json([
            "status" => true,
            'message' => 'Se ha Editado el tipo de aplicacion.'
        ], 200); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        if ($application) {
            $application->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la solicitud.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }

    public function listApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();
        //todo joins relations
        $application = Application::where('created_by', [])->get();
        return response()->json([
            "status" => true,
            'data' => $application
        ], 200);
    }

    private function decodeBase64($base64)
    {
        // Dividir la cadena base64 para obtener el tipo y los datos de la imagen
        @list($type, $fileData) = explode(';', $base64);
        @list(, $fileData) = explode(',', $fileData);

        // Obtener la extensión del archivo
        $extension = explode('/', mime_content_type($base64))[1];

        // Decodificar los datos de la imagen
        $file = base64_decode($fileData);

        return ['file' => $file, 'extension' => $extension];
    }
}
