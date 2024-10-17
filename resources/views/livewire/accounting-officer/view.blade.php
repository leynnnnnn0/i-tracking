<x-layouts.view heading="{{ ucfirst($officer->first_name) }}" backLocation="/accounting-officers">
    <x-column-info name="Office" :value="$officer->office->name" />
    <x-column-info name="First Name" :value="$officer->first_name" />
    <x-column-info name="Middle Name" :value="$officer->middle_name" />
    <x-column-info name="Last Name" :value="$officer->last_name" />
    <x-column-info name="Email" :value="$officer->email" />
    <x-column-info name="Phone Number" :value="$officer->phone_number" />
</x-layouts.view>