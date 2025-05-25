@extends('layouts.master')

@section('title', 'Edit Property')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4">Edit Property</h2>

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

    <form action="{{ route('properties.update', $property->id) }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <!-- Property Name -->
        <div class="col-md-12">
            <label for="name" class="form-label fw-bold">Property Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $property->name) }}" required>
        </div>

        <!-- Position Dropdown -->
        <div class="col-md-6">
            <label for="position_id" class="form-label fw-bold">Position</label>
            <select name="position_id" id="position_id" class="form-control" required>
                <option value="" disabled>Select a Position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $property->position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Property Name -->
        <div class="col-md-6">
            <label for="address" class="form-label fw-bold">Property Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $property->address) }}" required>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-success px-3" style="background-color: {{ $buttonColor }};">Update Property</button>
        </div>

    </form>
</div>

@endsection
