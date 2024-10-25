<x-layouts.view heading="{{ ucfirst($fund->name) }}" backLocation="/funds">
    <x-column-info name="Name" :value="$fund->name" />
</x-layouts.view>