<x-layouts.view heading="{{ ucfirst($supply->description) }}" backLocation="/supplies">
    <x-column-info name="Description" :value="$supply->description" />
    <x-column-info name="Unit" :value="$supply->unit" />
    <x-column-info name="Quantity" :value="$supply->quantity" />
    <x-column-info name="Used" :value="$supply->used" />
    <x-column-info name="Recently Added" :value="$supply->recently_added" />
    <x-column-info name="Total" :value="$supply->total" />
    <x-column-info name="Expiry Date" :value="$supply->expiry_date->format('F d, Y')" />
    <x-column-info name="Is Consumable" :value="$supply->is_consumable ? 'Yes' : 'No'" />
</x-layouts.view>