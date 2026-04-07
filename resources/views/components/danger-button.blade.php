<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-error-red border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 transition-all duration-200 shadow-md hover:shadow-red-200 active:scale-95']) }}>
    {{ $slot }}
</button>
