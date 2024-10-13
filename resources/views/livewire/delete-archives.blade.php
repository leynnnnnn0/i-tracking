<div>
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
                <x-td></x-td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-5">

        </div>
    </section>
</div>