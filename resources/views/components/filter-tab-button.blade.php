@props(['active' => false])
<button {{$attributes}} class="px-3 py-1 rounded-lg font-bold bg-opacity-75 {{ $active ? 'bg-green-500 text-white' : 'text-green-500'}} ">
    {{ $slot }}
</button>