<x-layouts.edit title="Borrowed Equipment" cancelLocation="/borrowed-logs" wire:click="update">
    <x-form.select label="Equipment" name="form.equipment_id" :data="$equipments" wire:model="form.equipment_id" />
    <x-form.input label="Borrower First Name" name="form.borrower_first_name" wire:model="form.borrower_first_name" />
    <x-form.input label="Borrower Last Name" name="form.borrower_last_name" wire:model="form.borrower_last_name" />
    <x-form.input label="Phone Number" name="form.borrower_phone_number" wire:model="form.borrower_phone_number" />
    <x-form.input label="Email" name="form.borrower_email" type="email" wire:model="form.borrower_email" />
    <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
    <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" />
</x-layouts.edit>