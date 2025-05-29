@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="animation: fadeInDown 0.5s;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="common-container container mt-4 p-4 shadow rounded bg-white">

    <h2 class="fw-bold mb-4">Tenant with Services</h2>

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('tenantServices.create') }}" style="background-color: {{ $buttonColor }};">
            <i class="fas fa-plus"></i> Add Service
        </a>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tenant Name</th>
                    <th>Phone</th>
                    <th>Property</th>
                    <th>Position</th>
                    <th>Service</th>
                    <th>Service Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenantServices as $tenantService)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tenantService->tenant->name ?? 'N/A' }}</td>
                        <td>{{ $tenantService->tenant->phone ?? 'N/A' }}</td>
                        <td>{{ $tenantService->tenant->property->name ?? 'N/A' }}</td>
                        <td>{{ $tenantService->tenant->property->position->name ?? 'N/A' }}</td>
                        <td>{{ $tenantService->service->name ?? 'N/A' }}</td>
                        <td>{{ $tenantService->value ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('tenantServices.edit', $tenantService->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

                            <form action="{{ route('tenantServices.destroy', $tenantService->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this service for the tenant?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<style>
    /* Smooth alert fade-in */
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

    .common-container h2 {
        font-weight: 700;
    }

    /* Table hover effect */
    table.table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button small padding */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }
</style>

@endsection
