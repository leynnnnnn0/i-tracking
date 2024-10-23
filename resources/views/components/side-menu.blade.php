<div class="min-w-60 bg-primary flex flex-col dark:bg-dark-primary">
    <x-nav-link href="/" :active="request()->is('/')">
        <x-ri-dashboard-line class="size-4" />
        Dashboard
    </x-nav-link>

    <span class="px-5 mt-5 text-white/50 text-xs">Equipment</span>
    <x-nav-link href="/equipment" :active="request()->is('equipment*')">
        <x-ri-tools-fill class="size-4" />
        Equipment
    </x-nav-link>
    <x-nav-link href="/borrowed-logs" :active="request()->is('borrowed-logs*')">
        <x-bi-pass class="size-4" />
        Borrowed Logs
    </x-nav-link>
    <x-nav-link href="/missing-equipment" :active="request()->is('missing-equipment*')">
        <x-bi-question-circle class="size-4" />
        Missing Equipment
    </x-nav-link>

    <span class="px-5 mt-5 text-white/50 text-xs">Supply</span>
    <x-nav-link href="/supplies" :active="request()->is('supplies') || request()->is('supplies/*')">
        <x-ri-product-hunt-line class="size-4" />
        Supplies
    </x-nav-link>
    <x-nav-link href="/supplies-history" :active="request()->is('supplies-history*')">
        <x-ri-history-fill class="size-4" />
        Supplies History
    </x-nav-link>
    <x-nav-link href="/categories" :active="request()->is('categories*')">
        <x-bi-textarea-resize class="size-4" />
        Categories
    </x-nav-link>


    @can('admin-access')
    <span class="px-5 mt-5 text-white/50 text-xs">People</span>
    <x-nav-link href="/personnel" :active="request()->is('personnel*')">
        <x-ri-group-line class=" size-4" />
        Personnel
    </x-nav-link>

    <x-nav-link href="/users" :active="request()->is('users*')">
        <x-ri-user-line class="size-4" />
        Users
    </x-nav-link>

    <x-nav-link href="/accounting-officers" :active="request()->is('accounting-officers*')">
        <x-ri-user-line class="size-4" />
        Accounting Officers
    </x-nav-link>


    <span class="px-5 mt-5 text-white/50 text-xs">Others</span>
    <x-nav-link href="/delete-archives" :active="request()->is('delete-archives*')">
        <x-bi-archive-fill class="size-4" />
        Delete Archives
    </x-nav-link>

    <x-nav-link href="/activity-logs" :active="request()->is('activity-log*')">
        <x-ri-history-fill class="size-4" />
        Activity Log
    </x-nav-link>

    <x-nav-link href="/departments" :active="request()->is('departments*')">
        <x-ri-home-office-line class="size-4" />
        Departments
    </x-nav-link>

    <x-nav-link href="/offices" :active="request()->is('offices*')">
        <x-ri-home-office-line class="size-4" />
        Offices
    </x-nav-link>


    @endcan

</div>