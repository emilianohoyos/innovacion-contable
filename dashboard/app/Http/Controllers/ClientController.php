<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\ApplyDocTypeFolder;
use App\Models\ApplyType;
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
use App\Models\MonthlyAccountingComment;
use App\Models\MonthlyAccountingFolder;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;
use App\Models\PersonType;
use App\Models\User;
use App\Providers\GraphTokenService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    protected $disk;
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected RegisterController $registerController,
        protected MonthConfigController $monthConfigController,
        GraphTokenService $oneDriveService
    ) {

        $this->disk = Storage::build([
            'driver' => config('filesystems.disks.onedrive.driver'),
            'root' => config('filesystems.disks.onedrive.root'),
            'directory_type' => config('filesystems.disks.onedrive.directory_type'),
            'access_token' => $oneDriveService->getAccessToken()
        ]);
    }

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
        $folders = Folder::all();
        $employees = Employee::select('id', 'firstname', 'lastname')->get();

        return view('clients.create', compact('person_type', 'document_type', 'employees', 'folders'));
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
                'supertransport_observation' => $validatedData['supertransport_observation'] ?? null,
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

            foreach ($validatedData['folders'] as $folder) {
                ClientFolder::create([
                    'client_id' => $client->id,
                    'folder_id' => $folder['folder_id'],
                ]);
            }



            if ($validatedData['person_type_id'] == 1) {
                $password = 'Innovacion' . date('Y');
                $user = $this->registerController->create([
                    'name' => $validatedData['firstname'] . $validatedData['lastname'],
                    'email' => $validatedData['email'],
                    'username' => $validatedData['identification'],
                    'password' => $password,
                    'rol' => 'client'
                ]);
                $client->contactInfo()->create([
                    'document_type_id' => $validatedData['contact_document_type_id'],
                    'identification' => $validatedData['identification'],
                    'firstname' => $validatedData['firstname'],
                    'lastname' => $validatedData['lastname'],
                    'job_title' => $validatedData['job_title'],
                    'email' => $validatedData['email'],
                    'cellphone' => $validatedData['cellphone'],
                    'user_id' => $user->id,
                    'birthday' => $validatedData['birthday'],
                    'observation' => $validatedData['observationContact'],
                    'channel_communication' => $validatedData['channel_communication'],
                ]);
            } else {
                foreach ($validatedData['contacts'] as $contact) {
                    $user = $this->registerController->create([
                        'name' => $contact['firstname'] . $contact['lastname'],
                        'email' => $contact['email'],
                        'username' => $contact['identification'],
                        'password' => 'Innovacion' . date('Y'),
                        'rol' => 'client'
                    ]);
                    $client->contactInfo()->create([
                        'document_type_id' => $contact['contact_document_type_id'],
                        'identification' => $contact['identification'],
                        'firstname' => $contact['firstname'],
                        'lastname' => $contact['lastname'],
                        'job_title' => $contact['job_title'],
                        'email' => $contact['email'],
                        'cellphone' => $contact['cellphone'],
                        'user_id' => $user->id,
                        'channel_communication' => $contact['channel_communication'],
                        'observation' => $contact['observationContact'],
                        'birthday' => $contact['birthday'],

                    ]);
                }
            }

            $year = Carbon::now()->year;
            // $this->monthConfigController->createMonthly($year);

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
        $client_id = $id;
        $person_type = PersonType::all();
        $document_type = DocumentType::all();
        $employees = Employee::select('id', 'firstname', 'lastname')->get();

        return view('clients.edit', compact('person_type', 'document_type', 'employees', 'client_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validatedData = $request->validated();
        $client->update([
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

        ClientResponsible::updateOrCreate([
            'client_id' =>  $client->id,
            'id' => $validatedData['client_responsible_id'],
        ], [
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
            'supertransport_observation' => $validatedData['supertransport_observation'] ?? null,
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

        EmployeeClient::find($validatedData['employee_client_id'])->update([
            'client_id' => $client->id,
            'employee_id' => $validatedData['employee_id'],
        ]);

        if ($validatedData['person_type_id'] == 1) {
            $user = User::where('username', $validatedData['identification'])->first();
            if ($user) {
                $user->update([
                    'username' => $validatedData['identification'],
                ]);
            } else {
                $password = 'Innovacion' . date('Y');
                $user = $this->registerController->create([
                    'name' => $validatedData['firstname'] . $validatedData['lastname'],
                    'email' => $validatedData['email'],
                    'username' => $validatedData['identification'],
                    'password' => $password,
                    'rol' => 'client'
                ]);
            }

            $client->contactInfo()->updateOrCreate([
                'client_id' => $client->id,
                'id' => $validatedData['contact_info_id'],
            ], [
                'document_type_id' => $validatedData['contact_document_type_id'],
                'identification' => $validatedData['identification'],
                'firstname' => $validatedData['firstname'],
                'lastname' => $validatedData['lastname'],
                'job_title' => $validatedData['job_title'],
                'email' => $validatedData['email'],
                'cellphone' => $validatedData['cellphone'],
                'user_id' => $user->id,
                'birthday' => $validatedData['birthday'],
                'observation' => $validatedData['observationContact'],
                'channel_communication' => $validatedData['channel_communication'],
            ]);
        } else {
            foreach ($validatedData['contacts'] as $contact) {
                $user = User::where('username', $contact['identification'])->first();

                if ($user) {
                    $user->update([
                        'username' => $contact['identification'],
                    ]);
                } else {
                    $user = $this->registerController->create([
                        'name' => $contact['firstname'] . $contact['lastname'],
                        'email' => $contact['email'],
                        'username' => $contact['identification'],
                        'password' => 'Innovacion' . date('Y'),
                        'rol' => 'client'
                    ]);
                }
                $client->contactInfo()->updateOrCreate([
                    'client_id' => $client->id,
                    'id' => $validatedData['contact_info_id'],
                ], [
                    'document_type_id' => $contact['contact_document_type_id'],
                    'identification' => $contact['identification'],
                    'firstname' => $contact['firstname'],
                    'lastname' => $contact['lastname'],
                    'job_title' => $contact['job_title'],
                    'email' => $contact['email'],
                    'cellphone' => $contact['cellphone'],
                    'user_id' => $user->id,
                    'channel_communication' => $contact['channel_communication'],
                    'observation' => $contact['observationContact'],
                    'birthday' => $contact['birthday'],

                ]);
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'Cliente Editado exitosamente',
        ], 201);
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
            'document_types.name as document_type',
            'client_responsibles.*'
        ])->leftJoin('client_responsibles', 'clients.id', 'client_responsibles.client_id')
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
                class="btn btn-primary btn-sm raised d-inline-flex align-items-center justify-content-center"
                onclick="addFolder(' . $client->client_id . ', \'' . addslashes($client->company_name) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';
                $btn .= '<button type="button"
            class="btn btn-info btn-sm raised d-inline-flex align-items-center justify-content-center"
            onclick="addComment(' . $client->client_id . ', \'' . addslashes($client->company_name) . '\')">
            <i class="material-icons-outlined">comment</i>
        </button>';
                $btn .= '<a href="' . route("client.edit", ["client" => $client->client_id]) . '"
        class="btn btn-success btn-sm raised d-inline-flex align-items-center justify-content-center">
        <i class="material-icons-outlined">edit</i>
    </a>';

                // $btn .= '<a href="' . route("client.follow-up", ["client_id" => $client->client_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                //     <i class="material-icons-outlined">visibility</i>
                // </a>';
                $btn .= '<button type="button"
                class="btn btn-sm btn-warning raised d-inline-flex align-items-center justify-content-center"
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
                $btn = '';
                $btn .= '<button type="button"
                    class="btn btn-info raised d-inline-flex align-items-center justify-content-center"
                    onclick="seeClient(' . $client->client_id . ')"
                    title="Ver cliente"
                    data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="material-icons-outlined">visibility</i>
                </button>
                ';
                $btn .= '<a href="' . route("client-monthly-accounting", ["clientId" => $client->client_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center "
                    title="Contabilidad anual"
                    data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="material-icons-outlined">event_note</i>
                </a>';
                $btn .= '<a href="' . route("client-monthly-accounting", ["clientId" => $client->client_id]) . '" class="btn btn-secondary raised d-inline-flex align-items-center justify-content-center "
                    title="Contabilidad mensual"
                    data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="material-icons-outlined">calendar_month</i>
                </a>';
                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function getMonthFolders($clientId)
    {
        // Obtener años únicos de MonthlyAccountingFolder para este cliente
        $years = MonthlyAccountingFolder::whereHas('clientFolder', function ($query) use ($clientId) {
            $query->where('client_id', $clientId);
        })
            ->selectRaw('DISTINCT year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('my_clients.month_folders', compact('clientId', 'years'));
    }

    public function getMonthFoldersData(Request $request, $clientId)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        // dd($year, $month);
        $query = MonthlyAccountingFolder::with(['clientFolder.folder' => function ($q) {
            $q->where('periodicity', 'MENSUAL');
        }])
            ->whereHas('clientFolder', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            });

        if (!empty($year)) {
            $query->where('year', $year);
        }
        if (!empty($month)) {
            // Asegura que el mes sea integer para evitar problemas de tipo
            $query->where('month_year', (int)$month);
        }

        $data = $query->get()
            ->filter(function ($item) {
                // Omite los que no tengan folder o folder sea null
                return optional($item->clientFolder->folder)->id !== null;
            })
            ->values();

        return DataTables::of($data)
            ->addColumn('acciones', function ($item) {
                $folderName = isset($item->clientFolder) && isset($item->clientFolder->folder) ? addslashes($item->clientFolder->folder->name) : '';
                $btn = '';
                // 1. Inactivar/activar carpeta
                $btn .= '<button type="button"
        class="btn btn-sm ' . ($item->is_active ? 'btn-secondary' : 'btn-light') . ' raised d-inline-flex align-items-center justify-content-center"
        onclick="toggleFolderStatus(' . $item->id . ')"
        title="Activar/Inactivar carpeta"
        data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="material-icons-outlined">' . ($item->is_active ? 'toggle_on' : 'toggle_off') . '</i>
    </button>';
                // 2. Modal de comentarios
                $btn .= '<button type="button"
        class="btn btn-sm btn-info raised d-inline-flex align-items-center justify-content-center"
        onclick="openCommentsModal(' . $item->id . ',\'' . $folderName . '\')"
        title="Comentarios"
        data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="material-icons-outlined">comment</i>
    </button>';
                // 3. Modal de documentos
                $btn .= '<button type="button"
        class="btn btn-sm btn-primary raised d-inline-flex align-items-center justify-content-center"
        onclick="openDocumentsModal(' . $item->id . "," . ')"
        title="Ver documentos"
        data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="material-icons-outlined">folder_open</i>
    </button>';
                // 4. Modal para cargar documentos de respuesta
                $btn .= '<button type="button"
        class="btn btn-sm btn-success raised d-inline-flex align-items-center justify-content-center"
        onclick="openUploadResponseModal(' . $item->id . ')"
        title="Cargar respuesta"
        data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="material-icons-outlined">upload_file</i>
    </button>';
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function toggleMonthFolderStatus($id)
    {
        $folder = MonthlyAccountingFolder::find($id);
        if (!$folder) {
            return response()->json([
                'status' => false,
                'message' => 'Carpeta mensual no encontrada',
            ], 404);
        }

        $folder->is_active = !$folder->is_active;
        $folder->save();

        return response()->json([
            'status' => true,
            'message' => $folder->is_active ? 'Carpeta activada' : 'Carpeta desactivada',
            'is_active' => $folder->is_active,
        ]);
    }

    public function getMonthlyAccountingComments($monthlyAccountingFolderId)
    {
        $comments = MonthlyAccountingComment::where('monthly_accounting_folder_id', $monthlyAccountingFolderId)
            ->with('user:id,name') // Incluye solo el ID y nombre del autor
            ->get();

        // Formatea los datos para incluir "author"
        $formattedComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'description' => $comment->comment,
                'created_at' => $comment->created_at,
                'author' => $comment->user ? $comment->user->name : null, // Obtén el nombre del autor
            ];
        });

        return response()->json($formattedComments);
    }

    public function saveMonthlyAccountingComment($monthlyAccountingFolderId)
    {

        $comments = MonthlyAccountingComment::create([
            'monthly_accounting_folder_id' => $monthlyAccountingFolderId,
            'comment' => request('comment'),
            'user_id' => auth()->user()->id,
            'user_type' => 'Employee'
        ]);


        return response()->json([
            'status' => 'true',
            'message' => 'Comentario guardado exitosamente',
        ], 200);
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
        $client = Client::with(['contactInfo', 'contactInfo.documentType', 'commentsClient.createdBy', 'documentType', 'personType', 'employees.employee', 'clientResponsible', 'folders'])->find($id);
        return response()->json($client);
    }

    /**
     * Retorna los documentos asociados a un monthly_accounting_folder_id
     */
    public function getDocumentsByMonthlyAccountingFolder($monthlyAccountingFolderId)
    {
        $query = MonthlyAccountingFolderApplyDocTypeFolder::with(['applyDocTypeFolders.applyDocumentType'])
            ->where('monthly_accounting_folder_id', $monthlyAccountingFolderId);
        return DataTables::of($query)
            ->addColumn('tipo_documento', function ($doc) {
                return optional($doc->applyDocTypeFolders->applyDocumentType)->name;
            })
            ->addColumn('answer', function ($doc) {
                return $doc->is_new ? 'Sí' : 'No';
            })
            ->addColumn('is_new', function ($doc) {
                return $doc->is_new ? 'Sí' : 'No';
            })
            ->addColumn('status', function ($doc) {
                return $doc->status == 1 ? 'Activo' : 'Inactivo';
            })
            ->addColumn('created_at', function ($doc) {
                return $doc->created_at ? $doc->created_at->format('Y-m-d H:i') : '';
            })
            ->addColumn('path', function ($doc) {
                if ($doc->path) {

                    return  '<a href="' . $doc->path . '" download class="btn btn-sm btn-success ms-1" title="Descargar archivo"><i class="material-icons-outlined">download</i></a>';
                }
                return '';
            })
            ->rawColumns(['path'])
            ->make(true);
    }

    public function documentTypeFolder($monthlyAccountingFolderId)
    {
        $data = MonthlyAccountingFolder::with(['clientFolder.folder.ApplyDocTypeFolders.applyDocumentType'])
            ->where('id', $monthlyAccountingFolderId)
            ->get();

        $applyType = optional($data->first()->clientFolder->folder)->ApplyDocTypeFolders ?? collect();

        $applyType = $applyType->map(function ($item) {
            return [
                'apply_document_type_id' => $item->id,
                'name' => optional($item->applyDocumentType)->name,

            ];
        });
        return response()->json($applyType);
    }

    public function storeMultipleDocuments(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'monthly_accounting_folder_upload_id' => 'required|exists:monthly_accounting_folders,id',
            'documents' => 'required|array|min:1',
            'documents.*.apply_document_type_id' => 'required|exists:apply_doc_type_folders,id',
            'documents.*.file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error en la validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        $monthlyAccountingFolderId = $request->input('monthly_accounting_folder_upload_id');

        $documents = $request->input('documents');
        $saved = [];

        foreach ($documents as $idx => $doc) {
            // if (!isset($doc['apply_document_type_id']) || !$request->file("documents.$idx.file")) continue;

            $typeId = $doc['apply_document_type_id'];
            $file = $request->file("documents.$idx.file");

            // Guardar archivo en storage/app/monthly_accounting/{monthlyAccountingFolderId}/{monthYear}/
            $filePath = "monthly_accounting/{$monthlyAccountingFolderId}/";
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            // Usar el disco personalizado (OneDrive) para guardar el archivo
            $path = $this->disk->putFileAs($filePath, $file, $fileName);

            // Guardar registro en la base de datos
            $record = MonthlyAccountingFolderApplyDocTypeFolder::create([
                'monthly_accounting_folder_id' => $monthlyAccountingFolderId,
                'apply_doc_type_folder_id' => $typeId,
                'answer' => true,
                'is_new' => true,
                'status' => 'PENDIENTE',
                'path' => $filePath . $fileName,
            ]);

            // Actualizar is_new de la carpeta mensual
            MonthlyAccountingFolder::where('id', $monthlyAccountingFolderId)->update(['is_new' => true]);

            $saved[] = [
                'type_id' => $typeId,
                'file' => $file->getClientOriginalName(),
                'path' => $filePath . $fileName,
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'Documentos guardados correctamente',
            'monthly_accounting_folder_id' => $monthlyAccountingFolderId,
            'saved' => $saved,
        ]);
    }
}
