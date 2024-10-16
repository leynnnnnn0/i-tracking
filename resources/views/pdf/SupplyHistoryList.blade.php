<x-layouts.pdf>
    <h4 class="center">Supplies History</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Used</th>
                <th>Recently Added</th>
                <th>Total</th>
                <th>Expiry Date</th>
                <th>Is Consumable?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplies as $supply)
            <tr>
                <td>{{ $supply->supply->description }}</td>
                <td>{{ $supply->total_quantity }}</td>
                <td>{{ $supply->total_used }}</td>
                <td>{{ $supply->total_added }}</td>
                <td>{{ $supply->total }}</td>
                <td>{{ $supply->expiry_date ? $supply->expiry_date->format('F d, Y') : 'N/A' }}</td>
                <td>{{ $supply->is_consumable ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>