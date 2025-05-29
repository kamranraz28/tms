@extends('layouts.master')

@section('title', 'View Cost')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center animate__animated animate__fadeInDown" role="alert" style="animation-duration: 0.7s;">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center animate__animated animate__fadeInDown" role="alert" style="animation-duration: 0.7s;">
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
                <div class="card shadow-lg rounded-4 animate__animated animate__fadeIn" style="animation-duration: 0.8s; border: none;">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0 fw-bold">Cost Details</h5>
                    </div>
                    <div class="card-body">

                        <p class="fs-5"><strong>Date:</strong> {{ \Carbon\Carbon::parse($cost->date)->format('F d, Y') }}</p>

                        @if ($cost->costDetails->isEmpty())
                            <p class="text-muted fst-italic">No cost details found.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle table-hover shadow-sm rounded-3" style="border-collapse: separate; border-spacing: 0 8px;">
                                    <thead class="table-primary rounded-3">
                                        <tr>
                                            <th>Service</th>
                                            <th>Amount</th>
                                            <th>Voucher</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cost->costDetails as $detail)
                                            <tr class="shadow-sm" style="transition: background-color 0.3s ease, transform 0.3s ease;">
                                                <td>{{ $detail->service->name ?? 'N/A' }}</td>
                                                <td>৳ {{ number_format($detail->amount, 2) }}</td>
                                                <td>
                                                    @if ($detail->memo_upload)
                                                        <a href="{{ asset('storage/vouchers/' . $detail->memo_upload) }}" target="_blank"
                                                           class="btn btn-sm btn-warning"
                                                           style="background-color: {{ $buttonColor }}; border-color: {{ $buttonColor }}; transition: background-color 0.3s;">
                                                           View
                                                        </a>
                                                    @else
                                                        <span class="text-muted fst-italic">No Voucher</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <a href="{{ route('costs.index') }}"
                           class="btn btn-primary mt-4 px-4 py-2 fw-semibold rounded-pill shadow-sm"
                           style="background-color: {{ $buttonColor }}; border-color: {{ $buttonColor }}; transition: background-color 0.3s ease;">
                            <i class="fas fa-arrow-left me-2"></i> Back
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>

    /* Table row hover effect */
    tbody tr:hover {
        background-color: #f0f8ff !important;
        transform: translateX(6px);
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        cursor: pointer;
    }

    /* Button hover */
    a.btn-primary:hover {
        background-color: darken({{ $buttonColor }}, 10%);
        border-color: darken({{ $buttonColor }}, 10%);
        box-shadow: 0 6px 12px rgb(0 0 0 / 0.15);
    }
</style>

@endsection
