<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-construction-orange border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-roofing-blue focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
