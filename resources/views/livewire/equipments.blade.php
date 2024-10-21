<div x-data="{
        showFormModal: false,
        showDeleteModal: false,
        showConfirmationModal: false,
        targetId: null,

        openConfirmationModal(id, name) {
            this.showConfirmationModal = true;
            this.targetId = id;
            $dispatch('setTargetId', { id: id })
            Livewire.on('Status Updated', () => {
            this.showConfirmationModal = false;
            })
        },
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
    <x-index-header wire:click="downloadPdf" heading="Equipment" buttonName="Add New Equipment" location="/equipments/create" pdfLocation="/equipments-pdf" />
    <div class="space-y-3">
        <!-- Filter tab -->
        <x-filter-tab>
            <x-filter-tab-button :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Active'" wire:click="setQuery('Active')">Active</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Borrowed'" wire:click="setQuery('Borrowed')">Borrowed</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Condemned'" wire:click="setQuery('Condemned')">Condemned</x-filter-tab-button>
        </x-filter-tab>

        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">
            <x-input wire:model.live="keyword" />
            <x-form.filter-select :data="$accountingOfficers" wire:model.live="accountingOfficerId">
                <option value="">Accounting Officer</option>
            </x-form.filter-select>
            <x-form.filter-select :data="$responsiblePersons" wire:model.live="responsiblePersonId">
                <option value="">Responsible Person</option>
            </x-form.filter-select>
            <x-form.filter-select :data="$operatingUnits" wire:model.live="operatingUnit">
                <option value="">Operating Unit</option>
            </x-form.filter-select>
            <x-form.filter-select :data="$organizationUnits" wire:model.live="organizationUnit">
                <option value="">Organization Unit</option>
            </x-form.filter-select>
        </x-others-filter>

        <!-- Table -->
        <x-table wire:scroll>
            <x-tr>
                <x-th>ID</x-th>
                <x-th>Name</x-th>
                <x-th>PN</x-th>
                <x-th>Quantity</x-th>
                <x-th>Organization Unit</x-th>
                <x-th>Operating Unit/Project</x-th>
                <x-th>Responsible Person</x-th>
                <x-th>Status</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($equipments as $equipment)
            <tr class="border-b border-gray-300">
                <x-td>{{ $equipment->id }}</x-td>
                <x-td>{{ $equipment->name }}</x-td>
                <x-td>{{ $equipment->property_number }}</x-td>
                <x-td>{{ $query === 'All' ||  $query === 'Active' ? $equipment->quantity : $equipment->borrowed_log->sum('quantity') ?? $equipment->total_borrowed  }}</x-td>
                <x-td>{{ $equipment->organization_unit }}</x-td>
                <x-td>{{ $equipment->operating_unit_project }}</x-td>
                <x-td>{{ $equipment->responsible_person->full_name }}</x-td>
                <x-td>
                    <span class="px-3 py-1 border font-bold rounded-lg bg-opacity-75 {{ $query === 'All' ? App\Enum\EquipmentStatus::getColor($equipment->status) : App\Enum\EquipmentStatus::getColor($query) }}">
                        {{ $query === 'All' ? 'Active' : $query }}
                    </span>
                </x-td>
                <x-td class="flex items-center gap-2">
                    <a href="/equipments/view/{{ $equipment->id }}">
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </a>
                    <a href="/equipments/edit/{{ $equipment->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <x-bi-trash @click="openDeleteModal({{ $equipment->id }})" class="cursor-pointer size-5 text-red-500" />
                    @if($equipment->status != 'Borrowed' && $equipment->status != 'Condemned')
                    <x-text-button @click="openFormModal({{ $equipment->id }})" class="text-orange-500">Borrowed</x-text-button>
                    @endif
                    @if($equipment->status == 'Borrowed')
                    <x-text-button @click="openConfirmationModal({{ $equipment->id }})" class="text-emerald-500">Returned</x-text-button>
                    @endif
                </x-td>
            </tr>
            @endforeach
        </x-table>

        <x-no-data :data="$equipments" id="paginatedEquipment" />
        <div>
            {{ $equipments->links(data: ['scrollTo' => '#paginatedEquipment']) }}
        </div>
    </div>

    <!-- Create Form Modal -->
    @if ($equipmentsList)
    <template x-if="showFormModal">
        <x-form-modal heading="Borrow Equipment Form">
            <x-form.select label="Equipment"
                name="borrowEquipmentForm.equipment_id" :data="$equipmentsList" wire:model="borrowEquipmentForm.equipment_id" disabled />
            <x-form.input label="Borrower First Name"
                name="borrowEquipmentForm.borrower_first_name" wire:model="borrowEquipmentForm.borrower_first_name" />
            <x-form.input label="Borrower Last Name"
                name="borrowEquipmentForm.borrower_last_name" wire:model="borrowEquipmentForm.borrower_last_name" />
            <x-form.input label="Phone Number"
                name="borrowEquipmentForm.borrower_phone_number" wire:model="borrowEquipmentForm.borrower_phone_number" :isRequired="false" />
            <x-form.input label="Email"
                name="borrowEquipmentForm.borrower_email" type="email" wire:model="borrowEquipmentForm.borrower_email" :isRequired="false" />
            <x-form.input label="Start Date"
                name="borrowEquipmentForm.start_date" type="date" wire:model="borrowEquipmentForm.start_date" />
            <x-form.input label="End Date"
                name="borrowEquipmentForm.end_date" type="date" wire:model="borrowEquipmentForm.end_date" />
            <x-form.input label="Equipment Quantity" name="borrowEquipmentForm.quantity" wire:model="borrowEquipmentForm.quantity" type="number" onkeydown="return event.keyCode !== 69" :hint="$quantityHint" />
            <section class="mt-5 flex items-center justify-end gap-3 col-span-2">
                <button @click="showFormModal = false" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300">Cancel</button>
                <x-primary-button wire:click="submit">Submit</x-primary-button>
            </section>
        </x-form-modal>
    </template>
    @endif

    <!-- Delete Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" message="Are you sure you want to delete this equipment?" />
    </template>

    <!-- Update Modal -->
    <template x-if="showConfirmationModal">
        <x-confirmation-modal @click="$wire.updateStatus(targetId)" message="Are you sure you want this to mark this as returned?" />
    </template>


</div>

@if(request('download_pdf'))
<script>
    window.onload = function() {
        window.location.href = "{!! route('responsible-person-pdf', ['previous_responsible_person' => request('previous_responsible_person'), 'equipment_id' => !! request('equipment_id') ]) !!}";


        window.history.replaceState({}, document.title, window.location.pathname);
    };
</script>
@endif