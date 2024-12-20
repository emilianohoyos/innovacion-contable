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
        return view('employees.index');
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
                'user_id' => 'nullable',
                'job_title' => 'nullable|string|max:50',
                'role' => 'nullable|string|max:50',
                'email' => 'required|email|max:100|unique:employees,email',
            ]);

            // Llamada al método registerUser en RegisterController usando los datos validados
            $user = $this->registerController->create([
                'name' => "{$validatedData['firstname']} {$validatedData['lastname']}",
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['identification']), // Encriptar la contraseña
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

    public function getEmployeesData()
    {
        $employees = Employee::select([
            'document_type_id',
            'employees.identification',
            'employees.id as employee_id',
            'employees.firstname',
            'employees.lastname',
            'employees.cellphone',
            'employees.email',
            'document_types.id'
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
                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                onclick="addFolder(' . $employees->employee_id . ', \'' . addslashes($employees->employee_id) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';
                $btn .= '<button type="button"
            class="btn btn-info raised d-inline-flex align-items-center justify-content-center"
            onclick="addComment(' . $employees->employee_id . ', \'' . addslashes($employees->employee_id) . '\')">
            <i class="material-icons-outlined">comment</i>
        </button>';

                $btn .= '<a href="' . route("client.follow-up", ["client_id" => $employees->employee_id]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                    <i class="material-icons-outlined">visibility</i>
                </a>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }
}
