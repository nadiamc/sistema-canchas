<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Crear Nueva Cancha</h2>

            <a href="{{ route('canchas.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('canchas.store') }}" method="POST">
            @csrf

            <!-- NOMBRE -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nombre</label>
                <input type="text" name="nombre"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <!-- TIPO -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Tipo de Cancha</label>
                <select name="tipo"
                        class="w-full border rounded px-3 py-2"
                        required>

                    <option value="">Seleccionar</option>

                    <option value="Fútbol 5 - Sintético">Fútbol 5 - Sintético</option>
                    <option value="Fútbol 7 - Césped Natural">Fútbol 7 - Césped Natural</option>
                    <option value="Fútbol 11">Fútbol 11</option>
                    <option value="Pádel">Pádel</option>
                    <option value="Tenis">Tenis</option>
                    <option value="Vóley">Vóley</option>
                    <option value="Básquet">Básquet</option>
                    <option value="Multijuego">Multijuego</option>

                </select>
            </div>

            <!-- PRECIO -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Precio por hora ($)</label>
                <input type="number" name="precio_hora"
                       step="1"
                       min="0"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <!-- BOTÓN -->
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Guardar Cancha
            </button>

        </form>
    </div>
</x-app-layout>