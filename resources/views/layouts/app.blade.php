<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SphereX') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Icon --}}
    <link rel="shortcut icon" href="/img/icon.png" type="img/icon">

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ openSidebar: false }" class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="antialiased dark:bg-gray-900">
            {{-- Navigation Bar section --}}
            @include('layouts.navigation')

            {{-- Sidebar section --}}
            @include('layouts.sidebar')

            {{-- Main section --}}
            <main class="p-4 md:ml-64 h-auto pt-20">
                <div class="p-4">
                    <h1 class="text-2xl text-gray-700 font-semibold md:text-3xl">
                        {{ $header }}
                    </h1>
                    <div>
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
