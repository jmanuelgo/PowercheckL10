<?php

namespace App\Http\Controllers;

use App\Models\Atleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialPeso;
use App\Models\Gimnasio;
use Illuminate\Support\Str;
use function Laravel\Prompts\search;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AtletaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $entrenador = Auth::user()->entrenador; // obtiene el modelo entrenador asociado al user logueado

        $atletas = Atleta::with(['user', 'gimnasio', 'historialPesos' => function ($query) {
            $query->latest()->limit(1); // solo el último peso
        }])
            ->where('entrenador_id', $entrenador->id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('entrenador.partials.table_atletas', compact('atletas'))->render();
        }

        return view('entrenador.atletas', compact('atletas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('entrenador.create_atleta');
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
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:masculino,femenino',
            'altura' => 'nullable|numeric',
            'peso' => 'required|numeric',
            'estilo_vida' => 'nullable|string',
            'lesiones_previas' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $password = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'apellidos' => $request->apellidos,
            'celular' => $request->celular,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('atleta');

        $foto = null;
        if ($request->hasFile('foto')) {
            $filename = 'atleta_' . time() . '.' . $request->foto->extension();
            $foto = $request->foto->storeAs('atletas_fotos', $filename, 'public');
        }

        $entrenador = Auth::user()->entrenador;

        $atleta = Atleta::create([
            'user_id' => $user->id,
            'entrenador_id' => $entrenador->id,
            'gimnasio_id' => $entrenador->gimnasio_id,
            'foto' => $foto,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
            'altura' => $request->altura,
            'estilo_vida' => $request->estilo_vida,
            'lesiones_previas' => $request->lesiones_previas,
        ]);
        HistorialPeso::create([
            'atleta_id' => $atleta->id,
            'peso' => $request->peso,
        ]);

        return redirect()->route('entrenador.atletas')->with('success', 'Atleta registrado. Contraseña: ' . $password);
    }


    /**
     * Display the specified resource.
     */
    public function show(Atleta $atleta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atleta $atleta)
    {
        $atleta->load('user'); // Cargar el usuario asociado al atleta
        $gimnasios = Gimnasio::all(); // Obtener todos los gimnasios para el select

        return view('entrenador.edit_atleta', compact('atleta', 'gimnasios'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'apellidos' => 'nullable|string|max:255',
        'celular' => 'nullable|string|max:20',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|in:masculino,femenino',
        'altura' => 'nullable|numeric',
        'estilo_vida' => 'nullable|string',
        'lesiones_previas' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    // Obtener el atleta
    $atleta = Atleta::findOrFail($id);
    $user = $atleta->user;

    // Actualizar usuario
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'apellidos' => $request->apellidos,
        'celular' => $request->celular,
    ]);

    // Actualizar los demás campos del atleta
    $atleta->update([
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'genero' => $request->genero,
        'altura' => $request->altura,
        'estilo_vida' => $request->estilo_vida,
        'lesiones_previas' => $request->lesiones_previas,
    ]);

    // Subir nueva foto si se seleccionó
    if ($request->hasFile('foto')) {
        $filename = 'atleta_' . time() . '.' . $request->foto->extension();
        $foto = $request->foto->storeAs('atletas_fotos', $filename, 'public');
        $atleta->update(['foto' => $foto]);
    }

    return redirect()->route('entrenador.atletas')->with('success', 'Atleta actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atleta $atleta)
    {
        // Eliminar la foto del atleta si existe
        if ($atleta->foto) {
            Storage::disk('public')->delete($atleta->foto);
        }

        // Eliminar el usuario asociado al atleta
        $user = $atleta->user;
        $user->delete();

        // Eliminar el atleta
        $atleta->delete();

        return redirect()->route('entrenador.atletas')->with('success', 'Atleta eliminado correctamente.');
    }
}
