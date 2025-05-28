@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="common-container">
        <h2>Payment Report</h2>
        <br>

        <form method="POST" action="{{ route('reports.filterPayments') }}" class="mb-4 row g-3 align-items-end">
            @csrf
            <div class="col-md-3">
                <label for="month" class="form-label">Select Month</label>
                <input type="month" name="month" id="month" class="form-control"
                    value="{{ session('month', now()->format('Y-m')) }}">
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
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('reports.resetPayments') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <table id="example" class="display" style="width:100%">
            <thead>
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
                        // Since payments are filtered in controller by currentMonth, this will get the payment for that month or null
                        $paidThisMonth = $tenant->payments->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tenant->name ?? 'N/A' }}</td>
                        <td>{{ $tenant->phone ?? 'N/A' }}</td>
                        <td>{{ $tenant->property->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($currentMonth . '-01')->format('F Y') }}</td>
                        <td>{{ $tenant->tenantServices->sum('value') ?? 0 }}</td>
                        <td>
                            @if ($paidThisMonth)
                                <a href="{{ route('tenant.paymentReverse', ['tenant' => $tenant->id, 'month' => $currentMonth]) }}"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Are you sure you want to mark this tenant as unpaid?')">Paid</a>
                            @else
                                <a href="{{ route('tenant.payment', ['tenant' => $tenant->id, 'month' => $currentMonth]) }}"
                                    class="btn btn-warning btn-sm"
                                    onclick="return confirm('Are you sure you want to confirm payment for this tenant?')">Unpaid</a>
                            @endif
                        </td>
                        <td>
                            @if ($paidThisMonth)
                                {{ \Carbon\Carbon::parse($paidThisMonth->created_at)->format('d M, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
