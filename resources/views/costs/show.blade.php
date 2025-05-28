@extends('layouts.master')

@section('title', 'View Cost')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Cost Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($cost->date)->format('F d, Y') }}</p>

            @if ($cost->costDetails->isEmpty())
                <p>No cost details found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Voucher</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cost->costDetails as $detail)
                            <tr>
                                <td>{{ $detail->service->name ?? 'N/A' }}</td>
                                <td>{{ number_format($detail->amount, 2) }}</td>
                                <td>
                                    @if ($detail->memo_upload)
                                        <a href="{{ asset('storage/vouchers/' . $detail->memo_upload) }}" target="_blank">View</a>
                                    @else
                                        <span class="text-muted">No Voucher</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('costs.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</div>
@endsection
