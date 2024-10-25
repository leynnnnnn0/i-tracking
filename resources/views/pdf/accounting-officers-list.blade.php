<x-layouts.pdf>
    <div class="table-header">
        <h1>List of Accounting Officers</h1>
        <p>Generated on: {{ date('F d, Y') }}</p>
    </div>
    <table class="print-table">

        <thead>
            <tr>
                <th>Id</th>
                <th>Office</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officers as $officer)
            <tr>
                <td>{{ $officer->id }}</td>
                <td>{{ $officer->office->name }}</td>
                <td>{{ $officer->first_name }}</td>
                <td>{{ $officer->middle_name }}</td>
                <td>{{ $officer->last_name }}</td>
                <td>{{ $officer->email }}</td>
                <td>{{ $officer->phone_number }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>