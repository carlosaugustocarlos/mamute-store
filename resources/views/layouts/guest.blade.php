<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-100 font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-8">
            <a href="/" class="mb-6 flex items-center gap-3">
                <x-application-logo class="h-11 w-11" />
                <span class="text-lg font-semibold text-slate-950">Mamute Store</span>
            </a>

            <div class="w-full max-w-md overflow-hidden rounded-lg border border-slate-200 bg-white px-6 py-6 shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
