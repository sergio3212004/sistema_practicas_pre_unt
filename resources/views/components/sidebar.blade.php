@php
    $role = auth()->user()->role;
@endphp

<div>
    @if ($role == 'alumno')
        <x-sidebars.alumno />
    @endif
    @if($role == 'profesor')
        <x-sidebars.profesor />
    @endif
    @if($role == 'director')
        <x-sidebars.director />
    @endif
    @if($role == 'empresa')
        <x-sidebars.empresa />
    @endif
</div>
