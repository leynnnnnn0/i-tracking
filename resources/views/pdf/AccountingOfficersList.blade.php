<x-layouts.pdf>
    <h4 class="center">List of Accounting Officers</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
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