@props(['active' => false])
<a {{ $attributes->class([
    'flex items-center gap-2 cursor-pointer text-lg font-bold text-white',
    'text-green-200' => $active,
    'hover:text-green-700 duration-300' => !$active,
]) }}
    wire:navigate>
    {{ $slot }}
</a>