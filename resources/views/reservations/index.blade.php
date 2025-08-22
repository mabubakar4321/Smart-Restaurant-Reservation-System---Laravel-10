@extends('AdminDashboard.layout')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-calendar-event me-2"></i>Reservations</h2>
            <p class="text-muted mb-0">Manage and track all customer reservations in one place.</p>
        </div>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> New Reservation
        </a>
    </div>

    {{-- Search & Filters --}}
    <div class="bg-white rounded-4 shadow-sm p-3 mb-3">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-pill"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="form-control border-0 bg-light rounded-end-pill" 
                           placeholder="Search by customer or phone...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select bg-light border-0 rounded-pill">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary rounded-pill w-100">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Reservations Table --}}
    <div class="bg-white rounded-4 shadow-sm p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="bg-light">
                    <tr class="text-secondary small text-uppercase">
                        <th class="py-3 px-3">#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Table</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td class="fw-semibold text-primary px-3">{{ $res->id }}</td>
                        <td>{{ $res->customer_name }}</td>
                        <td>{{ $res->customer_phone }}</td>
                        <td>{{ $res->table ? $res->table->name : '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($res->reservation_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $res->reservation_time)->format('g:i A') }}</td>
                        <td>{{ $res->duration }} mins</td>
                        <td>
                            @php
                                $statusColors = [
                                    'Pending' => 'badge bg-warning-subtle text-warning rounded-pill px-3 py-2',
                                    'Confirmed' => 'badge bg-info-subtle text-info rounded-pill px-3 py-2',
                                    'Done' => 'badge bg-success-subtle text-success rounded-pill px-3 py-2'
                                ];
                            @endphp
                            <span class="{{ $statusColors[$res->status] ?? 'badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2' }}">
                                {{ $res->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group">
                                <a href="{{ route('reservations.edit', $res->id) }}" class="btn btn-sm btn-light" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light text-danger" title="Delete" onclick="return confirm('Delete reservation?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076507.png" alt="No data" width="80">
                            <p class="mt-2 text-muted">No reservations found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
