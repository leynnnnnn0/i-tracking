<section class="space-y-3" x-data="{
        showDeleteModal: false,
        targetId: null,
        openDeleteModal(id) {
            this.showDeleteModal = true;
            this.targetId = id;
            Livewire.on('Data Deleted', () => {
                this.showDeleteModal = false;
            })
        },
    }">
    <x-index-header heading="Officers" buttonName="Add New Officer" location="/accounting-officers/create" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Office</x-th>
            <x-th>Full Name</x-th>
            <x-th>Email</x-th>
            <x-th>Phone Number</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($officers as $officer)
        <tr class="border-b border-gray-300">
            <x-td>{{ $officer->id }}</x-td>
            <x-td>{{ $officer->office ? $officer->office->name : 'N/A'  }}</x-td>
            <x-td>{{ $officer->full_name }}</x-td>
            <x-td>{{ $officer->email }}</x-td>
            <x-td>{{ $officer->phone_number }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash @click="openDeleteModal({{ $officer->id }})" class="cursor-pointer size-5 text-red-500" />
                <a href="/accounting-officers/edit/{{ $officer->id }}">
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <a href="/accounting-officers/view/{{ $officer->id }}">
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </a>
            </x-td>
        </tr>
        @endforeach
    </x-table>
    {{ $officers->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>