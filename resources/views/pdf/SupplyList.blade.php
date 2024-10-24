<x-layouts.pdf>
    <h4 class="center">List of Supplies</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Description</th>
                <th>Categories</th>
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
                <td>{{ $supply->id }}</td>
                <td>{{ $supply->description }}</td>
                <td>{{ implode(' / ', $supply->categories->map(function ($item) {
                            return $item->name;
                    })->toArray())}}</td>
                <td>{{ $supply->quantity }}</td>
                <td>{{ $supply->used }}</td>
                <td>{{ $supply->recently_added }}</td>
                <td>{{ $supply->total }}</td>
                <td>{{ $supply->formatted_expiry_date }}</td>
                <td>{{ $supply->is_consumable ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>