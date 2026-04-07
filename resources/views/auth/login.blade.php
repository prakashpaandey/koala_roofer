<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-roofing-blue">Welcome Back</h1>
        <p class="text-sm text-secondary-text mt-2">Sign in to manage your tradies and invoices</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@koalaroofer.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue" />
                @if (Route::has('password.request'))
                    <!-- <a class="text-xs font-semibold text-construction-orange hover:text-orange-700 transition" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a> -->
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full border-gray-200 focus:border-construction-orange focus:ring-construction-orange"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-construction-orange shadow-sm focus:ring-construction-orange" name="remember">
                <span class="ms-2 text-sm text-secondary-text">{{ __('Keep me logged in') }}</span>
            </label>
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-lg transition-transform active:scale-95">
                {{ __('Secure Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
