@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="animation: fadeInDown 0.5s;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="common-container container mt-4 p-4 shadow rounded bg-white">

    <h2 class="mb-5 fw-bold">All Costs</h2>

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('costs.create') }}" style="background-color: {{ $buttonColor }};">
            <i class="fas fa-plus"></i> Create Cost
        </a>
    </div>

    <table id="example" class="display table table-bordered" style="width:100%">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Cost Date</th>
                <th>Total Amount</th>
                <th>Cost Details</th>
                <th>Entry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($costs as $cost)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cost->date ?? 'N/A' }}</td>
                    <td>{{ $cost->costDetails->sum('amount') ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('costs.show', $cost->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Show Details</a>
                    </td>
                    <td>{{ $cost->created_at->format('Y-m-d') ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('costs.edit', $cost->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

                        <form action="{{ route('costs.destroy', $cost->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this cost?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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

    /* Style the alerts with padding and rounded edges */
    .alert {
        font-weight: 600;
    }

    /* Optional: style table borders and spacing */
    table.dataTable tbody tr:hover {
        background-color: #f9f9f9;
    }
</style>

@endsection
