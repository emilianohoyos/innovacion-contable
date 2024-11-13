<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('applications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|string',
            'apply_type_id' => 'required|exists:apply_types,id',
            'observations' => 'required|string',
            'application_date' => 'required|date',
            'estimated_delevery_date' => 'required|date',
            'state_id' => 'required|exists:states,id',
            'priority_type_id' => 'required|exists:priority_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        Application::create($validator->validate());

        return response()->json([
            "status" => true,
            'message' => 'Se ha Creado El tipo de applicacion.'
        ], 200); //
    }

    public function edit(string $id)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return response()->json([
            "status" => true,
            'data' => $application
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|string',
            'apply_type_id' => 'required|exists:apply_types,id',
            'observations' => 'required|string',
            'application_date' => 'required|date',
            'estimated_delevery_date' => 'required|date',
            'state_id' => 'required|exists:states,id',
            'priority_type_id' => 'required|exists:priority_types,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $validatedData = $validator->validated();

        $application->created_by = $validatedData['created_by'];
        $application->apply_type_id = $validatedData['apply_type_id'];
        $application->observations = $validatedData['observations'];
        $application->application_date = $validatedData['application_date'];
        $application->estimated_delevery_date = $validatedData['estimated_delevery_date'];
        $application->state_id = $validatedData['state_id'];
        $application->priority_type_id = $validatedData['priority_type_id'];
        $application->save();

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
        $application = Application::find($id);
        if ($application) {
            $application->delete();
            return response()->json([
                "status" => true,
                'message' => 'Se ha Eliminado la solicitud.'
            ], 200); //
        } else {
            echo 'No se encontró el contacto con ID' . $id;
        }
    }

    public function listApplication(Request $request)
    {
        //todo joins relations
        $application = Application::where('created_by', $request->user_id)->get();
        return response()->json([
            "status" => true,
            'data' => $application
        ], 200);
    }
}
