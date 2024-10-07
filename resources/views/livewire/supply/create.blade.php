<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Create New Supply</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Supply Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.input wire:model="form.description" name="form.description" label="Description" />
            <x-form.select wire:model="form.unit" name="form.unit" label="Unit" :data="$units" />
            <x-form.input wire:model="form.quantity" name="form.quantity" label="Quantity" type="number" />
            <x-form.input wire:model="form.expiry_date" name="form.expiry_date" label="Expiry Date" type="date" :isRequired="false" />

            <div class="grid grid-cols-3 gap-2">
                <x-form.label class="col-span-3">Categories <span class="text-red-500">*</span></x-form.label>
                @foreach ($categories as $key => $value)
                <button wire:click="addToCategories('{{ $key }}')" class="{{ in_array($key, $form->category) ? 'text-white bg-emerald-500' : ''}} text-xs border border-gray-500 rounded-lg px-2 py-1">{{ $value }}</button>
                @endforeach
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
        </section>
        <section class="flex justify-end gap-3">
            <a href="/supplies" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="save">Submit</x-primary-button>
        </section>
    </div>
</div>