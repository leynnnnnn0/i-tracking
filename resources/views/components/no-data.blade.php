@props(['data' => collect() ])
@if($data->count() == 0)
<div class="w-full h-96 flex flex-col items-center justify-center m-0 space-0 bg-white rounded-lg shadow-lg dark:bg-secondary-dark">
    <x-bi-pass class="size-16 text-primary-brown dark:text-white" />
    <span class="text-2xl font-bold text-primary-brown dark:text-white">No data to show</span>
</div>
@endif