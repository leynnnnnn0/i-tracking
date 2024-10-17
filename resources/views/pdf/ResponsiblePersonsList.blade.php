<x-layouts.pdf>
    <h4 class="center">List of Responsible Persons</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Accounting Officer</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($persons as $person)
            <tr>
                <td>{{ $person->id }}</td>
                <td>{{ $person->accounting_officer ?  $person->accounting_officer->full_name : 'N/A' }}</td>
                <td>{{ $person->first_name }}</td>
                <td>{{ $person->middle_name }}</td>
                <td>{{ $person->last_name }}</td>
                <td>{{ $person->email }}</td>
                <td>{{ $person->phone_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>