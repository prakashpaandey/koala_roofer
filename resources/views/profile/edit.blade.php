<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                <div class="max-w-xl">
                    <h3 class="text-lg font-black text-roofing-blue uppercase tracking-tight mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-construction-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Update Profile Information
                    </h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                <div class="max-w-xl">
                    <h3 class="text-lg font-black text-roofing-blue uppercase tracking-tight mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-construction-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        Security & Password
                    </h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white border border-error-red/20 shadow-sm rounded-2xl">
                <div class="max-w-xl">
                    <h3 class="text-lg font-black text-error-red uppercase tracking-tight mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Danger Zone
                    </h3>
                    <p class="text-xs text-secondary-text mb-6">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
