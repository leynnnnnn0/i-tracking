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
        <x-index-header heading="Borrowed Equipment Log" buttonName="Add new log" location="/borrowed-logs/create" />
        <x-table>
            <x-tr>
                <x-th>Id</x-th>
                <x-th>Equipment</x-th>
                <x-th>Borrower</x-th>
                <x-th>Start Date</x-th>
                <x-th>End Date</x-th>
                <x-th>Is Returned?</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($logs as $log)
            <tr class="border-b border-gray-300">
                <x-td>{{ $log->id }}</x-td>
                <x-td>{{ $log->equipment ? $log->equipment->name : 'N/A' }}</x-td>
                <x-td>{{ $log->borrower_first_name }}</x-td>
                <x-td>{{ $log->start_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->end_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->is_returned ? 'Yes' : 'No' }}</x-td>
                <x-td class="flex items-center gap-3">
                    @if($log->is_returned)
                    <x-bi-trash @click="openDeleteModal({{ $log->id }})" class="cursor-pointer size-5 text-red-500" />
                    @endif
                    <a href="/borrowed-logs/edit/{{ $log->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                    @if(!$log->is_returned)
                    <button @click="openConfirmationModal({{ $log->id }})" class="hover:underline text-red-500 text-xs">
                        Returned
                    </button>
                    @endif
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