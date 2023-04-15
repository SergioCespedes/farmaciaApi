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

//Route::get('/laboratorios', [\App\Http\Controllers\LaboratorioController::class, 'index']);


Route::apiResource('laboratorios', '\App\Http\Controllers\LaboratorioController');
Route::apiResource('usuarios', '\App\Http\Controllers\UsuarioController');
Route::apiResource('productos', '\App\Http\Controllers\ProductoController');
