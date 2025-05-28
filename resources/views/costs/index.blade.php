@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="common-container">
    <h2>All Costs</h2>


    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('costs.create') }}" style="background-color: {{ $buttonColor }};">
        <i class="fas fa-plus"> </i> Create Cost
        </a>
    </div>


    <table id="example" class="display" style="width:100%">
        <thead>
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
                        <!-- Action buttons: Edit and Delete -->
                        <a href="{{ route('costs.edit', $cost->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

                        <form action="{{ route('costs.destroy', $cost->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this cost?')">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
