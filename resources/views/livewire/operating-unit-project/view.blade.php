<x-layouts.view heading="{{ ucfirst($operatingUnit->name) }}" backLocation="/operating-units">
    <x-column-info name="Name" :value="$operatingUnit->name" />
</x-layouts.view>