<x-layouts.view heading="{{ ucfirst($department->name) }}" backLocation="/departments">
    <x-column-info name="Name" :value="$department->name" />
</x-layouts.view>