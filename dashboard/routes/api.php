<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientFolderController;
use App\Http\Controllers\MonthlyAccountingFolderApplyDocTypeFolderController;
use App\Http\Controllers\MonthlyAccountingFolderController;
use App\Models\ClientFolder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:api'])->group(function () {
    Route::post('create-application', [ApplicationController::class, 'create']);
    Route::post('list-applications', [ApplicationController::class, 'listApplication']);

    Route::get('list-apply-types', [ApplyTypeController::class, 'listApplyTypes']);
    Route::post('list-apply-types-apply-document-types', [ApplyTypesApplyDocumentTypeController::class, 'listApplyTypesApplyDocumentTypes']);


    //listar folders del cliente y por cada folder los documentos requeridos, indicar si tiene anexos y la fecha limita
    Route::get('client-folder', [ClientFolderController::class, 'index']);

    Route::post('monthly-accounting-folder', [MonthlyAccountingFolderController::class, 'store']);

    Route::post('attachments', [MonthlyAccountingFolderApplyDocTypeFolderController::class, 'store']);
});
