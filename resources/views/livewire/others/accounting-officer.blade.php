<section class="space-y-3">
    <x-index-header heading="Accounting Officers" buttonName="Add New" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($officers as $officer)
        <tr class="border-b border-gray-300">
            <x-td>{{ $officer->id }}</x-td>
            <x-td>{{ $officer->full_name }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash class="cursor-pointer size-5 text-red-500" />
                <a>
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <x-bi-eye class="cursor-pointer size-5 text-green-500" />
            </x-td>
        <tr>
            @endforeach
    </x-table>
</section>