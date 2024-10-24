<x-layouts.pdf>
    <h4 class="center">Supplies History</h4>
    @if($from && $to)
    <h5 class="center">From {{ Carbon\Carbon::parse($from)->format('F d, Y')}} To {{ Carbon\Carbon::parse($to)->format('F d, Y')}}</h5>
    @else
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    @endif
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
                <td>{{ $supply->quantity }}</td>
                <td>{{ $supply->used }}</td>
                <td>{{ $supply->added }}</td>
                <td>{{ $supply->total }}</td>
                <td>{{ $supply->expiry_date ? $supply->expiry_date->format('F d, Y') : 'N/A' }}</td>
                <td>{{ $supply->is_consumable ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>