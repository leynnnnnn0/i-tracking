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
    <x-index-header heading="Categories" buttonName="Add New Category" location="/categories/create" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($categories as $category)
        <tr class="border-b border-gray-300">
            <x-td>{{ $category->id }}</x-td>
            <x-td>{{ $category->name }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash @click="openDeleteModal({{ $category->id }})" class="cursor-pointer size-5 text-red-500" />
                <a href="/categories/edit/{{ $category->id }}">
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <a href="/categories/view/{{ $category->id }}">
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </a>
            </x-td>
        <tr>
            @endforeach
    </x-table>
    {{ $categories->links() }}

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</section>