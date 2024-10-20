<x-layouts.pdf>
    <h4 class="center">List of Users</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y') }}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->middle_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ ucfirst($user->gender) }}</td>
                    <td>{{ $user->date_of_birth->format('M d, Y') }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>
