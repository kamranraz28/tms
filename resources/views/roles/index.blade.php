@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<style>
  /* Container fade in + slide up */
  .common-container {
    max-width: 900px;
    margin: 2rem auto;
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Card like container */
  .common-container {
    background: #fff;
    padding: 2rem 2.5rem;
    border-radius: 12px;
    box-shadow: 0 25px 45px rgba(0,0,0,0.1);
  }

  /* Heading style */
  h2 {
    letter-spacing: 1px;
    font-weight: 700;
    margin-bottom: 1.75rem;
    text-align: center;
    color: #222;
  }

  /* Table styles */
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.75rem;
    font-size: 0.95rem;
  }

  thead tr {
    background-color: {{ $buttonColor }};
    color: #fff;
    border-radius: 12px;
  }
  thead th {
    padding: 12px 18px;
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

  /* Permissions list */
  ul {
    margin-bottom: 0;
    padding-left: 20px;
    color: #555;
  }

  /* Buttons */
  a.btn-outline-primary {
    border-color: {{ $buttonColor }};
    color: {{ $buttonColor }};
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 14px;
    transition: all 0.3s ease;
    display: inline-block;
  }
  a.btn-outline-primary:hover {
    background-color: {{ $buttonColor }};
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
  }

  /* Create Role button */
  .btn-primary {
    background-color: {{ $buttonColor }};
    font-weight: 600;
    border-radius: 8px;
    padding: 8px 18px;
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2);
    transition: transform 0.2s ease, box-shadow 0.3s ease;
  }
  .btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 28px rgba(13, 110, 253, 0.3);
  }

</style>

<div class="common-container">

    <h2>Roles</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary shadow" href="{{ route('roles.create') }}">
            <i class="fas fa-plus me-2"></i> Create Role
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $role->name }}</strong></td>
                    <td>
                        @if($role->permissions->isNotEmpty())
                            <ul>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted fst-italic">No permissions assigned</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <a class="btn btn-outline-primary" href="{{ route('roles.edit', $role->id) }}">
                            Edit Permissions
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
