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
        <x-index-header wire:click="downloadPdf" heading="Users" buttonName="Add New User" location="/users/create" />

        <!-- Filter -->
        <div class="bg-white rounded-lg h-fit p-3 flex items-center gap-3 justify-between">
            <div>
                <input type="text" class="w-42 rounded-lg border border-gray-300" placeholder="Search for keyword" wire:model.live="keyword">
                <x-form.filter-select :data="$roles" wire:model.live="role">
                    <option value="">Role</option>
                </x-form.filter-select>
            </div>
            <div class="flex items-center gap-3">
                <button wire:click="resetFilter" class="hover:bg-green-100 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg text-gray-500">Reset filter</button>
            </div>
        </div>

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
                    <x-link href="/users/view/{{ $user->id}}">
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </x-link>
                    <x-bi-trash @click="openDeleteModal({{ $user->id }})" class="cursor-pointer size-5 text-red-500" />
                    <x-link href="/users/edit/{{ $user->id}}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </x-link>
                </x-td>
            </tr>
            @endforeach
        </x-table>

        <x-no-data :data="$users" />

        <div>
            {{ $users->links()}}
        </div>
    </div>



    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>