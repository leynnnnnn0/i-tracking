@props(['heading'])
<div class="flex items-center justify-center fixed inset-0 min-h-screen bg-black/50">
    <div class="bg-white shadow-lg rounded-lg p-5 max-w-[500px] h-auto space-y-3">
        <section class="border-b border-gray-300 pb-5">
            <h1 class="text-emerald-900 text-lg font-bold">{{ $heading}}</h1>
        </section>
        <section class="grid grid-cols-2 gap-5">
            {{ $slot }}
        </section>
    </div>
</div>