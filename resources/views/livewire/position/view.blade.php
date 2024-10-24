<x-layouts.view heading="{{ ucfirst($position->name) }}" backLocation="/positions">
    <x-column-info name="Name" :value="$position->name" />
</x-layouts.view>