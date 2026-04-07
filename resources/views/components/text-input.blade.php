@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 focus:border-construction-orange focus:ring-construction-orange rounded-xl shadow-sm transition-all duration-200']) }}>
