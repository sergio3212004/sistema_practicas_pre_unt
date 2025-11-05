<x-nav-link href="#" :active="request()->is('evaluaciones')">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 13l4 4L19 7"></path>
    </svg>
    <span>Evaluaciones</span>
</x-nav-link>

<x-nav-link href="#" :active="request()->is('reportes')">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
    </svg>
    <span>Reportes</span>
</x-nav-link>

<x-nav-link href="{{ route('profesor.alumnos') }}" :active="request()->is('profesor/alumnos')">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-5M12 20v-8M7 20V10M2 20V4"></path>
    </svg>
    <span>Mis alumnos</span>
</x-nav-link>
