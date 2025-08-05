<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyDocTypeFolderController;
use App\Http\Controllers\ApplyDocumentTypeController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\BaseLayoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFolderController;
use App\Http\Controllers\ClientFollowUpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonthConfigController;
use App\Http\Controllers\MonthlyAccountingFolderApplyDocTypeFolderController;
use App\Http\Controllers\MonthlyAccountingFolderController;
use App\Models\MonthlyAccountingFolderApplyDocTypeFolder;

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
        return redirect()->route('dashboard.index');
    });

    // Define a GET route with dynamic placeholders for route parameters


    Route::resource('applytype', ApplyTypeController::class);
    Route::get('applytype-data', [ApplyTypeController::class, 'getApplyTypeData'])->name('applytype.data');
    Route::get('/apply-document-types/{applyTypeId}/documents', [ApplyTypeController::class, 'getRegisteredDocuments']);


    Route::resource('applydocumenttype', ApplyDocumentTypeController::class);
    Route::get('/apply-document-types', [ApplyDocumentTypeController::class, 'getApplyDocumentTypes'])->name('apply-document-types');

    Route::resource('apply-types-apply-document-type', ApplyTypesApplyDocumentTypeController::class);

    Route::resource('client', ClientController::class);

    Route::get('client/all/{id}', [ClientController::class, 'seeClientData']);

    Route::get('client/comment/{id}', [ClientController::class, 'getClientComments']);
    Route::post('client/comment/{id}', [ClientController::class, 'saveClientComment']);

    Route::get('/clients-data', [ClientController::class, 'getClientData'])->name('client.data');
    Route::get('/clients-by-employee', [ClientController::class, 'indexMyClients'])->name('client-by-employee.index');
    Route::get('/clients-by-employee-data', [ClientController::class, 'getClientByEmployeeData'])->name('client-by-employee.data');
    Route::get('/clients/{clientId}/folders', [ClientController::class, 'getRegisteredFolders']);

    Route::get('/client-montly-accounting/{clientId}', [ClientController::class, 'getMonthFolders'])->name('client-monthly-accounting');
    Route::get('/client-montly-accounting-data/{clientId}', [ClientController::class, 'getMonthFoldersData'])->name('client-monthly-accounting-data');

    // Ruta para activar/desactivar carpeta mensual
    Route::post('/monthly-accounting-folder/toggle-status/{id}', [ClientController::class, 'toggleMonthFolderStatus'])->name('monthly-accounting-folder.toggle-status');
    Route::get('monthly-accounting-folder/comment/{id}', [ClientController::class, 'getMonthlyAccountingComments']);
    Route::post('monthly-accounting-folder/comment/{id}', [ClientController::class, 'saveMonthlyAccountingComment']);

    Route::get('monthly-accounting-folder/doctype/{id}', [ClientController::class, 'documentTypeFolder']);

    Route::get('/monthly-accounting-folder/{monthlyAccountingFolderId}/documents', [ClientController::class, 'getDocumentsByMonthlyAccountingFolder']);

    Route::get('/clients-follow-up/{client_id}', [ClientFollowUpController::class, 'index'])->name('client.follow-up');
    Route::get('/clients-follow-up/{clientId}/{year}', [ClientFollowUpController::class, 'getClientFollowData']);


    Route::resource('employee', EmployeeController::class);
    Route::post('employee/disable/{id}', [EmployeeController::class, 'disableEmployee']);
    Route::post('employee/active/{id}', [EmployeeController::class, 'activeEmployee']);
    Route::get('/employee-data', [EmployeeController::class, 'getEmployeesData'])->name('employees.data');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('application', ApplicationController::class);
    Route::get('/application-datatable', [ApplicationController::class, 'getApplicationDatatable'])->name('application.datatable');

    Route::get('application/comment/{id}', [ApplicationController::class, 'getClientComments']);
    Route::post('application/comment/{id}', [ApplicationController::class, 'saveClientComment']);
    Route::post('application/state/{id}', [ApplicationController::class, 'updateStatus']);
    Route::post('application/employee/{id}', [ApplicationController::class, 'updateEmployee']);
    Route::post('/application/finalize/{id}', [ApplicationController::class, 'finalize']);

    Route::resource('folder', FolderController::class);
    Route::get('/folders-data', [FolderController::class, 'getFolderData'])->name('folders.data');
    Route::get('/folders/{folderId}/documents', [FolderController::class, 'getRegisteredDocuments']);
    Route::get('/folders', [FolderController::class, 'getFolders'])->name('folders');
    Route::resource('client-folder', ClientFolderController::class);

    Route::resource('month', MonthConfigController::class);
    Route::get('/month-by-year/{year}', [MonthConfigController::class, 'showByYear']);

    Route::resource('apply-document-type-folder', ApplyDocTypeFolderController::class);
    Route::get('{routeName}/{name?}', [BaseLayoutController::class, 'pageView']);

    //descarga de archivos
    Route::post('monthly-accounting-folder-file', [MonthlyAccountingFolderApplyDocTypeFolderController::class, 'downloadFromOneDrive'])->name('file.download');

    // Descarga de archivos adjuntos de solicitudes
    Route::get('/application/download/{path}', [ApplicationController::class, 'downloadAttachment'])
        ->where('path', '.*')
        ->name('application.download');
});
