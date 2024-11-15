<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyDocumentTypeController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();


// Define a group of routes with 'auth' middleware applied
Route::middleware(['auth'])->group(function () {
    // Define a GET route for the root URL ('/')
    Route::get('/', function () {
        // Return a view named 'index' when accessing the root URL
        return view('index');
    });

    // Define a GET route with dynamic placeholders for route parameters


    Route::resource('applytype', ApplyTypeController::class);
    Route::resource('applydocumenttype', ApplyDocumentTypeController::class);
    Route::resource('client', ClientController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('application', ApplicationController::class);

    // Route::get('{routeName}/{name?}', [HomeController::class, 'pageView']);
});
