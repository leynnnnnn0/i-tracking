<div x-data="{
    showConfirmationModal: false,
    targetId: null,
    openConfirmationModal(id){
        this.targetId = id;
        this.showConfirmationModal = true;
        Livewire.on('Condemned', () => {
            this.showConfirmationModal = false;
        })
    }
}">
    <section class="space-y-3">
        <x-index-header heading="Missing Equipment List" buttonName="Make A Report" location="/missing-equipments/create" wire:click="downloadPdf" />

        <!-- Filter tab -->
        <x-filter-tab>
            <x-filter-tab-button :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Reported'" wire:click="setQuery('Reported')">Reported</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Reported To SPMO'" wire:click="setQuery('Reported To SPMO')">Reported To SPMO</x-filter-tab-button>
            <x-filter-tab-button :active="$query == 'Condemned'" wire:click="setQuery('Condemned')">Condemned</x-filter-tab-button>
        </x-filter-tab>


        <x-table>
            <x-tr>
                <x-th>Equipment</x-th>
                <x-th>status</x-th>
                <x-th>Reported By</x-th>
                <x-th>Reported Date</x-th>
                <x-th>Is Condemned?</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($data as $report)
            <tr class="border-b border-gray-300">
                <x-td>{{ $report->equipment->name}}</x-td>
                <x-td>{{ Str::headline($report->status)}}</x-td>
                <x-td>{{ $report->reported_by}}</x-td>
                <x-td>{{ $report->reported_date->format('F d, Y')}}</x-td>
                <x-td>{{ $report->equipment->status === 'Condemned' ? 'Yes' : 'No'}}</x-td>
                <x-td class="flex items-center gap-3">
                    <a href="/missing-equipments/edit/{{ $report->id}}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    @if($report->status === 'Reported to SPMO' && $report->equipment->status !== 'Condemned')
                    <button @click="openConfirmationModal({{ $report->equipment->id }})" class="hover:underline text-red-500 text-xs">
                        Condemned
                    </button>
                    @endif
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <x-no-data :data="$data" />
        <div>
            {{ $data->links() }}
        </div>
    </section>
    <template x-if="showConfirmationModal">
        <x-confirmation-modal @click="$wire.condemned(targetId)" message="Are you sure this item is already condemned?" />
    </template>
</div>