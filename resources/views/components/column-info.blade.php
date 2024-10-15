@props(['name', 'value'])
<div class="flex flex-col gap-1">
    <x-span-xs>{{ $name }}</x-span-xs>
    <x-span>{{ $value }}</x-span>
</div>