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
<x-sidebar-layout :links="$links" title="Nuevo Entrenador - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Registrar Nuevo Entrenador</h1>
        <p class="text-sm text-text-primary">
            Crea una cuenta y perfil para un nuevo entrenador.
        </p>
    </x-slot>

    <form action="{{ route('admin.entrenadores.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white text-black p-6 rounded shadow-md space-y-4 max-w-xl">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nombre completo</label>
            <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label for="apellidos" class="block font-medium">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="w-full border px-4 py-2 rounded" required>

        <div>
            <label for="email" class="block font-medium">Correo electrónico</label>
            <input type="email" name="email" id="email" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label for="telefono" class="block font-medium">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="gimnasio_id" class="block font-medium">Gimnasio asignado</label>
            <select name="gimnasio_id" id="gimnasio_id" class="w-full border px-4 py-2 rounded" required>
                @foreach ($gimnasios as $gimnasio)
                    <option value="{{ $gimnasio->id }}">{{ $gimnasio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="especialidad" class="block font-medium">Especialidad</label>
            <input type="text" name="especialidad" id="especialidad" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="experiencia" class="block font-medium">Experiencia</label>
            <textarea name="experiencia" id="experiencia" rows="4" class="w-full border px-4 py-2 rounded"></textarea>
        </div>

        <div>
            <label for="foto" class="block font-medium">Foto de perfil (opcional)</label>
            <input type="file" name="foto" id="foto" class="w-full">
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="btn-colorprimary hover:bg-button-hover text-white font-bold px-6 py-2 rounded">
                Guardar Entrenador
            </button>
        </div>
    </form>
</x-sidebar-layout>
