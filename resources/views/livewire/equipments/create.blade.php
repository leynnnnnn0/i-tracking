<div class="space-y-4">
    <x-plain-heading>Create New Personnel</x-plain-heading>

    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Supply Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.select label="Responsible Person"
                :data="$persons"
                name="form.responsible_person_id"
                wire:model="form.responsible_person_id">
            </x-form.select>

            <x-form.input label="Unique ID"
                name="form.uid"
                wire:model="form.uid" />

            <x-form.input label="Name"
                name="form.name"
                wire:model="form.name" />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/equipments" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="submit">Submit</x-primary-button>
        </section>
    </div>
</div>