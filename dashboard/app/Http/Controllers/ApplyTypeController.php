<?php

namespace App\Http\Controllers;

use App\Models\ApplyType;
use App\Models\ApplyTypesApplyDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ApplyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applyType = ApplyType::all();
        return view('apply_types.index', compact('applyType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apply_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'estimated_days' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        ApplyType::create($validator->validate());

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo de applicacion.'
        ], 200); //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyType $applyType)
    {
        return response()->json([
            "status" => true,
            'data' => $applyType
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
    public function update(Request $request, ApplyType $applyType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'estimated_days' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $applyType->name = $validatedData['name'];
        $applyType->estimated_days = $validatedData['estimated_days'];
        $applyType->save();

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
        $applyType = ApplyType::find($id);
        if ($applyType) {
            $applyType->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la informacion del Proveedor.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }

    public function getApplyTypeData()
    {
        $applyTypes = ApplyType::select(['id', 'name', 'estimated_days', 'created_at']);
        return DataTables::of($applyTypes)
            ->addColumn('acciones', function ($applyType) {
                $btn = '<button type="button"
                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                onclick="addApplyDocumentType(' . $applyType->id . ', \'' . addslashes($applyType->name) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function getRegisteredDocuments($applyTypeId)
    {
        // Obtener los documentos registrados para este tipo de aplicación
        $documents = ApplyTypesApplyDocumentType::where('apply_type_id', $applyTypeId)
            ->join('apply_document_types', 'apply_types_apply_document_types.apply_document_type_id', '=', 'apply_document_types.id')
            ->select('apply_types_apply_document_types.id', 'apply_types_apply_document_types.apply_document_type_id', 'apply_document_types.name', 'apply_types_apply_document_types.is_required')
            ->get();

        return response()->json($documents);
    }
}
