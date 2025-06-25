<?php
$links = [
    [
        'name' => 'Dashboard',
        'url' => route('entrenador.dashboard'),
        'active' => request()->routeIs('entrenador.dashboard'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0H5a2 2 0 01-2-2v-4m16 0a2 2 0 012 2v4a2 2 0 01-2 2h-6" />
        </svg>',
    ],
    [
        'name' => 'Atletas',
        'url' => route('entrenador.atletas'),
        'active' => request()->routeIs('entrenador.atletas.*'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21.17 15.17A4.001 4.001 0 0018.83 9H5.17a4.001 4.001 0 00-2.34 6.17l1.41-1.41A2.001 2.001 0 015.17 11h13.66a2.001 2.001 0 011.41.59l1.41-1.41zM12 20a8.003 8.003 0 01-7.94-7H20a8.003 8.003 0 01-7.94 7z" />
        </svg>',
    ],
];
?>
<x-sidebar-layout :links="$links" title="Dashboard - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Nuevo Atleta</h1>
        <p class="text-sm text-text-primary">Completa los datos para registrar un nuevo atleta.</p>
    </x-slot>

    <form action="{{ route('entrenador.atletas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-black">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-text-primary">Nombre</label>
                <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-text-primary">Correo</label>
                <input type="email" name="email" id="email" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label for="apellidos" class="block text-sm font-medium text-text-primary">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="celular" class="block text-sm font-medium text-text-primary">Celular</label>
                <input type="text" name="celular" id="celular" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="fecha_nacimiento" class="block text-sm font-medium text-text-primary">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label for="genero" class="block text-sm font-medium text-text-primary">Género</label>
                <select name="genero" id="genero" class="w-full border px-3 py-2 rounded">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
            <div>
                <label for="altura" class="block text-sm font-medium text-text-primary">Altura (en metros)</label>
                <input type="number" step="0.01" name="altura" id="altura" class="w-full border px-3 py-2 rounded">
            </div>
                        <div class="md:col-span-2 text-text-primary">
                <label for="peso" class="block text-sm font-medium">Peso Inicial (kg)</label>
                <input type="number" name="peso" id="peso" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label for="estilo_vida" class="block text-sm font-medium text-text-primary">Estilo de Vida</label>
                <input type="text" name="estilo_vida" id="estilo_vida" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="md:col-span-2">
                <label for="lesiones_previas" class="block text-sm font-medium text-text-primary">Lesiones Previas</label>
                <textarea name="lesiones_previas" id="lesiones_previas" class="w-full border px-3 py-2 rounded" rows="3"></textarea>
            </div>
            <div class="md:col-span-2">
                <label for="foto" class="block text-sm font-medium text-text-primary">Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*" class="w-full border px-3 py-2 rounded">
            </div>
        </div>

        <button type="submit" class="bg-button-color hover:bg-button-hover text-white font-semibold px-6 py-2 rounded-lg">
            Registrar Atleta
        </button>
    </form>
</x-sidebar-layout>
