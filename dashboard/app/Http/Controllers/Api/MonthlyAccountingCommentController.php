<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonthlyAccountingComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonthlyAccountingCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth('api')->user();

        $userId = $user->id;

        // Obtener el ID del cliente desde el usuario autenticado
        if (!$userId) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $query = MonthlyAccountingComment::where('monthly_accounting_folder_id', $request->monthly_accounting_folder_id)->get();

        if ($query) {
            return response()->json([
                'message' => 'comentarios obtenidos correctamente',
                'comments' => $query
            ]);
        }

        return response()->json(['error' => 'no hay comentarios'], 401);
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
                'monthly_accounting_folder_id' => 'required',
                'user_type' => 'required',
                'comment' => 'required'
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
        $user_id =  auth('api')->user()->pluck('id')->first();

        MonthlyAccountingComment::create([
            'user_id' => $user_id,
            'user_type' => $validatedData['user_type'],
            'monthly_accounting_folder_id' => $validatedData['monthly_accounting_folder_id'],
            'comment' => $validatedData['comment'],
        ]);
        return response()->json([
            "status" => true,
            'message' => 'Se ha registrado correctamente.',
        ], 200);
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
