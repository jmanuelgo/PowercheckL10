<table class="min-w-full text-sm bg-white text-black rounded shadow">
    <thead class="bg-zinc-800 text-white">
        <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Dirección</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($gimnasios as $gimnasio)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $gimnasio->nombre }}</td>
                <td class="px-4 py-2">{{ $gimnasio->direccion }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.gimnasios.edit', $gimnasio) }}"
                       class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('admin.gimnasios.destroy', $gimnasio) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar gimnasio?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-4 text-center text-gray-500">No se encontraron gimnasios.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $gimnasios->links() }}
</div>
