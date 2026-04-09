<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-black text-roofing-blue dark:text-gray-100 uppercase tracking-tight">Verify Email</h2>
    </div>

    <div class="mb-6 text-sm text-secondary-text dark:text-slate-400 font-medium leading-relaxed bg-blue-50/50 dark:bg-slate-950/50 p-4 rounded-xl border border-blue-100 dark:border-slate-800 text-center">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-lg dark:shadow-none transition-transform active:scale-95">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="underline text-sm font-semibold text-secondary-text dark:text-slate-400 hover:text-construction-orange dark:hover:text-orange-400 rounded-md focus:outline-none transition">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
