@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="common-container">
    <h2 class="mb-4 fw-bold">Payment Report</h2>

    <form method="POST" action="{{ route('reports.filterPayments') }}" class="mb-4 row g-3 align-items-end">
        @csrf
        <div class="col-md-3">
            <label for="month" class="form-label">Select Month</label>
            <input type="month" name="month" id="month" class="form-control" value="{{ session('month', now()->format('Y-m')) }}">
        </div>

        <div class="col-md-3">
            <label for="tenant_id" class="form-label fw-bold">Tenant</label>
            <select name="tenant_id" id="tenant_id" class="form-control">
                <option value="" {{ session('tenant_id') === null ? 'selected' : '' }}>All Tenants</option>
                @foreach ($tenants as $tenant)
                    <option value="{{ $tenant->id }}" {{ session('tenant_id') == $tenant->id ? 'selected' : '' }}>
                        {{ $tenant->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" style="background-color: {{ $buttonColor }};">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('reports.resetPayments') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover" style="width:100%">
            <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: white;">
                <tr>
                    <th>#</th>
                    <th>Tenant Name</th>
                    <th>Phone</th>
                    <th>Property</th>
                    <th>Month</th>
                    <th>Total Payable</th>
                    <th>Payment Status</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    @php
                        $paidThisMonth = $tenant->payments->first();
                    @endphp
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $tenant->name ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $tenant->phone ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $tenant->property->name ?? 'N/A' }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($currentMonth . '-01')->format('F Y') }}</td>
                        <td class="align-middle">৳ {{ number_format($tenant->tenantServices->sum('value') ?? 0, 2) }}</td>
                        <td class="align-middle">
                            @if ($paidThisMonth)
                                <a href="{{ route('tenant.paymentReverse', ['tenant' => $tenant->id, 'month' => $currentMonth]) }}"
                                   class="btn btn-success btn-sm"
                                   onclick="return confirm('Are you sure you want to mark this tenant as unpaid?')"
                                   style="transition: transform 0.2s ease;">
                                   Paid
                                </a>
                            @else
                                <a href="{{ route('tenant.payment', ['tenant' => $tenant->id, 'month' => $currentMonth]) }}"
                                   class="btn btn-warning btn-sm"
                                   onclick="return confirm('Are you sure you want to confirm payment for this tenant?')"
                                   style="transition: transform 0.2s ease;">
                                   Unpaid
                                </a>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if ($paidThisMonth)
                                {{ \Carbon\Carbon::parse($paidThisMonth->created_at)->format('d M, Y') }}
                            @else
                                <span class="text-muted fst-italic">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .common-container {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #004a9f; /* darker shade or adjust as needed */
        transform: translateY(-2px);
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .btn-success, .btn-warning {
        transition: transform 0.2s ease;
    }

    .btn-success:hover, .btn-warning:hover {
        transform: scale(1.05);
    }
</style>

@endsection
