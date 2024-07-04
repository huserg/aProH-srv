<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        #background {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<img id="background" src="/storage/images/svg/background.svg" alt="Background"/>
<div class="flex flex-col min-h-screen">
    <!-- Header and Navigation -->
    <header class="relative bg-black-50 text-yellow/50 dark:bg-black dark:text-white/50 w-full py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <img class="size-12" src="/storage/images/svg/logo.svg" alt="aProH logo"/>
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-md px-3 py-2 text-yellow ring-1 ring-transparent transition hover:text-yellow/70 focus:outline-none focus-visible:ring-yellow dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            {{__('Dashboard')}}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-md px-3 py-2 text-yellow ring-1 ring-transparent transition hover:text-yellow/70 focus:outline-none focus-visible:ring-yellow dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            {{ __('Login') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="rounded-md px-3 py-2 text-yellow ring-1 ring-transparent transition hover:text-yellow/70 focus:outline-none focus-visible:ring-yellow dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12">
        <div class="text-center">
            <h1 class="w-full h-full font-bold" style="font-size: 5rem;">{{ __('aProH ?') }}</h1>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black-50 text-yellow/50 dark:bg-black dark:text-white/70 py-6 text-center text-sm">
        {{ config('app.name') }} &copy; {{ date('Y') }}
    </footer>
</div>
@livewireScripts
</body>
</html>
