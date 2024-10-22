<a {{ $attributes->merge(['class' => 'cursor-pointer']) }} wire:navigate.hover>
    {{ $slot }}
</a>