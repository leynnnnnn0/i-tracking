@props(['title', 'cancelLocation'])
<div>
    <x-plain-heading class="mb-3">Create New {{ $title }}</x-plain-heading>
    <div class="bg-white rounded-xl p-5 dark:dark-primary">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">{{ $title }} Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            {{ $slot }}
        </section>
        <section class="flex justify-end gap-3">
            <a href="{{ $cancelLocation }}" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300" wire:navigate.hover>Cancel</a>
            <x-primary-button {{ $attributes }}>Submit</x-primary-button>
        </section>
    </div>
</div>