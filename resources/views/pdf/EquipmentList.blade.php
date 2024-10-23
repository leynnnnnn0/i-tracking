<x-layouts.pdf>
    <h4 class="center">List of Equipments</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    @if ($isAccountingOfficerFiltered)
    <span>Accounting Officer: {{ $isAccountingOfficerFiltered }}</span>
    @elseif($isResponsiblePersonFiltered)
    <span>Responsible Person: {{ $isResponsiblePersonFiltered }}</span>
    @endif
    <table class="print-table">
        <thead>
            <tr>
                <th>Accounting Officer</th>
                <th>Responsible Person</th>
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
            @foreach ($data as $equipment)
            <tr>
                <td>{{ $equipment->accounting_officer->full_name }}</td>
                <td>{{ $equipment->personnel->full_name }}</td>
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
                <td>{{ $equipment->estimated_useful_time ? 'Until' .  Carbon\Carbon::createFromFormat('Y-m', $equipment->estimated_useful_time)->format('F Y') : 'N/a'}}</td>
                <td>{{ number_format($equipment->unit_price, 2) }}</td>
                <td>{{ number_format($equipment->total_amount, 2) }}</td>
                <td>{{ $query === 'Condemned' ? 'Condemned' : $equipment->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>