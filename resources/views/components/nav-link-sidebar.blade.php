@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3 text-sm font-bold bg-white/10 text-white rounded-lg transition-all duration-200 shadow-inner'
            : 'flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/70 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if(isset($icon))
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
            {!! $icon !!}
        </svg>
    @endif
    <span>{{ $slot }}</span>
</a>
