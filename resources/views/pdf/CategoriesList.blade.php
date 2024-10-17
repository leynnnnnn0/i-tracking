<x-layouts.pdf>
    <h4 class="center">List of Categories</h4>
    <h5 class="center">As of {{ Carbon\Carbon::today()->format('F d, Y')}}</h5>
    <table class="print-table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.pdf>