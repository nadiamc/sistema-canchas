<x-guest-layout>

    <div class="text-center">
        <h1 class="text-2xl font-bold mb-4">
            Sistema de Canchas Multijuego ⚽
        </h1>

        <p class="mb-6">
            Gestión de reservas, horarios y canchas.
        </p>

        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Iniciar sesión
        </a>

        <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-2">
            Registrarse
        </a>
    </div>

</x-guest-layout>
