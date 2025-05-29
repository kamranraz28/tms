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
    <h2 class="mb-4 fw-bold">All Services</h2>

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('services.create') }}" style="background-color: {{ $buttonColor }};">
            <i class="fas fa-plus me-1"></i> Create Service
        </a>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover" style="width:100%">
            <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: white;">
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $service->name ?? 'N/A' }}</td>
                        <td class="align-middle">{{ $service->description ?? 'N/A' }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning"
                                style="background-color: {{ $buttonColor }};">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                class="d-inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
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
        background-color: darken(var(--bs-primary), 10%);
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
