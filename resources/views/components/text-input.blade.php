@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 dark:border-slate-800 dark:bg-slate-950 dark:text-gray-300 focus:border-construction-orange dark:focus:border-orange-500 focus:ring-construction-orange dark:focus:ring-orange-500/20 rounded-xl shadow-sm transition-all duration-200 transition-colors']) }}>
