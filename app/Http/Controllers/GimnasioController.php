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
            ->when(
                $search,
                fn($query) =>
                $query->where('nombre', 'like', '%' . $search . '%')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if ($request->wantsJson()) {
            return response()->json($gimnasios);
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
        //
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
