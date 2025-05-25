@extends('layouts.master')

@section('title', 'Edit Tenant Service')

@section('content')

    <div class="common-container container mt-4">

        <h2 class="text-center mb-4">Edit Tenant Service</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tenantServices.update', $tenantService->id) }}" method="POST" enctype="multipart/form-data"
            class="common-form row g-4 shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <div class="col-md-12">
                <label for="tenant_id" class="form-label fw-bold">Tenant</label>
                <select name="tenant_id" id="tenant_id" class="form-control" required>
                    <option value="" disabled>Select a Tenant</option>
                    @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ $tenantService->tenant_id == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="service_id" class="form-label fw-bold">Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="" disabled>Select a Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ $tenantService->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="value" class="form-label fw-bold">Value</label>
                <input type="number" name="value" id="value" class="form-control"
                    value="{{ old('value', $tenantService->value) }}" placeholder="Enter Service Value" required>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary px-3" style="background-color: {{ $buttonColor }};">Update Service</button>
            </div>

        </form>
    </div>

@endsection
