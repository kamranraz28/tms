@extends('layouts.master')

@section('title', 'Edit Tenant')

@section('content')

<div class="common-container container mt-4 p-4 shadow rounded bg-white">

    <h2 class="text-center mb-5 fw-bold">Edit Tenant</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="animation: fadeInDown 0.5s;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf
        @method('PUT')

        <div class="col-md-12">
            <label for="property_id" class="form-label fw-bold">Property</label>
            <select name="property_id" id="property_id" class="form-control position-dropdown" required>
                <option value="" disabled>Select a Property</option>
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}" {{ $tenant->property_id == $property->id ? 'selected' : '' }}>
                        {{ $property->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="name" class="form-label fw-bold">Tenant Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $tenant->name) }}" placeholder="Enter Tenant Name" required>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label fw-bold">Tenant Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control"
                value="{{ old('phone', $tenant->phone) }}" placeholder="Enter Tenant Phone Number" required>
        </div>

        <div class="col-md-6">
            <label for="address" class="form-label fw-bold">Tenant Permanent Address</label>
            <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address', $tenant->address) }}" placeholder="Enter Tenant Permanent Address">
        </div>

        <div class="col-md-6">
            <label for="nid_number" class="form-label fw-bold">Tenant NID Number</label>
            <input type="text" name="nid_number" id="nid_number" class="form-control"
                value="{{ old('nid_number', $tenant->nid_number) }}" placeholder="Tenant NID Number" required>
        </div>

        <div class="col-md-6">
            <label for="nid_upload" class="form-label fw-bold">Tenant NID Upload</label>
            <input type="file" name="nid_upload" id="nid_upload" class="form-control">
            @if ($tenant->nid_upload)
                <small class="text-muted d-block mt-1">
                    <a href="{{ asset('storage/' . $tenant->nid_upload) }}" target="_blank">View Current NID</a>
                </small>
            @endif
        </div>

        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-4" style="background-color: {{ $buttonColor }};">Update Tenant</button>
        </div>
    </form>
</div>

<style>
    .position-dropdown {
        border: 2px solid {{ $buttonColor }};
        border-radius: 0.5rem;
        padding: 0.375rem 0.75rem;
        transition: border-color 0.3s ease;
    }

    .position-dropdown:focus {
        border-color: {{ $buttonColor }};
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .form-label {
        font-weight: 600;
    }

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
</style>

@endsection
