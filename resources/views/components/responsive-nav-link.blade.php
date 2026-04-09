@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-roofing-blue dark:border-blue-500 text-start text-base font-bold text-roofing-blue dark:text-blue-400 bg-blue-50 dark:bg-slate-800 focus:outline-none transition duration-150 ease-in-out transition-colors'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-roofing-blue dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-800 hover:border-roofing-blue dark:hover:border-gray-700 focus:outline-none transition duration-150 ease-in-out transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
