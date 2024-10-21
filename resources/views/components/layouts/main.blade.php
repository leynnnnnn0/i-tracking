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

    <tallstackui:script />
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins text-gray-900 antialiased">
    <x-toaster-hub />
    <div class="flex flex-col min-h-screen">
        <livewire:navigation />
        <section class="flex-1 flex min-h-full">
            <div class="min-w-60 bg-primary flex flex-col dark:bg-dark-primary">
                <x-nav-link href="/" :active="request()->is('/')">
                    <x-ri-dashboard-line class="size-4" />
                    Dashboard
                </x-nav-link>
                <x-nav-link href="/equipment" :active="request()->is('equipment*')">
                    <x-ri-tools-fill class="size-4" />
                    Equipment
                </x-nav-link>
                <x-nav-link href="/personnel" :active="request()->is('personnel*')">
                    <x-ri-group-line class=" size-4" />
                    Personnel
                </x-nav-link>
                <x-nav-link href="/supplies" :active="request()->is('supplies*')">
                    <x-ri-product-hunt-line class="size-4" />
                    Supplies
                </x-nav-link>
                @can('can-handle-delete-archives')
                <x-nav-link href="/delete-archives" :active="request()->is('delete-archives*')">
                    <x-bi-archive-fill class="size-4" />
                    Delete Archives
                </x-nav-link>
                @endcan
                <x-nav-link href="/users" :active="request()->is('users*')">
                    <x-ri-user-line class="size-4" />
                    Users
                </x-nav-link>
                <x-nav-link href="/borrowed-logs" :active="request()->is('borrowed-logs*')">
                    <x-bi-pass class="size-4" />
                    Borrowed Logs
                </x-nav-link>
                <x-nav-link href="/activity-logs" :active="request()->is('activity-log*')">
                    <x-ri-history-fill class="size-4" />
                    Activity Log
                </x-nav-link>
                <x-nav-link href="/missing-equipments" :active="request()->is('missing-equipments*')">
                    <x-bi-question-circle class="size-4" />
                    Missing Equipment
                </x-nav-link>
                <x-nav-link href="/supplies-history" :active="request()->is('supplies-history*')">
                    <x-ri-history-fill class="size-4" />
                    Supplies History
                </x-nav-link>
                <x-nav-link href="/offices" :active="request()->is('offices*')">
                    <x-ri-home-office-line class="size-4" />
                    Offices
                </x-nav-link>
                <x-nav-link href="/categories" :active="request()->is('categories*')">
                    <x-bi-textarea-resize class="size-4" />
                    Categories
                </x-nav-link>
                <x-nav-link href="/accounting-officers" :active="request()->is('accounting-officers*')">
                    <x-ri-user-line class="size-4" />
                    Accounting Officers
                </x-nav-link>
                <x-nav-link href="/responsible-persons" :active="request()->is('responsible-persons*')">
                    <x-bi-people-fill class="size-4" />
                    Responsible Persons
                </x-nav-link>
            </div>
            <div class="flex-1 p-5 bg-primary-gray min-w-[1200px] dark:bg-black/25">
                {{ $slot}}
            </div>
        </section>
    </div>
</body>

</html>