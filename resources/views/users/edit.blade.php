@extends('layouts.master')

@section('title', 'Edit User')

@section('content')

<style>
  /* Container animation */
  .common-container {
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
    margin-top: 40px;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(25px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Card styling */
  form.common-form {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }

  /* Input and select styling */
  .form-control {
    border-radius: 6px;
    border: 1.5px solid #ced4da;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
  }

  /* Labels bold and spaced */
  label.form-label {
    font-weight: 600;
    margin-bottom: 6px;
  }

  /* Button styling with hover */
  button.btn-primary {
    background-color: {{ $buttonColor }};
    border-color: {{ $buttonColor }};
    padding: 0.5rem 2rem;
    font-weight: 600;
    border-radius: 8px;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }
  button.btn-primary:hover {
    background-color: darken({{ $buttonColor }}, 10%);
    transform: translateY(-3px);
  }
</style>

<div class="common-container container">
    <h2 class="text-center mb-4">Edit User and Assign Role</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="common-form row g-4">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label for="name" class="form-label">User Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Enter User Name" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter Email" required>
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep the same password">
        </div>

        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
        </div>

        <div class="col-md-12">
            <label for="role" class="form-label">Assign Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="" disabled>Select a Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary">Update User and Assign Role</button>
        </div>
    </form>
</div>

@endsection
