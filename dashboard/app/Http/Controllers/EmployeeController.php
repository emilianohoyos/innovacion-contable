<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\DocumentType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function __construct(protected RegisterController $registerController) {}
    public function index()
    {
        $document_type = DocumentType::all();
        return view('employees.index', compact('document_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $document_type = DocumentType::all();
        return view('employees.create', compact('document_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'document_type_id' => 'required',
                'identification' => 'required|string|max:20',
                'firstname' => 'required|string|max:50',
                'lastname' => 'required|string|max:50',
                'cellphone' => 'required|string|max:15',
                'emergency_contact_name' => 'nullable',
                'emergency_contact_phone' => 'nullable',
                'emergency_contact_address' => 'nullable',
                'profession' => 'nullable',
                'profession_description' => 'nullable',
                'observation' => 'nullable',
                'user_id' => 'nullable',
                'job_title' => 'nullable|string|max:50',
                'role' => 'nullable|string|max:50',
                'email' => 'required|email|max:100',
            ]);

            $password = 'Innovacion' . date('Y');
            // Llamada al método registerUser en RegisterController usando los datos validados
            $user = $this->registerController->create([
                'name' => "{$validatedData['firstname']} {$validatedData['lastname']}",
                'email' => $validatedData['email'],
                'username' => $validatedData['identification'],
                'rol' => 'employee',
                'password' => $password, // Encriptar la contraseña
            ]);

            // Asignar el `user_id` generado al array validado
            $validatedData['user_id'] = $user->id;

            // Crear el empleado
            Employee::create($validatedData);

            return response()->json(['message' => 'Empleado y usuario registrados exitosamente'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Devolver errores de validación en formato JSON
            return response()->json([
                'errors' => $e->validator->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Employee::find($id);
        return response()->json(['status' => true, 'data' => $data], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'document_type_id' => 'required',
            'nit' => 'required|string|max:20',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'cellphone' => 'required|string|max:15',
            'job_title' => 'nullable|string|max:50',
            'emergency_contact_name' => 'nullable',
            'emergency_contact_phone' => 'nullable',
            'emergency_contact_address' => 'nullable',
            'profession' => 'nullable',
            'profession_description' => 'nullable',
            'observation' => 'nullable',
            'role' => 'nullable|string|max:50',
            'email' => 'required|email|max:100|unique:employees,email,' . $employee->id,
        ]);

        $employee->update([
            'document_type_id' => $validatedData['document_type_id'],
            'identification' => $validatedData['nit'],
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'cellphone' => $validatedData['cellphone'],
            'job_title' => $validatedData['job_title'],
            'emergency_contact_name' => $validatedData['emergency_contact_name'],
            'emergency_contact_phone' => $validatedData['emergency_contact_phone'],
            'emergency_contact_address' => $validatedData['emergency_contact_address'],
            'profession' => $validatedData['profession'],
            'profession_description' => $validatedData['profession_description'],
            'observation' => $validatedData['observation'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
        ]);
        return response()->json(['status' => true, 'message' => 'Empleado actualizado exitosamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getEmployeesData()
    {
        $employees = Employee::select([
            'document_types.name as document_type',
            'employees.identification',
            'employees.id as employee_id',
            'employees.firstname',
            'employees.lastname',
            'employees.cellphone',
            'employees.active',
            'employees.email',
            'employees.emergency_contact_name',
            'employees.emergency_contact_phone',
            'employees.emergency_contact_address',
            'employees.profession',
            'employees.profession_description',
            'employees.observation',
            'document_types.id',
            'document_types.name'
        ])
            ->join(
                'document_types',
                'employees.document_type_id',
                'document_types.id'
            );
        return DataTables::of($employees)
            ->addColumn('name', function ($employees) {
                return $employees->firstname . ' ' . $employees->lastname;
            })
            ->addColumn('acciones', function ($employees) {
                $btn = '<button type="button"
                class="btn btn-warning raised d-inline-flex align-items-center justify-content-center"
                onclick="editEmployee(' . $employees->employee_id . ')">
                <i class="material-icons-outlined">edit</i>
            </button>';
                if ($employees->active == 0) {
                    $btn .= '<button type="button"
                    class="btn btn-success raised d-inline-flex align-items-center justify-content-center"
                    onclick="activeEmployee(' . $employees->employee_id . ')">
                    <i class="material-icons-outlined">check_circle</i> Activar
                </button>';
                } else {
                    $btn .= '<button type="button"
                    class="btn btn-danger raised d-inline-flex align-items-center justify-content-center"
                    onclick="disableEmployee(' . $employees->employee_id . ')">
                    <i class="material-icons-outlined">block</i> Desactivar
                </button>';
                }

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function disableEmployee(string $id)
    {
        $employee = Employee::find($id);
        $employee->active = false;
        $employee->save();
        return response()->json(['status' => true, 'message' => 'Empleado desactivado exitosamente'], 200);
    }

    public function activeEmployee(string $id)
    {
        $employee = Employee::find($id);
        $employee->active = true;
        $employee->save();
        return response()->json(['status' => true, 'message' => 'Empleado activado exitosamente'], 200);
    }
}
