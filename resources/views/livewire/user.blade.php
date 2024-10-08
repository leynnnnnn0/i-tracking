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
    <div class="space-y-3">
        <x-index-header heading="Users" buttonName="Add New User" location="/users/create" />
        <x-table>
            <x-tr>
                <x-th>Id</x-th>
                <x-th>Full Name</x-th>
                <x-th>Phone Number</x-th>
                <x-th>Email</x-th>
                <x-th>Role</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($users as $user)
            <tr class="border-b border-gray-300">
                <x-td>{{ $user->id }}</x-td>
                <x-td>{{ $user->first_name }}</x-td>
                <x-td>{{ $user->phone_number }}</x-td>
                <x-td>{{ $user->email }}</x-td>
                <x-td>{{ $user->role }}</x-td>
                <x-td class="flex items-center gap-3">
                    <x-bi-trash @click="openDeleteModal({{ $user->id }})" class="cursor-pointer size-5 text-red-500" />
                    <a href="/users/edit/{{ $user->id}}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </x-td>
            </tr>
            @endforeach
        </x-table>

        <div>
            {{ $users->links()}}
        </div>
    </div>



    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>