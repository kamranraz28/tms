<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Invoice for {{ $tenant->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background: #f4f6f8;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .invoice-box {
            background: #ffffff;
            max-width: 850px;
            margin: auto;
            padding: 50px 60px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            font-size: 2.2rem;
            font-weight: bold;
            color: #34495e;
        }

        .invoice-header h5 {
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 8px;
            color: #7f8c8d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #2c3e50;
            color: #fff;
        }

        table th, table td {
            padding: 14px 16px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tfoot tr th {
            background-color: #ecf0f1;
            font-weight: bold;
            font-size: 1.05rem;
        }

        .alert-warning {
            font-size: 0.95rem;
            border-radius: 6px;
        }

        .btn-success {
            min-width: 200px;
            font-weight: bold;
            font-size: 1.05rem;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.25);
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .invoice-box {
                box-shadow: none;
                border: none;
                margin: 0;
                max-width: 100%;
                padding: 0;
            }

            .btn-success {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <h1>Tenant Invoice</h1>
            <h5>
                {{ $tenant->invoice_month == 1
                    ? now()->format('F, Y')
                    : now()->subMonth()->format('F, Y')
                }}
            </h5>

        </div>

        <div class="mb-4">
            <p><strong>Tenant Name:</strong> {{ $tenant->name }}</p>
            <p><strong>Tenant Phone:</strong> {{ $tenant->phone }}</p>
            <p><strong>Property:</strong> {{ $tenant->property->name }} - {{ $tenant->property->position->name }}</p>
            <p><strong>Address:</strong> {{ $tenant->property->address ?? 'N/A' }}</p>
        </div>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-end">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $tenantService)
                <tr>
                    <td>{{ $tenantService->service->name }}</td>
                    <td class="text-end">{{ number_format($tenantService->value, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Amount</th>
                    <th class="text-end">{{ number_format($total, 2) }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="alert alert-warning mt-4">
            <strong>Note:</strong> Please pay your service dues by the due date to avoid any inconvenience.
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('tenant.invoice.pdf', $tenant->id) }}" class="btn btn-success">Download as PDF</a>
        </div>
    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
