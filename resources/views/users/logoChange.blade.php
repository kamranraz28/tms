@extends('layouts.master')

@section('title', 'My Profile')

@section('content')

<style>
    .logo-section {
        padding: 2rem;
        background: linear-gradient(to right, #f0f4f8, #e2e8f0);
        min-height: 100vh;
    }

    .glass-form {
        backdrop-filter: blur(14px);
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

    .form-label {
        font-weight: 600;
        color: #333;
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

    .preview-img {
        max-height: 120px;
        margin-top: 1rem;
        object-fit: contain;
    }

    .alert {
        animation: fadeInDown 0.8s ease-in-out;
    }
</style>

<div class="logo-section container animate__animated animate__fadeIn">
    <h2 class="text-center fw-bold mb-5 animate__animated animate__fadeInDown">🖼️ Change Application Logo</h2>

    @if (session('success'))
        <div class="alert alert-success text-center rounded-pill shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updateLogo') }}" method="POST"
        class="row g-4 p-5 glass-form mx-auto col-md-8" enctype="multipart/form-data">
        @csrf

        <!-- Upload Logo -->
        <div class="col-md-12 animate__animated animate__fadeInUp animate__delay-1s">
            <label for="image" class="form-label">Upload New Logo</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                onchange="previewLogo(event)">
            <small class="text-muted">Leave blank if you don't want to change the logo.</small>

            <div class="text-center">
                <img id="logo-preview" class="preview-img d-none mt-3 rounded shadow-sm" alt="Logo Preview">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4 animate__animated animate__fadeInUp animate__delay-2s">
            <button type="submit" class="btn btn-animated text-white"
                style="background-color: {{ $buttonColor ?? '#0d6efd' }};">
                ✅ Update Logo
            </button>
        </div>
    </form>
</div>

<script>
    function previewLogo(event) {
        const input = event.target;
        const preview = document.getElementById('logo-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
