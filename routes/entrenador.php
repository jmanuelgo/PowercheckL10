<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\LoginEntrenadorController;
use App\Http\Controllers\AtletaController;

Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.entrenadordashboard'])->get('/dashboard', [LoginEntrenadorController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas'])->get('/atletas', [AtletaController::class, 'index'])->name('atletas');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas.create'])->get('/atletas/create', [AtletaController::class, 'create'])->name('atletas.create');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas.create'])->post('/atletas', [AtletaController::class, 'store'])->name('atletas.store');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas.edit'])->get('/atletas/{atleta}/edit', [AtletaController::class, 'edit'])->name('atletas.edit');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas.update'])->put('/atletas/{atleta}', [AtletaController::class, 'update'])->name('atletas.update');
Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.atletas.destroy'])->delete('/atletas/{atleta}', [AtletaController::class, 'destroy'])->name('atletas.destroy');