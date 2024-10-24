<div x-data="{
    showConfirmationModal: false,
    showDeleteModal: false,
    targetId: null,
    message:  null,
    openConfirmationModal(id, message){
        this.targetId = id;
        this.message = message;
        this.showConfirmationModal = true;
        Livewire.on('Condemned', () => {
            this.showConfirmationModal = false;
        })
    },
    openDeleteModal(id) {
        this.showDeleteModal = true;
        this.targetId = id;
        Livewire.on('Data Deleted', () => {
            this.showDeleteModal = false;
        })
    }
}">
    <section class="space-y-3">
        <x-index-header heading="Missing Equipment List" buttonName="Make A Report" location="/missing-equipment/create" wire:click="downloadPdf" />

        <!-- Filter tab -->
        <x-filter-tab>
            <x-filter-tab-button target="setQuery('All')" :active="$query == 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Reported')" :active="$query == 'Reported'" wire:click="setQuery('Reported')">Reported</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Reported To SPMO')" :active="$query == 'Reported To SPMO'" wire:click="setQuery('Reported To SPMO')">Reported To SPMO</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Condemned')" :active="$query == 'Condemned'" wire:click="setQuery('Condemned')">Condemned</x-filter-tab-button>
        </x-filter-tab>

        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">

            <x-input wire:model.live="keyword" />

        </x-others-filter>

        <x-table>
            <x-tr>
                <x-th>Report Id</x-th>
                <x-th>Equipment</x-th>
                <x-th>status</x-th>
                <x-th>Reported By</x-th>
                <x-th>Reported Date</x-th>
                <x-th>Is Condemned?</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($data as $report)
            <tr class="border-b border-gray-300">
                <x-td>{{ $report->id}}</x-td>
                <x-td>{{ $report->equipment->name}}</x-td>
                <x-td>{{ Str::headline($report->status)}}</x-td>
                <x-td>{{ $report->reported_by}}</x-td>
                <x-td>{{ $report->reported_date->format('F d, Y')}}</x-td>
                <x-td>{{ $report->is_condemned ? 'Yes' : 'No'}}</x-td>
                <x-td>
                    <div class="flex items-center gap-2">
                        <x-link href="/missing-equipment/view/{{ $report->id}}">
                            <x-bi-eye class="size-5 text-green-500" />
                        </x-link>
                        <x-link href="/missing-equipment/edit/{{ $report->id}}">
                            <x-bi-pencil-square class="size-5 text-blue-500" />
                        </x-link>
                        <x-bi-trash @click="openDeleteModal({{ $report->id }})" class="cursor-pointer size-5 text-red-500" />
                        @if($report->status === 'Reported to SPMO' && !$report->is_condemned)
                        <button @click="openConfirmationModal({{ $report->id }}, 'Are you sure you want to tag this item as condemned?')" class="hover:underline text-red-500 text-xs">
                            Condemned
                        </button>
                        @endif
                        @if($report->status === 'Reported')
                        <button @click="openConfirmationModal({{ $report->id }}, 'Are you sure you want to tag this item as Reported To SPMO?')" class="hover:underline text-orange-500 text-xs">
                            Reported To SPMO
                        </button>
                        @endif
                    </div>
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
        <x-confirmation-modal @click="$wire.changeStatus(targetId)" />
    </template>
    <!-- Delete Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" message="Are you sure you want to delete this equipment?" />
    </template>
</div>