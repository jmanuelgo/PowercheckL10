<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Gimnasio;
use Illuminate\Validation\Rule;

class EntrenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $entrenadores = Entrenador::with(['user', 'gimnasio']) // Cargar ambas relaciones
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        if ($request->ajax()) {
            return view('admin.partials.table_entrenadores', compact('entrenadores'))->render();
        }

        return view('admin.entrenadores', compact('entrenadores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gimnasios = Gimnasio::orderBy('nombre')->get();

        return view('admin.create_entrenador', compact('gimnasios'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'apellidos' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:20',
            'gimnasio_id' => 'required|exists:gimnasios,id',
            'especialidad' => 'nullable|string',
            'experiencia' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // 1. Generar contraseña aleatoria
        $password = Str::random(8);

        // 2. Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'apellidos' => $request->apellidos,
            'password' => Hash::make($password),
            'celular' => $request->celular,
        ]);

        $user->assignRole('entrenador');

        // 3. Manejar la imagen
        $foto = null;
        if ($request->hasFile('foto')) {
            $filename = 'entrenador_' . time() . '.' . $request->foto->extension();
            $foto = $request->foto->storeAs('entrenadores_fotos', $filename, 'public');
        }

        // 4. Crear perfil de entrenador
        Entrenador::create([
            'user_id' => $user->id,
            'gimnasio_id' => $request->gimnasio_id,
            'especialidad' => $request->especialidad,
            'experiencia' => $request->experiencia,
            'foto' => $foto,
        ]);

        // 5. Mostrar la contraseña generada al admin
        return redirect()
            ->route('admin.entrenadores')
            ->with('success', 'Entrenador creado exitosamente. Contraseña: ' . $password);
    }


    /**
     * Display the specified resource.
     */
    public function show(Entrenador $entrenador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrenador $entrenador)
    {
        return view('admin.edit_entrenador', [
            'entrenador' => $entrenador,
            'gimnasios' => Gimnasio::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Entrenador $entrenador)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users')->ignore($entrenador->user_id)],
        'apellidos' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:20',
        'gimnasio_id' => 'required|exists:gimnasios,id',
        'especialidad' => 'nullable|string',
        'experiencia' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    $user = $entrenador->user;

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'apellidos' => $request->apellidos,
        'celular' => $request->celular,
    ]);

    // Actualizar imagen si hay nueva
    if ($request->hasFile('foto')) {
        if ($entrenador->foto && Storage::disk('public')->exists($entrenador->foto)) {
            Storage::disk('public')->delete($entrenador->foto);
        }

        $filename = 'entrenador_' . time() . '.' . $request->foto->extension();
        $path = $request->foto->storeAs('entrenadores_fotos', $filename, 'public');
        $entrenador->foto = $path;
    }

    $entrenador->gimnasio_id = $request->gimnasio_id;
    $entrenador->especialidad = $request->especialidad;
    $entrenador->experiencia = $request->experiencia;
    $entrenador->save();

    return redirect()->route('admin.entrenadores')->with('success', 'Entrenador actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrenador $entrenador)
    {
        // Eliminar foto si existe
        if ($entrenador->foto && Storage::disk('public')->exists($entrenador->foto)) {
            Storage::disk('public')->delete($entrenador->foto);
        }

        // Eliminar usuario asociado
        $user = $entrenador->user;
        $user->delete();

        // Eliminar perfil de entrenador
        $entrenador->delete();

        return redirect()->route('admin.entrenadores')->with('success', 'Entrenador eliminado correctamente.');
    }
}
