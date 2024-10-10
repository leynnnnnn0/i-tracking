<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Print Table</title>
    <style>
        /* Reset default margins and padding for printing */
        @page {
            margin: 1cm;
        }

        /* Table styles */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        /* Header styles */
        .print-table thead th {
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 8px;
            font-weight: bold;
            text-align: left;
        }

        /* Cell styles */
        .print-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        /* Alternate row colors */
        .print-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Optional: Add page break rules */
        .print-table tr {
            page-break-inside: avoid;
        }

        /* Optional: Style for specific columns */
        .print-table .numeric {
            text-align: right;
        }

        /* Optional: Footer row styles */
        .print-table tfoot tr {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>

</html>