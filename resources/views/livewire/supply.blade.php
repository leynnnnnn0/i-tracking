<div x-data="{
            showDeleteModal: false,
            open: false,
            targetId: null,
            showAddQuantity: false,
            showAddQuantityModal(id) {
                this.targetId = id;
                this.showAddQuantity = !this.showAddQuantity;
                Livewire.on('quantityValueUpdated', () => {
                    this.showAddQuantity = false;
                })
            },
            openDeleteModal(id) {
                this.showDeleteModal = true;
                this.targetId = id;
                Livewire.on('Data Deleted', () => {
                    this.showDeleteModal = false;
                })
                },
            toggle(id) {
                this.targetId = id;
                this.open = !this.open;
                Livewire.on('usedValueUpdated', () => {
                    this.open = false;
                })
            }}">
    <section class="space-y-3">
        <x-index-header heading="Supplies" buttonName="Create New Supply" location="/supplies/create" wire:click="downloadPdf" />
        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">
            <x-input wire:model.live="keyword" />
            <div class="w-[300px]">
                <x-form.filter-select :options="$categories" wire:model.live="category" multiple placeholder="Filter by Category" />
            </div>
        </x-others-filter>

        <section>
            <x-table>
                <x-tr>
                    <x-th>Id</x-th>
                    <x-th>Description</x-th>
                    <x-th>Used</x-th>
                    <x-th>Total</x-th>
                    <x-th>Expiry Date</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
                @foreach ($data as $supply)
                <tr class="border-b border-gray-300">
                    <x-td>{{ $supply->id }}</x-td>
                    <x-td>{{ $supply->description }}</x-td>
                    <x-td>
                        <span class=" cursor-pointer" @click="toggle({{$supply->id}})">
                            {{ $supply->used }}
                        </span>
                    </x-td>
                    <x-td>
                        <span class="px-3 py-1 rounded-lg text-white font-bold border bg-opacity-75 text-border-black {{ $this->getColor($supply->total) }}">
                            {{ $supply->total }}</x-td>
                    </span>
                    <x-td>{{ $supply->expiry_date ? $supply->expiry_date->format('F d, Y') : 'N/A' }}</x-td>
                    <x-td>
                        <div class="flex items-center gap-2">
                            <x-link href="/supplies/view/{{ $supply->id}}">
                                <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                            </x-link>
                            <x-link href="/supplies/edit/{{ $supply->id}}">
                                <x-bi-pencil-square class="size-5 text-blue-500" />
                            </x-link>
                            <x-bi-trash class="cursor-pointer size-5 text-red-500" @click="openDeleteModal({{ $supply->id }})" />
                            <x-text-button class="text-green-500" @click="showAddQuantityModal({{$supply->id}})">Add Quantity</x-text-button>
                            <div class="flex items-center gap-2"></div>
                    </x-td>
                </tr>
                @endforeach
            </x-table>

            <x-no-data :data=" $data" />

            <div class="mt-5">
                {{ $data->links() }}
            </div>
        </section>
    </section>

    <template x-if="open">
        <div class="flex items-center justify-center fixed bg-black/50 inset-0">
            <div class="relative bg-white rounded-lg h-fit min-w-[300px] p-5 space-y-2 dark:bg-secondary-dark">
                <x-bi-x @click="toggle" class="absolute top-3 right-3 size-5 cursor-pointer" />
                <section class="pb-3 border-b border-gray-300">
                    <h1 class="text-gray-700 font-bold text-lg dark:text-white">Add Used Value for item #<span x-text="targetId"></span></h1>
                </section>
                <x-tsnumber wire:model="form.used" />
                <x-primary-button @click="$wire.add(targetId)" class="w-full flex justify-center">Add</x-primary-button>
            </div>
        </div>
    </template>
    <template x-if="showAddQuantity">
        <div class="flex items-center justify-center fixed bg-black/50 inset-0">
            <div class="relative bg-white rounded-lg h-fit min-w-[300px] p-5 space-y-2 dark:bg-secondary-dark">
                <x-bi-x @click="showAddQuantityModal" class="absolute top-3 right-3 size-5 cursor-pointer" />
                <section class="pb-3 border-b border-gray-300">
                    <h1 class="text-gray-700 font-bold text-lg dark:text-white">Add Quantity for item #<span x-text="targetId"></span></h1>
                </section>
                <x-tsnumber wire:model="form.recently_added" />
                <x-primary-button @click="$wire.addQuantity(targetId)" class="w-full flex justify-center">Add</x-primary-button>
            </div>
        </div>
    </template>

    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>