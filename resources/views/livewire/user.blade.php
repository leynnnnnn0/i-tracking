<section class="space-y-3">
    <x-index-header heading="Users" buttonName="Add New User" location="/users/create" />
    <x-table>
        <x-tr>
            <x-th>Id</x-th>
            <x-th>Full Name</x-th>
            <x-th>Phone Number</x-th>
            <x-th>Email</x-th>
            <x-th>Role</x-th>
            <x-th>Actions</x-th>
        </x-tr>
        @foreach ($users as $user)
        <tr class="border-b border-gray-300">
            <x-td>{{ $user->id }}</x-td>
            <x-td>{{ $user->first_name }}</x-td>
            <x-td>{{ $user->phone_number }}</x-td>
            <x-td>{{ $user->email }}</x-td>
            <x-td>{{ $user->role }}</x-td>
            <x-td></x-td>
        </tr>
        @endforeach
    </x-table>
</section>