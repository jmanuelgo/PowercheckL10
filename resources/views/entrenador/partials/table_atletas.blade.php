 @forelse($atletas as $atleta)
     <tr class="border-b">
         <td>{{ $atleta->user->name }}</td>
            <td>{{ $atleta->user->apellidos }}</td>
         <td>{{ $atleta->user->celular }}</td>
         <td>{{ $atleta->gimnasio->nombre ?? 'No asignado' }}</td>
         <td>{{ $atleta->edad ?? 'N/D' }} años</td>
         <td>{{ $atleta->genero }}</td>
         <td>{{ $atleta->altura }} m</td>
         <td>
             {{ $atleta->historialPesos->first()?->peso ?? 'Sin registro' }} kg
         </td>
     <td class="px-4 py-2 flex gap-2">
         <a href="{{ route('entrenador.atletas.edit', $atleta) }}" class="text-blue-600 hover:underline">Editar</a>
         <form action="{{ route('entrenador.atletas.destroy', $atleta) }}" method="POST"
             onsubmit="return confirm('¿Eliminar atleta?')">
             @csrf
             @method('DELETE')
             <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
         </form>
     </td>
     </tr>
 @empty
     <tr>
         <td colspan="4" class="px-4 py-4 text-center text-gray-500">No se encontraron atlteas registrados.</td>
     </tr>
 @endforelse 

 <div class="mt-4">
     {{ $atletas->links() }}
 </div>
