@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="common-container">
    <h2>All Tenants</h2>


    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('tenants.create') }}" style="background-color: {{ $buttonColor }};">
        <i class="fas fa-plus"> </i> Create Tenant
        </a>
        <a class="btn btn-primary" href="{{ route('sendInvoice') }}" style="background-color: {{ $buttonColor }};">
        <i class="fas fa-plus"> </i> Send Invoice
        </a>
    </div>


    <table id="example" class="display" style="width:100%">
        <thead>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tenant->name ?? 'N/A' }}</td>
                    <td>{{ $tenant->phone ?? 'N/A' }}</td>
                    <td>{{ $tenant->address ?? 'N/A' }}</td>
                    <td>{{ $tenant->nid_number ?? 'N/A' }}</td>
                    <td>
                        @if($tenant->nid_upload)
                            <a href="{{ asset('storage/' . $tenant->nid_upload) }}" target="_blank">View NID</a>
                        @else
                            N/A
                        @endif

                    </td>
                    <td>{{ $tenant->property->name ?? 'N/A' }}</td>
                    <td>{{ $tenant->property->position->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('tenants.services', $tenant->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Services</a>
                    </td>
                    <td>

                        <!-- Action buttons: Edit and Delete -->
                        <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

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

@endsection
