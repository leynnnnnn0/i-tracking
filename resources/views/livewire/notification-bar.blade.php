<div class="bg-black/10 min-h-screen fixed inset-0 flex justify-end z-10 max-h-screen">
    <button @click="showNotificationBar = false" class="absolute top-3 right-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
        </svg>
    </button>
    <div class="flex flex-col w-64 bg-white shadow-l-lg h-full p-3 gap-3 max-h-full overflow-y-scroll">
        <h1 class="font-bold text-orange-500">Notifications</h1>
        @foreach ($notifications as $notification)
        <x-notification-container :identification="$notification->title" :message="$notification->message" wire:click="markAsRead({{ $notification->id }})">
            <span wire:loading class="flex items-center justify-center">
                <svg class="animate-spin h-3 w-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        </x-notification-container>
        @endforeach
    </div>
</div>