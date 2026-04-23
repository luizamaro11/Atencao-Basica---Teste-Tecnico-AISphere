<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PrimaryCare') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Fonte Nunito -->
    <link href="https://fonts.bunny.net/css?family=nunito:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="text-stone-800 antialiased selection:bg-teal-100 selection:text-teal-900">
    <!-- Fundo bege super claro/off-white (stone-50) -->
    <div class="min-h-screen bg-stone-50 transition-colors duration-300">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-stone-50/80 backdrop-blur-md sticky top-0 z-10">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 border-b border-stone-200/60">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>