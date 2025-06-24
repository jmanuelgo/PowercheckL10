<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GimnasioController;
use App\Http\Controllers\EntrenadorController;


Route::middleware(['auth', 'role:admin', 'permission:admin.admindashboard'])->get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'role:admin', 'permission:admin.admindashboard'])->group(function () {
    Route::get('/configuración', [AdminController::class, 'edit'])->name('configuracion');
    Route::put('/configuración', [AdminController::class, 'update'])->name('configuracion.update');
});
// Gimnasios
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios'])->get('/gimnasios', [GimnasioController::class, 'index'])->name('gimnasios');
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios.create'])->get('/gimnasios/create', [GimnasioController::class, 'create'])->name('gimnasios.create');
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios.create'])->post('/gimnasios', [GimnasioController::class, 'store'])->name('gimnasios.store');
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios.edit'])->get('/gimnasios/{gimnasio}/edit', [GimnasioController::class, 'edit'])->name('gimnasios.edit');
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios.edit'])->put('/gimnasios/{gimnasio}', [GimnasioController::class, 'update'])->name('gimnasios.update');
Route::middleware(['auth', 'role:admin', 'permission:admin.gimnasios.destroy'])->delete('/gimnasios/{gimnasio}', [GimnasioController::class, 'destroy'])->name('gimnasios.destroy');


// Entrenadores
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores'])->get('/entrenadores', [EntrenadorController::class, 'index'])->name('entrenadores');
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores.create'])->get('/entrenadores/create', [EntrenadorController::class, 'create'])->name('entrenadores.create');
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores.create'])->post('/entrenadores', [EntrenadorController::class, 'store'])->name('entrenadores.store');
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores.edit'])->get('/entrenadores/{entrenador}/edit', [EntrenadorController::class, 'edit'])->name('entrenadores.edit');
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores.edit'])->put('/entrenadores/{entrenador}', [EntrenadorController::class, 'update'])->name('entrenadores.update');
Route::middleware(['auth', 'role:admin', 'permission:admin.entrenadores.destroy'])->delete('/entrenadores/{entrenador}', [EntrenadorController::class, 'destroy'])->name('entrenadores.destroy');

