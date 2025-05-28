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
            padding: 1rem;
        }

        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .count-number {
            font-size: 2rem;
            /* smaller font */
            font-weight: 800;
            color: #333;
        }

        .card-icon {
            font-size: 1.8rem;
            opacity: 0.7;
        }

        .card-body p {
            font-size: 0.85rem;
            color: #555;
        }
    </style>

    <div class="dashboard-section">
        <h2 class="mb-4 fw-bold animate__animated animate__fadeInDown">📊 System Overview</h2>

        <div class="row g-3">
            <!-- Use col-md-3 for smaller boxes -->
            <div class="col-md-3">
                <div class="card glass-card animate__animated">
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

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
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

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
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

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="card-title text-dark">Paid Tenants ({{ $thisMonth }})</div>
                                <div class="count-number" data-count="{{ $paidTenantsCount ?? 0 }}">0</div>
                            </div>
                            <div><i class="fas fa-check-circle card-icon text-success"></i></div>
                        </div>
                        <p class="mt-2">Active tenants who have paid for {{ $thisMonth }}.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="card-title text-dark">Unpaid Tenants ({{ $thisMonth }})</div>
                                <div class="count-number" data-count="{{ $unpaidTenantsCount ?? 0 }}">0</div>
                            </div>
                            <div><i class="fas fa-exclamation-circle card-icon text-warning"></i></div>
                        </div>
                        <p class="mt-2">Active tenants who have not paid for {{ $thisMonth }}.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="card-title text-dark">Total Payable ({{ $thisMonth }})</div>
                                <div class="count-number" data-count="{{ $totalPayableValue ?? 0 }}">0</div>
                            </div>
                            <div><i class="fas fa-money-bill-wave card-icon text-info"></i></div>
                        </div>
                        <p class="mt-2">Total amount expected from active tenants {{ $thisMonth }}.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="card-title text-dark">Total Paid ({{ $thisMonth }})</div>
                                <div class="count-number" data-count="{{ $totalPaidValue ?? 0 }}">0</div>
                            </div>
                            <div><i class="fas fa-wallet card-icon text-success"></i></div>
                        </div>
                        <p class="mt-2">Total amount received from tenants {{ $thisMonth }}.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card glass-card animate__animated">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="card-title text-dark">Remaining Amount ({{ $thisMonth }})</div>
                                <div class="count-number" data-count="{{ $totalRemainingValue ?? 0 }}">0</div>
                            </div>
                            <div><i class="fas fa-hourglass-half card-icon text-danger"></i></div>
                        </div>
                        <p class="mt-2">Amount yet to be collected from tenants {{ $thisMonth }}.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".glass-card");
            const counters = document.querySelectorAll(".count-number");

            // Animate cards one by one with delay
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add("animate__fadeInUp");
                }, index * 400); // 400ms gap between each card animation
            });

            // Count-up animation with staggered start
            counters.forEach((counter, index) => {
                setTimeout(() => {
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
                }, index * 400 + 500); // start counting slightly after card animation
            });
        });
    </script>


@endsection
