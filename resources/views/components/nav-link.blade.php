@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-roofing-blue dark:border-blue-500 text-sm font-bold leading-5 text-roofing-blue dark:text-blue-400 focus:outline-none transition duration-150 ease-in-out transition-colors'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-roofing-blue dark:hover:text-gray-200 hover:border-roofing-blue dark:hover:border-gray-700 focus:outline-none transition duration-150 ease-in-out transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
