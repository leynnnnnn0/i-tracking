<nav x-data="{showNotificationBar: false}" class="h-16 shadow-lg bg-white px-10 flex items-center justify-between">
    <h1 class="text-lg font-bold text-emerald-900">iTracking</h1>
    <button @click="showNotificationBar = true" class="relative">
        <span class="absolute -right-3 -top-5 font-bold text-orange-500 p-1 rounded-full ">{{ $notifications->count() }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
        </svg>
    </button>
    <template x-if="showNotificationBar">
        <livewire:notification-bar :$notifications />
    </template>
</nav>