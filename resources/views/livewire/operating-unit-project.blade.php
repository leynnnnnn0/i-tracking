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
    <x-index-header heading="Operating Units" buttonName="Add New Operating Unit" location="/operating-units/create" wire:click="downloadPdf" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($operatingUnits as $operatingUnit)
        <tr class="border-b border-gray-300">
            <x-td>{{ $operatingUnit->id }}</x-td>
            <x-td>{{ $operatingUnit->name }}</x-td>
            <x-td>
                <div class="flex items-center gap-2">
                    <x-bi-trash @click="openDeleteModal({{ $operatingUnit->id }})" class="cursor-pointer size-5 text-red-500" />
                    <x-link href="/operating-units/edit/{{ $operatingUnit->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </x-link>
                    <x-link href="/operating-units/view/{{ $operatingUnit->id }}">
                        <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    </x-link>
                </div>
            </x-td>
        <tr>
            @endforeach
    </x-table>
    {{ $operatingUnits->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>
