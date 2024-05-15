<?php

use App\Http\Controllers\Api\ResultatsController;
use App\Http\Controllers\Api\CriterisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MatriculaController;
use App\Http\Controllers\Api\AutoavaluacioApi;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('ResultatsController', ResultatsController::class);

Route::apiResource('CriterisController', CriterisController::class);

Route::apiResource('MatriculaController', MatriculaController::class);

Route::apiResource('AutoavaluacioApi', AutoavaluacioApi::class);

Route::get('AutoavaluacioApi/modulos/{id}', [AutoavaluacioApi::class, 'modulos']);

Route::get('AutoavaluacioApi/ra/{id}', [AutoavaluacioApi::class, 'ra']);










