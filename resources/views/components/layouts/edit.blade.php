<div x-data="{
     showConfirmationModal: false,
     openConfirmationModal() {
            this.showConfirmationModal = true;
            Livewire.on('Confirm Update', () => {
            this.showConfirmationModal = false;
            })
        },
    }">
    <x-plain-heading>Edit Personnel Information</x-plain-heading>
    <div class="bg-white rounded-xl p-5">
        <section class="pb-5 border-b border-gray-300">
            <h1 class="text-gray-700 font-bold text-lg">Personnel Information</h1>
            <p class="text-gray-600 text-xs">Please input all the required fields.</p>
        </section>
        <section class="py-2 grid grid-cols-2 gap-5">
            <x-form.input label="First Name" name="form.first_name" wire:model="form.first_name" />
            <x-form.input label="Middle Name" name="form.middle_name" :isRequired="false" wire:model="form.middle_name" />
            <x-form.input label="Last Name" name="form.last_name" wire:model="form.last_name" />
            <x-form.select label="Gender" :data="$genders" name="form.gender" wire:model="form.gender" />
            <x-form.date label="Date of Birth" name="form.date_of_birth" type="date" wire:model="form.date_of_birth" />
            <x-form.input label="Phone Number" name="form.phone_number" type="number" wire:model="form.phone_number" />
            <x-form.input label="Email" name="form.email" type="email" wire:model="form.email" />
            <x-form.select label="Position" :data="$positions" name="form.position" wire:model="form.position" />
            <x-form.date label="Start Date" name="form.start_date" type="date" wire:model="form.start_date" />
            <x-form.date label="End Date" name="form.end_date" type="date" wire:model="form.end_date" :isRequired="false" />
            <x-form.text-area label="Remarks" name="form.remarks" wire:model="form.remarks" :isRequired="false" />
            <x-form.select label="Department" :data="$departments" name="form.department_id" wire:model="form.department_id" />
        </section>
        <section class="flex justify-end gap-3">
            <a href="/supplies" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
            <x-primary-button @click="openConfirmationModal">Update</x-primary-button>
        </section>
    </div>

    <!-- Modal -->
    <template x-if="showConfirmationModal">
        <x-confirmation-modal message="Are you sure you want to update the equipment details?" wire:click="update" />
    </template>

</div>