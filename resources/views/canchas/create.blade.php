<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Nueva Cancha') }}
            </h2>
            <a href="{{ route('canchas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow">
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">¡Atención! Por favor corrige los siguientes errores:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('canchas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Cancha:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ej: Cancha N° 1 Techada" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Superficie / Deporte:</label>
                        <select name="tipo" id="tipo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="Fútbol 5 - Sintético" {{ old('tipo') == 'Fútbol 5 - Sintético' ? 'selected' : '' }}>Fútbol 5 - Sintético</option>
                            <option value="Fútbol 7 - Césped Natural" {{ old('tipo') == 'Fútbol 7 - Césped Natural' ? 'selected' : '' }}>Fútbol 7 - Césped Natural</option>
                            <option value="Paddle - Cristal" {{ old('tipo') == 'Paddle - Cristal' ? 'selected' : '' }}>Paddle - Cristal</option>
                            <option value="Tenis - Polvo de Ladrillo" {{ old('tipo') == 'Tenis - Polvo de Ladrillo' ? 'selected' : '' }}>Tenis - Polvo de Ladrillo</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="precio_hora" class="block text-gray-700 text-sm font-bold mb-2">Precio por Hora ($):</label>
                        <input type="number" step="0.01" min="0" name="precio_hora" id="precio_hora" value="{{ old('precio_hora') }}" placeholder="Ej: 4500" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow focus:outline-none focus:shadow-outline">
                            Guardar Cancha
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>