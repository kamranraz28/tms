@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="container my-4">
    <h1 class="mb-4">Dashboard Overview</h1>
    <div class="row mb-4">
        <!-- Cards -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Tenants</h5>
                    <h2>{{ $tenantCount }}</h2>
                    <p class="card-text">All tenants registered in the system.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Tenants</h5>
                    <h2>{{ $activeTenants }}</h2>
                    <p class="card-text">Tenants currently active.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Properties</h5>
                    <h2>{{ $totalProperties }}</h2>
                    <p class="card-text">Properties available in the system.</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
