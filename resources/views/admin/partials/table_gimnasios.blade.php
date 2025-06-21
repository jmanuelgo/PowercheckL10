
    @forelse($gimnasios as $gimnasio)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $gimnasio->nombre }}</td>
            <td class="px-4 py-2">{{ $gimnasio->ubicacion }}</td>
            <td class="px-4 py-2">{{ $gimnasio->celular }}</td>
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('admin.gimnasios.edit', $gimnasio) }}" class="text-blue-600 hover:underline">Editar</a>
                <form action="{{ route('admin.gimnasios.destroy', $gimnasio) }}" method="POST" onsubmit="return confirm('¿Eliminar gimnasio?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="px-4 py-4 text-center text-gray-500">No se encontraron gimnasios.</td>
        </tr>
    @endforelse

<div class="mt-4">
    {{ $gimnasios->links() }}
</div>
