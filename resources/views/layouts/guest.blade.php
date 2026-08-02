<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GNRI Riau') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-900 min-h-screen flex flex-col justify-center items-center p-4">
        
        <!-- Branding Logo / Header -->
        <div class="mb-6 text-center">
            <a href="/" class="inline-flex items-center gap-2">
                <!-- Kalau ada gambar logo PNG/SVG bisa pakai tag <img> di sini, contoh: -->
                <!-- <img src="{{ asset('images/logo.png') }}" class="w-12 h-12" alt="Logo GNRI"> -->
                
                <!-- Teks Logo Standar -->
                <span class="text-3xl font-black tracking-wider text-emerald-400">GNRI</span>
                <span class="text-sm font-extrabold text-slate-300 border-l-2 border-slate-700 pl-2 tracking-widest">RIAU</span>
            </a>
        </div>

        <!-- Auth Card Container -->
        <div class="w-full sm:max-w-md bg-white shadow-xl rounded-2xl p-6 sm:p-8 border border-slate-800/20">
            {{ $slot }}
        </div>

    </body>
</html>