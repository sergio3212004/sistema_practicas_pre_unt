<x-app-layout>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600">Bienvenido de nuevo, {{ Auth::user()->getNombreAttribute() }}</p>
    </div>

    <h2>
        Bienvenido {{ Auth::user()->rol }}
    </h2>

</x-app-layout>
