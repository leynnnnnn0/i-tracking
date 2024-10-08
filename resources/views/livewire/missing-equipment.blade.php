<div>
    <section class="space-y-3">
        <div class="flex items-center justify-between mb-5">
            <h1 class="font-bold text-2xl text-emerald-900">Missing Equipment List</h1>
            <a href="/missing-equipments/create" class="px-4 py-1 bg-emerald-500 rounded-lg text-white hover:bg-opacity-75 transition-colors duration-300">Make A Report</a>
        </div>

        <x-table>
            <x-tr>
                <x-th>Equipment Id</x-th>
                <x-th>status</x-th>
                <x-th>Reported By</x-th>
                <x-th>Reported Date</x-th>
                <x-th>Actions</x-th>
            </x-tr>
            @foreach ($data as $report)
            <tr class="border-b border-gray-300">
                <x-td>{{ $report->equipment_id}}</x-td>
                <x-td>{{ $report->status}}</x-td>
                <x-td>{{ $report->reported_by}}</x-td>
                <x-td>{{ $report->reported_date->format('F d, Y')}}</x-td>
                <x-td></x-td>
            </tr>
            @endforeach
        </x-table>
        <div>
            {{ $data->links() }}
        </div>
    </section>
</div>