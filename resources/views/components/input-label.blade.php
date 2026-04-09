@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-400 transition-colors duration-300']) }}>
    {{ $value ?? $slot }}
</label>
