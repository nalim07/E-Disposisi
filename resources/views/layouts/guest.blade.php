<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-disposisi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div
            class="grid lg:grid-cols-2 w-4/5 h-full px-12 py-28 bg-primary shadow-md overflow-hidden sm:rounded-lg gap-8">
            <!-- Kolom Kiri - Sambutan -->
            <div class="flex flex-col items-center justify-center bg-white text-center p-4">
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold">Selamat Datang</h1>
                    <h1 class="text-3xl font-bold">E - Disposisi</h1>
                    <img src="{{ asset('images/logo-smp.png') }}" alt="Logo"
                        class="w-48 mx-auto mt-6 transition-transform hover:scale-105">
                </div>
            </div>

            <!-- Kolom Kanan - Form Login -->
            <div
                class="flex items-center justify-center transform">
                <div class="w-full max-w-md p-8 space-y-6">
                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-white">Login</h1>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
