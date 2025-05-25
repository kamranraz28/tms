@extends('layouts.master')

@section('title', 'Create Service')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4">Create Position</h2>

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

    <form action="{{ route('positions.store') }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf

        <!-- User Name Field -->
        <div class="col-md-12">
            <label for="name" class="form-label fw-bold">Position Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Service Name" required>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary px-3" style="background-color: {{ $buttonColor }};">Create Service</button>
        </div>

    </form>
</div>

@endsection
