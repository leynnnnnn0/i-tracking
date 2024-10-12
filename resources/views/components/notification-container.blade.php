@props(['identification', 'message'])
<section class="flex flex-col h-fit border-b border-gray-300 py-2 gap-2">
    <h1 class="text-black font-bold text-sm">
        {{ $identification }}
    </h1>
    <p class="text-xs">{{ $message }}</p>
    <div class="flex items-center gap-2">
        <span class="cursor-pointer text-green-500 text-xs underline">Mark as read</span>
    </div>
</section>