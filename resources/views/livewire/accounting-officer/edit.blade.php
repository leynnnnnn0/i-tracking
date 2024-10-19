<x-layouts.edit title="Officer" cancelLocation="/accounting-officers" wire:click="update">
    <x-form.select label="Office"
        :data="$offices"
        name="form.office_id"
        wire:model="form.office_id">
    </x-form.select>

    <x-form.input label="First Name"
        name="form.first_name"
        wire:model="form.first_name"
        placeholder="Enter first name"
        required />

    <x-form.input label="Middle Name"
        name="form.middle_name"
        :isRequired="false"
        wire:model="form.middle_name"
        placeholder="Enter middle name" />

    <x-form.input label="Last Name"
        name="form.last_name"
        wire:model="form.last_name"
        placeholder="Enter last name"
        required />

    <x-form.input label="Email"
        name="form.email"
        type="email"
        wire:model="form.email"
        placeholder="Enter email"
        required />

    <x-form.input label="Phone Number"
        name="form.phone_number"
        wire:model="form.phone_number"
        placeholder="Enter phone number"
        required />
</x-layouts.edit>