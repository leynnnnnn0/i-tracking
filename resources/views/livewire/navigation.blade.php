<nav x-data="{showNotificationBar: false}" class="h-16 shadow-lg bg-white px-10 flex items-center justify-between dark:bg-dark-primary dark:shadow-white/10">
    <img src="{{ Vite::asset('resources/images/iTrackLogo.png')}}" class="size-24" alt="logo">
    <div class="flex items-center gap-3">
        <x-tsdropdown text="Menu" position="bottom-end">
            <x-tsdropdown.items>
                <x-color-mode-button />
            </x-tsdropdown.items>
            <x-tsdropdown.items separator>
                <button wire:click="logout">Logout</button>
            </x-tsdropdown.items>
        </x-tsdropdown>
    </div>


</nav>