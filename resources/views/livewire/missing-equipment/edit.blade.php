<x-layouts.edit title="Missing Equipment" cancelLocation="/missing-equipments" wire:click="update">
    <x-form.select label="Equipment" :data="$equipments" name="form.equipment_id" wire:model="form.equipment_id" />
    <x-form.select label="Status" :data="$statuses" name="form.status" wire:model.live="form.status" />
    <x-form.input label="Reported By" name="form.reported_by" wire:model="form.reported_by" />
    <x-form.date label="Reported Date" name="form.reported_date" wire:model="form.reported_date" />
    <x-form.text-area label="Description" name="form.description" wire:model="form.description" :isRequired="false" />
    <x-form.input label="Missing Equipment Quantity" name="form.quantity" wire:model="form.quantity" type="number" onkeydown="return event.keyCode !== 69" :hint="$quantityHint" />
    @if($form->status === 'Reported to SPMO')
    <div class="flex gap-1 flex-col">
        <label class="text-sm text-gray-700">Is Condemened? <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-3 h-full">
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">Yes</label>
                <input wire:model="form.is_condemned" value="1" type="radio" name="form.is_condemned">
            </div>
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">No</label>
                <input wire:model="form.is_condemned" value="0" type="radio" name="form.is_condemned">
            </div>
        </div>
    </div>
    @endif
</x-layouts.edit>