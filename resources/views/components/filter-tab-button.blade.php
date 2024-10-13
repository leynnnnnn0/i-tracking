@props(['active' => false])
<button {{$attributes}} class="px-3 py-1 rounded-lg font-bold bg-opacity-75 hover:bg-green-200 transition-colors duration-300 {{ $active ? 'bg-green-500 text-white' : 'text-green-500'}} ">
    {{ $slot }}
</button>