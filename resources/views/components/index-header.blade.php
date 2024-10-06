@props(['heading', 'location' => '/', 'buttonName'])
<div class="flex items-center justify-between mb-5">
    <h1 class="font-bold text-2xl text-emerald-900">{{ $heading}}</h1>
    <a href="{{ $location }}" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">{{ $buttonName }}</a>
</div>