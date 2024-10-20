<div>
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <x-plain-heading>Supplies History</x-plain-heading>
            <button wire.loading.attr="disabled" wire:click="downloadPdf" class="px-4 py-1 bg-primary rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">
                Export as PDF
            </button>
        </div>
        <!-- Filter -->
        <div class="bg-white rounded-lg h-fit p-3 flex items-center gap-3 justify-between">
            <div class="flex items-end gap-3">
                <x-form.input label="Supply Name" name="name" wire:model="name" placeholder="Search..." />
                <x-form.input label="From" name="from" type="date" wire:model="from" />
                <x-form.input label="To" name="to" type="date" wire:model="to" />
            </div>
            <div class="flex items-center gap-3">
                <button wire:click="resetFilter" class="hover:bg-green-100 transition-colors duration-300 border border-gray-300 px-3 py-1 rounded-lg text-gray-500">Reset filter</button>
                <x-primary-button class="h-fit self-center" wire:click="filter">Filter</x-primary-button>
            </div>
        </div>
        <x-table>
            <x-tr>
                <x-th>Supply Id</x-th>
                <x-th>Supply Name</x-th>
                <x-th>Total Quantity</x-th>
                <x-th>Total Used</x-th>
                <x-th>Total Added</x-th>
                <x-th>Total</x-th>
                <x-th>Date</x-th>
            </x-tr>
            @foreach ($history as $data)
            <tr class="border-b border-gray-300">
                <x-td>{{ $data->supply->id }}</x-td>
                <x-td>{{ $data->supply->description }}</x-td>
                <x-td>{{ $data->total_quantity }}</x-td>
                <x-td>{{ $data->total_used }}</x-td>
                <x-td>{{ $data->total_added }}</x-td>
                <x-td>{{ $data->total }}</x-td>
                <x-td>{{ $data->created_at->format('F d, Y') }}</x-td>
            </tr>
            @endforeach
        </x-table>
        <x-no-data :data="$history" />
        {{ $history->links() }}
    </div>
</div>