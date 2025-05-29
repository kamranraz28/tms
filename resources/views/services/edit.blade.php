@extends('layouts.master')

@section('title', 'Edit Service')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4 fw-bold">Edit Service</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <!-- Service Name -->
        <div class="col-md-6">
            <label for="name" class="form-label fw-bold">Service Name</label>
            <input type="text" name="name" id="name" class="form-control border-primary"
                   placeholder="Enter Service Name" value="{{ old('name', $service->name) }}" required>
        </div>

        <!-- Description -->
        <div class="col-md-6">
            <label for="description" class="form-label fw-bold">Description</label>
            <input type="text" name="description" id="description" class="form-control border-primary"
                   placeholder="Enter Description" value="{{ old('description', $service->description) }}">
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-success px-4 py-2" style="background-color: {{ $buttonColor }};">
                <i class="fas fa-sync-alt me-1"></i> Update Service
            </button>
        </div>
    </form>

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

    .btn-success {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-success:hover {
        background-color: darken(var(--bs-success), 10%);
        transform: translateY(-2px);
    }

    .form-control {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: {{ $buttonColor }};
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

@endsection
