@props(['sidebarOpen' => false, 'sidebarCollapsed' => false])

@php
    $user = Auth::user();
    $rol = $user->rol->rol ?? null;

    // Mapa de roles a componentes parciales
    $componentesSidebar = [
        'alumno' => 'components.sidebar.alumno',
        'profesor' => 'components.sidebar.profesor',
        'empresa' => 'components.sidebar.empresa',
        'director' => 'components.sidebar.director',
    ];

    $componente = $componentesSidebar[$rol] ?? null;
@endphp

<aside
    x-show="!sidebarCollapsed"
    x-transition:enter="transition-transform ease-in-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition-transform ease-in-out duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
>
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-4 flex items-center justify-center">
            <img
                src="{{ asset('logo-informatica.png') }}"
                alt="Logo informática"
                class="h-[75%] w-auto"
            >
        </div>

        <!-- Navegación dinámica -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-2">
                <!-- Dashboard (común para todos) -->
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </x-nav-link>

                {{-- Incluir sidebar según rol --}}
                @if ($componente)
                    @include($componente)
                @else
                    <p class="text-gray-500 text-sm mt-4">Sin permisos asignados</p>
                @endif
            </div>
        </nav>

        <!-- User Section -->
        <div class="p-4 bg-gray-800 flex-shrink-0">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</aside>
