<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplyTypeController;
use App\Http\Controllers\ApplyTypesApplyDocumentTypeController;
use App\Http\Controllers\Auth\AuthController;

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
Route::post('create-application', [ApplicationController::class, 'create']);
Route::post('list-applications', [ApplicationController::class, 'listApplication']);

Route::get('list-apply-types', [ApplyTypeController::class, 'listApplyTypes']);
Route::get('list-apply-types-apply-document-types', [ApplyTypesApplyDocumentTypeController::class, 'listApplyTypesApplyDocumentTypes']);
