<x-layouts.pdf>
    <h4 class="center">List of Offices</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offices as $office)
            <tr>
                <td>{{ $office->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>