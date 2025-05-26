@extends('layouts.master')

@section('title', 'Create Property')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4">Create Property</h2>

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

    <form action="{{ route('properties.store') }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf

        <!-- User Name Field -->
        <div class="col-md-12">
            <label for="name" class="form-label fw-bold">Property Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter User Name" required>
        </div>

        <div class="col-md-6">
            <label for="position_id" class="form-label fw-bold">Posotion</label>
            <select name="position_id" id="position_id" class="form-control" required>
                <option value="" selected disabled>Select a Position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>



        <!-- User Name Field -->
        <div class="col-md-6">
            <label for="address" class="form-label fw-bold">Property Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Enter Property Address" required>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-3" style="background-color: {{ $buttonColor }};">Create Property</button>
        </div>

    </form>
</div>

@endsection
