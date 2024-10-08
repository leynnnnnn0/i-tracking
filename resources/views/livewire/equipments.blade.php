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
    <x-table>
        <x-tr>
            <x-th>Unique ID</x-th>
            <x-th>Responsible Person</x-th>
            <x-th>Name</x-th>
            <x-th>Is Available?</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($equipments as $equipment)
        <tr class="border-b border-gray-300">
            <x-td>{{ $equipment->uid }}</x-td>
            <x-td>{{ $equipment->responsible_person->full_name }}</x-td>
            <x-td>{{ $equipment->name }}</x-td>
            <x-td>
                <span class="px-2 py-1 border bg-opacity-75 rounded-lg text-white font-bold {{ $equipment->is_available === 'Yes' ? 'border-green-500 bg-green-500' : 'border-red-500 bg-red-500'}}">
                    {{ $equipment->is_available }}
                </span>
            </x-td>
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
    {{ $equipments->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>