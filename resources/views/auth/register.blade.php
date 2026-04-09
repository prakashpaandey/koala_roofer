<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-roofing-blue dark:text-gray-100 uppercase tracking-tight italic">Join Koala Roofer</h2>
        <p class="text-xs font-bold text-secondary-text dark:text-slate-400 uppercase tracking-widest mt-1">Create your management account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-bold uppercase tracking-wider text-roofing-blue dark:text-gray-400" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-200 dark:border-slate-800 dark:bg-slate-950/50 dark:text-gray-300 focus:border-construction-orange focus:ring-construction-orange"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-lg dark:shadow-none transition-transform active:scale-95">
                {{ __('Register Account') }}
            </x-primary-button>
            <div class="text-center">
                <a class="text-xs text-secondary-text dark:text-slate-400 hover:text-construction-orange dark:hover:text-orange-400 transition" href="{{ route('login') }}">
                    {{ __('Already registered? Login here') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
