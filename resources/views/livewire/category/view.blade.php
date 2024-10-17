<x-layouts.view heading="{{ ucfirst($category->name) }}" backLocation="/categories">
    <x-column-info name="Name" :value="$category->name" />
</x-layouts.view>