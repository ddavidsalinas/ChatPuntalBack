<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('v1/usuario', App\Http\Controllers\Api\V1\UserController::class);
Route::apiResource('v1/rol', App\Http\Controllers\Api\V1\RoleController::class);
Route::apiResource('v1/transito', App\Http\Controllers\Api\V1\TransitController::class);
Route::apiResource('v1/administrativo', App\Http\Controllers\Api\V1\AdministrativeController::class);
Route::apiResource('v1/plazaBase', App\Http\Controllers\Api\V1\BaseBerthController::class);
Route::apiResource('v1/guardiaCivil', App\Http\Controllers\Api\V1\CivilGuardController::class);
Route::apiResource('v1/concesionario', App\Http\Controllers\Api\V1\ConcessionaireController::class);
Route::apiResource('v1/tripulante', App\Http\Controllers\Api\V1\CrewController::class);
Route::apiResource('v1/plaza', App\Http\Controllers\Api\V1\DockController::class);
Route::apiResource('v1/guardamuelles', App\Http\Controllers\Api\V1\DockWorkerController::class);
Route::apiResource('v1/instalacion', App\Http\Controllers\Api\V1\FacilityController::class);
Route::apiResource('v1/incidencia', App\Http\Controllers\Api\V1\IncidentController::class);




