<x-layouts.pdf>
    <div class="table-header">
        <h1>Supplies History</h1>
        @if($from && $to)
        <p>From {{ Carbon\Carbon::parse($from)->format('F d, Y')}} To {{ Carbon\Carbon::parse($to)->format('F d, Y')}}</p>
        @else
        <p>As of {{ Carbon\Carbon::today()->format('F d, Y')}}</p>
        @endif
    </div>
    <table class="print-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Used</th>
                <th>Added</th>
                <th>Total</th>
                <th>Expiry Date</th>
                <th>Categories</th>
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
                <x-td>{{ $supply->supply->formattedCategories($supply->supply->categories) }}</x-td>
                <td>{{ $supply->is_consumable ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>