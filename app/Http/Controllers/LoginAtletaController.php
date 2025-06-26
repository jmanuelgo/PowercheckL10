<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAtletaController extends Controller
{
    public function index()
    {
        return view('atleta.dashboard');
    }
}
