<div>
    <section class="space-y-3">
        <x-plain-heading>Activity Log</x-plain-heading>
        <section>
            <x-table>
                <x-tr>
                    <x-th>User</x-th>
                    <x-th>Action Type</x-th>
                    <x-th>Model Type</x-th>
                    <x-th>Model Id</x-th>
                    <x-th>Action Take at</x-th>
                    <x-th>Actions</x-th>
                </x-tr>

                @foreach ($audits as $audit)
                <tr class="border-b border-gray-300">
                    <x-td>{{ $audit->user->full_name }}</x-td>
                    <x-td>{{ $audit->event }}</x-td>
                    <x-td>{{ Str::title(Str::snake( Str::after($audit->auditable_type, 'Models\\'), ' '))  }}</x-td>
                    <x-td>{{ $audit->auditable_id }}</x-td>
                    <x-td>{{ $audit->created_at->format('F d, Y H:i:s a') }}</x-td>
                    <x-td>
                        <x-link href="/activity-logs/view/{{ $audit->id }}">
                            <x-bi-eye class="cursor-pointer size-5 text-green-500" />
                        </x-link>
                    </x-td>
                </tr>

                @endforeach
                </tr>
            </x-table>
            <x-no-data :data="$audits" />

            <div class="mt-5">
                {{ $audits->links() }}
            </div>
        </section>
    </section>
</div>