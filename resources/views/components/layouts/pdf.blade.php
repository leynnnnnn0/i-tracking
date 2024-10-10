<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Print Table</title>
    <style>
        /* Reset default margins and padding for printing */
        @page {
            margin: 0.5cm;
            /* Adjust margins to prevent overflow */
        }


        /* Table styles */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            font-size: 12px;
            table-layout: fixed;
            /* Ensure consistent layout */
        }

        .print-table th,
        td {
            font-size: 10px;
            /* Adjust the size to your preference */
            font-weight: bold;
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
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
            word-wrap: break-word;
            /* Ensures content wraps */
        }

        /* Alternate row colors */
        .print-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Ensure rows don't break across pages */
        .print-table tr {
            page-break-inside: avoid;
        }

        /* Optional: Footer row styles */
        .print-table tfoot tr {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        /* Numeric alignment */
        .print-table .numeric {
            text-align: right;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>

</html>