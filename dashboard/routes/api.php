<?php

use App\Http\Controllers\Api\ClientFolderController;
use App\Http\Controllers\Api\MonthlyAccountingCommentController;
use App\Http\Controllers\Api\MonthlyAccountingFolderController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ApplyTypeController;
use App\Http\Controllers\Api\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\MonthlyAccountingFolderApplyDocTypeFolderController;
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

Route::get('/application/download/{path}', [\App\Http\Controllers\ApplicationController::class, 'downloadAttachment'])
->where('path', '.*')
->name('application.download');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth.jwt'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);


    Route::post('create-application', [ApplicationController::class, 'store']);
    Route::get('list-applications', [ApplicationController::class, 'listApplication']);
    Route::post('cancel-application', [ApplicationController::class, 'cancelApplication']);

    Route::post('list-comments', [CommentController::class, 'listComments']);
    Route::post('create-comment', [CommentController::class, 'store']);

    Route::get('list-apply-types', [ApplyTypeController::class, 'listApplyTypes']);
    Route::post('list-apply-types-apply-document-types', [ApplyTypesApplyDocumentTypeController::class, 'listApplyTypesApplyDocumentTypes']); 




    //listar folders del cliente y por cada folder los documentos requeridos, indicar si tiene anexos y la fecha limita
    Route::get('client-folder', [ClientFolderController::class, 'index']);

    Route::post('monthly-accounting-folder', [MonthlyAccountingFolderController::class, 'index']);

    Route::post('monthly-accounting-comment', [MonthlyAccountingCommentController::class, 'index']);
    Route::post('monthly-accounting-comment/store', [MonthlyAccountingCommentController::class, 'store']);

    Route::post('attachments', [MonthlyAccountingFolderApplyDocTypeFolderController::class, 'store']);
});
