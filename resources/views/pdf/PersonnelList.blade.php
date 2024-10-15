<x-layouts.pdf>
    <h4 class="center">List of Personnels</h4>
    <table class="print-table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Department</th>
                <th>Position</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personnels as $personnel)
            <tr>
                <td>{{ $personnel->full_name }}</td>
                <td>{{ $personnel->gender }}</td>
                <td>{{ $personnel->date_of_birth->format('F d, Y') }}</td>
                <td>{{ $personnel->phone_number }}</td>
                <td>{{ $personnel->email }}</td>
                <td>{{ $personnel->department->name ?? 'N/A' }}</td>
                <td>{{ $personnel->position }}</td>
                <td>{{ $personnel->start_date->format('F d, Y') }}</td>
                <td>{{ $personnel->end_date ? $personnel->end_date->format('F d, Y') : 'N/A' }}</td>
                <td>{{ $personnel->remarks ?? 'No remarks' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>