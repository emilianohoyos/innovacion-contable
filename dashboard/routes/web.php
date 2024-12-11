<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyDocTypeFolderController;
use App\Http\Controllers\ApplyDocumentTypeController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFolderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
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
    Route::get('applytype-data', [ApplyTypeController::class, 'getApplyTypeData'])->name('applytype.data');
    Route::get('/apply-document-types/{applyTypeId}/documents', [ApplyTypeController::class, 'getRegisteredDocuments']);


    Route::resource('applydocumenttype', ApplyDocumentTypeController::class);
    Route::get('/apply-document-types', [ApplyDocumentTypeController::class, 'getApplyDocumentTypes'])->name('apply-document-types');

    Route::resource('apply-types-apply-document-type', ApplyTypesApplyDocumentTypeController::class);

    Route::resource('client', ClientController::class);
    Route::get('/clients-data', [ClientController::class, 'getClientData'])->name('client.data');
    Route::get('/clients/{clientId}/folders', [ClientController::class, 'getRegisteredFolders']);


    Route::resource('employee', EmployeeController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('application', ApplicationController::class);

    Route::resource('folder', FolderController::class);
    Route::get('/folders-data', [FolderController::class, 'getFolderData'])->name('folders.data');
    Route::get('/folders/{folderId}/documents', [FolderController::class, 'getRegisteredDocuments']);
    Route::get('/folders', [FolderController::class, 'getFolders'])->name('folders');

    Route::resource('client-folder', ClientFolderController::class);

    Route::resource('apply-document-type-folder', ApplyDocTypeFolderController::class);


    Route::get('{routeName}/{name?}', [HomeController::class, 'pageView']);
});
