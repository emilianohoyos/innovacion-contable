<?php

namespace App\Http\Controllers\Api;

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
use App\Http\Controllers\Controller;
use App\Models\ClientContactInfo;
use App\Models\EmployeeClient;
use App\Providers\GraphTokenService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ApplicationController extends Controller
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
        $rules = [
            'apply_type_id' => 'required|exists:apply_types,id',
            'observation' => 'nullable|string',
            'file' => 'nullable|array',
            // 'attachments' => 'nullable|array'
        ];

        $applyTypes = ApplyType::with('applyDocumentTypes')->find($request->apply_type_id);
        // Obtener solo los IDs
        $documentTypeIds = $applyTypes->applyDocumentTypes->pluck('id')->toArray();


        $validator = Validator::make($request->all(), $rules);

        $user = auth('api')->user();
        $userId = $user->id;
        // Obtener el ID del cliente desde el usuario autenticado
        if ($userId) {
            $client_id = ClientContactInfo::where('user_id', $userId)
                ->value('client_id');
        } else {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $fechaActual = Carbon::now();
        $employee_id = EmployeeClient::where('client_id', $client_id)->pluck('employee_id')->first();
        try {
            $apply = Application::create(
                [
                    'created_by' =>  $userId,
                    'apply_type_id' => $applyTypes->id,
                    'client_id' => $client_id,
                    'estimated_delevery_date' => $fechaActual->addDays($applyTypes->estimated_days),
                    'priority' => $applyTypes->priority,
                    'employee_id' => $employee_id,
                    'observations' => $validatedData['observation'],
                    'application_date' => now(),
                    'state_id' => 1,
                ]
            );

            HistoryState::create([
                'state_id' => 1,
                'user_id' => $userId,
                'application_id' => $apply->id,
                'changed_at' => now()
            ]);

            foreach ($documentTypeIds as $id) {
                $groupKey = "document_{$id}";

                // Verificar si existe el grupo de documentos en 'files'
                if (isset($request->input('files')[$groupKey])) {
                    // Procesar cada archivo dentro del grupo
                    foreach ($request->input('files')[$groupKey] as $attachment) {
                        // Limpiar y decodificar Base64
                        $base64String = preg_replace('/^data:[^;]+;base64,/', '', $attachment['fileBase64']);
                        $decodedData = base64_decode($base64String, true);

                        if ($decodedData === false) {
                            return response()->json([
                                "status" => false,
                                "message" => "Error al decodificar el archivo base64 en el grupo {$groupKey}."
                            ], 400);
                        }

                        // Sanitizar el nombre del archivo
                        $fileName = $this->sanitizeFilename($attachment['name']);
                        $filePath = "applications/{$apply->id}/{$id}/";
                        $fullPath = $filePath . $fileName;


                        // Guardar el archivo
                        $this->disk->put($fullPath, $decodedData);

                        // Registrar en la base de datos
                        Attachment::create([
                            'application_id' => $apply->id,
                            'apply_document_type_id' => $id,
                            'url' => $fullPath,
                            'filename' => $fileName,
                            'attachment_type' => '' // Añadir tipo si es necesario
                        ]);
                    }
                }
            }

            return response()->json([
                "status" => true,
                'message' => 'Se ha Creado la solicitud.'
            ], 200); //
        } catch (\Throwable $th) {
            Log::error('Error al procesar archivos', [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString() // Opcional: solo para ambientes de desarrollo
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Error interno al procesar los archivos.',
                'error_details' => env('APP_DEBUG') ? $th->getMessage() : null // Mostrar detalles solo en desarrollo
            ], 500);
        }
    }

    private function sanitizeFilename($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $name = Str::slug(pathinfo($filename, PATHINFO_FILENAME));
        return "{$name}.{$extension}";
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
        $user = auth('api')->user();
        $userId = $user->id;
        // Obtener el ID del cliente desde el usuario autenticado
        if ($userId) {
            $client_id = ClientContactInfo::where('user_id', $userId)
                ->value('client_id');
        } else {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $application = Application::with(['applyType', 'attachments.applyDocumentType', 'state'])->where('client_id', $client_id)->get();
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

    public function cancelApplication(Request $request)
    {
        $rules = [
            'application_id' => 'required|exists:applications,id',
            'reason' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $validatedData = $validator->validated();

        $application = Application::find($validatedData['application_id']);
        if (!$application) {
            return response()->json(['message' => 'Solicitud no encontrada'], 404);
        }

        // Cambiar el estado de la solicitud a cancelada
        $application->state_id = 5; // Asumiendo que el ID 5 es para "Cancelada"
        $application->observations = $validatedData['reason'];
        $application->save();

        // Registrar el motivo de la cancelación
        HistoryState::create([
            'state_id' => 5,
            'user_id' => auth('api')->user()->id,
            'application_id' => $application->id,
            'changed_at' => now(),
            'observation' => $validatedData['reason']

        ]);

        return response()->json(['message' => 'Solicitud cancelada exitosamente'], 200);
    }
}
