<div x-data="{
        showDeleteModal: false,
        targetId: null,
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
                <x-th>Equipment</x-th>
                <x-th>Borrower</x-th>
                <x-th>Start Date</x-th>
                <x-th>End Date</x-th>
                <x-th>Is Returned?</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($logs as $log)
            <tr class="border-b border-gray-300">
                <x-td>{{ $log->equipment ? $log->equipment->name : 'N/A' }}</x-td>
                <x-td>{{ $log->borrower_first_name }}</x-td>
                <x-td>{{ $log->start_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->end_date->format('F d, Y')}}</x-td>
                <x-td>{{ $log->is_returned ? 'Yes' : 'No' }}</x-td>
                <x-td class="flex items-center gap-3">
                    <x-bi-trash @click="openDeleteModal({{ $log->id }})" class="cursor-pointer size-5 text-red-500" />
                    <a href="/borrowed-logs/edit/{{ $log->id }}">
                        <x-bi-pencil-square class="size-5 text-blue-500" />
                    </a>
                    <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                </x-td>
            </tr>
            @endforeach
        </x-table>
        <div>
            {{ $logs->links()}}
        </div>
    </div>
    <!-- Modal -->
    <template x-if="showDeleteModal">
        <x-delete-modal @click="$wire.delete(targetId)" />
    </template>
</div>