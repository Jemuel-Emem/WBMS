<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WBMS - Wedding Booking Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-white text-gray-700">

<div class="min-h-screen flex flex-col justify-center items-center ">

    <header class="absolute top-0 right-0 p-6">
        @if (Route::has('login'))
            <div class="flex space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="text-gray-700 hover:text-pink-600 font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-white border border-gray-300 shadow-sm rounded-lg text-gray-700 hover:bg-pink-100 transition">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-pink-400 text-white shadow rounded-lg hover:bg-pink-500 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </header>

    <main class="text-center px-6">
        <h1 class="text-5xl font-bold text-gray-700">
            <span class="text-pink-500">WBMS</span> – Wedding Booking<br>Management System
        </h1>

        <p class="mt-4 text-lg text-gray-600 max-w-xl">
            A modern and elegant platform to schedule weddings, manage clients,
            organize venue reservations and ensure every event is unforgettable.
        </p>

        <div class="mt-8">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 transition">
                Book Your Dream Wedding
            </a>
        </div>
    </main>

    <footer class="absolute bottom-5 text-gray-500 text-sm">
        © {{ date('Y') }} WBMS. All Rights Reserved.
    </footer>

</div>

</body>
</html>
