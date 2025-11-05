<x-nav-link href="{{ route('alumno.ficha.index') }}" :active="request()->is('alumno/ficha-registro')">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 20h9M12 4h9M3 4h.01M3 20h.01M3 12h.01M12 12h9"></path>
    </svg>
    <span>Ficha de Registro</span>
</x-nav-link>
