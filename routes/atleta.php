<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtletaController;
use App\Http\Controllers\LoginAtletaController;

Route::middleware(['auth', 'role:atleta', 'permission:atleta.atletadashboard'])->get('/dashboard', [LoginAtletaController::class, 'index'])->name('dashboard');