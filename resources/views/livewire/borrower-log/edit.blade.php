<x-layouts.edit title="Borrowed Equipment" cancelLocation="/borrowed-logs" wire:click="update">
    <x-form.select label="Equipment" name="form.equipment_id" :options="$equipments" wire:model="form.equipment_id" disabled />
    <x-form.tsnumber label="Equipment Quantity" name="form.quantity" wire:model.live="form.quantity" :hint="$quantityHint" />
    <x-form.input label="Borrower First Name" name="form.borrower_first_name" wire:model="form.borrower_first_name" />
    <x-form.input label="Borrower Last Name" name="form.borrower_last_name" wire:model="form.borrower_last_name" />
    <x-form.tsnumber label="Phone Number" name="form.borrower_phone_number" wire:model="form.borrower_phone_number" />
    <x-form.input label="Email" name="form.borrower_email" type="email" wire:model="form.borrower_email" />
    <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
    <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" />
    <x-form.select label="Status" name="form.status" :options="$statuses" wire:model.live="form.status" />
    @if ($form->status === 'partially_returned' || $form->status === 'partially_returned_with_loss')
    <x-form.tsnumber disabled label="Total Returned Quantity" name="form.total_quantity_returned" wire:model.live="form.total_quantity_returned" />
    <x-form.tsnumber label="Return Quantity" name="form.quantity_returned" wire:model.live="form.quantity_returned" />
    @endif
    @if ($form->status === 'partially_lost' || $form->status == 'returned_with_loss' || $form->status === 'partially_returned_with_loss')
    <x-form.tsnumber label="Lost Quantity" name="form.quantity_lost" wire:model.live="form.quantity_lost" />
    @endif
</x-layouts.edit>