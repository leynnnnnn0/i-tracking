<x-layouts.pdf>
    <table class="print-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Used</th>
                <th>Recently Added</th>
                <th>Total</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $supply)
            <tr>
                <td>{{ $supply['id'] }}</td>
                <td>{{ $supply['description'] }}</td>
                <td>{{ $supply['quantity'] }}</td>
                <td>{{ $supply['used'] }}</td>
                <td>{{ $supply['recently_added'] }}</td>
                <td>{{ $supply['total'] }}</td>
                <td>{{ Carbon\Carbon::parse($supply['expiry_date'])->format('F d, Y')  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>