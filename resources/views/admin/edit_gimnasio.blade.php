<?php
$links = [
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0H5a2 2 0 01-2-2v-4m16 0a2 2 0 012 2v4a2 2 0 01-2 2h-6" />
        </svg>',
    ],
    [
        'name' => 'Gimnasios',
        'url' => route('admin.gimnasios'),
        'active' => request()->routeIs('admin.gimnasios*'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2M3 13h2l.894 2.236a2 2 0 001.788 1.264H8M21 13h-2l-.894 2.236a2 2 0 01-1.788 1.264H16" />
        </svg>',
    ],
    [
        'name' => 'Entrenadores',
        'url' => route('admin.entrenadores'),
        'active' => request()->routeIs('admin.entrenadores*'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.953 9.953 0 0112 15c2.21 0 4.248.713 5.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
        </svg>',
    ],
];
?>
<x-sidebar-layout :links="$links" title="Editar Gimnasio - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Editar Gimnasio</h1>
        <p class="text-sm text-text-primary">Modifica los datos del gimnasio.</p>
    </x-slot>

    <form action="{{ route('admin.gimnasios.update', $gimnasio) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow text-black">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $gimnasio->nombre) }}" required class="w-full border px-4 py-2 rounded" />
        </div>

        <div class="mb-4">
            <label for="ubicacion" class="block text-sm font-medium">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion', $gimnasio->ubicacion) }}" required class="w-full border px-4 py-2 rounded" />
        </div>

        <div class="mb-4">
            <label for="celular" class="block text-sm font-medium">Celular</label>
            <input type="text" name="celular" id="celular" value="{{ old('celular', $gimnasio->celular) }}" required class="w-full border px-4 py-2 rounded" />
        </div>

        <div class="mb-4">
            <label for="logo" class="block text-sm font-medium">Logo (opcional)</label>
            <input type="file" name="logo" id="logo" class="w-full border px-4 py-2 rounded" />
            @if($gimnasio->logo)
                <p class="mt-2 text-sm">Logo actual:</p>
                <img src="{{ asset('storage/' . $gimnasio->logo) }}" alt="Logo actual" class="h-16 mt-1">
            @endif
        </div>
                    <a href="{{ route('admin.gimnasios') }}"
               class="px-4 py-2 bg-zinc-600 hover:bg-zinc-700 text-black rounded mr-2">Cancelar</a>
        <button type="submit" class="btn-colorprimary">Actualizar Gimnasio</button>
    </form>
</x-sidebar-layout>
