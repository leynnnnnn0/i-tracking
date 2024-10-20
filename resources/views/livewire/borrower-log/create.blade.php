<div class="space-y-4">
    <h1 class="font-bold text-2xl text-emerald-900">Create New Log</h1>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Borrower Form</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.tsselect :options="$equipments" wire:model.live="form.equipment_id" :options="$equipments" label="Equipment" />
            <x-form.input label="Borrower First Name" name="form.borrower_first_name" wire:model="form.borrower_first_name" />
            <x-form.input label="Borrower Last Name" name="form.borrower_last_name" wire:model="form.borrower_last_name" />
            <x-form.input label="Phone Number" name="form.borrower_phone_number" wire:model="form.borrower_phone_number" />
            <x-form.input label="Email" name="form.borrower_email" type="email" wire:model="form.borrower_email" />
            <x-form.date label="Start Date" name="form.start_date" wire:model="form.start_date" />
            <x-form.date label="End Date" name="form.end_date" wire:model="form.end_date" />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/borrow-logs" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="submit">Submit</x-primary-button>
        </section>
    </div>
</div>