<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrenadorController;

Route::middleware(['auth', 'role:entrenador', 'permission:entrenador.entrenadordashboard'])->get('/dashboard', [EntrenadorController::class, 'index'])->name('entrenador.dashboard');