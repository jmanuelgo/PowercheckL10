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
        'active' => request()->routeIs('admin.gimnasios.*'),
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2M3 13h2l.894 2.236a2 2 0 001.788 1.264H8M21 13h-2l-.894 2.236a2 2 0 01-1.788 1.264H16" />
        </svg>',
    ],
    [
        'name' => 'Entrenadores',
        'url' => route('admin.entrenadores'),
        'active' => request()->routeIs('admin.entrenadores.*'),
        'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.953 9.953 0 0112 15c2.21 0 4.248.713 5.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
        </svg>',
    ],
];
?>
<x-sidebar-layout :links="$links" title="Configuración - PowerCheck">
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-2">Configuración de perfil, {{ Auth::user()->name }}</h1>
        <p class="text-sm text-text-primary">Actualiza tus datos personales y contraseña.</p>
    </x-slot>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="p-4 mb-4 rounded-lg border border-green-300 bg-green-100 text-green-800 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO DE ACTUALIZACIÓN --}}
    <form method="POST" action="{{ route('admin.configuracion.update') }}" class="space-y-6 max-w-xl">
        @csrf
        @method('PUT')

        {{-- NOMBRE --}}
        <div>
            <label for="name" class="block font-semibold">Nombre</label>
            <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}"
                   class="w-full mt-1 border px-4 py-2 rounded text-black">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- CORREO --}}
        <div>
            <label for="email" class="block font-semibold">Correo electrónico</label>
            <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}"
                   class="w-full mt-1 border px-4 py-2 rounded text-black">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- CAMBIAR CONTRASEÑA --}}
        <div class="border-t pt-4">
            <h2 class="text-lg font-semibold mb-2">Cambiar contraseña</h2>

            <div class="mb-4">
                <label for="current_password" class="block font-semibold">Contraseña actual</label>
                <input id="current_password" name="current_password" type="password"
                       class="w-full mt-1 border px-4 py-2 rounded text-black">
                @error('current_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-semibold">Nueva contraseña</label>
                <input id="password" name="password" type="password"
                       class="w-full mt-1 border px-4 py-2 rounded text-black">
                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold">Confirmar nueva contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="w-full mt-1 border px-4 py-2 rounded text-black">
            </div>
        </div>

        {{-- BOTÓN --}}
        <div>
            <button type="submit"
                    class="bg-button-color hover:bg-button-hover text-white font-semibold px-4 py-2 rounded-lg transition">
                Guardar cambios
            </button>
        </div>
    </form>
</x-sidebar-layout>
