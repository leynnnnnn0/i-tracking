@props(['identification', 'message'])
<section class="flex flex-col h-fit border-b border-gray-300 py-2 gap-2">
    <h1 class="text-orange-500 font-bold text-sm">
        {{ $identification }}
    </h1>
    <p class="text-xs">{{ $message }}</p>
</section>