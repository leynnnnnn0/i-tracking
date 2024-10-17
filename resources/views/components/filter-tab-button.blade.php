@props(['active' => false])
<button {{$attributes}} class="px-3 py-1 rounded-lg font-bold  hover:bg-green-200 transition-colors duration-300 {{ $active ? 'bg-primary text-white' : 'text-primary'}} ">
    {{ $slot }}
</button>