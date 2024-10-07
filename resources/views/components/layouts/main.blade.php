<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins text-gray-900 antialiased">
    <x-toaster-hub />
    <div class="flex flex-col min-h-screen">
        <x-navigation />
        <section class="flex-1 flex min-h-full">
            <div class="w-60 bg-emerald-500 flex flex-col">
                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                    <x-ri-dashboard-line class="size-7" />
                    Dashboard
                </x-nav-link>
                <x-nav-link href="/equipments" :active="request()->is('equipments')">
                    <x-ri-tools-fill class="size-7" />
                    Equipments
                </x-nav-link>
                <x-nav-link href="/personnels" :active="request()->is('personnels')">
                    <x-ri-group-line class=" size-7" />
                    Personnels
                </x-nav-link>
                <x-nav-link href="/supplies" :active="request()->is('supplies')">
                    <x-ri-product-hunt-line class="size-7" />
                    Supplies
                </x-nav-link>
                <x-nav-link>
                    <x-bi-archive-fill class="size-7" />
                    Archive
                </x-nav-link>
                <x-nav-link href="/users" :active="request()->is('users')">
                    <x-ri-user-line class="size-7" />
                    Users
                </x-nav-link>
                <x-nav-link href="/borrowed-logs" :active="request()->is('borrowed-logs')">
                    <x-bi-pass class="size-7" />
                    Borrowed Logs
                </x-nav-link>
                <x-nav-link href="/others" :active="request()->is('others')">
                    <x-ri-more-line class="size-7" />
                    Others
                </x-nav-link>
            </div>
            <div class="flex-1 p-5 bg-[#eaeaea]">
                {{ $slot}}
            </div>
        </section>
    </div>
</body>

</html>