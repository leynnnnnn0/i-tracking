<div class="space-y-5">
    <div class="flex items-center justify-between">
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
                <x-td>{{ $supply->used }}</x-td>
                <x-td>
                    <span class="px-3 py-1 rounded-lg text-white {{ $this->getColor($supply->total) }}">
                        {{ $supply->total }}</x-td>
                </span>
                <x-td>{{ $supply->expiry_date ? $supply->expiry_date->format('F d, Y') : 'N/A' }}</x-td>
                <x-td class="flex items-center gap-3">
                    <x-bi-trash class="cursor-pointer size-5 text-red-500" wire:click="delete('{{$supply->id}}')" />
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                    <x-bi-eye class="size-5 text-green-500" />
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-5">
            {{ $data->links() }}
        </div>
    </section>
</div>