<x-layouts.pdf>
    <div class="equipmentNewOwnerPdf">
        <h4 class="center">New Responsible Person for Equipment id #{{$equipment->id}}</h4>
        <h5 class="center">{{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
        <table class="print-table">
            <thead>
                <tr>
                    <th>Accounting Officer</th>
                    <th>Previous Responsible Person</th>
                    <th>New Responsible Person</th>
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
                <tr>
                    <td>{{ $equipment->responsible_person->accounting_officer->full_name }}</td>
                    <td>{{ $previous_responsible_person }}</td>
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
                    <td>Until {{ Carbon\Carbon::createFromFormat('Y-m', $equipment->estimated_useful_time)->format('F Y') }}</td>
                    <td>{{ number_format($equipment->unit_price, 2) }}</td>
                    <td>{{ number_format($equipment->total_amount, 2) }}</td>
                    <td>{{ $equipment->status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.pdf>