<?php

namespace App\Http\Controllers;

use App\Models\Gimnasio;
use Illuminate\Http\Request;

class GimnasioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $search = $request->query('search');

    $gimnasios = Gimnasio::query()
        ->when($search, fn($query) =>
            $query->where('nombre', 'like', '%' . $search . '%')
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    if ($request->ajax()) {
        return view('admin.partials.table_gimnasios', compact('gimnasios'))->render();
    }

    return view('admin.gimnasios', compact('gimnasios'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_gimnasio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'celular' => 'required|string|max:20',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $path;
    }

    Gimnasio::create($validated);

    return redirect()->route('admin.gimnasios')->with('success', 'Gimnasio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gimnasio $gimnasio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gimnasio $gimnasio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gimnasio $gimnasio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gimnasio $gimnasio)
    {
        //
    }
}
