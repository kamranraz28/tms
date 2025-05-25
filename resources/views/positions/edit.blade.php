@extends('layouts.master')

@section('title', 'Edit Service')

@section('content')

<div class="common-container container mt-4">

    <h2 class="text-center mb-4">Edit Position</h2>

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

    <form action="{{ route('positions.update', $position->id) }}" method="POST" class="common-form row g-4 shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <!-- Service Name -->
        <div class="col-md-12">
            <label for="name" class="form-label fw-bold">position Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Service Name"
                   value="{{ old('name', $position->name) }}" required>
        </div>

        <!-- Submit -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-success px-4" style="background-color: {{ $buttonColor }};">Update Service</button>
        </div>
    </form>

</div>

@endsection
