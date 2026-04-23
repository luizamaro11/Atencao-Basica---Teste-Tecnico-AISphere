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
        <!-- Fonte Nunito para um visual mais acolhedor e humano -->
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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-stone-50">
            <div class="mb-8 text-center">
                <a href="/" class="flex flex-col items-center gap-3 text-teal-700">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-3xl tracking-tight text-stone-800">Primary<span class="text-teal-600">Care</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-sm overflow-hidden sm:rounded-3xl border border-stone-200/50">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-stone-400 text-sm">
                &copy; {{ date('Y') }} PrimaryCare. Todos os direitos reservados.
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
