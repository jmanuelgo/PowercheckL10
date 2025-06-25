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
        
        <h1 class="text-2xl font-bold mb-2">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-sm text-text-primary">
            Desde aquí puedes gestionar gimnasios, entrenadores y más.
        </p>
    </x-slot>

    {{-- Contenido principal --}}
    <div class="mt-4">
        <p class="text-base">Este es tu panel principal.</p>
    </div>
</x-sidebar-layout>
