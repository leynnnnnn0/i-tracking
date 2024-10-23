<x-layouts.create title="Supply" :cancelLocation="route('supplies.index')" wire:click="submit">
    <x-form.input wire:model="form.description" name="form.description" label="Description" />
    <x-form.select wire:model="form.unit" name="form.unit" label="Unit" :options="$units" />
    <x-form.tsnumber wire:model="form.quantity" name="form.quantity" label="Quantity" />
    <x-form.date wire:model="form.expiry_date" name="form.expiry_date" label="Expiry Date" :isRequired="false" />

    <div class="grid grid-cols-3 gap-2">
        <x-form.label class="col-span-3">Categories <span class="text-red-500">*</span></x-form.label>
        @foreach ($categories as $key => $value)
        <button wire:click="addToCategories('{{ $key }}')" class="{{ in_array($key, $form->category) ? 'text-white bg-primary dark:bg-dark-primary' : ''}} text-xs border border-gray-500 dark:border-white dark:text-white rounded-lg px-2 py-1">{{ $value }}</button>
        @endforeach
        <br>
        <x-form.error name="form.category" />
    </div>

    <div class="flex gap-1 flex-col">
        <label class="text-sm text-gray-700">Is Consumable? <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-3 h-full">
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
</x-layouts.create>