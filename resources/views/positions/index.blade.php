@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="common-container">
    <h2>All Positions</h2>


    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('positions.create') }}" style="background-color: {{ $buttonColor }};">
        <i class="fas fa-plus"> </i> Create Service
        </a>
    </div>


    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>position Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $position->name ?? 'N/A' }}</td>
                    <td>
                        <!-- Action buttons: Edit and Delete -->
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-warning" style="background-color: {{ $buttonColor }};">Edit</a>

                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
