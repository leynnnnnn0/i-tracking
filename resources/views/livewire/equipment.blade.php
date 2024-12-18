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
    <x-index-header wire:click="downloadPdf" heading="Equipment" buttonName="Add New Equipment" :location="route('equipment.create')" pdfLocation="/equipments-pdf" />
    <div class="space-y-3">
        <!-- Filter tab -->
        <x-filter-tab>
            <x-filter-tab-button target="setQuery('All')" :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Available')" :active="$query == 'Available'" wire:click="setQuery('Available')">Available</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Borrowed')" :active="$query == 'Borrowed'" wire:click="setQuery('Borrowed')">Borrowed</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Condemned')" :active="$query == 'Condemned'" wire:click="setQuery('Condemned')">Condemned</x-filter-tab-button>
        </x-filter-tab>

        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">

            <x-input wire:model.live="keyword" />
            <x-form.filter-select placeholder="Accounting Officer"
                :options="$accountingOfficers"
                wire:model.live="accountingOfficerId" />
            <x-form.filter-select placeholder="Responsible Person"
                :options="$responsiblePersons"
                wire:model.live="responsiblePersonId" />
            <x-form.filter-select placeholder="Operating Unit"
                :options="$operatingUnits"
                wire:model.live="operatingUnit" />
            <x-form.filter-select placeholder="Organization Unit"
                :options="$organizationUnits"
                wire:model.live="organizationUnit" />
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
                <x-th>Status</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($equipments as $equipment)
            <tr class="border-b border-gray-300">
                <x-td>{{ $equipment->id }}</x-td>
                <x-td>{{ $equipment->name }}</x-td>
                <x-td>{{ $equipment->property_number }}</x-td>
                <x-td>{{ $equipment->quantity($query)}}</x-td>
                <x-td>{{ $equipment->organization_unit->name }}</x-td>
                <x-td>{{ $equipment->operating_unit_project->name }}</x-td>
                <x-td>
                    <span class="px-3 py-1 border font-bold rounded-lg bg-opacity-75 {{ $query === 'Condemned' ? App\Enum\EquipmentStatus::getColor(App\Enum\EquipmentStatus::CONDEMNED)  : App\Enum\EquipmentStatus::getColor($equipment->status) }}">
                        {{ $query === 'Condemned' ? $query : Str::headline($equipment->status->value) }}
                </x-td>
                <x-td>
                    <div class="flex items-center gap-2">
                        <x-link href="/equipment/view/{{ $equipment->id }}?query={{$query}}">
                            <x-bi-eye class="size-5 text-green-500" />
                        </x-link>
                        <x-link href="/equipment/edit/{{ $equipment->id }}">
                            <x-bi-pencil-square class="size-5 text-blue-500" />
                        </x-link>
                        <x-bi-trash @click="openDeleteModal({{ $equipment->id }})" class="cursor-pointer size-5 text-red-500" />
                        @if($equipment->quantity > $equipment->quantity_borrowed)
                        <x-text-button @click="openFormModal({{ $equipment->id }})" class="text-orange-500">
                            Borrow
                        </x-text-button>
                        @endif
                    </div>
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
            <x-form.select disabled label="Equipment"
                name="borrowEquipmentForm.equipment_id" :options="$equipmentsList" wire:model="borrowEquipmentForm.equipment_id" />
            <x-form.input label="Borrower First Name"
                name="borrowEquipmentForm.borrower_first_name" wire:model="borrowEquipmentForm.borrower_first_name" />
            <x-form.input label="Borrower Last Name"
                name="borrowEquipmentForm.borrower_last_name" wire:model="borrowEquipmentForm.borrower_last_name" />
            <x-form.input label="Phone Number"
                name="borrowEquipmentForm.borrower_phone_number" wire:model="borrowEquipmentForm.borrower_phone_number" :isRequired="false" />
            <x-form.input label="Email"
                name="borrowEquipmentForm.borrower_email" type="email" wire:model="borrowEquipmentForm.borrower_email" :isRequired="false" />
            <x-form.date
                label="Start Date"
                name="borrowEquipmentForm.start_date"
                :disable="\Carbon\CarbonInterval::days(1)->toPeriod(now()->subMonth(), now()->subDay())->toArray()"
                wire:model.live="borrowEquipmentForm.start_date" />
            <x-form.date
                label="End Date"
                name="borrowEquipmentForm.end_date"
                :disable="\Carbon\CarbonInterval::days(1)->toPeriod(now()->subMonth(), now()->subDay())->toArray()"
                wire:model="borrowEquipmentForm.end_date" />
            <x-form.tsnumber label="Equipment Quantity" name="borrowEquipmentForm.quantity" wire:model="borrowEquipmentForm.quantity" :hint="$quantityHint" />
            <section class="mt-5 flex items-center justify-end gap-3 col-span-2">
                <button @click="showFormModal = false" class="px-4 py-1 border border-gray-500 rounded-lg text-black hover:bg-opacity-75 transition-colors duration-300 dark:text-white dark:border-white">Cancel</button>
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
        window.location.href = "{!! route('equipment-new-responsible-person-pdf', ['previous_responsible_person' => request('previous_responsible_person'), 'equipment_id' => request('equipment_id') ]) !!}";


        window.history.replaceState({}, document.title, window.location.pathname);
    };
</script>
@endif