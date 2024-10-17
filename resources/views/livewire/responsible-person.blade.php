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
    <x-index-header heading="Responsible Persons" buttonName="Add New Responsible Person" location="/responsible-persons/create" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Accounting Officer</x-th>
            <x-th>Full Name</x-th>
            <x-th>Email</x-th>
            <x-th>Phone Number</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($persons as $person)
        <tr class="border-b border-gray-300">
            <x-td>{{ $person->id }}</x-td>
            <x-td>{{ $person->accounting_officer ? $person->accounting_officer->full_name :'N/A' }}</x-td>
            <x-td>{{ $person->full_name }}</x-td>
            <x-td>{{ $person->email }}</x-td>
            <x-td>{{ $person->phone_number }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash @click="openDeleteModal({{ $person->id }})" class="cursor-pointer size-5 text-red-500" />
                <a href="/responsible-persons/edit/{{ $person->id }}">
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <a href="/responsible-persons/view/{{ $person->id }}">
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </a>
            </x-td>
        </tr>
        @endforeach
    </x-table>
    {{ $persons->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>