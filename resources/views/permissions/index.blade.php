@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">
    <h2 class="text-center mb-4" style="font-weight: 700; letter-spacing: 1px; color: #333;">Permissions</h2>

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary shadow-sm animate__animated animate__fadeInRight"
           href="{{ route('permissions.create') }}"
           style="background-color: {{ $buttonColor }}; border-radius: 8px; font-weight: 600;">
            <i class="fas fa-plus me-2"></i> Create Permission
        </a>
    </div>

    <div class="table-responsive shadow rounded animate__animated animate__fadeInUp">
        <table id="example" class="display table table-striped table-hover" style="width:100%; border-radius: 8px; overflow: hidden;">
            <thead class="table-dark" style="border-radius: 8px;">
                <tr>
                    <th style="width: 5%;">SN</th>
                    <th>Permission Name</th>
                    <th style="width: 20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr style="transition: background-color 0.3s ease;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}"
                               class="btn btn-warning btn-sm me-2"
                               style="background-color: {{ $buttonColor }}; border-radius: 6px; font-weight: 600; box-shadow: 0 2px 6px rgba(0,0,0,0.15); transition: transform 0.2s ease;">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this permission?');"
                                        style="border-radius: 6px; font-weight: 600; box-shadow: 0 2px 6px rgba(0,0,0,0.15); transition: transform 0.2s ease;">
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

<!-- Animate.css CDN for easy animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* Hover effects on rows */
    #example tbody tr:hover {
        background-color: #f0f4ff;
        cursor: pointer;
    }

    /* Buttons scale on hover */
    .btn-warning:hover, .btn-danger:hover, .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    /* Table header text style */
    #example thead th {
        letter-spacing: 1px;
    }
</style>

<script>
    // Initialize DataTables if not already initialized
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "Search permissions...",
                search: "",
            },
            pageLength: 10,
            lengthChange: false,
        });
    });
</script>

@endsection
