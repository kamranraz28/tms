<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Invoice for {{ $tenant->name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #000;
        }

        h2, h3, h4 {
            margin: 4px 0;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tfoot th {
            text-align: right;
        }

        .note {
            margin-top: 25px;
            padding: 10px;
            background: #fffae6;
            border: 1px solid #f0e6cc;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }

        .signature-box .label {
            margin-top: 60px;
            border-top: 1px solid #000;
            display: inline-block;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    <h2>Tenant Invoice</h2>

    <div class="info">
        <p><strong>Tenant Name:</strong> {{ $tenant->name }}</p>
        <p><strong>Phone:</strong> {{ $tenant->phone }}</p>
        <p><strong>Property:</strong> {{ $tenant->property->name }} - {{ $tenant->property->position->name }}</p>
        <p><strong>Address:</strong> {{ $tenant->property->address ?? 'N/A' }}</p>
        <p><strong>Month:</strong> {{ now()->format('F, Y') }}</p>
        <p><strong>Invoice Date:</strong> {{ now()->format('d M, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align: right;">Amount (BDT)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $tenantService)
                <tr>
                    <td>{{ $tenantService->service->name }}</td>
                    <td style="text-align: right;">{{ number_format($tenantService->value, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total Amount</th>
                <th style="text-align: right;">{{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="note">
        <strong>Notes:</strong> Please pay your service dues by the due date to avoid any inconvenience.
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div class="label">Owner Signature</div>
        </div>
    </div>

</body>
</html>
