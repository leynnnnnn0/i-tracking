<div x-data="{
        showDeleteModal: false,
        targetId: null,
        openDeleteModal(id) {
        this.showDeleteModal = true;
        this.targetId = id;
        Livewire.on('Data Deleted', () => {
            this.showDeleteModal = false;
        })
        }
    }">
    <x-index-header heading="Equipments" buttonName="Add New Equipment" location="/equipments/create" />
    <div class="space-y-3">

        <x-filter-tab>
            <x-filter-tab-button :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Available'" wire:click="setQuery('Available')">Available</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Borrowed'" wire:click="setQuery('Borrowed')">Borrowed</x-filter-tab-button>
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
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <div>
            {{ $equipments->links() }}
        </div>
    </div>
    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>