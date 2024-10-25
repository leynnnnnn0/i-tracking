<x-layouts.view heading="{{ ucfirst($equipment->name) }}" backLocation="/personal-protective-equipment">
    <x-column-info name="Name" :value="$equipment->name" />
</x-layouts.view>