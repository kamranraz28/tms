@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="common-container">
    <h2>Tenant with Servies</h2>


    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('tenantServices.create') }}" style="background-color: {{ $buttonColor }};">
        <i class="fas fa-plus"> </i> Add Service
        </a>
    </div>


    <table id="example" class="display" style="width:100%">
        <thead>
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

                        <!-- Action buttons: Edit and Delete -->
                        <a href="{{ route('tenantServices.edit', $tenantService->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

                        <form action="{{ route('tenantServices.destroy', $tenantService->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service for the tenant?')">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
