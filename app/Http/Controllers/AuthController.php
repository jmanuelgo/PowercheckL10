<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function ShowLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validamos los campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentamos autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirección por rol
            if ($user->hasRole('admin')) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->hasRole('entrenador')) {
                return redirect()->intended('/entrenador/inicio');
            } elseif ($user->hasRole('atleta')) {
                return redirect()->intended('/atleta/perfil');
            }

            // Si no tiene rol
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'error' => 'Este usuario no tiene un rol válido asignado.',
            ]);
        }

        // Fallo de autenticación
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Has cerrado sesión correctamente.');
    }
}
