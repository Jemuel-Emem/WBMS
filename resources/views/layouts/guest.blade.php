<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WBMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-4">

        <!-- LOGO + Title -->
        <div class="flex flex-col items-center space-y-2">
            <a href="/" wire:navigate class="flex flex-col items-center">
                <img src="{{ asset('images/wbms.png') }}"
                     class="w-24 h-24 object-contain"
                     alt="WBMS Logo">
                <span class="mt-1 text-2xl font-bold text-gray-700">WBMS</span>
                <span class="text-sm text-gray-500">
                    Wedding Booking Management System
                </span>
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md mt-8 bg-white/90 backdrop-blur-md border border-pink-100
                    shadow-xl rounded-2xl px-6 py-6">

            <div class="mb-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700">Welcome</h2>
                <p class="text-sm text-gray-500">Sign in or create an account</p>
            </div>

            <!-- Slot for Breeze/Fortify -->
            {{ $slot }}

        </div>
    </div>

</body>
</html>
