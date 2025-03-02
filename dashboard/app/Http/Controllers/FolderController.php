<?php

namespace App\Http\Controllers;

use App\Models\ApplyDocTypeFolder;
use App\Models\Folder;
use App\Models\PersonType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = Folder::all();
        return view('folder.index', compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $person_type = PersonType::all();

        return view('folder.create', compact('person_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'periodicity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        Folder::create($validator->validate());

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo de applicacion.'
        ], 200); //
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        //
    }

    public function getFolderData()
    {
        $folders = Folder::select(['id', 'name', 'periodicity']);
        return DataTables::of($folders)
            ->addColumn('acciones', function ($folder) {
                $btn = '<button type="button"
                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                onclick="addApplyDocumentType(' . $folder->id . ', \'' . addslashes($folder->name) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function getRegisteredDocuments($folderId)
    {
        // Obtener los documentos registrados para este tipo de aplicación
        $documents = ApplyDocTypeFolder::where('folder_id', $folderId)
            ->join('apply_document_types', 'apply_doc_type_folders.apply_document_type_id', '=', 'apply_document_types.id')
            ->select('apply_doc_type_folders.id', 'apply_doc_type_folders.apply_document_type_id', 'apply_document_types.name', 'apply_doc_type_folders.is_required')
            ->get();

        return response()->json($documents);
    }

    public function getFolders(Request $request)
    {
        $search = $request->get('q'); // Toma el parámetro de búsqueda
        $query = Folder::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $folders = $query->get(['id', 'name']);

        return response()->json($folders);
    }
}
