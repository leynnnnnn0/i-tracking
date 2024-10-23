<x-layouts.edit title="Supply" cancelLocation="/supplies" wire:click="update">
    <x-form.input wire:model="form.description" name="form.description" label="Description" :isRequired="true" />
    <x-form.select wire:model="form.unit" name="form.unit" label="Unit" :isRequired="true" :options="$units" />
    <x-form.date wire:model="form.expiry_date" name="form.expiry_date" label="Expiry Date" type="date" />
    <div class="flex gap-1 flex-col">
        <label class="text-sm text-gray-700">Is Consumable? <span class="text-red-500">*</span></label>
        <div class="flex gap-3 h-full">
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">Yes</label>
                <input wire:model="form.is_consumable" value="1" type="radio" name="isConsumable">
            </div>
            <div class="flex items-center gap-1">
                <label class="text-sm text-gray-700">No</label>
                <input wire:model="form.is_consumable" value="0" type="radio" name="isConsumable">
            </div>
        </div>
        <x-form.error name="form.is_consumable" />
    </div>
    <div class="grid grid-cols-3 gap-2">
        <x-form.label class="col-span-3">Categories <span class="text-red-500">*</span></x-form.label>
        @foreach ($categories as $key => $value)
        <button wire:click="addToCategories('{{ $key }}')" class="{{ in_array($key, $form->category->toArray()) ? 'text-white bg-emerald-500 dark:bg-dark-primary' : ''}} text-xs border border-gray-500 rounded-lg px-2 py-1 dark:text-white dark:border-white">{{ $value }}</button>
        @endforeach
        <x-form.error name="form.category" />
    </div>
</x-layouts.edit>