@extends('layouts.master')

@section('title', 'My Profile')

@section('content')

<style>
    .profile-section {
        padding: 2rem;
        background: linear-gradient(to right, #f9fafc, #e3e8f0);
        min-height: 100vh;
    }

    .glass-form {
        backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.3);
        border-radius: 1rem;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: all 0.3s ease;
        animation: fadeInUp 1s ease-in-out;
    }

    .glass-form:hover {
        transform: scale(1.01);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .glass-form label {
        font-weight: 600;
        color: #333;
    }

    .form-control-color {
        height: 3rem;
        width: 100%;
        padding: 0.5rem;
        border-radius: 0.5rem;
        border: 1px solid #ccc;
    }

    .btn-animated {
        font-weight: 600;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border-radius: 2rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-animated:hover {
        transform: translateY(-3px);
        filter: brightness(1.1);
    }

    .alert {
        animation: fadeInDown 0.8s ease-in-out;
    }
</style>

<div class="profile-section container animate__animated animate__fadeIn">
    <h2 class="text-center fw-bold mb-5 animate__animated animate__fadeInDown">🎨 Customize App Colors</h2>

    @if (session('success'))
        <div class="alert alert-success text-center rounded-pill shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger rounded shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updateColors') }}" method="POST" class="row g-4 p-5 glass-form mx-auto col-md-8" enctype="multipart/form-data">
        @csrf

        <!-- Header Background Color -->
        <div class="col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
            <label for="headerColor" class="form-label">🖌️ Header Background</label>
            <input type="color" id="headerColor" name="headerColor" class="form-control form-control-color"
                value="{{ old('headerColor', $headerColor ?? '#ffffff') }}">
        </div>

        <!-- Sidebar Background Color -->
        <div class="col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
            <label for="sidebarColor" class="form-label">📁 Sidebar Background</label>
            <input type="color" id="sidebarColor" name="sidebarColor" class="form-control form-control-color"
                value="{{ old('sidebarColor', $sidebarColor ?? '#ffffff') }}">
        </div>

        <!-- Button Background Color -->
        <div class="col-md-6 mt-3 animate__animated animate__fadeInUp animate__delay-3s">
            <label for="buttonColor" class="form-label">🎯 Button Background</label>
            <input type="color" id="buttonColor" name="buttonColor" class="form-control form-control-color"
                value="{{ old('buttonColor', $buttonColor ?? '#ffffff') }}">
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-5 animate__animated animate__fadeInUp animate__delay-4s">
            <button type="submit" class="btn btn-animated text-white"
                style="background-color: {{ $buttonColor }};">
                ✅ Update Colors
            </button>
        </div>
    </form>
</div>

@endsection
