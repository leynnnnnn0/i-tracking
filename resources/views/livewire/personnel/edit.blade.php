<div class="space-y-4">
    <x-plain-heading>Edit Personnel Information</x-plain-headi>
        <div class="bg-white rounded-xl p-5">
            <section class="py-2 grid grid-cols-2 gap-5">
                <x-form.input label="First Name" name="form.first_name" wire:model="form.first_name" />
                <x-form.input label="Middle Name" name="form.middle_name" :isRequired="false" wire:model="form.middle_name" />
                <x-form.input label="Last Name" name="form.last_name" wire:model="form.last_name" />
                <x-form.select label="Gender" :data="$genders" name="form.gender" wire:model="form.gender" />
                <x-form.input label="Date of Birth" name="form.date_of_birth" type="date" wire:model="form.date_of_birth" />
                <x-form.input label="Phone Number" name="form.phone_number" type="number" wire:model="form.phone_number" />
                <x-form.input label="Email" name="form.email" type="email" wire:model="form.email" />
                <x-form.select label="Position" :data="$positions" name="form.position" wire:model="form.position" />
                <x-form.input label="Start Date" name="form.start_date" type="date" wire:model="form.start_date" />
                <x-form.input label="End Date" name="form.end_date" type="date" wire:model="form.end_date" :isRequired="false" />
                <x-form.input label="Remarks" name="form.remarks" wire:model="form.remarks" :isRequired="false" />
                <x-form.select label="Department" :data="$departments" name="form.department_id" wire:model="form.department_id" />
            </section>
            <section class="flex justify-end gap-3">
                <a href="/supplies" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
                <button wire:click="edit" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">Update</button>
            </section>
        </div>
</div>