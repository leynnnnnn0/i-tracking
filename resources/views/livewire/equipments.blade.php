<section class="space-y-3">
    <x-index-header heading="Equipments" buttonName="Add New Equipment" location="/equipments/create" />
    <x-table>
        <x-tr>
            <x-th>Unique ID</x-th>
            <x-th>Responsible Person</x-th>
            <x-th>Name</x-th>
            <x-th>Is Available?</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($equipments as $equipment)
        <tr class="border-b border-gray-300">
            <x-td>{{ $equipment->uid }}</x-td>
            <x-td>{{ $equipment->responsible_person->full_name }}</x-td>
            <x-td>{{ $equipment->name }}</x-td>
            <x-td>{{ $equipment->is_availble }}</x-td>
            <x-td class="flex items-center gap-2">
                <x-bi-trash class="cursor-pointer size-5 text-red-500" />
                <a href="/equipments/edit/{{ $equipment->id }}">
                    <x-bi-pencil-square class="size-5 text-blue-500" />
                </a>
                <x-bi-eye class="cursor-pointer size-5 text-green-500" />
            </x-td>
        <tr>
            @endforeach
    </x-table>
    {{ $equipments->links() }}
</section>