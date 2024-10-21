<div>
    <div class="space-y-3">
        <x-plain-heading>Dashboard</x-plain-heading>
        <section class="flex items-center justify-between gap-2">
            <x-stats-container>
                <x-ri-tools-fill class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-sm">Available Equipment</h1>
                    <span class="text-white font-bold text-2xl">{{ $availableEquipments }}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-bi-pass class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-sm">Borrowed Equipment</h1>
                    <span class="text-white font-bold text-2xl">{{ $borrowedEquipments ?? 0 }}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-bi-question-circle class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-sm">Missing Equipment</h1>
                    <span class="text-white font-bold text-2xl">{{ $missingEquipments}}</span>
                </div>
            </x-stats-container>
            <x-stats-container>
                <x-ri-group-line class="size-10 text-white" />
                <div class="flex flex-col gap-2">
                    <h1 class="text-white font-bold text-sm">Personnel</h1>
                    <span class="text-white font-bold text-2xl">{{ $personnels ?? 0 }}</span>
                </div>
            </x-stats-container>
        </section>

        <section>
            <h1 class="font-bold text-primary">Low Stock Supplies</h1>
            <x-table>
                <x-tr>
                    <x-th>Id</x-th>
                    <x-th>Description</x-th>
                    <x-th>Total</x-th>
                    <x-th>Expiry Date</x-th>
                </x-tr>
                @foreach ($supplies as $supply)
                <tr class="border border-b-300">
                    <x-td>{{ $supply->id }}</x-td>
                    <x-td>{{ $supply->description }}</x-td>
                    <x-td>
                        <span class="px-3 py-1 rounded-lg text-white font-bold border bg-opacity-75 text-border-black {{ App\Helper\ColorStatus::getTotalColor($supply->total)}}">
                            {{ $supply->total }}
                        </span>
                    </x-td>
                    <x-td>{{ $supply->expiry_date->format('F d, Y') }}</x-td>
                </tr>
                @endforeach

            </x-table>
            <x-no-data :data="$supplies" />
            {{ $supplies->links() }}
        </section>
    </div>
</div>