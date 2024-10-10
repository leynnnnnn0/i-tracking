<div>
    <div class="space-y-3">
        <x-plain-heading>Supplies History</x-plain-heading>
        <x-table>
            <x-tr>
                <x-th>Supply Id</x-th>
                <x-th>Supply Name</x-th>
                <x-th>Total Quantity</x-th>
                <x-th>Total Used</x-th>
                <x-th>Total Added</x-th>
                <x-th>Total</x-th>
                <x-th>Action</x-th>
            </x-tr>
            @foreach ($history as $data)
            <tr class="border-b border-gray-300">
                <x-td>{{ $data->supply->id }}</x-td>
                <x-td>{{ $data->supply->description }}</x-td>
                <x-td>{{ $data->total_quantity }}</x-td>
                <x-td>{{ $data->total_used }}</x-td>
                <x-td>{{ $data->total_added }}</x-td>
                <x-td>{{ $data->total }}</x-td>
                <x-td>

                </x-td>
            </tr>
            @endforeach
        </x-table>
        {{ $history->links() }}
    </div>
</div>