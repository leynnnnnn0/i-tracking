<x-layouts.view heading="{{ ucfirst($office->name) }}" backLocation="/offices">
    <x-column-info name="Name" :value="$office->name" />
</x-layouts.view>