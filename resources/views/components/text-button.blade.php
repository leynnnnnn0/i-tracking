<button {{ $attributes->merge(['class' => 'flex items-center gap-2 hover:underline text-xs']) }}>
    {{ $slot }}
</button>