<x-layouts.edit title="Personnel" cancelLocation="/personnels" wire:click="update">
    <x-form.input label="First Name" name="form.first_name" wire:model="form.first_name" />
    <x-form.input label="Middle Name" name="form.middle_name" :isRequired="false" wire:model="form.middle_name" />
    <x-form.input label="Last Name" name="form.last_name" wire:model="form.last_name" />
    <x-form.select label="Gender" :data="$genders" name="form.gender" wire:model="form.gender" />
    <x-form.date label="Date of Birth" name="form.date_of_birth" wire:model="form.date_of_birth" />
    <x-form.input label="Phone Number" name="form.phone_number" type="number" wire:model="form.phone_number" />
    <x-form.input label="Email" name="form.email" type="email" wire:model="form.email" />
    <x-form.select label="Position" :data="$positions" name="form.position" wire:model="form.position" />
    <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
    <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" :isRequired="false" />
    <x-form.text-area label="Remarks" name="form.remarks" wire:model="form.remarks" :isRequired="false" />
    <x-form.select label="Department" :data="$departments" name="form.department_id" wire:model="form.department_id" />
</x-layouts.edit>