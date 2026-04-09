<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-black text-roofing-blue dark:text-gray-100 uppercase tracking-tight">Confirm Password</h2>
    </div>

    <div class="mb-6 text-sm text-secondary-text dark:text-slate-400 font-medium leading-relaxed bg-blue-50/50 dark:bg-slate-950/50 p-4 rounded-xl border border-blue-100 dark:border-slate-800 text-center">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-lg dark:shadow-none transition-transform active:scale-95">
                {{ __('Confirm Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
