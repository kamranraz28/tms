@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="common-container">
        <h2>Costing Report</h2>

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
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('reports.resetCosts') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <table id="example" class="display" style="width:100%">
            <thead>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $costDetail->service->name ?? 'N/A' }}</td>
                        <td>{{ $costDetail->amount ?? 'N/A' }}</td>
                        <td>
                            @if ($costDetail->voucher)
                                <a href="{{ asset('storage/vouchers/' . $costDetail->voucher) }}" target="_blank"
                                    class="btn btn-sm btn-primary">View Voucher</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $costDetail->cost->date ?? 'N/A' }}</td>
                        <td>{{ $costDetail->created_at->format('Y-m-d') ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
