<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAccountingComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonthlyAccountingCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user_id =  auth()->user()->clients()->pluck('id')->first();
        MonthlyAccountingComment::create([]);
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
