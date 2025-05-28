@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-section {
        padding: 2rem;
        background: linear-gradient(135deg, #f3f4f6, #ffffff);
    }

    .glass-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.2);
        border-radius: 1rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .glass-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .count-number {
        font-size: 2.8rem;
        font-weight: 800;
        color: #333;
    }

    .card-icon {
        font-size: 2.2rem;
        opacity: 0.7;
    }

    .card-body p {
        font-size: 0.9rem;
        color: #555;
    }
</style>

<div class="dashboard-section">
    <h2 class="mb-4 fw-bold animate__animated animate__fadeInDown">📊 System Overview</h2>

    <div class="row g-4">
        <!-- Total Tenants -->
        <div class="col-md-4">
            <div class="card glass-card animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="card-title text-dark">Total Tenants</div>
                            <div class="count-number" data-count="{{ $tenantCount }}">0</div>
                        </div>
                        <div><i class="fas fa-users card-icon text-primary"></i></div>
                    </div>
                    <p class="mt-2">All tenants registered in the system.</p>
                </div>
            </div>
        </div>

        <!-- Active Tenants -->
        <div class="col-md-4">
            <div class="card glass-card animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="card-title text-dark">Active Tenants</div>
                            <div class="count-number" data-count="{{ $activeTenants }}">0</div>
                        </div>
                        <div><i class="fas fa-user-check card-icon text-success"></i></div>
                    </div>
                    <p class="mt-2">Currently active tenants in the system.</p>
                </div>
            </div>
        </div>

        <!-- Total Properties -->
        <div class="col-md-4">
            <div class="card glass-card animate__animated animate__fadeInUp animate__delay-3s">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="card-title text-dark">Total Properties</div>
                            <div class="count-number" data-count="{{ $totalProperties }}">0</div>
                        </div>
                        <div><i class="fas fa-building card-icon text-info"></i></div>
                    </div>
                    <p class="mt-2">Properties listed in the database.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Count-Up Animation Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const counters = document.querySelectorAll(".count-number");
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / 40;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 30);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
</script>

@endsection
