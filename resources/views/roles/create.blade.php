@extends('layouts.master')

@section('title', 'Create Role')

@section('content')

<style>
  /* Container card with fadeInUp animation */
  .common-container {
    max-width: 900px;
    margin: 3rem auto;
    background: #fff;
    padding: 2.5rem 3rem;
    border-radius: 12px;
    box-shadow: 0 25px 45px rgba(0,0,0,0.1);
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
  }

  h2 {
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 2rem;
    text-align: center;
    color: #222;
  }

  /* Form input with colored border */
  input[type="text"] {
    border: 2px solid {{ $buttonColor }};
    border-radius: 8px;
    font-size: 1.1rem;
    padding: 0.6rem 0.9rem;
    transition: border-color 0.3s ease;
  }
  input[type="text"]:focus {
    outline: none;
    border-color: darken({{ $buttonColor }}, 15%);
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
  }

  /* Table styling */
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.7rem;
    font-size: 1rem;
  }
  thead tr {
    background-color: {{ $buttonColor }};
    color: white;
    border-radius: 12px;
  }
  thead th {
    padding: 14px 18px;
    text-align: left;
  }
  tbody tr {
    background: #f9f9f9;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    border-radius: 12px;
  }
  tbody tr:hover {
    background: #e9f0ff;
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.15);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }
  tbody td {
    padding: 14px 18px;
    vertical-align: middle;
  }

  /* Checkbox styling */
  .form-check-input {
    width: 20px;
    height: 20px;
    cursor: pointer;
    border: 2px solid {{ $buttonColor }};
    border-radius: 6px;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }
  .form-check-input:checked {
    background-color: {{ $buttonColor }};
    border-color: {{ $buttonColor }};
  }

  /* Submit button */
  button.btn-primary {
    background-color: {{ $buttonColor }};
    font-weight: 600;
    padding: 0.75rem 3rem;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2);
    transition: transform 0.2s ease, box-shadow 0.3s ease;
    border: none;
  }
  button.btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 28px rgba(13, 110, 253, 0.3);
  }

  /* Label for select all checkbox */
  .form-check-label {
    font-weight: 700;
    user-select: none;
  }

</style>

<div class="common-container">

    <h2>Create Role</h2>

    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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

    <!-- Create Role Form -->
    <form action="{{ route('roles.store') }}" method="POST" class="row g-4">
        @csrf

        <!-- Role Name Input -->
        <div class="col-md-6 offset-md-3">
            <label for="name" class="form-label fw-bold">Role Name:</label>
            <input type="text" name="name" id="name" class="form-control form-control-lg" required placeholder="Enter role name">
        </div>

        <!-- Permissions Table -->
        <div class="col-md-12 mt-4">
            <label class="form-label fw-bold">Assign Permissions:</label>
            <div class="table-responsive rounded shadow-sm" style="border: 1px solid #ddd;">
                <table id="example" class="table table-hover mb-0" style="width:100%; min-width: 600px;">
                    <thead class="table-primary" style="background-color: {{ $buttonColor }}; color: white;">
                        <tr>
                            <th class="text-center">SN</th>
                            <th>Permission Name</th>
                            <th class="text-center">
                                <div class="form-check mb-0">
                                    <input type="checkbox" class="form-check-input" id="select-all">
                                    <label class="form-check-label fw-bold" for="select-all">Select All</label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $index => $permission)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="align-middle">{{ $permission->name }}</td>
                            <td class="text-center align-middle">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input permission-checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission-{{ $permission->id }}">
                                    <label class="form-check-label" for="permission-{{ $permission->id }}"></label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                Create Role
            </button>
        </div>
    </form>
</div>

<!-- JavaScript for Select All functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        selectAllCheckbox.addEventListener('change', function () {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        permissionCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!this.checked) {
                    selectAllCheckbox.checked = false;
                } else if ([...permissionCheckboxes].every(chk => chk.checked)) {
                    selectAllCheckbox.checked = true;
                }
            });
        });
    });
</script>

@endsection
