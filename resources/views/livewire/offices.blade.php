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
    <x-index-header heading="Offices" buttonName="Add New Office" location="/offices/create" wire:click="downloadPdf" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($offices as $office)
        <tr class="border-b border-gray-300">
            <x-td>{{ $office->id }}</x-td>
            <x-td>{{ $office->name }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash @click="openDeleteModal({{ $office->id }})" class="cursor-pointer size-5 text-red-500" />
                <a href="/offices/edit/{{ $office->id }}">
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <a href="/offices/view/{{ $office->id }}">
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </a>
            </x-td>
        <tr>
            @endforeach
    </x-table>
    {{ $offices->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>