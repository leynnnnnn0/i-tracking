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
        <x-index-header heading="Personnel" buttonName="Create New Personnel" location="/personnel/create" wire:click="downloadPdf" />
        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">
            <x-input wire:model.live="keyword" />
            <div class="w-[300px]">
                <x-form.filter-select placeholder="Position" :options="$positions" wire:model.live="positionId" />
            </div>
            <div class="w-[200px]">
                <x-form.filter-select placeholder="Department" :options="$departments" wire:model.live="departmentId" />
            </div>
            <div class="w-[300px]">
                <x-form.filter-select placeholder="Office" :options="$offices" wire:model.live="officeId" />
            </div>
        </x-others-filter>

        <section>
            <x-table>
                <x-tr>
                    <x-th>Full Name</x-th>
                    <x-th>Office</x-th>
                    <x-th>Department</x-th>
                    <x-th>Position</x-th>
                    <x-th>Phone Number</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
                @foreach ($data as $personnel)
                <tr class="border-b border-gray-300">
                    <x-td>{{ $personnel->full_name }}</x-td>
                    <x-td>{{ $personnel->office ? $personnel->office->name : 'N/a' }}</x-td>
                    <x-td>{{ $personnel->department ? $personnel->department->name : 'N/a' }}</x-td>
                    <x-td>{{ $personnel->position->name }}</x-td>
                    <x-td>{{ $personnel->phone_number }}</x-td>
                    <x-td>
                        <div class="flex items-center gap-2">
                            <x-link href="/personnel/view/{{ $personnel->id}}">
                                <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                            </x-link>
                            <x-link href="/personnel/edit/{{ $personnel->id}}">
                                <x-bi-pencil-square class="size-5 text-blue-500" />
                            </x-link>
                            <x-bi-trash @click="openDeleteModal({{ $personnel->id }})" class="cursor-pointer size-5 text-red-500" />
                        </div>
                    </x-td>
                </tr>
                @endforeach
            </x-table>

            <x-no-data :data="$data" />

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