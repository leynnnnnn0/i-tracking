@props(['data' => collect() ])
@if($data->count() == 0)
<div class="w-full h-96 flex flex-col items-center justify-center m-0 space-0 bg-white rounded-lg shadow-lg">
    <x-bi-pass class="size-16 text-primary-brown" />
    <span class="text-2xl font-bold text-primary-brown">No data to show</span>
</div>
@endif