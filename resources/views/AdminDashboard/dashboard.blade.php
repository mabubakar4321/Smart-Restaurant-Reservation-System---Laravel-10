@extends('AdminDashboard.layout')
@section('content')

<style>
    .stat-card {
        transition: all 0.3s ease;
        border: none;
        background: linear-gradient(135deg, #ffffff, #f9f9f9);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    .stat-icon {
        padding: 15px;
        border-radius: 50%;
        background: rgba(0, 123, 255, 0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    .card-header {
        border-bottom: 2px solid #f1f1f1;
        background-color: transparent;
    }
    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 20px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- Total Reservations -->
        <div class="col-md-3">
            <div class="card stat-card rounded-4 p-3 text-center">
                <div class="card-body">
                    <div class="stat-icon bg-primary text-white mb-3">
                        <i class="bi bi-calendar-check fs-3"></i>
                    </div>
                    <h6 class="fw-semibold text-muted">Total Reservations</h6>
                    <h2 class="fw-bold text-dark">{{ $totalReservations }}</h2>
                    <small class="text-secondary">All time</small>
                </div>
            </div>
        </div>

        <!-- Today's Reservations -->
        <div class="col-md-3">
            <div class="card stat-card rounded-4 p-3 text-center">
                <div class="card-body">
                    <div class="stat-icon bg-success text-white mb-3">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <h6 class="fw-semibold text-muted">Done Reservations</h6>
                    <h2 class="fw-bold text-dark">{{ $doneReservationsCount }}</h2>
                    <small class="text-secondary">All Time</small>
                </div>
            </div>
        </div>

        <!-- Available Tables -->
        <div class="col-md-3">
            <div class="card stat-card rounded-4 p-3 text-center">
                <div class="card-body">
                    <div class="stat-icon bg-warning text-white mb-3">
                        <i class="bi bi-table fs-3"></i>
                    </div>
                    <h6 class="fw-semibold text-muted">Available Tables</h6>
                    <h2 class="fw-bold text-dark">{{ $totalTables }}</h2>
                    <small class="text-secondary">Ready for booking</small>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-md-3">
            <div class="card stat-card rounded-4 p-3 text-center">
                <div class="card-body">
                    <div class="stat-icon bg-danger text-white mb-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <h6 class="fw-semibold text-muted">Revenue</h6>
                    <h2 class="fw-bold text-dark">${{$totalamount}}</h2>
                    <small class="text-secondary">This month</small>
                </div>
            </div>
        </div>
    </div>



     <div class="col-md-3">
            <div class="card stat-card rounded-4 p-3 text-center">
                <div class="card-body">
                    <div class="stat-icon bg-danger text-white mb-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                    <h6 class="fw-semibold text-muted">Pending Reservations</h6>
                    <h2 class="fw-bold text-dark">{{ $pendingReservationsCount }}</h2>
                    <small class="text-secondary">All Time</small>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Recent Reservations Table -->
    
</div>

@endsection
