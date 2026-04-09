<nav class="bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 h-16 md:h-20 flex items-center shadow-sm transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 md:h-16 items-center">
            <div class="flex items-center">
                <!-- Mobile Mobile Hamburger -->
                <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-roofing-blue dark:hover:text-construction-orange hover:bg-gray-100 dark:hover:bg-slate-800 focus:outline-none transition lg:hidden shadow-sm">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Breadcrumb Placeholder or Page Title -->
                <div class="hidden lg:flex items-center space-x-2 text-sm text-secondary-text dark:text-gray-400 font-medium ml-4">
                    <span>KoalaRoofer</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-roofing-blue dark:text-gray-200 font-bold uppercase tracking-wide">{{ Str::headline(Request::segment(1) ?? 'Dashboard') }}</span>
                </div>
            </div>

            <!-- Actions & Settings -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode; localStorage.theme = darkMode ? 'dark' : 'light'; if(darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');" 
                    class="p-2 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-400 dark:text-gray-300 hover:text-roofing-blue dark:hover:text-construction-orange transition-all duration-300">
                    <!-- Sun Icon -->
                    <svg x-show="!darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <!-- Moon Icon -->
                    <svg x-show="darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <div class="flex items-center">
                 <div class="flex items-center ms-2 sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 md:gap-3 px-2 md:px-4 py-1.5 md:py-2 border border-gray-100 dark:border-slate-800 text-sm font-bold rounded-full text-roofing-blue dark:text-gray-200 bg-gray-50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-700 hover:shadow-md transition-all duration-200">
                                <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-roofing-blue flex items-center justify-center text-white text-[10px] md:text-xs font-black shadow-inner">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden md:block">{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-roofing-blue dark:text-gray-200 border-b border-gray-50 dark:border-slate-800">
                                {{ __('My Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="font-semibold text-error-red dark:text-red-400"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
