@extends('layouts.master')

@section('title', 'Edit Cost')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

<section class="blog-one">
    <div class="container">
        <div class="row gutter-y-30">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Cost</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('costs.update', $cost->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date">Select Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ $cost->date }}" required>
                                </div>
                            </div>

                            <!-- Existing CostDetails -->
                            <div id="field-container">
                                @foreach ($cost->costDetails as $index => $detail)
                                    <div class="row mb-3 field-group">
                                        <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                                        <div class="col-md-4">
                                            <label>Service</label>
                                            <select name="service_id[]" class="form-control" required>
                                                <option value="">-- Select Service --</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}" {{ $detail->service_id == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Amount</label>
                                            <input type="text" name="amount[]" class="form-control" value="{{ $detail->amount }}" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Voucher</label>
                                            <input type="file" name="voucher[]" class="form-control">
                                            @if ($detail->memo_upload)
                                                <small>Current:
                                                    <a href="{{ asset('storage/vouchers/' . $detail->memo_upload) }}" target="_blank">
                                                        View
                                                    </a>
                                                </small>
                                            @endif
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-field" {{ $loop->first ? 'style=display:none;' : '' }}>Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-primary mt-2" id="add-more">Add More</button>
                            <button type="submit" class="btn btn-success mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fieldContainer = document.getElementById('field-container');
        const addMoreBtn = document.getElementById('add-more');

        addMoreBtn.addEventListener('click', function () {
            const fieldGroup = document.createElement('div');
            fieldGroup.classList.add('row', 'mb-3', 'field-group');

            fieldGroup.innerHTML = `
                <input type="hidden" name="detail_id[]" value="new">
                <div class="col-md-4">
                    <label>Service</label>
                    <select name="service_id[]" class="form-control" required>
                        <option value="">-- Select Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Amount</label>
                    <input type="text" name="amount[]" class="form-control" placeholder="Amount" required>
                </div>

                <div class="col-md-3">
                    <label>Voucher</label>
                    <input type="file" name="voucher[]" class="form-control">
                </div>

                <div class="col-md-2 d-flex align-items-end">
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
                btn.style.display = index === 0 ? 'none' : 'block';
            });
        }

        updateRemoveButtons();
    });
</script>

@endsection
