<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-black text-roofing-blue dark:text-gray-100 uppercase tracking-tight">Recover Access</h2>
    </div>
    
    <div class="mb-6 text-xs text-secondary-text dark:text-slate-400 font-medium leading-relaxed bg-blue-50/50 dark:bg-slate-950/50 p-4 rounded-xl border border-blue-100 dark:border-slate-800">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-lg dark:shadow-none transition-transform active:scale-95">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
