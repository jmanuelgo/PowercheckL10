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
<x-sidebar-layout :links="$links" title="Editar Entrenador - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Editar Entrenador</h1>
        <p class="text-sm text-text-primary">Modifica los datos del entrenador seleccionado.</p>
    </x-slot>

    <form method="POST" action="{{ route('admin.entrenadores.update', $entrenador) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow text-black">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $entrenador->user->name) }}" class="w-full rounded border px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold">Apellidos</label>
            <input type="text" name="apellidos" value="{{ old('apellidos', $entrenador->user->apellidos) }}" class="w-full rounded border px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email', $entrenador->user->email) }}" class="w-full rounded border px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold">Celular</label>
            <input type="text" name="celular" value="{{ old('celular', $entrenador->user->celular) }}" class="w-full rounded border px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold">Gimnasio</label>
            <select name="gimnasio_id" class="w-full rounded border px-4 py-2">
                @foreach ($gimnasios as $gimnasio)
                    <option value="{{ $gimnasio->id }}" {{ $entrenador->gimnasio_id == $gimnasio->id ? 'selected' : '' }}>
                        {{ $gimnasio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Especialidad</label>
            <input type="text" name="especialidad" value="{{ old('especialidad', $entrenador->especialidad) }}" class="w-full rounded border px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold">Experiencia</label>
            <textarea name="experiencia" class="w-full rounded border px-4 py-2">{{ old('experiencia', $entrenador->experiencia) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Foto actual</label><br>
            @if ($entrenador->foto)
                <img src="{{ asset('storage/' . $entrenador->foto) }}" alt="Foto del entrenador" class="w-24 h-24 object-cover shadow border rounded-full" width="70" height="70"> 
            @else
                <span class="text-sm text-gray-500">Sin imagen</span>
            @endif
        </div>

        <div>
            <label class="block font-semibold">Cambiar Foto</label>
            <input type="file" name="foto" class="w-full">
        </div>

        <div class="mt-4">
            <button type="submit"
                class="bg-button-color hover:bg-button-hover text-white font-semibold px-4 py-2 rounded-lg transition">
                Guardar cambios
            </button>
            <a href="{{ route('admin.entrenadores') }}" class="ml-4 text-sm text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</x-sidebar-layout>
