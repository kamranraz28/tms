@extends('layouts.master')

@section('title', 'Edit Service')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4">Edit Service</h2>

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

    <form action="{{ route('services.update', $service->id) }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <!-- Service Name -->
        <div class="col-md-6">
            <label for="name" class="form-label fw-bold">Service Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Service Name"
                   value="{{ old('name', $service->name) }}" required>
        </div>

        <!-- Description -->
        <div class="col-md-6">
            <label for="description" class="form-label fw-bold">Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter Description"
                   value="{{ old('description', $service->description) }}">
        </div>

        <!-- Submit -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-success px-4" style="background-color: {{ $buttonColor }};">Update Service</button>
        </div>
    </form>

</div>

@endsection
