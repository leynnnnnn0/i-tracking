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
    <div>
        <x-index-header heading="Personnels" buttonName="Create New Personnel" location="/personnels/create" />
        <section>
            <x-table>
                <x-tr>
                    <x-th>Full Name</x-th>
                    <x-th>Department</x-th>
                    <x-th>Position</x-th>
                    <x-th>Phone Number</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
                @foreach ($data as $personnel)
                <tr class="border-b border-gray-300">
                    <x-td>{{ $personnel->full_name }}</x-td>
                    <x-td>{{ $personnel->department->name }}</x-td>
                    <x-td>{{ $personnel->position }}</x-td>
                    <x-td>{{ $personnel->phone_number }}</x-td>
                    <x-td class="flex items-center gap-3">
                        <x-bi-trash @click="openDeleteModal({{ $personnel->id }})" class="cursor-pointer size-5 text-red-500" />
                        <a href="/personnels/edit/{{ $personnel->id}}">
                            <x-bi-pencil-square class="size-5 text-blue-500" />
                        </a>
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </x-td>
                </tr>
                @endforeach
            </x-table>
            <div class="mt-5">
                {{ $data->links() }}
            </div>
        </section>
    </div>

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>