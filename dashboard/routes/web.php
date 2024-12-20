<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyDocTypeFolderController;
use App\Http\Controllers\ApplyDocumentTypeController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFolderController;
use App\Http\Controllers\ClientFollowUpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonthConfigController;

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

Route::post('/upload-onedrive', [HomeController::class, 'saveFile'])->name('upload.onedrive');
Route::get('/upload-onedrive', [HomeController::class, 'testOneDrive']);
Route::get('/download', [HomeController::class, 'downloadFromOneDrive']);



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

    Route::get('/clients-follow-up/{client_id}', [ClientFollowUpController::class, 'index'])->name('client.follow-up');
    Route::get('/clients-follow-up/{clientId}/{year}', [ClientFollowUpController::class, 'getClientFollowData']);

    Route::resource('employee', EmployeeController::class);
    Route::get('/employee-data', [EmployeeController::class, 'getEmployeesData'])->name('employees.data');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('application', ApplicationController::class);

    Route::resource('folder', FolderController::class);
    Route::get('/folders-data', [FolderController::class, 'getFolderData'])->name('folders.data');
    Route::get('/folders/{folderId}/documents', [FolderController::class, 'getRegisteredDocuments']);
    Route::get('/folders', [FolderController::class, 'getFolders'])->name('folders');
    Route::resource('client-folder', ClientFolderController::class);

    Route::resource('month', MonthConfigController::class);
    Route::get('/month-by-year/{year}', [MonthConfigController::class, 'showByYear']);

    Route::resource('apply-document-type-folder', ApplyDocTypeFolderController::class);


    Route::get('{routeName}/{name?}', [HomeController::class, 'pageView']);
});
