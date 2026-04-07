<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-2.5 bg-white border border-gray-200 rounded-xl font-bold text-xs text-roofing-blue uppercase tracking-widest shadow-sm hover:bg-gray-50 active:bg-gray-100 transition-all duration-200 active:scale-95']) }}>
    {{ $slot }}
</button>
