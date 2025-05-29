@extends('layouts.master')

@section('title', 'Add Tenant Service')

@section('content')

<div class="common-container container mt-4 p-4 shadow rounded bg-white">

    <h2 class="text-center mb-5 fw-bold">Add Tenant Service</h2>

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

    <form action="{{ route('tenantServices.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf

        <div class="col-md-6">
            <label for="tenant_id" class="form-label fw-bold">Tenant</label>
            <select name="tenant_id" id="tenant_id" class="form-control position-dropdown" required>
                <option value="" selected disabled>Select a Tenant</option>
                @foreach ($tenants as $tenant)
                    <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="service_id" class="form-label fw-bold">Service</label>
            <select name="service_id" id="service_id" class="form-control position-dropdown" required>
                <option value="" selected disabled>Select a Service</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="value" class="form-label fw-bold">Value</label>
            <input type="number" name="value" id="value" class="form-control" placeholder="Enter Service Value" required>
        </div>

        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-4" style="background-color: {{ $buttonColor }};">Add Service</button>
        </div>
    </form>
</div>

<style>
    /* Dropdown border matches button color */
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

    /* Consistent label font weight */
    .form-label {
        font-weight: 600;
    }

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
</style>

@endsection
