@props(['heading', 'backLocation'])
<div class="space-y-3">
    <x-plain-heading>{{ $heading }} Details</x-plain-heading>
    <section class="grid grid-cols-2 bg-white rounded-lg shadow-lg p-5 gap-3">
        {{ $slot }}
    </section>
    <div class="pt-3">
        <x-plain-button-link href="{{ $backLocation }}">
            Back
        </x-plain-button-link>
    </div>
</div>