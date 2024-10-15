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
        <div class="flex items-center justify-between mb-5">
            <h1 class="font-bold text-2xl text-emerald-900">Missing Equipment List</h1>
            <a href="/missing-equipments/create" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">Make A Report</a>
        </div>

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
                    <button @click="openConfirmationModal({{ $report->id}})" class="hover:underline text-red-500 text-xs">
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