<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $userId = $user->id;
        $userRol = $user->rol;
        $total_solicitudes = Application::where('employee_id', $userId)->count();
        $total_solicitudes_pendientes = Application::where('employee_id', $userId)->whereIn('state_id', [1, 2])->count();
        $total_solicitudes_atendidas = Application::where('employee_id', $userId)->whereIn('state_id', [4])->count();
        $total_solicitudes_canceladas = Application::where('employee_id', $userId)->whereIn('state_id', [4])->count();
        $applications = Application::select([
            'applications.id as application_id',
            'apply_types.name as apply_type_name',
            'company_name',
            'estimated_delevery_date',
            'applications.priority',
            'states.name as state_name',
            'states.id as state_id',
            'applications.created_at',

            // DB::raw("CONCAT(employees.firstname, ' ', employees.lastname) as employee")
        ])
            ->join('apply_types', 'applications.apply_type_id', '=', 'apply_types.id')
            ->join('clients', 'applications.client_id', '=', 'clients.id')
            ->join('employees', 'applications.employee_id', '=', 'employees.id')
            ->join(
                'states',
                'applications.state_id',
                '=',
                'states.id'
            )->whereIn('state_id', [1, 2, 3]);
        if (!$userRol === 'admin') {
            $applications->where('applications.employee_id', $userId);
        }

        $applications = $applications->get();

        return view('dashboard.index', compact('total_solicitudes', 'total_solicitudes_pendientes', 'total_solicitudes_atendidas', 'total_solicitudes_canceladas', 'applications'));
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
        //
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
