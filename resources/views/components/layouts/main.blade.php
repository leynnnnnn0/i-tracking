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
        <livewire:navigation />
        <section class="flex-1 flex min-h-full">
            <div class="min-w-60 bg-emerald-500 flex flex-col">
                <x-nav-link href="/" :active="request()->is('/')">
                    <x-ri-dashboard-line class="size-5" />
                    Dashboard
                </x-nav-link>
                <x-nav-link href="/equipments" :active="request()->is('equipments*')">
                    <x-ri-tools-fill class="size-5" />
                    Equipments
                </x-nav-link>
                <x-nav-link href="/personnels" :active="request()->is('personnels*')">
                    <x-ri-group-line class=" size-5" />
                    Personnels
                </x-nav-link>
                <x-nav-link href="/supplies" :active="request()->is('supplies*')">
                    <x-ri-product-hunt-line class="size-5" />
                    Supplies
                </x-nav-link>
                @can('can-handle-delete-archives')
                <x-nav-link href="/delete-archives" :active="request()->is('delete-archives*')">
                    <x-bi-archive-fill class="size-5" />
                    Delete Archives
                </x-nav-link>
                @endcan
                <x-nav-link href="/users" :active="request()->is('users*')">
                    <x-ri-user-line class="size-5" />
                    Users
                </x-nav-link>
                <x-nav-link href="/borrowed-logs" :active="request()->is('borrowed-logs*')">
                    <x-bi-pass class="size-5" />
                    Borrowed Logs
                </x-nav-link>
                <x-nav-link href="/activity-logs" :active="request()->is('activity-log*')">
                    <x-ri-history-fill class="size-5" />
                    Activity Log
                </x-nav-link>
                <x-nav-link href="/missing-equipments" :active="request()->is('missing-equipments*')">
                    <x-bi-question-circle class="size-5" />
                    Missing Equipments
                </x-nav-link>
                <x-nav-link href="/supplies-history" :active="request()->is('supplies-history*')">
                    <x-ri-history-fill class="size-5" />
                    Supplies History
                </x-nav-link>
                <x-nav-link href="/others" :active="request()->is('others')">
                    <x-ri-more-line class="size-5" />
                    Others
                </x-nav-link>
            </div>
            <div class="flex-1 p-5 bg-[#eaeaea] min-w-[1200px]">
                {{ $slot}}
            </div>
        </section>
    </div>
</body>

</html>