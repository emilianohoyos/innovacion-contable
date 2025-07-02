<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplyType;
use App\Models\Attachment;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Employee;
use App\Models\HistoryState;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = State::all();
        $employee = Employee::all();
        return view('applications.index', compact('status', 'employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $applyTypes = ApplyType::all();
        $clients = Client::all();
        $employees = Employee::all();

        return view('applications.create', compact('applyTypes', 'clients', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $applyTypes = ApplyType::with('applyDocumentTypes')->find($request->apply_type_id);
        // Obtener solo los IDs
        $documentTypeIds = $applyTypes->applyDocumentTypes->pluck('id')->toArray();

        $rules = [
            'apply_type_id' => 'required|exists:apply_types,id',
            'client_id' => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'observation' => 'nullable|string',
            'estimated_delevery_date' => 'required|date',
            'priority' => 'required',
            'file' => 'nullable|array',
            // 'attachments' => 'nullable|array'
        ];

        foreach ($documentTypeIds as $id) {
            $rules["document_{$id}"] = 'nullable|array';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();
        // $attachments = $validatedData['attachments'];
        // unset($validatedData['attachments']);


        $apply = Application::create(
            [
                'created_by' => Auth::user()->id,
                'apply_type_id' => $validatedData['apply_type_id'],
                'client_id' => $validatedData['client_id'],
                'estimated_delevery_date' => $validatedData['estimated_delevery_date'],
                'priority' => $validatedData['priority'],
                'employee_id' => $validatedData['employee_id'],
                'observations' => $validatedData['observation'],
                'application_date' => now(),
                'state_id' => 1,
            ]
        );

        HistoryState::create([
            'state_id' => 1,
            'user_id' => Auth::user()->id,
            'application_id' => $apply->id,
            'changed_at' => now()
        ]);
        // if ($request->has('attachments')) {
        //     foreach ($attachments as $attach) {
        //         $AtachId = Attachment::create([
        //             'application_id' => $apply->id,
        //             'apply_document_type_id' => $attach->apply_document_type_id ? $attach->apply_document_type_id : null,
        //             'another_document_type' => $attach->another_document_type ? $attach->another_document_type : null,
        //             'attachment_type' => $attach->attachment_type ? $attach->attachment_type : null,
        //         ]);

        //         $file = $this->decodeBase64($attach->base64);

        //         // Generar un nombre único para la imagen
        //         $fileName = uniqid() . '.' . $file['extension'];

        //         // Guardar la imagen en el almacenamiento público (public/storage/property_photos)
        //         $path = Storage::disk('public')->put("applications/{$apply->id}/{$fileName}", $file['file']);
        //         if ($path) {
        //             // Construir la URL o ruta relativa manualmente
        //             $fullPath = Storage::url("applications/{$apply->id}/{$file}");
        //         } else {
        //             return response()->json(["status" => false, 'message' => 'Error al guardar el archivo'], 500);
        //         }
        //         $AtachId->url = $fullPath;
        //         $AtachId->save();
        //     }
        // }

        foreach ($documentTypeIds as $id) {
            if ($request->hasFile("document_{$id}")) {
                foreach ($request->file("document_{$id}") as $file) {
                    // Obtener el nombre original del archivo
                    $originalName = $file->getClientOriginalName();

                    // Guardar el archivo con su nombre original
                    $filePath = $file->storeAs("applications/{$apply->id}/{$id}/", $originalName, 'public');

                    // Crear el registro en la base de datos
                    Attachment::create([
                        'application_id' => $apply->id,
                        'apply_document_type_id' => $id,
                        'url' => $filePath,
                        'attachment_type' => ''
                    ]);
                }
            }
        }

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado la solicitud.'
        ], 200); //
    }

    public function edit(string $id)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show($application_id)
    {
        $application = Application::with('attachments')
            ->select([
                'applications.id as application_id',
                'apply_types.name as apply_type_name',
                'nit',
                'company_name',
                'estimated_delevery_date',
                'applications.priority',
                'states.name as state_name',
                'states.id as state_id',
                'applications.employee_id',
                'applications.observations',
                'applications.created_at',
                DB::raw("CONCAT(employees.firstname, ' ', employees.lastname) as employee")
            ])
            ->join('apply_types', 'applications.apply_type_id', '=', 'apply_types.id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('states', 'applications.state_id', '=', 'states.id')
            ->join('employee_clients', 'clients.id', '=', 'employee_clients.client_id')
            ->join('employees', 'employee_clients.employee_id', '=', 'employees.id')
            ->where('applications.id', $application_id) // En lugar de find()
            ->first(); //

        $attachments = Attachment::with('applyDocumentType')->where('application_id', $application_id)->get();

        return response()->json([
            "status" => true,
            'data' => $application,
            'attachment' => $attachments
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
        $application = Application::where('created_by', $validatedData['user_id'])->get();
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

    public function getApplicationDatatable()
    {
        // dd('entro');
        $application = Application::select([
            'applications.id as application_id',
            'apply_types.name as apply_type_name',
            'company_name',
            'estimated_delevery_date',
            'applications.priority',
            'states.name as state_name',
            'states.id as state_id',
            'applications.created_at',

            DB::raw("CONCAT(employees.firstname, ' ', employees.lastname) as employee")
        ])
            ->join('apply_types', 'applications.apply_type_id', '=', 'apply_types.id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('employees', 'applications.employee_id', '=', 'employees.id')
            ->join(
                'states',
                'applications.state_id',
                '=',
                'states.id'
            );
        return DataTables::of($application)
            ->addColumn('dias_transcurridos', function ($application) {
                $dias = Carbon::parse($application->estimated_delevery_date)->diffInDays($application->created_at, false);
                return max(0, $dias);
            })
            ->addColumn('acciones', function ($application) {
                $btn = "  <button type='button'
                                            class='btn btn-primary raised d-inline-flex align-items-center justify-content-center'
                                            onClick='seeApplicationModal($application->application_id)'>
                                            <i class='material-icons-outlined'>visibility</i>
                                        </button>";
                $btn .= "<button type='button'
                                            class='btn btn-light raised d-inline-flex align-items-center justify-content-center'
                                            onClick='commentsModal($application->application_id)'>
                                            <i class='material-icons-outlined'>add_comment</i>
                                        </button>";
                // dd($application->state_id === 4);
                if (!$application->state_id === 5 || !$application->state_id === 4) {
                    $btn .= "<button  type='button'
                                        class='btn btn-info raised d-inline-flex align-items-center justify-content-center'
                                        onClick='statusModal($application->application_id)'>
                                        <i class='material-icons-outlined'>sync</i>
                                    </button>";
                }
                $btn .= "<button  type='button'
                class='btn btn-warning raised d-inline-flex align-items-center justify-content-center'
                onClick='employeeModal($application->application_id)'>
                <i class='material-icons-outlined'>swap_horiz</i>
            </button>";

                $btn .= '<button type="button" onclick="confirmDelete()"
                                            class="btn btn-danger raised d-inline-flex align-items-center justify-content-center">
                                            <i class="material-icons-outlined">delete</i>
                                        </button>';
                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }



    public function getClientComments($application_id)
    {
        $comments = Comment::where('application_id', $application_id)
            ->with('createdBy:id,name') // Incluye solo el ID y nombre del autor
            ->get();

        // Formatea los datos para incluir "author"
        $formattedComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'description' => $comment->description,
                'created_at' => $comment->created_at,
                'author' => $comment->createdBy ? $comment->createdBy->name : null, // Obtén el nombre del autor
            ];
        });

        return response()->json($formattedComments);
    }

    public function saveClientComment($application_id)
    {

        $comments = Comment::create([
            'application_id' => $application_id,
            'description' => request('comment'),
            'created_by' => auth()->user()->id,
        ]);


        return response()->json([
            'status' => 'true',
            'message' => 'Comentario guardado exitosamente',
        ], 200);
    }

    public function updateStatus(Request $request, $application_id)
    {
        $apply = Application::find($application_id);
        $apply->state_id = $request->state_id;
        $apply->save();

        HistoryState::create([
            'state_id' => $request->state_id,
            'user_id' => Auth::user()->id,
            'application_id' => $apply->id,
            'changed_at' => now()
        ]);

        return response()->json(
            [
                'message' => 'Se ha actualizado el estado'
            ],
            200
        );
    }

    public function updateEmployee(Request $request, $application_id)
    {
        $apply = Application::find($application_id);
        $apply->employee_id = $request->employee_id;
        $apply->save();

        return response()->json(
            [
                'message' => 'Se ha actualizado el empleado'
            ],
            200
        );
    }
}
