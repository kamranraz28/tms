<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Invoice for {{ $tenant->name }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
        .note {
            margin-top: 20px;
            padding: 10px;
            background: #fffae6;
            border: 1px solid #f0e6cc;
        }
    </style>
</head>
<body>

<h2>Invoice for {{ $tenant->name }}</h2>

<table>
    <thead>
        <tr>
            <th>Service Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $tenantService)
            <tr>
                <td>{{ $tenantService->service->name }}</td>
                <td>{{ number_format($tenantService->value, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <th>Total</th>
            <th>{{ number_format($total, 2) }}</th>
        </tr>
    </tbody>
</table>

<div class="note">
    Please pay your service dues by the due date to avoid any inconvenience.
</div>

</body>
</html>
