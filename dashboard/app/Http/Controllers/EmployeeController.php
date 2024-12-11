<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\DocumentType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
}
