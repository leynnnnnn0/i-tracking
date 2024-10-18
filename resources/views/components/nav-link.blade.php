@props(['active' => false])
<a {{ $attributes->class([
    'flex items-center gap-2 cursor-pointer text-sm font-bold text-white px-5 py-3',
    'border-l-2 border-emerald-700 bg-white/10' => $active,
    'hover:text-green-700 duration-300 dark:hover:text-white/10' => !$active,
]) }}
    wire:navigate>
    {{ $slot }}
</a>