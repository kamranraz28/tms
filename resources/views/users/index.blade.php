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
        <h2 class="mb-4 fw-bold">List of Users with Their Roles</h2>

        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{ route('users.create') }}" style="background-color: {{ $buttonColor }};">
                <i class="fas fa-plus me-1"></i> Create User
            </a>
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-hover" style="width:100%">
                <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->id }}</td>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @forelse ($user->roles as $role)
                                    <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                                @empty
                                    <span class="text-muted">No roles assigned</span>
                                @endforelse
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                    style="background-color: {{ $buttonColor }};">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('POST')
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
        /* Fade-in animation */
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
            /* Start hidden, fade in */
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        /* Button hover */
        .btn-primary {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: darken(var(--bs-primary), 10%);
            transform: translateY(-2px);
        }

        /* Table row hover */
        table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* Role badges */
        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.7em;
            transition: background-color 0.3s ease;
        }

        .badge.bg-secondary:hover {
            background-color: #6c757dcc;
        }
    </style>

@endsection
