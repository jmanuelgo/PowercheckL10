
 @forelse($entrenadores as $entrenador)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $entrenador->user->name ?? '—' }}</td>
                <td class="px-4 py-2">{{ $entrenador->user->apellidos ?? '—' }}</td>
                <td class="px-4 py-2">{{ $entrenador->user->email ?? '—' }}</td>
                <td class="px-4 py-2">{{ $entrenador->user->celular ?? '—' }}</td>
                <td class="px-4 py-2">{{ $entrenador->gimnasio->nombre ?? '—' }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.entrenadores.edit', $entrenador) }}"
                       class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('admin.entrenadores.destroy', $entrenador) }}"
                          method="POST" onsubmit="return confirm('¿Eliminar entrenador?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No se encontraron entrenadores.</td>
            </tr>
        @endforelse

<div class="mt-4">
    {{ $entrenadores->links() }}
</div>
