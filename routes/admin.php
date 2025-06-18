<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GimnasioController;
use App\Http\Controllers\EntrenadorController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/gimnasios', [GimnasioController::class, 'index'])->name('gimnasios');
    Route::get('/gimnasios/create', [GimnasioController::class, 'create'])->name('gimnasios.create');
    Route::post('/gimnasios', [GimnasioController::class, 'store'])->name('gimnasios.store');
    Route::get('/gimnasios/{gimnasio}/edit', [GimnasioController::class, 'edit'])->name('gimnasios.edit');
    Route::put('/gimnasios/{gimnasio}', [GimnasioController::class, 'update'])->name('gimnasios.update');
    Route::delete('/gimnasios/{gimnasio}', [GimnasioController::class, 'destroy'])->name('gimnasios.destroy');
    Route::get('/entrenadores', [EntrenadorController::class, 'index'])->name('entrenadores');
});
