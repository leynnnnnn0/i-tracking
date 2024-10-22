<x-layouts.create title="User" :cancelLocation="route('users.index')" wire:click="submit">
    <x-form.input label="First Name"
        name="form.first_name"
        wire:model="form.first_name" />

    <x-form.input label="Middle Name"
        name="form.middle_name"
        wire:model="form.middle_name" />

    <x-form.input label="Last Name"
        name="form.last_name"
        wire:model="form.last_name" />

    <x-form.date label="Date of Birth"
        name="form.date_of_birth"
        wire:model="form.date_of_birth" />

    <x-tsselect.styled label="gender"
        :options="$genders"
        name="form.gender"
        wire:model="form.gender">
    </x-tsselect.styled>

    <x-form.input label="Phone Number"
        name="form.phone_number"
        wire:model="form.phone_number" />

    <x-form.input label="Email"
        type="email"
        name="form.email"
        wire:model="form.email" />


    <x-form.select label="Role"
        :options="$roles"
        name="form.role"
        wire:model="form.role">
    </x-form.select>

    <x-tspassword label="Password"
        wire:model="form.password" />

</x-layouts.create>