<x-app-layout>
    {{-- Header claro --}}
    <x-slot name="header">
        <header class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Bienvenido a tu panel, {{ auth()->user()->name }}.
            </p>
        </header>
    </x-slot>

    {{-- Contenido principal --}}
    <main class="py-12 flex-grow">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensaje de estado --}}
            @if (session('status'))
                <div class="rounded-md bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Tarjeta de información --}}
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Estado de la cuenta</h3>
                <p class="text-gray-600">{{ __("¡Has iniciado sesión correctamente!") }}</p>
            </div>

            {{-- Sección de estadísticas / widgets --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                    <h4 class="font-semibold text-gray-800 mb-2">Actividades recientes</h4>
                    <p class="text-gray-600 text-sm">Aquí verás tus últimas acciones en el sitio.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                    <h4 class="font-semibold text-gray-800 mb-2">Notificaciones</h4>
                    <p class="text-gray-600 text-sm">Tienes nuevas notificaciones pendientes.</p>
                </div>
            </div>

            {{-- Otra sección de ejemplo --}}
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <h4 class="font-semibold text-gray-800 mb-2">Información adicional</h4>
                <p class="text-gray-600 text-sm">Puedes agregar más widgets o detalles aquí según tu necesidad.</p>
            </div>

        </div>
    </main>
</x-app-layout>
