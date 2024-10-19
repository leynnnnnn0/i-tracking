<div x-data="{
     showConfirmationModal: false,
     openConfirmationModal() {
            this.showConfirmationModal = true;
            Livewire.on('Confirm Update', () => {
            this.showConfirmationModal = false;
            })
        },
    }">
    <section class="space-y-3">
        <x-plain-heading>Edit Equipment Details</x-plain-heading>

        <div class="bg-white rounded-xl p-5">
            <section class="pb-5 border-b border-gray-300">
                <h1 class="text-gray-700 font-bold text-lg">Equipment Information</h1>
                <p class="text-gray-600 text-xs">Please input all the required fields.</p>
            </section>
            <section class="py-2 grid grid-cols-2 gap-5">
                <x-form.tsselect :options="$officers" wire:model.live="officer" label="Accounting Officer" />

                <x-form.tsselect :options="$persons" wire:model.live="form.responsible_person_id" label="Responsible Person" />

                <x-form.select label="Organization Unit"
                    :data="$organizations"
                    name="form.organization_unit"
                    wire:model="form.organization_unit">
                </x-form.select>

                <x-form.select label="Operating Unit Project"
                    :data="$operating_units"
                    name="form.operating_unit_project"
                    wire:model="form.operating_unit_project" />

                <x-form.input label="Property Number"
                    name="form.property_number"
                    wire:model="form.property_number" />

                <x-form.input label="Quantity"
                    onkeydown="return event.keyCode !== 69"
                    name="form.quantity"
                    type="number"
                    wire:model.lazy="form.quantity" />

                <x-form.select label="Unit"
                    :data="$units"
                    name="form.unit"
                    wire:model="form.unit" />

                <x-form.input label="Name"
                    name="form.name"
                    wire:model="form.name" />

                <x-form.text-area label="Description"
                    name="form.description"
                    wire:model="form.description"
                    :isRequired="false" />

                <x-form.input label="Date Acquired"
                    name="form.date_acquired"
                    type="date"
                    wire:model="form.date_acquired" />

                <x-form.input label="Fund"
                    name="form.fund"
                    wire:model="form.fund" />

                <x-form.input label="PPE Class"
                    name="form.ppe_class"
                    wire:model="form.ppe_class" />

                <div class="flex flex-col">
                    <span>Estimated Useful Time</span>
                    <x-tsdate month-year-only wire:model="form.estimated_useful_time" name="form.estimated_useful_time" />
                    <x-form.error name="form.estimated_useful_time" />
                </div>

                <x-form.input label="Unit Price"
                    onkeydown="return event.keyCode !== 69"
                    name="form.unit_price"
                    type="number"
                    step="0.01"
                    wire:model.lazy="form.unit_price" />

                <x-form.input label="Total Amount"
                    onkeydown="return event.keyCode !== 69"
                    name="form.total_amount"
                    type="number"
                    step="0.01"
                    wire:model="form.total_amount" />

            </section>
            <section class="flex justify-end gap-3">
                <a href="/equipments" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</a>
                <x-primary-button @click="openConfirmationModal">Update</x-primary-button>
            </section>
        </div>


    </section>
    <!-- Modal -->
    <template x-if="showConfirmationModal">
        <x-confirmation-modal message="Are you sure you want to update the equipment details?" wire:click="update" />
    </template>
</div>