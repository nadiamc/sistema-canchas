<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Gestión de Canchas</h2>

            <a href="{{ route('canchas.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                + Nueva Cancha
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <table class="w-full border">
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Tipo</th>
                <th class="border px-4 py-2">Precio</th>
                <th class="border px-4 py-2"></th> <!-- sin texto -->
            </tr>

            @foreach($canchas as $cancha)
            <tr>
                <td class="border px-4 py-2">{{ $cancha->nombre }}</td>
                <td class="border px-4 py-2">{{ $cancha->tipo }}</td>

                <td class="border px-4 py-2">
                    ${{ number_format($cancha->precio_hora, 2, ',', '.') }}
                </td>

                <td class="border px-4 py-2 text-center">

                    <!-- ✅ EDITAR -->
                    <a href="{{ route('canchas.edit', $cancha) }}"
                       class="text-blue-600 font-semibold">
                        Editar
                    </a>

                    |

                    <!-- ✅ ELIMINAR -->
                    <form action="{{ route('canchas.destroy', $cancha) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('¿Eliminar esta cancha?')"
                                class="text-red-600 font-semibold">
                            Eliminar
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach

        </table>
    </div>
</x-app-layout>