<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="p-2 text-roofing-blue hover:bg-blue-50 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-black text-2xl text-roofing-blue leading-tight uppercase tracking-tight">
                {{ __('Account Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ activeTab: 'profile' }">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
            
            <!-- Settings Sub-Sidebar -->
            <div class="w-full lg:w-72 flex-shrink-0">
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-4 sticky top-6">
                    <p class="text-[10px] font-black text-secondary-text uppercase tracking-widest mb-4 px-4">User Settings</p>
                    <nav class="space-y-1">
                        <button 
                            @click="activeTab = 'profile'"
                            :class="activeTab === 'profile' ? 'bg-blue-50 text-roofing-blue border-l-4 border-roofing-blue' : 'text-secondary-text hover:bg-gray-50 border-l-4 border-transparent'"
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold transition-all duration-200 rounded-r-lg group"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="activeTab === 'profile' ? 'text-roofing-blue' : 'text-gray-400 group-hover:text-roofing-blue'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Info
                        </button>

                        <button 
                            @click="activeTab = 'security'"
                            :class="activeTab === 'security' ? 'bg-blue-50 text-roofing-blue border-l-4 border-roofing-blue' : 'text-secondary-text hover:bg-gray-50 border-l-4 border-transparent'"
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold transition-all duration-200 rounded-r-lg group"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="activeTab === 'security' ? 'text-roofing-blue' : 'text-gray-400 group-hover:text-roofing-blue'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Security
                        </button>

                        <div class="pt-4 mt-4 border-t border-gray-50">
                            <button 
                                @click="activeTab = 'danger'"
                                :class="activeTab === 'danger' ? 'bg-red-50 text-error-red border-l-4 border-error-red' : 'text-secondary-text hover:bg-red-50/50 border-l-4 border-transparent'"
                                class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold transition-all duration-200 rounded-r-lg group"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" :class="activeTab === 'danger' ? 'text-error-red' : 'text-gray-400 group-hover:text-error-red'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Danger Zone
                            </button>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1">
                <!-- Profile Section -->
                <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                    <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                        <div class="max-w-xl">
                            <h3 class="text-xl font-black text-roofing-blue uppercase tracking-tight mb-2">Profile Information</h3>
                            <p class="text-sm text-secondary-text mb-8">Update your account's name and contact email address.</p>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                    <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                        <div class="max-w-xl">
                            <h3 class="text-xl font-black text-roofing-blue uppercase tracking-tight mb-2">Security & Password</h3>
                            <p class="text-sm text-secondary-text mb-8">Ensure your account is using a long, random password to stay secure.</p>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Danger Zone Section -->
                <div x-show="activeTab === 'danger'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                    <div class="p-8 bg-white border border-error-red/10 shadow-sm rounded-2xl">
                        <div class="max-w-xl">
                            <h3 class="text-xl font-black text-error-red uppercase tracking-tight mb-2">Danger Zone</h3>
                            <p class="text-sm text-secondary-text mb-8">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
