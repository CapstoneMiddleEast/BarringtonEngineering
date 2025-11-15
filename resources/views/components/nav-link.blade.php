@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block font-medium py-2 px-3 text-red-500 text-sm'
            : 'block py-2 px-3 dark:text-white text-gray-900 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800 text-sm';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
