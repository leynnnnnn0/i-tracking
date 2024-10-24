<x-layouts.view heading="{{ ucfirst($personnel->full_name) }}" backLocation="/personnel">
    <x-column-info name="Full Name" :value="$personnel->full_name" />
    <x-column-info name="Office" :value="$personnel->office->name" />
    <x-column-info name="Department" :value="$personnel->department->name" />
    <x-column-info name="Position" :value="$personnel->position->name" />
    <x-column-info name="First Name" :value="$personnel->first_name" />
    <x-column-info name="Middle Name" :value="$personnel->middle_name ?? 'N/A'" />
    <x-column-info name="Last Name" :value="$personnel->last_name" />
    <x-column-info name="Gender" :value="$personnel->gender" />
    <x-column-info name="Date of Birth" :value="$personnel->date_of_birth->format('F d, Y')" />
    <x-column-info name="Phone Number" :value="$personnel->phone_number" />
    <x-column-info name="Email" :value="$personnel->email" />
    <x-column-info name="Start Date" :value="$personnel->start_date->format('F d, Y')" />
    <x-column-info name="End Date" :value="$personnel->end_date ? $personnel->end_date->format('F d, Y') : 'N/A'" />
    <x-column-info name="Remarks" :value="$personnel->remarks ?? 'No remarks'" />
</x-layouts.view>