<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel=" preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
</head>

<body class="font-poppins text-gray-900 antialiased">
    <x-toaster-hub />
    <x-tsdialog />
    <div class="flex flex-col min-h-screen">
        <livewire:navigation />
        <section class="flex-1 flex min-h-full">
            <x-side-menu />
            <div class="flex-1 p-5 bg-primary-gray min-w-[1250px] dark:bg-tertiary-dark">
                {{ $slot}}
            </div>
        </section>
    </div>
</body>

</html>