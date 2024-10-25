@props(['heading', 'backLocation', 'downloadable' => false])
<div class="space-y-3">
    <div class="flex items-center justify-between">
        <x-plain-heading>{{ $heading }} Details</x-plain-heading>
        @if ($downloadable)
        <button wire:loading.attr="disabled" wire:target="downloadPdf" {{ $attributes }} class="flex items-center gap-2 px-4 py-1 bg-primary rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300 dark:bg-dark-primary">
            Export as PDF
            <x-loading wire:loading wire:target="downloadPdf" />
        </button>
        @endif
    </div>
    <section class="grid grid-cols-2 bg-white rounded-lg shadow-lg p-5 gap-3 dark:bg-secondary-dark">
        {{ $slot }}
    </section>
    <div class="pt-3">
        <x-plain-button-link href="{{ $backLocation }}">
            Back
        </x-plain-button-link>
    </div>
</div>