<div x-data="{
        showFormModal: false,
        showDeleteModal: false,
        targetId: null,
        openFormModal(id) {
            this.showFormModal = true;
            this.targetId = id;
            $dispatch('setTargetId', { id: id })
            Livewire.on('borrowLogCreated', () => {
            this.showFormModal = false;
            })
        },
        openDeleteModal(id) {
        this.showDeleteModal = true;
        this.targetId = id;
        Livewire.on('Data Deleted', () => {
            this.showDeleteModal = false;
        })
        }
    }">
    <x-index-header heading="Equipments" buttonName="Add New Equipment" location="/equipments/create" pdfLocation="/equipments-pdf" />
    <div class="space-y-3">

        <x-filter-tab>
            <x-filter-tab-button :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Active'" wire:click="setQuery('Active')">Active</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Borrowed'" wire:click="setQuery('Borrowed')">Borrowed</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Condemnd'" wire:click="setQuery('Condemnd')">Codemnd</x-filter-tab-button>
        </x-filter-tab>
        <x-table>
            <x-tr>
                <x-th>Organization Unit</x-th>
                <x-th>Operating Unit/Project</x-th>
                <x-th>PN</x-th>
                <x-th>Name</x-th>
                <x-th>Responsible Person</x-th>
                <x-th>Status</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($equipments as $equipment)
            <tr class="border-b border-gray-300">
                <x-td>{{ $equipment->organization_unit }}</x-td>
                <x-td>{{ $equipment->operating_unit_project }}</x-td>
                <x-td>{{ $equipment->property_number }}</x-td>
                <x-td>{{ $equipment->name }}</x-td>
                <x-td>{{ $equipment->responsible_person->full_name }}</x-td>
                <x-td>{{ $equipment->status }}</x-td>
                <x-td class="flex items-center gap-2">
                    <x-bi-trash @click="openDeleteModal({{ $equipment->id }})" class="cursor-pointer size-5 text-red-500" />
                    <a href="/equipments/edit/{{ $equipment->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <button data-toggle="modal" data-target="#exampleModalCenter">
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </button>
                    @if($equipment->status != 'Borrowed')
                    <button @click="openFormModal({{ $equipment->id }})" class="underline text-orange-500 text-xs">Mark as Borrowed</button>
                    @endif
                    @if($equipment->status == 'Borrowed')
                    <a href="" class="underline text-emerald-500 text-xs">Mark as Returned</a>
                    @endif
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <div>
            {{ $equipments->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if ($equipmentsList)
    <template x-if="showFormModal">
        <x-form-modal heading="Borrow Equipment Form">
            <x-form.select label="Equipment"
                name="borrowEquipmentForm.equipment_id" :data="$equipmentsList" wire:model="borrowEquipmentForm.equipment_id" />
            <x-form.input label="Borrower First Name"
                name="borrowEquipmentForm.borrower_first_name" wire:model="borrowEquipmentForm.borrower_first_name" />
            <x-form.input label="Borrower Last Name"
                name="borrowEquipmentForm.borrower_last_name" wire:model="borrowEquipmentForm.borrower_last_name" />
            <x-form.input label="Phone Number"
                name="borrowEquipmentForm.borrower_phone_number" wire:model="borrowEquipmentForm.borrower_phone_number" />
            <x-form.input label="Email"
                name="borrowEquipmentForm.borrower_email" type="email" wire:model="borrowEquipmentForm.borrower_email" />
            <x-form.input label="Start Date"
                name="borrowEquipmentForm.start_date" type="date" wire:model="borrowEquipmentForm.start_date" />
            <x-form.input label="End Date"
                name="borrowEquipmentForm.end_date" type="date" wire:model="borrowEquipmentForm.end_date" />
            <section class="mt-5 flex items-center justify-end gap-3 col-span-2">
                <button @click="showFormModal = false" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</button>
                <x-primary-button wire:click="submit">Submit</x-primary-button>
            </section>
        </x-form-modal>
    </template>
    @endif
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />


    </template>





</div>