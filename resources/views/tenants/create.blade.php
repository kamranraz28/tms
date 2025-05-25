@extends('layouts.master')

@section('title', 'Create Property')

@section('content')

    <div class="common-container container mt-4">

        <h2 class="text-center mb-4">Create Tenant</h2>

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

        <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data"
            class="common-form row g-4 shadow p-4 rounded bg-light">
            @csrf

            <div class="col-md-12">
                <label for="property_id" class="form-label fw-bold">Property</label>
                <select name="property_id" id="property_id" class="form-control" required>
                    <option value="" selected disabled>Select a Property</option>
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- User Name Field -->
            <div class="col-md-6">
                <label for="name" class="form-label fw-bold">Tenant Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Tenant Name" required>
            </div>

            <!-- User Name Field -->
            <div class="col-md-6">
                <label for="phone" class="form-label fw-bold">Tenant Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Tenant" required>
            </div>

            <!-- User Name Field -->
            <div class="col-md-6">
                <label for="address" class="form-label fw-bold">Tenant Permanent Address</label>
                <input type="text" name="address" id="address" class="form-control"
                    placeholder="Enter Tenant Permanent Address">
            </div>

            <!-- User Name Field -->
            <div class="col-md-6">
                <label for="nid_number" class="form-label fw-bold">Tenant NID Number</label>
                <input type="text" name="nid_number" id="nid_number" class="form-control" placeholder="Tenant NID Number"
                    required>
            </div>

            <!-- User Name Field -->
            <div class="col-md-6">
                <label for="nid_upload" class="form-label fw-bold">Tenant NID Upload</label>
                <input type="file" name="nid_upload" id="nid_upload" class="form-control" placeholder="Tenant NID Upload">
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary px-3" style="background-color: {{ $buttonColor }};">Create
                    Property</button>
            </div>

        </form>
    </div>

@endsection
