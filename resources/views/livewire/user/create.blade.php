<div class="space-y-4">
    <x-plain-heading>Create New User</x-plain-heading>

    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">User Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>

        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.input label="First Name"
                name="form.first_name"
                wire:model="form.first_name" />

            <x-form.input label="Middle Name"
                name="form.middle_name"
                wire:model="form.middle_name" />

            <x-form.input label="Last Name"
                name="form.last_name"
                wire:model="form.last_name" />

            <x-form.input label="Date of Birth"
                type="date"
                name="form.date_of_birth"
                wire:model="form.date_of_birth" />

            <x-form.select label="gender"
                :data="$genders"
                name="form.gender"
                wire:model="form.gender">
            </x-form.select>

            <x-form.input label="Phone Number"
                name="form.phone_number"
                wire:model="form.phone_number" />

            <x-form.input label="Email"
                type="email"
                name="form.email"
                wire:model="form.email" />

            <x-form.input label="Password"
                type="password"
                name="form.password"
                wire:model="form.password" />

            <x-form.select label="Role"
                :data="$roles"
                name="form.role"
                wire:model="form.role">
            </x-form.select>

        </section>
        <section class="flex justify-end gap-3">
            <a href="/users" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button wire:click="submit">Submit</x-primary-button>
        </section>
    </div>
</div>