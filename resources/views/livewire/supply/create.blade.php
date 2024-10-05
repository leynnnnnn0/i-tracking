<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Create New Supply</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Supply Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.input wire:model="form.description" name="form.description" label="Description" :isRequired="true" />
            <x-form.select wire:model="form.unit" name="form.unit" label="Unit" :isRequired="true" :data="$units" />
            <x-form.input wire:model="form.quantity" name="form.quantity" label="Quantity" type="number" />
            <x-form.select wire:model="form.category" name="form.category" label="Category" :isRequired="true" :data="$categories" />
            <x-form.input wire:model="form.expiry_date" name="form.expiry_date" label="Expiry Date" type="date" />
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
        <section class="flex justify-end">
            <button wire:click="save" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">Submit</button>
        </section>
    </div>
</div>