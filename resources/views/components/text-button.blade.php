<button {{ $attributes->merge(['class' => 'hover:underline text-xs']) }}>
    {{ $slot }}
</button>