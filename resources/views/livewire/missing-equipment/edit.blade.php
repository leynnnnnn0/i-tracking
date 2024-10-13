<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Edit Report Details</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Report Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.select label="Equipment" :data="$equipments" name="form.equipment_id" wire:model="form.equipment_id" />
            <x-form.select label="Status" :data="$statuses" name="form.status" wire:model="form.status" />
            <x-form.input label="Reported By" name="form.reported_by" wire:model="form.reported_by" />
            <x-form.input label="Reported Date" name="form.reported_date" type="date" wire:model="form.reported_date" />
            <x-form.text-area label="Description" name="form.description" wire:model="form.description" :isRequired="false" />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/missing-equipments" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="edit">Edit</x-primary-button>
        </section>
    </div>
</div>