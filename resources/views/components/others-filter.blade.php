<div class="bg-white rounded-lg h-fit p-3 flex items-center gap-3 justify-between dark:bg-black/50">
    <div>
        {{ $slot }}
    </div>
    <div class="flex items-center gap-3">
        <button {{ $attributes }} class="hover:bg-green-100 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg text-gray-500">Reset filter</button>
    </div>
</div>