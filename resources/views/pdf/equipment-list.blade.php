<x-layouts.pdf>
    <div class="table-header">
        <h1>Equipment List</h1>
        <p>Generated on: {{ date('F d, Y') }}</p>
        @if($accountingOfficer)
        <p>Accounting Officer: {{ $accountingOfficer }}</p>
        @endif
        @if($responsiblePerson)
        <p>Responsible Person: {{ $responsiblePerson }}</p>
        @endif
    </div>
    <table class="print-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Accounting Officer</th>
                <th>Responsible Person</th>
                <th>Organization Unit</th>
                <th>Operating Unit Project</th>
                <th>Property Number</th>
                <th>Quantity</th>
                <th>Unit</th>
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
            @foreach ($equipments as $equipment)
            <tr>
                <td>{{ $equipment->id }}</td>
                <td>{{ $equipment->name ?? 'N/a' }}</td>
                <td>{{ $equipment->accounting_officer->full_name ?? 'N/a' }}</td>
                <td>{{ $equipment->personnel->full_name ?? 'N/a' }}</td>
                <td>{{ $equipment->organization_unit->name  ?? 'N/a'}}</td>
                <td>{{ $equipment->operating_unit_project->name ?? 'N/a' }}</td>
                <td>{{ $equipment->property_number ?? 'N/a' }}</td>
                <td>{{ $equipment->quantity($query) ?? 'N/a' }}</td>
                <td>{{ $equipment->unit ?? 'N/a' }}</td>
                <td>{{ $equipment->description ?? 'N/a' }}</td>
                <td>{{ Carbon\Carbon::parse($equipment->date_acquired)->format('F d, Y') }}</td>
                <td>{{ $equipment->fund->name ?? 'N/a' }}</td>
                <td>{{ $equipment->personal_protective_equipment->name ?? 'N/a' }}</td>
                <td>{{ $equipment->estimated_useful_time ? 'Until ' .  Carbon\Carbon::createFromFormat('Y-m', $equipment->estimated_useful_time)->format('F Y') : 'N/a'}}</td>
                <td>{{ number_format($equipment->unit_price, 2) ?? 'N/a'}} </td>
                <td>{{ number_format($equipment->total_amount, 2) ?? 'N/a'}} </td>
                <td>{{ $query === 'Condemned' ? 'Condemned' : $equipment->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>