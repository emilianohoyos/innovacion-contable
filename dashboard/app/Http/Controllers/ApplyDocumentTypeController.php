<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocumentType;
use App\Models\ApplyType;
use App\Models\ApplyTypesApplyDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applyDocumentType = ApplyDocumentType::select('apply_document_types.id', 'apply_document_types.name as document_type', 'apply_types_apply_document_types.is_required', 'apply_types.name as apply_type')
            ->join('apply_types_apply_document_types', 'apply_document_types.id', 'apply_types_apply_document_types.apply_document_type_id')
            ->join('apply_types', 'apply_types_apply_document_types.apply_type_id', 'apply_types.id')
            ->get();

        return view('apply_document_types.index', compact('applyDocumentType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $applyType = ApplyType::all();
        return view('apply_document_types.create', compact('applyType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'apply_type_id' => 'required|string',
            'is_required' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validate();
        $applyDocumentType = ApplyDocumentType::firstOrCreate(
            ['name' => $validatedData['name']]
        );

        ApplyTypesApplyDocumentType::create([
            'apply_type_id' => $validatedData['apply_type_id'],
            'apply_document_type_id' => $applyDocumentType['id'],
            'is_required' => $validatedData['is_required']
        ]);

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo docuemnto aplicacion.'
        ], 200); //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyDocumentType $applyDocumentType)
    {
        return response()->json([
            "status" => true,
            'data' => $applyDocumentType
        ], 200);
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
    public function update(Request $request, ApplyDocumentType $applyDocumentType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $applyDocumentType->name = $validatedData['name'];
        $applyDocumentType->estimated_days = $validatedData['estimated_days'];
        $applyDocumentType->save();

        return response()->json([
            "status" => true,
            'message' => 'Se ha Editado el tipo de documento de aplicacion.'
        ], 200); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $applyDocumentType = ApplyDocumentType::find($id);
        if ($applyDocumentType) {
            $applyDocumentType->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la informacion de tipo de documento de la aplicacion.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }
}
