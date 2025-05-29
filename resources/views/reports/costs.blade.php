@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="common-container">
    <h2 class="mb-4 fw-bold">Costing Report</h2>

    <!-- Date Range Filter Form -->
    <form method="POST" action="{{ route('reports.filterCosts') }}" class="mb-4 row g-3 align-items-end">
        @csrf
        <div class="col-md-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ session('from_date') }}">
        </div>

        <div class="col-md-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ session('to_date') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" style="background-color: {{ $buttonColor }};">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('reports.resetCosts') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover" style="width:100%">
            <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: white;">
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Amount</th>
                    <th>Voucher</th>
                    <th>Cost Date</th>
                    <th>Entry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($costDetails as $costDetail)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $costDetail->service->name ?? 'N/A' }}</td>
                        <td class="align-middle">৳ {{ number_format($costDetail->amount ?? 0, 2) }}</td>
                        <td class="align-middle">
                            @if ($costDetail->voucher)
                                <a href="{{ asset('storage/vouchers/' . $costDetail->voucher) }}" target="_blank"
                                   class="btn btn-sm btn-primary"
                                   style="background-color: {{ $buttonColor }};">
                                    View Voucher
                                </a>
                            @else
                                <span class="text-muted fst-italic">N/A</span>
                            @endif
                        </td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($costDetail->cost->date ?? null)->format('Y-m-d') ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $costDetail->created_at ? $costDetail->created_at->format('Y-m-d') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .common-container {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #004a9f; /* or use a darker shade of $buttonColor if possible */
        transform: translateY(-2px);
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .btn-danger, .btn-warning {
        transition: transform 0.2s ease;
    }

    .btn-danger:hover, .btn-warning:hover {
        transform: scale(1.05);
    }
</style>

@endsection
