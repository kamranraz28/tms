@extends('layouts.master')

@section('title', 'Add Costs')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
        role="alert" style="animation: fadeInDown 0.5s;">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
        role="alert" style="animation: fadeInDown 0.5s;">
        <span>{{ session('error') }}</span>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

<div class="common-container container mt-4 p-4 shadow rounded bg-white">

    <h2 class="text-center mb-5 fw-bold">Add Costs</h2>

    <form action="{{ route('costs.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf

        <div class="col-md-6">
            <label for="date" class="form-label fw-bold">Select Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div id="field-container" class="col-12">
            <div class="row mb-3 field-group align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Service</label>
                    <select name="service_id[]" class="form-control" required>
                        <option value="">-- Select Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Amount</label>
                    <input type="text" name="amount[]" class="form-control" placeholder="Amount" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Voucher</label>
                    <input type="file" name="voucher[]" class="form-control">
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger remove-field" style="display: none;">Remove</button>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-primary" id="add-more" style="background-color: {{ $buttonColor }};">Add More</button>
            <button type="submit" class="btn btn-success" style="background-color: {{ $buttonColor }};">Submit</button>
        </div>
    </form>
</div>

<style>
    /* Smooth alert fade-in */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Consistent label font weight */
    .form-label {
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fieldContainer = document.getElementById('field-container');
        const addMoreBtn = document.getElementById('add-more');

        addMoreBtn.addEventListener('click', function () {
            const fieldGroup = document.createElement('div');
            fieldGroup.classList.add('row', 'mb-3', 'field-group', 'align-items-end');

            fieldGroup.innerHTML = `
                <div class="col-md-4">
                    <label class="form-label fw-bold">Service</label>
                    <select name="service_id[]" class="form-control" required>
                        <option value="">-- Select Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Amount</label>
                    <input type="text" name="amount[]" class="form-control" placeholder="Amount" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Voucher</label>
                    <input type="file" name="voucher[]" class="form-control">
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger remove-field">Remove</button>
                </div>
            `;

            fieldContainer.appendChild(fieldGroup);
            updateRemoveButtons();
        });

        fieldContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.closest('.field-group').remove();
                updateRemoveButtons();
            }
        });

        function updateRemoveButtons() {
            const removeButtons = document.querySelectorAll('.remove-field');
            removeButtons.forEach((btn, index) => {
                btn.style.display = index === 0 ? 'none' : 'inline-block';
            });
        }

        updateRemoveButtons();
    });
</script>

@endsection
