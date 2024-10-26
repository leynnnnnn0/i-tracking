@props(['identification', 'message', 'target'])
<section class="flex flex-col h-fit border-b border-gray-300 py-2 gap-2">
    <h1 class="text-primary-brown font-bold text-sm dark:text-white">
        {{ $identification }}
    </h1>
    <p class="text-xs dark:text-white">{{ $message }}</p>
    <x-text-button class="flex items-center gap-2 text-green-500" wire:target="{{$target}}" wire.loading.attr="disabled" {{ $attributes }}>
        Mark as read
        <span wire:loading wire:target="{{$target}}" class="flex items-center justify-center">
            <svg class="animate-spin h-3 w-3 text-text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
    </x-text-button>
</section>