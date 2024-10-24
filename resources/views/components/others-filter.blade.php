<div class="bg-white rounded-lg h-fit p-3 flex items-center gap-3 justify-between dark:bg-dark-primary">
    <div class="flex items-center gap-2">
        {{ $slot }}
    </div>
    <button {{ $attributes }} class="flex items-center gap-2 hover:bg-green-100 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg text-gray-500">
        <span>
            Reset filter
        </span>
        <x-loading wire:target="resetFilter" />
    </button>
</div>