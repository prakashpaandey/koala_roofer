<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-construction-orange dark:bg-construction-orange border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-roofing-blue dark:focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-200 active:scale-95 shadow-md hover:shadow-orange-200 dark:hover:shadow-none transition-colors']) }}>
    {{ $slot }}
</button>
