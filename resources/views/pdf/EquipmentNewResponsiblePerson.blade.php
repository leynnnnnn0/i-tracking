<x-layouts.pdf>
    <div class="equipmentNewOwnerPdf">
        <h1>COORCAARRD</h1>
        <section>
            <span>Change of new resonsible person for equipment #{{ $equipment->id }}</span>
        </section>
        <table class="print-table">
            <thead>
                <tr>
                    <th>PN</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Previous Responsible Person</th>
                    <th>New Responsible Person</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $equipment->property_number }}</td>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->description }}</td>
                    <td>{{ $previous_responsible_person }}</td>
                    <td>{{ $equipment->responsible_person->full_name }}</td>
                    <th>{{ Carbon\Carbon::today()->format('Y-m-d')}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.pdf>