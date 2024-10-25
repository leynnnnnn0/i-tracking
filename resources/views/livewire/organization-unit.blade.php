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
    <x-index-header heading="Organizations Unit" buttonName="Add New Organization Unit" location="/organization-units/create" wire:click="downloadPdf" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($organizations as $organization)
        <tr class="border-b border-gray-300">
            <x-td>{{ $organization->id }}</x-td>
            <x-td>{{ $organization->name }}</x-td>
            <x-td>
                <div class="flex items-center gap-2">
                    <x-bi-trash @click="openDeleteModal({{ $organization->id }})" class="cursor-pointer size-5 text-red-500" />
                    <x-link href="/organization-units/edit/{{ $organization->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </x-link>
                    <x-link href="/organization-units/view/{{ $organization->id }}">
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </x-link>
                </div>
            </x-td>
        <tr>
            @endforeach
    </x-table>
    {{ $organizations->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>