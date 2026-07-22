<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('proyecto', [ProyectoController::class, 'index']);
Route::get('proyecto/{id}', [ProyectoController::class, 'show']);
Route::post('proyecto', [ProyectoController::class, 'store']);
Route::put('proyecto/{id}', [ProyectoController::class, 'update']);
Route::delete('proyecto/{id}', [ProyectoController::class, 'destroy']);
