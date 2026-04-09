<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
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
        
        <script>
            // Set dark mode immediately if returning/preferred
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-soft-gray dark:bg-slate-950 transition-colors duration-300">
        <div class="flex min-h-screen overflow-hidden">
            <!-- Left Side / Blue Panel (Matches Dashboard Sidebar) -->
            <div class="hidden lg:flex lg:flex-col lg:w-[400px] xl:w-[500px] bg-roofing-blue dark:bg-slate-950 items-center justify-center p-12 text-center border-r border-white/10 relative shadow-[4px_0_24px_rgba(0,0,0,0.1)] z-10 transition-colors duration-300">
                <div class="flex flex-col items-center">
                    <a href="/" class="mb-12 transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('logo.png') }}" class="h-20 xl:h-24 w-auto filter brightness-0 invert drop-shadow" alt="Koala Roofer">
                    </a>
                    <h2 class="text-3xl xl:text-4xl font-black text-white uppercase tracking-tight mb-6 leading-tight">Manage Your<br>Roofing Business.</h2>
                    <p class="text-blue-200/80 font-medium text-sm leading-relaxed max-w-sm">The all-in-one platform to manage your tradies, streamline your invoices, and scale your operations effortlessly.</p>
                </div>
                <!-- Optional graphic/decoration at the bottom -->
                <div class="absolute bottom-8 text-[9px] font-black tracking-widest text-white/30 uppercase">
                    &copy; {{ date('Y') }} KOALAROOFER v1.0
                </div>
            </div>

            <!-- Right Side / Login Area (Matches Dashboard Main Content) -->
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-12 bg-soft-gray dark:bg-slate-950/50 transition-colors duration-300">
                
                <!-- Mobile Logo (Visible only on small screens) -->
                <div class="lg:hidden mb-10 text-center">
                    <a href="/">
                        <x-application-logo class="w-auto h-16" />
                    </a>
                </div>

                <!-- Form Container -->
                <div class="w-full max-w-md bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 shadow-2xl dark:shadow-none overflow-hidden rounded-[2rem] transition-colors duration-300">
                    <div class="px-8 py-10 sm:p-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
