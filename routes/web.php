<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoWebController;

Route::get('/', function () {
    return redirect()->route('proyectos.index');
});

Route::get('/proyectos', [ProyectoWebController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/crear', [ProyectoWebController::class, 'create'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoWebController::class, 'store'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoWebController::class, 'show'])->name('proyectos.show');
Route::get('/proyectos/{id}/editar', [ProyectoWebController::class, 'edit'])->name('proyectos.edit');
Route::put('/proyectos/{id}', [ProyectoWebController::class, 'update'])->name('proyectos.update');
Route::get('/proyectos/{id}/eliminar', [ProyectoWebController::class, 'confirmarEliminar'])->name('proyectos.confirmarEliminar');
Route::delete('/proyectos/{id}', [ProyectoWebController::class, 'destroy'])->name('proyectos.destroy');
