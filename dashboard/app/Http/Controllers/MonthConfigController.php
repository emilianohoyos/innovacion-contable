<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\MonthConfig;

use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('month.index');
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
        $tableData = $request->input('table');

        foreach ($tableData as $row) {
            $monthConfig = MonthConfig::updateOrCreate(
                ['year' => $row['year'], 'month' => $row['month']],
                ['end_date' => $row['end_date']]
            );
        }
        if ($monthConfig->wasRecentlyCreated) {
            // $this->createMonthly($monthConfig->year);
        }

        return response()->json([
            'status' => true,
            'message' => 'Año, mes y fecha limite registrados exitosamente',
        ], 201);
    }

    // public function createMonthly($year)
    // {
    //     $clients = Client::select('id')->get();
    //     $months = MonthConfig::where('year', $year)->get();
    //     $data = [];
    //     foreach ($clients as $client) {
    //         $years = MonthlyAccounting::select('year')
    //             ->where('client_id', $client->id)
    //             ->distinct()
    //             ->pluck('year');
    //         if ($years->isEmpty() || !$years->contains($year)) {

    //             foreach ($months as $item) {
    //                 $data[] = [
    //                     'year' => $item->year,
    //                     'month' => $item->month,
    //                     'client_id' => $client->id,
    //                     'employee_id' => null, // Ajusta este campo según tu lógica
    //                     'start_date' => Carbon::create($year, $item->month, 1)->startOfMonth(),
    //                     'end_date' => $item->end_date,
    //                     'state' => 'PENDIENTE ASOCIAR EMPLEADO', // Ajusta este valor según tu lógica
    //                     'created_at' => Carbon::now(),
    //                     'updated_at' => Carbon::now(),
    //                 ];
    //             }
    //         }
    //     }
    //     MonthlyAccounting::insert($data);
    //     return true;
    // }

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

    public function showByYear($year)
    { // Obtener el año del query string

        $data = MonthConfig::where('year', $year)
            ->get(['id', 'year', 'month', 'start_date', 'end_date']); // Seleccionar los campos necesarios

        return response()->json($data);
    }
}
