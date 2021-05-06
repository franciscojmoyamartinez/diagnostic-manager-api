<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('patients', [PatientController::class, 'index']);
Route::get('patients/{patient}', [PatientController::class, 'show']);
Route::post('patients', [PatientController::class, 'store']);
Route::put('patients/{patient}', [PatientController::class, 'update']);
Route::delete('patients/{patient}', [PatientController::class, 'delete']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
