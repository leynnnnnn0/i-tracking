@props(['identification', 'message'])
<section class="flex flex-col h-fit border-b border-gray-300 py-2 gap-2">
    <h1 class="text-primary-brown font-bold text-sm">
        {{ $identification }}
    </h1>
    <p class="text-xs">{{ $message }}</p>
    <x-text-button class="flex items-center gap-2 text-green-500" wire.loading.attr="disabled" {{ $attributes }}>
        Mark as read
    </x-text-button>
</section>