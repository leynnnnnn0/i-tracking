<div x-data="{
    showDeleteModal: false,
    targetId: null,
    type: null,
    openDeleteModal(id, type){
        Livewire.on('Data Deleted', () => {
            this.showDeleteModal = false;
        })
        this.showDeleteModal = true;
        this.targetId = id;
        this.type = type;
    }
}">
    <section class="space-y-3">
        <x-plain-heading>Delete Archives</x-plain-heading>
        <x-table>
            <x-tr>
                <x-th>Id</x-th>
                <x-th>Type</x-th>
                <x-th>Name</x-th>
                <x-th>Deleted At</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($deletedItems as $item)
            <tr class="border border-gray-300">
                <x-td>{{ $item->id }}</x-td>
                <x-td>{{ ucfirst($item->type) }}</x-td>
                <x-td>{{ $item->delete_name  }}</x-td>
                <x-td>{{ Carbon\Carbon::parse($item->deleted_at)->format('F j, Y \a\t h:i a') }}</x-td>
                <x-td class="flex items-center gap-3">
                    <button @click="openDeleteModal({{ $item->id}}, '{{$item->type}}')" class="hover:underline flex items-center gap-1 text-xs text-red-500">
                        <x-bi-trash class="cursor-pointer size-5 text-red-500" /> Delete Permanently
                    </button>
                    <button wire:click="restore({{ $item->id}}, '{{$item->type}}')" class="hover:underline flex items-center gap-1 text-xs text-blue-500">
                        <x-ri-history-fill class="size-5" /> Restore
                    </button>
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-5">

        </div>
    </section>


    <!-- Delete Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId, type)" />
    </template>
</div>