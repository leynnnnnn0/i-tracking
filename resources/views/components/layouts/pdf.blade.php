<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Print Table</title>
    <style>
        /* Reset default margins and padding for printing */
        * {
            font-family: 'Poppins', 'sans-serif';
            width: 100%;
        }

        .equipmentNewOwnerPdf {
            margin: 5px;
        }

        .center {
            text-align: center;
            margin: 0;
        }

        section {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @page {
            margin: 0.5cm;
            /* Adjust margins to prevent overflow */
        }

        /* Table styles */
        .print-table {
            margin-top: 20px;
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
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        /* Header styles */
        .print-table thead th {
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 5px;
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