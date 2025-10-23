<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Prácticas - Pre Informática') }}</title>

    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 transition min-h-screen flex flex-col">

{{-- Barra de navegación --}}
@include('layouts.navigation')

{{-- Encabezado opcional --}}
@isset($header)
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
            <h1 class="text-lg font-semibold text-gray-800">
                {{ $header }}
            </h1>
        </div>
    </header>
@endisset

{{-- Contenido principal (ocupa el espacio disponible) --}}
<main class="flex-grow flex items-start justify-center">
    <div class="max-w-7xl w-full p-6 lg:p-8">
        {{ $slot }}
    </div>
</main>

{{-- Footer fijo al fondo --}}
<footer class="mt-auto bg-white border-t border-gray-200 py-4 text-center text-sm text-gray-600">
    © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
</footer>

</body>
</html>
