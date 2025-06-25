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
        <h1 class="text-2xl font-bold mb-2">Editar Atleta - {{ $atleta->user->name }}</h1>
        <p class="text-sm text-text-primary">Modifica los datos del atleta.</p>
    </x-slot>

    <form action="{{ route('entrenador.atletas.update', $atleta->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Datos de Atleta -->
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Datos del Atleta</h2>
                    <!-- Botón de Editar -->
                    <button type="button" id="edit-btn" class="text-blue-600 hover:text-blue-800">
                        Editar
                    </button>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ $atleta->user->name }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium">Correo</label>
                    <input type="email" name="email" id="email" value="{{ $atleta->user->email }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="apellidos" class="block text-sm font-medium">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" value="{{ $atleta->user->apellidos }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="celular" class="block text-sm font-medium">Celular</label>
                    <input type="text" name="celular" id="celular" value="{{ $atleta->user->celular }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-medium">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $atleta->fecha_nacimiento->format('Y-m-d') }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="genero" class="block text-sm font-medium">Género</label>
                    <select name="genero" id="genero" class="w-full border px-3 py-2 rounded" disabled>
                        <option value="masculino" {{ $atleta->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ $atleta->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>

                <div>
                    <label for="altura" class="block text-sm font-medium">Altura</label>
                    <input type="number" step="0.01" name="altura" id="altura" value="{{ $atleta->altura }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="estilo_vida" class="block text-sm font-medium">Estilo de Vida</label>
                    <input type="text" name="estilo_vida" id="estilo_vida" value="{{ $atleta->estilo_vida }}" class="w-full border px-3 py-2 rounded" disabled>
                </div>

                <div>
                    <label for="lesiones_previas" class="block text-sm font-medium">Lesiones Previas</label>
                    <textarea name="lesiones_previas" id="lesiones_previas" class="w-full border px-3 py-2 rounded" disabled>{{ $atleta->lesiones_previas }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="foto" class="block text-sm font-medium">Foto</label>
                    <input type="file" name="foto" id="foto" class="w-full border px-3 py-2 rounded" disabled>
                </div>
            </div>
        </div>

        <!-- Botones de guardar y cancelar (inicialmente ocultos) -->
        <div id="action-buttons" class="hidden">
            <button type="submit" class="bg-button-color hover:bg-button-hover text-white font-semibold px-6 py-2 rounded-lg">Guardar</button>
            <button type="button" id="cancel-btn" class="ml-4 text-red-600 hover:text-red-800">Cancelar</button>
        </div>
    </form>

    <script>
        // Mostrar/ocultar formulario de edición
        document.getElementById('edit-btn').addEventListener('click', function() {
            // Activar/desactivar inputs
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.disabled = false);

            // Mostrar los botones de guardar y cancelar
            document.getElementById('action-buttons').classList.remove('hidden');
            document.getElementById('edit-btn').classList.add('hidden');
        });

        // Cancelar edición (volver a la vista anterior)
        document.getElementById('cancel-btn').addEventListener('click', function() {
            // Desactivar inputs nuevamente
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.disabled = true);

            // Ocultar los botones de guardar y cancelar
            document.getElementById('action-buttons').classList.add('hidden');
            document.getElementById('edit-btn').classList.remove('hidden');
        });
    </script>
</x-sidebar-layout>

