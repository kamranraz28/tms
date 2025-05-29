@extends('layouts.master')

@section('title', 'Edit Permission')

@section('content')

<div class="container my-5">
    <div class="card shadow-lg animate__animated animate__fadeInDown" style="border-radius: 12px;">
        <div class="card-header text-white d-flex justify-content-center align-items-center" style="background-color: {{ $buttonColor }}; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h4 class="mb-0 fw-bold" style="letter-spacing: 1px;">Edit Permission: {{ $permission->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="name" class="form-label fw-semibold">Permission Name:</label>
                    <input type="text"
                           class="form-control shadow-sm"
                           name="name"
                           id="name"
                           value="{{ old('name', $permission->name) }}"
                           placeholder="Enter permission name"
                           required>
                    <div class="invalid-feedback">
                        Please provide a permission name.
                    </div>
                </div>

                <div class="col-12 text-center mt-4">
                    <button type="submit"
                        class="btn btn-primary btn-lg px-4 py-2 shadow"
                        style="background-color: {{ $buttonColor }}; border-radius: 8px; font-weight: 600; transition: transform 0.2s ease;"
                        onmouseover="this.style.transform='scale(1.05)';"
                        onmouseout="this.style.transform='scale(1)';">
                        Update Permission
                    </button>
                    <a href="{{ route('permissions.index') }}"
                       class="btn btn-secondary btn-lg px-4 py-2 shadow ms-3"
                       style="background-color: {{ $buttonColor }}; opacity: 0.7; border-radius: 8px; font-weight: 600; transition: opacity 0.2s ease;"
                       onmouseover="this.style.opacity='1';"
                       onmouseout="this.style.opacity='0.7';">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Animate.css for fadeIn effect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
// Bootstrap form validation
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>

<style>
    input.form-control:focus {
        box-shadow: 0 0 8px {{ $buttonColor }};
        border-color: {{ $buttonColor }};
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
</style>

@endsection
