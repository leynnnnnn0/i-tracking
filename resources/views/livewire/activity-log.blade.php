<div>
    <section class="space-y-3">
        <x-plain-heading>Activity Log</x-plain-heading>
        <section>
            <x-table>
                <x-tr>
                    <x-th>User</x-th>
                    <x-th>Action Type</x-th>
                    <x-th>Description</x-th>
                    <x-th>Model Type</x-th>
                    <x-th>Model Id</x-th>
                    <x-th>Actions</x-th>
                </x-tr>

                @foreach ($logs as $log)
                <tr class="border-b border-gray-300">
                    <x-td>{{ $log->user->full_name }}</x-td>
                    <x-td>{{ $log->action_type}}</x-td>
                    <x-td>{{ $log->description }}</x-td>
                    <x-td>{{ $log->model_type }}</x-td>
                    <x-td>{{ $log->model_id }}</x-td>
                    <x-td><x-bi-eye class="cursor-pointer size-5 text-green-500" /></x-td>
                </tr>

                @endforeach
                </tr>
            </x-table>
            <div class="mt-5">
                {{ $logs->links() }}
            </div>
        </section>
    </section>
</div>