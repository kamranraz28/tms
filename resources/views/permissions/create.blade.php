@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="container my-5">
    <div class="card shadow-lg animate__animated animate__fadeInDown" style="border-radius: 12px;">
        <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h4 class="mb-0" style="font-weight: 700; letter-spacing: 1px;">Create Permission</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label fw-semibold">Permission Name:</label>
                    <input type="text" class="form-control shadow-sm" name="name" id="name" placeholder="Enter permission name" required>
                    <div class="invalid-feedback">
                        Please provide a permission name.
                    </div>
                </div>

                <div class="col-12 text-center mt-4">
                    <button type="submit"
                            class="btn btn-primary px-4 py-2 shadow"
                            style="background-color: {{ $buttonColor }}; border-radius: 8px; font-weight: 600; transition: transform 0.2s ease;"
                            onmouseover="this.style.transform='scale(1.05)';"
                            onmouseout="this.style.transform='scale(1)';">
                        Create Permission
                    </button>
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
    .card-header {
        letter-spacing: 1.2px;
    }
    input.form-control:focus {
        box-shadow: 0 0 8px {{ $buttonColor }};
        border-color: {{ $buttonColor }};
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
</style>

@endsection
