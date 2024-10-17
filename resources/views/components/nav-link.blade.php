@props(['active' => false])
<a {{ $attributes->class([
    'flex items-center gap-2 cursor-pointer text-sm font-bold text-white px-5 py-3',
    'border-l-2 border-emerald-700 bg-emerald-400' => $active,
    'hover:text-green-700 duration-300' => !$active,
]) }}
    wire:navigate>
    {{ $slot }}
</a>