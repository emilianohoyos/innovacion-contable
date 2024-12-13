<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAccounting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientFollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($client_id)
    {
        // Actualizar la lista de años después de la inserción
        $years = MonthlyAccounting::select('year')
            ->where('client_id', $client_id)
            ->distinct()
            ->pluck('year');
        return view('clients.follow-up.index', compact('years', 'client_id'));
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
    public function getClientFollowData($client_id, $year,)
    {
        $clients = MonthlyAccounting::Select('year', 'month', 'end_date', 'state')
            ->where('client_id', $client_id)
            ->where('year', $year);
        return DataTables::of($clients)
            ->editColumn('month', function ($client) {
                $months = [
                    1 => "Enero",
                    2 => "Febrero",
                    3 => "Marzo",
                    4 => "Abril",
                    5 => "Mayo",
                    6 => "Junio",
                    7 => "Julio",
                    8 => "Agosto",
                    9 => "Septiembre",
                    10 => "Octubre",
                    11 => "Noviembre",
                    12 => "Diciembre"
                ];
                return $months[$client->month] ?? 'Mes desconocido'; // Si el mes no está definido
            })
            ->addColumn('acciones', function ($client) {
                $btn = '<button type="button"
                class="btn btn-primary raised d-inline-flex align-items-center justify-content-center"
                onclick="addFolder(' . $client->year . ', \'' . addslashes($client->year) . '\')">
                <i class="material-icons-outlined">add</i>
            </button>';
                $btn .= '<a href="' . route("client.follow-up", ["client_id" => $client->year]) . '" class="btn btn-warning raised d-inline-flex align-items-center justify-content-center ">
                    <i class="material-icons-outlined">visibility</i>
                </a>';

                return  $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }
}
