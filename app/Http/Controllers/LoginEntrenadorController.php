<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginEntrenadorController extends Controller
{
    public function index()
    {
        return view('entrenador.dashboard');
    }
}
