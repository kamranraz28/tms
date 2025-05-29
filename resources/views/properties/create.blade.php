@extends('layouts.master')

@section('title', 'Create Property')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4 fw-bold">Create Property</h2>

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

    <form action="{{ route('properties.store') }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf

        <!-- Property Name -->
        <div class="col-md-12">
            <label for="name" class="form-label fw-bold">Property Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Property Name" required>
        </div>

        <!-- Position -->
        <div class="col-md-6">
            <label for="position_id" class="form-label fw-bold">Position</label>
            <select name="position_id" id="position_id" class="form-control" required>
                <option value="" selected disabled>Select a Position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Address -->
        <div class="col-md-6">
            <label for="address" class="form-label fw-bold">Property Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Property Address" required>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-4" style="background-color: {{ $buttonColor }};">Create Property</button>
        </div>
    </form>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .common-container {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        background-color: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
    }

    .form-label {
        color: #333;
        font-weight: 600;
    }

    .form-control {
        border-radius: 0.5rem;
    }
</style>

@endsection
