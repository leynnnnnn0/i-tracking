<x-layouts.pdf>
    <table class="print-table">
        <thead>
            <tr>
                <th>Responsible Person ID</th>
                <th>Organization Unit</th>
                <th>Operating Unit Project</th>
                <th>Property Number</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Name</th>
                <th>Description</th>
                <th>Date Acquired</th>
                <th>Fund</th>
                <th>PPE Class</th>
                <th>Estimated Useful Time</th>
                <th>Unit Price</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $equipment) <!-- Changed from $supply to $equipment -->
            <tr>
                <td>{{ $equipment->responsible_person->full_name }}</td>
                <td>{{ $equipment->organization_unit }}</td>
                <td>{{ $equipment->operating_unit_project }}</td>
                <td>{{ $equipment->property_number }}</td>
                <td>{{ $equipment->quantity }}</td>
                <td>{{ $equipment->unit }}</td>
                <td>{{ $equipment->name }}</td>
                <td>{{ $equipment->description }}</td>
                <td>{{ Carbon\Carbon::parse($equipment->date_acquired)->format('F d, Y') }}</td>
                <td>{{ $equipment->fund }}</td>
                <td>{{ $equipment->ppe_class }}</td>
                <td>{{ $equipment->estimated_useful_time }}</td>
                <td>{{ number_format($equipment->unit_price, 2) }}</td>
                <td>{{ number_format($equipment->total_amount, 2) }}</td>
                <td>{{ $equipment->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>