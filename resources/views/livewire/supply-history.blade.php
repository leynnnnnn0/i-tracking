<div>
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <x-plain-heading>Supplies History</x-plain-heading>
            <button wire.loading.attr="disabled" wire:click="downloadPdf" class="px-4 py-1 bg-primary rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300 dark:bg-dark-primary">
                Export as PDF
            </button>
        </div>
        <!-- Filter -->
        <div class="bg-white rounded-lg h-fit p-3 flex items-center gap-3 justify-between dark:bg-dark-primary">
            <div class="flex items-center gap-2">
                <x-form.input label="Supply Name" name="name" wire:model.live="name" placeholder="Search..." />
                <x-form.input label="From" name="from" type="date" wire:model="from" />
                <x-form.input label="To" name="to" type="date" wire:model="to" />
                <div class="w-[300px]">
                    <x-form.filter-select label="Category" :options="$categories" wire:model="category" multiple placeholder="Filter by Category" />
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button wire:click="resetFilter" class="hover:bg-green-100 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg text-gray-500">Reset filter</button>
                <button wire:click="filter" wire:loading.attr="disabled" class="flex items-center gap-2 hover:bg-opacity-75 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg bg-primary text-white dark:bg-secondary-dark">
                    <span>
                        Filter
                    </span>
                    <x-loading wire:loading wire:target="filter" />
                </button>
            </div>
        </div>


        <x-table>
            <x-tr>
                <x-th>Id</x-th>
                <x-th>Supply Name</x-th>
                <x-th>Quantity</x-th>
                <x-th>Used</x-th>
                <x-th>Added</x-th>
                <x-th>Total</x-th>
                <x-th>Categories</x-th>
                <x-th>Date</x-th>
            </x-tr>
            @foreach ($history as $data)
            <tr class="border-b border-gray-300">
                <x-td>{{ $data->supply->id }}</x-td>
                <x-td>{{ $data->supply->description }}</x-td>
                <x-td>{{ $data->quantity }}</x-td>
                <x-td>{{ $data->used }}</x-td>
                <x-td>{{ $data->added }}</x-td>
                <x-td>{{ $data->total }}</x-td>
                <x-td>{{ $data->supply->formattedCategories($data->supply->categories) }}</x-td>
                <x-td>{{ $data->created_at->format('F d, Y') }}</x-td>
            </tr>
            @endforeach
        </x-table>
        <x-no-data :data="$history" />
        {{ $history->links() }}
    </div>
</div>