<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-primary-text bg-soft-gray">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-roofing-blue text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-2xl">
                <div class="flex flex-col h-full">
                    <!-- Sidebar Header / Logo -->
                    <div class="flex items-center justify-center h-20 border-b border-white/10 px-6">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                            <img src="{{ asset('logo.png') }}" alt="Koala Roofer" class="h-10 w-auto filter brightness-0 invert">
                        </a>
                    </div>

                    <!-- Sidebar Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
                        <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="m10 3 4 4.4L14 7h3l-2.2 9H5.2L3 7h3l.1-1.6L10 3Z">
                            {{ __('Dashboard') }}
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('tradies.index')" :active="request()->routeIs('tradies.*')" icon="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            {{ __('Tradies') }}
                        </x-nav-link-sidebar>

                        <x-nav-link-sidebar :href="route('invoices.index')" :active="request()->routeIs('invoices.*')" icon="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                            {{ __('Invoices') }}
                        </x-nav-link-sidebar>
                    </nav>

                    <!-- Sidebar Footer -->
                    <div class="p-4 border-t border-white/10 text-xs text-center text-white/50">
                        &copy; {{ date('Y') }} KoalaRoofer v1.0
                    </div>
                </div>
            </aside>

            <!-- Main Content Container -->
            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.navigation')

                <!-- Page Header (Optional Breadcrumbs/Title) -->
                @isset($header)
                    <div class="bg-white px-6 py-4 border-b border-gray-200">
                        <div class="max-w-7xl">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Main Content Area -->
                <main class="flex-1 overflow-y-auto p-6 bg-soft-gray">
                    {{ $slot }}
                </main>
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden transition-opacity duration-300"></div>
        </div>
    </body>
</html>
