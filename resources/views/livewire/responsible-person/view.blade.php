<x-layouts.view heading="{{ ucfirst($person->first_name) }}" backLocation="/responsible-persons">
    <x-column-info name="Accounting Officer" :value="$person->accounting_officer->full_name" />
    <x-column-info name="First Name" :value="$person->first_name" />
    <x-column-info name="Middle Name" :value="$person->middle_name" />
    <x-column-info name="Last Name" :value="$person->last_name" />
    <x-column-info name="Email" :value="$person->email" />
    <x-column-info name="Phone Number" :value="$person->phone_number" />
</x-layouts.view>