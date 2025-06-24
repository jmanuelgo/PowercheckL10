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
<x-sidebar-layout :links="$links" title="Entrenadores - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Gestión de Entrenadores</h1>
        <p class="text-sm text-text-primary">
            Aquí puedes ver todos los entrenadores registrados en la plataforma.
        </p>
    </x-slot>

    <div class="mb-4">
        <input type="text" id="search-entrenador" placeholder="Buscar gimnasio..." class="px-4 py-2 border rounded w-full text-black">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm bg-white text-black rounded shadow">
            <thead class="bg-zinc-800 text-white">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Apellidos</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Celular</th>
                    <th class="px-4 py-2">Gimnasio</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>

            {{-- ESTE DIV CAMBIA VIA AJAX --}}
            <tbody id="entrenador-table">
                @include('admin.partials.table_entrenadores', ['entrenadores' => $entrenadores])
            </tbody>
        </table>
        <div id="entrenador-pagination" class="mt-4">
         {{ $entrenadores->links() }}
        </div>
            <a href="{{ route('admin.entrenadores.create') }}"
       class="bg-button-color hover:bg-button-hover text-white font-semibold px-4 py-2 rounded-lg transition">
        + Nuevo Entrenador
    </a>
    </div>
</x-sidebar-layout>
