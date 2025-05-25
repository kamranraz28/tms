<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Invoice for {{ $tenant->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* A4 page styling */
        body {
            background: #f7f7f7;
            padding: 30px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .invoice-box {
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 50px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            background: #2c3e50;
            color: white;
            text-align: left;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tfoot tr th {
            background: #ecf0f1;
            font-weight: 700;
            font-size: 1.1rem;
            text-align: right;
        }

        .alert-warning {
            font-size: 0.95rem;
            border-radius: 5px;
        }

        .btn-success {
            min-width: 180px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 3px 6px rgba(46,204,113,.3);
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
        <h2 class="text-center">Invoice for {{ $tenant->name }}</h2>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th class="text-end">Value (BDT)</th>
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
                    <th>Total</th>
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

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
