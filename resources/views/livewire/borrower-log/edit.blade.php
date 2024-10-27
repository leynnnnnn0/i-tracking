<x-layouts.edit title="Borrowed Equipment" cancelLocation="/borrowed-logs" wire:click="update">
    <x-form.select label="Equipment" name="form.equipment_id" :options="$equipments" wire:model="form.equipment_id" disabled/>
    <x-form.tsnumber label="Equipment Quantity" name="form.quantity" wire:model.live="form.quantity" :hint="$quantityHint" />
    <x-form.input label="Borrower First Name" name="form.borrower_first_name" wire:model="form.borrower_first_name" />
    <x-form.input label="Borrower Last Name" name="form.borrower_last_name" wire:model="form.borrower_last_name" />
    <x-form.tsnumber label="Phone Number" name="form.borrower_phone_number" wire:model="form.borrower_phone_number" />
    <x-form.input label="Email" name="form.borrower_email" type="email" wire:model="form.borrower_email" />
    <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
    <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" />
    <div class="flex gap-1 flex-col">
        <label class="text-sm text-gray-700">Is Returned? <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-3 h-full">
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">Yes</label>
                <input wire:model.live="form.is_returned" value="1" type="radio" name="is_returned">
            </div>
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">No</label>
                <input wire:model.live="form.is_returned" value="0" type="radio" name="is_returned">
            </div>
        </div>
        <x-form.error name="form.is_returned" />
    </div>
    @if ($form->is_returned)
    <x-form.date label="Return Date" name="form.returned_date" wire:model="form.returned_date" />
    @endif
</x-layouts.edit>