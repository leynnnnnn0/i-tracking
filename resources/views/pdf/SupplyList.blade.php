<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>

<body class="font-poppins">
    <h1 class="">Test Livewire</h1>
    <table class="table  table-striped">
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Used</th>
            <th>Recently Added</th>
            <th>Total</th>
            <th>Expiry Date</th>
        </tr>
        @foreach ($data as $supply)
        <tr>
            <td>{{ $supply['id'] }}</td>
            <td>{{ $supply['description'] }}</td>
            <td>{{ $supply['quantity'] }}</td>
            <td>{{ $supply['used'] }}</td>
            <td>{{ $supply['recently_added'] }}</td>
            <td>{{ $supply['total'] }}</td>
            <td>{{ $supply['expiry_date']  }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>