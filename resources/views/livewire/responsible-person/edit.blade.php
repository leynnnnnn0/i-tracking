<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Edit Responsible Person Details</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Responsible Person Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.select label="Accounting Officer"
                :data="$officers"
                name="form.accounting_officer_id"
                wire:model="form.accounting_officer_id">
            </x-form.select>

            <x-form.input label="First Name"
                name="form.first_name"
                wire:model="form.first_name"
                placeholder="Enter first name"
                required />

            <x-form.input label="Middle Name"
                name="form.middle_name"
                wire:model="form.middle_name"
                placeholder="Enter middle name" />

            <x-form.input label="Last Name"
                name="form.last_name"
                wire:model="form.last_name"
                placeholder="Enter last name"
                required />

            <x-form.input label="Email"
                name="form.email"
                type="email"
                wire:model="form.email"
                placeholder="Enter email"
                required />

            <x-form.input label="Phone Number"
                name="form.phone_number"
                wire:model="form.phone_number"
                placeholder="Enter phone number"
                required />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/accounting-officers" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="edit">Edit</x-primary-button>
        </section>
    </div>
</div>