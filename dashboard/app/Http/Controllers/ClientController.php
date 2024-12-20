<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\ClientContactInfo;
use App\Models\ClientFolder;
use App\Models\ClientsComment;
use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\EmployeeClient;
use App\Models\Folder;
use App\Models\MonthConfig;
use App\Models\PersonType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected RegisterController $registerController,
        protected MonthConfigController $monthConfigController,
    ) {}
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $person_type = PersonType::all();
        $document_type = DocumentType::all();
        $employees = Employee::select('id', 'firstname', 'lastname')->get();

        return view('clients.create', compact('person_type', 'document_type', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();

        $client = DB::transaction(function () use ($validatedData) {
            $user = $this->registerController->create([
                'name' => $validatedData['company_name'],
                'email' => $validatedData['email_company'],
                'password' => Hash::make($validatedData['nit']),
            ]);

            $client = Client::create([
                'person_type_id' => $validatedData['person_type_id'],
                'document_type_id' => $validatedData['document_type_id'],
                'user_id' => $user->id,
                'nit' => $validatedData['nit'],
                'company_name' => $validatedData['company_name'],
                'address' => $validatedData['address'],
                'vat_responsible' => $validatedData['vat_responsible'] ?? false,
                'is_selfretaining' => $validatedData['is_selfretaining'] ?? false,
                'is_simple_taxation_regime' => $validatedData['is_simple_taxation_regime'] ?? false,
                'is_ica_withholding_agent' => $validatedData['is_ica_withholding_agent'] ?? false,
                'municipality_ica_withholding_agent' => $validatedData['municipality_ica_withholding_agent'] ?? null,
                'is_ica_selfretaining_agent' => $validatedData['is_ica_selfretaining_agent'] ?? false,
                'municipality_ica_selfretaining_agent' => $validatedData['municipality_ica_selfretaining_agent'] ?? null,
                'observation' => $validatedData['observation'] ?? null,
                'email' => $validatedData['email_company']
            ]);
            if (isset($validatedData['employee_id']) && is_array($validatedData['employee_id'])) {
                $employees = array_map(fn($id) => ['employee_id' => $id], $validatedData['employee_id']);
                $client->employees()->createMany($employees);
            }
            if ($validatedData['person_type_id'] == 1) {
                $client->contactInfo()->create([
                    'firstname' => $validatedData['firstname'],
                    'lastname' => $validatedData['lastname'],
                    'job_title' => $validatedData['job_title'],
                    'email' => $validatedData['email'],
                    'cellphone' => $validatedData['cellphone'],
                ]);
            } else {
                $client->contactInfo()->createMany($validatedData['contacts']);
            }

            $year = Carbon::now()->year();
            $this->monthConfigController->createMonthly($year);

            return $client;
        });

        return response()->json([
            'status' => true,
            'message' => 'Cliente y usuario registrados exitosamente',
            'data' => $client->load('contactInfo'),
        ], 201);
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

    public function getClientData()
    {
        $clients = Client::select(['clients.id as client_id', 'nit', 'company_name', 'email', 'person_types.name as person_type'])
            ->join(
                'person_types',
                'clients.person_type_id',
                'person_types.id'
            );
        return DataTables::of($clients)
            ->addColumn('acciones', function ($client) {
                $btn = '<button type="button"
                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                onclick="addFolder(' . $client->client_id . ', \'' . addslashes($client->company_name) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';
                $btn .= '<button type="button"
            class="btn btn-info raised d-inline-flex align-items-center justify-content-center"
            onclick="addComment(' . $client->client_id . ', \'' . addslashes($client->company_name) . '\')">
            <i class="material-icons-outlined">comment</i>
        </button>';

                $btn .= '<a href="' . route("client.follow-up", ["client_id" => $client->client_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                    <i class="material-icons-outlined">visibility</i>
                </a>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function getRegisteredFolders($clientId)
    {
        // Obtener los documentos registrados para este tipo de aplicación
        $documents = ClientFolder::where('client_id', $clientId)
            ->join('folders', 'client_folders.folder_id', '=', 'folders.id')
            ->select('client_folders.id', 'client_folders.folder_id', 'folders.name')
            ->get();

        return response()->json($documents);
    }

    public function storeComment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required',
            'comment' => 'required'
        ]);

        $validatedData = $validate->validate();

        ClientsComment::create([
            'client_id' =>  $validatedData['client_id'],
            'comment' => $validatedData['comment'],
        ]);
    }
}
