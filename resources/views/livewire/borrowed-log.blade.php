<div x-data="{
        showDeleteModal: false,
        showConfirmationModal: false,
        targetId: null,
        openConfirmationModal(id) {
        this.showConfirmationModal = true;
        this.targetId = id;
        console.log(this.targetId)
        Livewire.on('Mark As Returned', () => {
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
    <div class="space-y-3">
        <x-index-header wire:click="downloadPdf" heading="Borrowed Equipment Log" buttonName="Add new log" location="/borrowed-logs/create" />

        <x-filter-tab>
            <x-filter-tab-button target="setQuery('All')" :active="$query === 'All'" wire:click="setQuery('All')">All</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Returned')" :active="$query === 'Returned'" wire:click="setQuery('Returned')">Returned</x-filter-tab-button>
            <x-filter-tab-button target="setQuery('Not Returned')" :active="$query === 'Not Returned'" wire:click="setQuery('Not Returned')">Not Returned</x-filter-tab-button>
        </x-filter-tab>

        <!-- Filter -->
        <x-others-filter wire:click="resetFilter">

            <x-input wire:model.live="keyword" />

        </x-others-filter>


        <x-table>
            <x-tr>
                <x-th>Id</x-th>
                <x-th>Equipment</x-th>
                <x-th>Borrowed Quantity</x-th>
                <x-th>Borrower</x-th>
                <x-th>Start Date</x-th>
                <x-th>End Date</x-th>
                <x-th>Is Returned?</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($logs as $log)
            <tr class="border-b border-gray-300">
                <x-td>{{ $log->id }}</x-td>
                <x-td>{{ $log->equipment->name }}</x-td>
                <x-td>{{ $log->quantity }}</x-td>
                <x-td>{{ $log->full_name }}</x-td>
                <x-td>{{ $log->start_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->end_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->is_returned ? 'Yes' : 'No' }}</x-td>
                <x-td>
                    <div class="flex items-center gap-2">
                        <x-link href="/borrowed-logs/view/{{ $log->id }}">
                            <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                        </x-link>

                        <x-link href="/borrowed-logs/edit/{{ $log->id }}">
                            <x-bi-pencil-square class="size-5 text-blue-500" />
                        </x-link>
                        @if($log->is_returned)
                        <x-bi-trash @click="openDeleteModal({{ $log->id }})" class="cursor-pointer size-5 text-red-500" />
                        @endif

                        @if(!$log->is_returned)
                        <x-text-button @click="openConfirmationModal({{ $log->id }})" class="text-green-500">
                            Returned
                        </x-text-button>
                        @endif
                    </div>
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <x-no-data :data="$logs" />
        <div>
            {{ $logs->links()}}
        </div>
    </div>
    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>

    <template x-if="showConfirmationModal">
        <x-confirmation-modal message="Are you sure you want to mark this as returned?" @click="$wire.returned(targetId)" />
    </template>



</div>