<x-layouts.view heading="{{ ucfirst($user->first_name) }}" backLocation="/users">
    <x-column-info name="First Name" :value="$user->first_name" />
    <x-column-info name="Middle Name" :value="$user->middle_name ?? 'N/A'" />
    <x-column-info name="Last Name" :value="$user->last_name" />
    <x-column-info name="Gender" :value="ucfirst($user->gender)" />
    <x-column-info name="Date of Birth" :value="$user->date_of_birth->format('M d, Y')" />
    <x-column-info name="Phone Number" :value="$user->phone_number" />
    <x-column-info name="Email" :value="$user->email" />
    <x-column-info name="Role" :value="ucfirst($user->role)" />
</x-layouts.view>