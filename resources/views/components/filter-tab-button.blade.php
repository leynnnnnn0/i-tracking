@props(['active' => false])
<button {{$attributes}} class="px-3 py-1 rounded-lg font-bold dark:hover:bg-black/10 hover:bg-green-200 transition-colors duration-300 {{ $active ? 'bg-primary text-white dark:text-white dark:bg-dark-primary' : 'text-primary dark:text-white'}} ">
    {{ $slot }}
</button>