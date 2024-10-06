<div x-data="information">
    <div class="flex items-center justify-between mb-5">
        <h1 class="font-bold text-2xl text-emerald-900">Supplies</h1>
        <a href="/supplies/create" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">Create New Supply</a>
    </div>
    <section>
        <x-table>
            <x-tr>
                <x-th>
                    Description
                </x-th>
                <x-th>
                    Quantity
                </x-th>
                <x-th>
                    Used
                </x-th>
                <x-th>
                    Total
                </x-th>
                <x-th>
                    Expiry Date
                </x-th>
                <x-th>
                    Actions
                </x-th>
            </x-tr>
            @foreach ($data as $supply)
            <tr class="border-b border-gray-300">
                <x-td>{{ $supply->description }}</x-td>
                <x-td>{{ $supply->quantity }}</x-td>
                <x-td>
                    <span class="cursor-pointer" @click="toggle({{$supply->id}})">
                        {{ $supply->used }}
                    </span>
                </x-td>
                <x-td>
                    <span class="px-3 py-1 rounded-lg text-green-500 {{ $this->getColor($supply->total) }}">
                        {{ $supply->total }}</x-td>
                </span>
                <x-td>{{ $supply->expiry_date ? $supply->expiry_date->format('F d, Y') : 'N/A' }}</x-td>
                <x-td class="flex items-center gap-3">
                    <x-bi-trash class="cursor-pointer size-5 text-red-500" wire:click="delete('{{$supply->id}}')" />
                    <a href="/supplies/edit/{{ $supply->id}}">
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
    <!-- <template x-if="open && supply">
        <div class="flex items-center justify-center absolute bg-black/50 inset-0">
            <div class="relative bg-white rounded-lg h-fit w-[500px] p-5">
                <x-bi-x @click="toggle" class="absolute top-3 right-3 size-7 cursor-pointer" />
                <section class="pb-3 mb-3 border-b border-gray-300">
                    <h1 class="text-gray-700 font-bold text-lg">Supply Information</h1>
                </section>
                <section class="grid grid-cols-2 gap-3">
                    <x-flex-col>
                        <x-span-xs>Description</x-span-xs>
                        <x-span x-text="supply.description"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Unit</x-span-xs>
                        <x-span x-text="supply.unit"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Quanitity</x-span-xs>
                        <x-span x-text="supply.quantity"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Used</x-span-xs>
                        <x-span x-text="supply.used"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Recently Added</x-span-xs>
                        <x-span x-text="supply.recently_added"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Total</x-span-xs>
                        <x-span x-text="supply.total"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Expiry Date</x-span-xs>
                        <x-span x-text="supply.expiry_date"></x-span>
                    </x-flex-col>
                    <x-flex-col>
                        <x-span-xs>Is consumable?</x-span-xs>
                        <x-span x-text="supply.is_consumable"></x-span>
                    </x-flex-col>
                </section>
            </div>
        </div>
    </template> -->
    <template x-if="open">
        <div class="flex items-center justify-center absolute bg-black/50 inset-0">
            <div class="relative bg-white rounded-lg h-fit w-[300px] p-5 space-y-2">
                <x-bi-x @click="toggle" class="absolute top-3 right-3 size-5 cursor-pointer" />
                <section class="pb-3 border-b border-gray-300">
                    <h1 class="text-gray-700 font-bold text-lg">Add Used Value</h1>
                </section>
                <input wire:model="form.used" class="rounded-lg border-gray-300 w-full" type="number">
                <x-primary-button @click="$wire.add(targetId)" class="w-full flex justify-center">Add</x-primary-button>
            </div>
        </div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('information', () => ({
            open: false,
            targetId: null,
            updateUsedValue: true,
            supply: null,
            toggle(id) {
                this.targetId = id;
                this.open = !this.open;
                Livewire.on('usedValueUpdated', () => {
                    this.open = false;
                })
                // this.supply = result;
                // const result = @json($data).data.find(item => item.id == id);
            }
        }))
    })
</script>