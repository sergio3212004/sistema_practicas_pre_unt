@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center px-4 py-3 w-full rounded-lg text-gray-100 bg-gray-800 transition-colors'
                : 'flex items-center px-4 py-3 w-full rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
