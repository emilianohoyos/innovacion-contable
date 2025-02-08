<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\StoreClientRequest;
use App\Models\ApplyDocTypeFolder;
use App\Models\Client;
use App\Models\ClientContactInfo;
use App\Models\ClientFolder;
use App\Models\ClientResponsible;
use App\Models\ClientsComment;
use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\EmployeeClient;
use App\Models\Folder;
use App\Models\MonthConfig;
use App\Models\MonthlyAccounting;
use App\Models\MonthlyAccountingFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
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

            $client = Client::create([
                'person_type_id' => $validatedData['person_type_id'],
                'document_type_id' => $validatedData['document_type_id'],
                'nit' => $validatedData['nit'],
                'company_name' => $validatedData['company_name'],
                'address' => $validatedData['address'],
                'observation' => $validatedData['observation'] ?? null,
                'email' => $validatedData['email_company'],
                'category' => $validatedData['category'],
                'review' => $validatedData['review'],
            ]);

            ClientResponsible::create([
                'client_id' =>  $client->id,
                'is_simple_taxation_regime'       => $validatedData['is_simple_taxation_regime'] == "TRUE" ? true : false,
                'simple_taxation_regime_advances' => $validatedData['simple_taxation_regime_advances'] ?? null,
                'simple_taxation_regime_consolidated_annual' => $validatedData['simple_taxation_regime_consolidated_annual'] ?? null,
                'is_industry_commerce' => $validatedData['is_industry_commerce'] == "TRUE" ? true : false,
                'industry_commerce_periodicity' => $validatedData['industry_commerce_periodicity'] ?? null,
                'industry_commerce_places' => isset($validatedData['industry_commerce_places'])
                    ? json_encode($validatedData['industry_commerce_places'], JSON_UNESCAPED_UNICODE)
                    : null,
                'is_industry_commerce_retainer' => $validatedData['is_industry_commerce_retainer'] == "TRUE" ? true : false,
                'industry_commerce_retainer_periodicity' => $validatedData['industry_commerce_retainer_periodicity'] ?? null,
                'industry_commerce_retainer_places' => isset($validatedData['industry_commerce_retainer_places'])
                    ? json_encode($validatedData['industry_commerce_retainer_places'], JSON_UNESCAPED_UNICODE)
                    : null,
                'is_industry_commerce_selfretaining' => $validatedData['is_industry_commerce_selfretaining'] == "TRUE" ? true : false,
                'industry_commerce_selfretaining_periodicity' => $validatedData['industry_commerce_selfretaining_periodicity'] ?? null,
                'industry_commerce_selfretaining_places' => isset($validatedData['industry_commerce_selfretaining_places'])
                    ? json_encode($validatedData['industry_commerce_selfretaining_places'], JSON_UNESCAPED_UNICODE)
                    : null,
                'vat_responsible' => $validatedData['vat_responsible'] == "TRUE" ? true : false,
                'vat_responsible_periodicity' => $validatedData['vat_responsible_periodicity'] ?? null,
                'vat_responsible_observation' => $validatedData['vat_responsible_observation'] ?? null,
                'is_rent' => $validatedData['is_rent'] == "TRUE" ? true : false,
                'rent_periodicity' => $validatedData['rent_periodicity'] ?? null,
                'is_supersociety' => $validatedData['is_supersociety'] == "TRUE" ? true : false,
                'supersociety_periodicity' => $validatedData['supersociety_periodicity'] ?? null,
                'is_supertransport' => $validatedData['is_supertransport'] == "TRUE" ? true : false,
                'supertransport_periodicity' => $validatedData['supertransport_periodicity'] ?? null,
                'is_superfinancial' => $validatedData['is_superfinancial'] == "TRUE" ? true : false,
                'superfinancial_periodicity' => $validatedData['superfinancial_periodicity'] ?? null,
                'is_source_retention' => $validatedData['is_source_retention'] == "TRUE" ? true : false,
                'source_retention_periodicity' => $validatedData['source_retention_periodicity'] ?? null,
                'is_dian_exogenous_information' => $validatedData['is_dian_exogenous_information'] == "TRUE" ? true : false,
                'dian_exogenous_information_periodicity' => $validatedData['dian_exogenous_information_periodicity'] ?? null,
                'is_municipal_exogenous_information' => $validatedData['is_municipal_exogenous_information'] == "TRUE" ? true : false,
                'municipal_exogenous_information_periodicity' => $validatedData['municipal_exogenous_information_periodicity'] ?? null,
                'municipal_exogenous_information_places' => isset($validatedData['municipal_exogenous_information_places'])
                    ? json_encode($validatedData['municipal_exogenous_information_places'], JSON_UNESCAPED_UNICODE)
                    : null,
                'is_wealth_tax' => $validatedData['is_wealth_tax'] == "TRUE" ? true : false,
                'wealth_tax_periodicity' => $validatedData['wealth_tax_periodicity'] ?? null,
                'is_radian' => $validatedData['is_radian'] == "TRUE" ? true : false,
                'radian_periodicity' => $validatedData['radian_periodicity'] ?? null,
                'is_e_payroll' => $validatedData['is_e_payroll'] == "TRUE" ? true : false,
                'e_payroll_periodicity' => $validatedData['e_payroll_periodicity'] ?? null,
                'is_single_registry_final_benefeciaries' => $validatedData['is_single_registry_final_benefeciaries'] == "TRUE" ? true : false,
                'single_registry_final_benefeciaries_periodicity' => $validatedData['single_registry_final_benefeciaries_periodicity'] ?? null,
                'is_renovacion_esal' => $validatedData['is_renovacion_esal'] == "TRUE" ? true : false,
                'renovacion_esal_periodicity' => $validatedData['renovacion_esal_periodicity'] ?? null,
                'is_assets_abroad' => $validatedData['is_assets_abroad'] == "TRUE" ? true : false,
                'assets_abroad_periodicity' => $validatedData['assets_abroad_periodicity'] ?? null,
                'is_single_registry_proposers' => $validatedData['is_single_registry_proposers'] == "TRUE" ? true : false,
                'single_registry_proposers_periodicity' => $validatedData['single_registry_proposers_periodicity'] ?? null,
                'single_registry_proposers_places' => isset($validatedData['single_registry_proposers_places'])
                    ? json_encode($validatedData['single_registry_proposers_places'], JSON_UNESCAPED_UNICODE)
                    : null,
                'is_renewal_commercial_registration' => $validatedData['is_renewal_commercial_registration'] == "TRUE" ? true : false,
                'renewal_commercial_registration_periodicity' => $validatedData['renewal_commercial_registration_periodicity'] ?? null,
                'is_national_tourism_fund' => $validatedData['is_national_tourism_fund'] == "TRUE" ? true : false,
                'national_tourism_fund_periodicity' => $validatedData['national_tourism_fund_periodicity'] ?? null,
                'is_special_tax_regime' => $validatedData['is_special_tax_regime'] == "TRUE" ? true : false,
                'is_national_tourism_registry' => $validatedData['is_national_tourism_registry'] == "TRUE" ? true : false,
                'national_tourism_registry_periodicity' => $validatedData['national_tourism_registry_periodicity'] ?? null,
            ]);


            EmployeeClient::create([
                'client_id' => $client->id,
                'employee_id' => $validatedData['employee_id'],
            ]);



            if ($validatedData['person_type_id'] == 1) {
                $user = $this->registerController->create([
                    'name' => $validatedData['firstname'] . $validatedData['lastname'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make('Innovacion' . Carbon::now()->year),
                ]);
                $client->contactInfo()->create([
                    'firstname' => $validatedData['firstname'],
                    'lastname' => $validatedData['lastname'],
                    'job_title' => $validatedData['job_title'],
                    'email' => $validatedData['email'],
                    'cellphone' => $validatedData['cellphone'],
                    'user_id' => $user->id,
                    'birthday' => $validatedData['birthday'],
                    'observation' => $validatedData['observationContact'],
                    'channel_communication' => json_encode($validatedData['channel_communication']),
                ]);
                $folders = Folder::where('person_type_id', 1)->get();
                foreach ($folders as $folder) {
                    ClientFolder::firstOrCreate([
                        'client_id' => $client->id,
                        'folder_id' => $folder->id,
                    ]);
                }
            } else {
                foreach ($validatedData['contacts'] as $contact) {
                    $user = $this->registerController->create([
                        'name' => $contact['firstname'] . $contact['lastname'],
                        'email' => $contact['email'],
                        'password' => Hash::make('Innovacion' . Carbon::now()->year),
                    ]);
                    $client->contactInfo()->create([
                        'firstname' => $contact['firstname'],
                        'lastname' => $contact['lastname'],
                        'job_title' => $contact['job_title'],
                        'email' => $contact['email'],
                        'cellphone' => $contact['cellphone'],
                        'user_id' => $user->id,
                        'channel_communication' => json_encode($contact['channel_communication']),
                        'observation' => $contact['observationContact'],
                        'birthday' => $contact['birthday'],

                    ]);
                }
            }

            $year = Carbon::now()->year;
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
        $clients = Client::select([
            'clients.id as client_id',
            'nit',
            'company_name',
            'email',
            'address',
            'person_types.name as person_type',
            'document_types.name as document_type'
        ])
            ->join(
                'person_types',
                'clients.person_type_id',
                'person_types.id'
            )
            ->join('employee_clients', 'clients.id', 'employee_clients.client_id')
            ->join('document_types', 'clients.document_type_id', 'document_types.id');
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

                // $btn .= '<a href="' . route("client.follow-up", ["client_id" => $client->client_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                //     <i class="material-icons-outlined">visibility</i>
                // </a>';
                $btn .= '<button type="button"
                class="btn btn-warning raised d-inline-flex align-items-center justify-content-center"
                onclick="seeClient(' . $client->client_id . ')">
                <i class="material-icons-outlined">visibility</i>
            </button>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function indexMyClients()
    {
        return view('my_clients.index');
    }


    public function getClientByEmployeeData()
    {
        $clients = Client::select([
            'clients.id as client_id',
            'nit',
            'company_name',
            'email',
            'address',
            'person_types.name as person_type',
            'document_types.name as document_type'
        ])
            ->join(
                'person_types',
                'clients.person_type_id',
                'person_types.id'
            )
            ->join('employee_clients', 'clients.id', 'employee_clients.client_id')
            ->join('document_types', 'clients.document_type_id', 'document_types.id')
            ->where(function ($query) {
                if (!auth()->user()->rol == 'ADMIN') {
                    $query->where('employee_clients.employee_id', auth()->user()->employee->id);
                }
            });
        return DataTables::of($clients)
            ->addColumn('acciones', function ($client) {
                $date = Carbon::now();
                $btn = '<a href="' . route("client-monthly-folders", ["clientId" => $client->client_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                    <i class="material-icons-outlined">folder</i>
                </a>';
                $btn .= '<button type="button"
                class="btn btn-info raised d-inline-flex align-items-center justify-content-center"
                onclick="seeClient(' . $client->client_id . ')">
                <i class="material-icons-outlined">visibility</i>
            </button>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function getMonthFolders($clientId)
    {

        $current_date = Carbon::now();
        $current_year = $current_date->year;
        $current_month = $current_date->month;

        if ($current_month == 1) {
            $current_month = 12;
            $current_year -= 1;
        }

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
                    ->where('monthly_accountings.month', $current_month);
            })
            ->leftJoin('monthly_accounting_folders', function ($join) {
                $join->on('monthly_accounting_folders.folder_id', '=', 'folders.id')
                    ->on('monthly_accounting_folders.monthly_accounting_id', '=', 'monthly_accountings.id');
            })
            ->where('client_folders.client_id', $clientId)
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
        // dd($folders);
        return view('my_clients.month_folders', compact('folders'));
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

    public function getClientComments($clientId)
    {
        $comments = ClientsComment::where('client_id', $clientId)
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

    public function saveClientComment($clientId)
    {

        $comments = ClientsComment::create([
            'client_id' => $clientId,
            'description' => request('comment'),
            'created_by' => auth()->user()->id,
        ]);


        return response()->json([
            'status' => 'true',
            'message' => 'Comentario guardado exitosamente',
        ], 200);
    }
    public function seeClientData(String $id)
    {
        $client = Client::with(['contactInfo', 'commentsClient', 'documentType', 'personType', 'employees.employee'])->find($id);
        return response()->json($client);
    }
}
