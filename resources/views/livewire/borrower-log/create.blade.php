<x-layouts.create title="Borrow Log" :cancelLocation="route('borrowed-logs.index')" wire:click="submit">
    <x-form.tsselect :options="$equipments" wire:model.live="form.equipment_id" :options="$equipments" label="Equipment" />
    <x-form.tsnumber label="Equipment Quantity" name="form.quantity" wire:model="form.quantity" :hint="$quantityHint" />
    <x-form.input label="Borrower First Name" name="form.borrower_first_name" wire:model="form.borrower_first_name" />
    <x-form.input label="Borrower Last Name" name="form.borrower_last_name" wire:model="form.borrower_last_name" />
    <x-form.input label="Phone Number" name="form.borrower_phone_number" wire:model="form.borrower_phone_number" />
    <x-form.input label="Email" name="form.borrower_email" type="email" wire:model="form.borrower_email" />
    <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
    <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" />
</x-layouts.create>