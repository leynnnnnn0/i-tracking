<x-layouts.view heading="{{ ucfirst($organizationUnit->name) }}" backLocation="/organization-units">
    <x-column-info name="Name" :value="$organizationUnit->name" />
</x-layouts.view>