<x-layouts.pdf>
    <h4 class="center">Missing Equipments</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y') }}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Equipment ID</th>
                <th>Status</th>
                <th>Description</th>
                <th>Reported By</th>
                <th>Reported Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipments as $equipment)
            <tr>
                <td>{{ $equipment->equipment->name }}</td>
                <td>{{ $equipment->status }}</td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $equipment->reported_by }}</td>
                <td>{{ $equipment->reported_date ? $equipment->reported_date->format('F d, Y') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>