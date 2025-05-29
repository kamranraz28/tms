@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="animation: fadeInDown 0.6s;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="common-container p-4 shadow-sm rounded bg-white">

    <h2 class="mb-4 fw-bold text-center">All Tenants</h2>

    <div class="d-flex justify-content-end mb-4 gap-3 flex-wrap">
        <a href="{{ route('sendInvoice') }}" class="btn btn-primary btn-lg" style="background-color: {{ $buttonColor }};">
            <i class="fas fa-paper-plane me-2"></i> Send Invoice to All Tenants
        </a>
        <a href="{{ route('tenants.create') }}" class="btn btn-success btn-lg" style="background-color: {{ $buttonColor }};">
            <i class="fas fa-plus me-2"></i> Create Tenant
        </a>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered align-middle" style="width:100%;">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Tenant Name</th>
                    <th>Phone</th>
                    <th>Permanent Address</th>
                    <th>NID Number</th>
                    <th>NID Upload</th>
                    <th>Property</th>
                    <th>Position</th>
                    <th>Service Details</th>
                    <th>Invoice Month</th>
                    <th>Send Invoice</th>
                    <th>Notify System</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $tenant->name ?? 'N/A' }}</td>
                        <td>{{ $tenant->phone ?? 'N/A' }}</td>
                        <td>{{ $tenant->address ?? 'N/A' }}</td>
                        <td>{{ $tenant->nid_number ?? 'N/A' }}</td>
                        <td class="text-center">
                            @if($tenant->nid_upload)
                                <a href="{{ asset('storage/' . $tenant->nid_upload) }}" target="_blank" class="btn btn-sm btn-outline-primary">View NID</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $tenant->property->name ?? 'N/A' }}</td>
                        <td>{{ $tenant->property->position->name ?? 'N/A' }}</td>
                        <td class="text-center">
                            <a href="{{ route('tenants.services', $tenant->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Services</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('month.change', $tenant->id) }}" class="btn btn-sm btn-info" onclick="return confirm('Are you sure you want to change the invoice month for this tenant?')">
                                {{ $tenant->invoice_month == 1 ? 'Current Month' : 'Previous Month' }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('invoice.send', $tenant->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Send Invoice</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('invoice.change', $tenant->id) }}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to change the invoice system for this tenant?')">
                                {{ $tenant->invoicing == 1 ? 'Automatic' : 'Manual' }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning mb-1" style="background-color: {{ $buttonColor }};">Edit</a>

                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tenant?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .common-container {
        background-color: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 0.6s ease forwards;
    }

    .btn-primary, .btn-success, .btn-warning, .btn-info, .btn-danger {
        border-radius: 0.4rem;
        transition: background-color 0.25s ease, transform 0.15s ease;
    }

    .btn-primary:hover, .btn-success:hover, .btn-warning:hover, .btn-info:hover, .btn-danger:hover {
        filter: brightness(90%);
        transform: translateY(-2px);
    }

    table.dataTable tbody tr:hover {
        background-color: #f1f7ff;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>

@endsection
