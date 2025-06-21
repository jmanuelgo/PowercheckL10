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
<x-sidebar-layout :links="$links" title="Crear gimnasio - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Crear Nuevo Gimnasio</h1>
        <p class="text-sm text-text-primary">
            Completa el formulario para registrar un nuevo gimnasio en la plataforma.
        </p>
    </x-slot>

    <form action="{{ route('admin.gimnasios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow text-black">
        @csrf

        <div>
            <label for="nombre" class="block font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                   class="w-full border rounded px-4 py-2 mt-1">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ubicacion" class="block font-medium">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}" required
                   class="w-full border rounded px-4 py-2 mt-1">
            @error('ubicacion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="celular" class="block font-medium">Celular</label>
            <input type="text" name="celular" id="celular" value="{{ old('celular') }}" required
                   class="w-full border rounded px-4 py-2 mt-1">
            @error('celular')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
    <label for="logo" class="block font-medium">Logo del Gimnasio</label>
    <input type="file" name="logo" id="logo"
           class="w-full border rounded px-4 py-2 mt-1 bg-white text-black">
    @error('logo')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

        <div class="flex justify-end">
            <a href="{{ route('admin.gimnasios') }}"
               class="px-4 py-2 bg-zinc-600 hover:bg-zinc-700 text-white rounded mr-2">Cancelar</a>
            <button type="submit" class="bg-button-color hover:bg-button-hover text-black font-semibold px-4 py-2 rounded">
                Guardar
            </button>
        </div>
    </form>
</x-sidebar-layout>