<div class="space-y-5">
    <h1 class="font-bold text-2xl">Supplies</h1>
    <section>
        <x-table>
            <x-tr>
                <x-th>
                    Item
                </x-th>
                <x-th>
                    Stocks
                </x-th>
                <x-th>
                    Cost Per Piece
                </x-th>
                <x-th>
                    Description
                </x-th>
                <x-th>
                    Actions
                </x-th>
            </x-tr>
            @foreach ($data as $supply)
            <tr class="border-b border-gray-300">
                <x-td>{{ $supply->name }}</x-td>
                <x-td>{{ $supply->stocks }}</x-td>
                <x-td>{{ Number::format($supply->cost_per_piece, 2)}}</x-td>
                <x-td>test</x-td>
                <x-td class="flex items-center gap-3">
                    <x-bi-trash class="size-5 text-red-500" />
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </x-td>
            </tr>
            @endforeach

        </x-table>
    </section>
</div>