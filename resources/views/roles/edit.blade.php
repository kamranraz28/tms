@extends('layouts.master')

@section('title', 'Edit Role')

@section('content')

<div class="common-container animate__animated animate__fadeInUp" style="max-width: 800px; margin: auto;">

    <h2 class="mb-4 text-center fw-bold" style="letter-spacing: 1px;">Edit Role</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Edit role form starts -->
    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="card p-4 shadow-sm rounded">
        @csrf
        @method('PUT')

        <!-- Role Name Field -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">Role Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" class="form-control form-control-lg" required
                style="border-color: {{ $buttonColor }};">
        </div>

        <!-- Permissions Table -->
        <div class="table-responsive mb-4">
            <table id="example" class="table table-hover align-middle" style="width: 100%; min-width: 500px;">
                <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: #fff;">
                    <tr>
                        <th>SL</th>
                        <th>Permission Name</th>
                        <th class="text-center">Select</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="text-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg px-4" style="background-color: {{ $buttonColor }}; font-weight: 600; transition: background-color 0.3s ease;">
                Update Role
            </button>
        </div>
    </form>
    <!-- Edit role form ends -->

</div>


@endsection
