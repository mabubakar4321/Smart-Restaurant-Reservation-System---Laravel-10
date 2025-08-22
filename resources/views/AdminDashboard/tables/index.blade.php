@extends('AdminDashboard.layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #eef2f3);
        font-family: 'Poppins', sans-serif;
    }
    h2 {
        font-weight: 600;
        color: #333;
    }
    .card-table {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        padding: 20px;
    }
    table {
        border-radius: 12px;
        overflow: hidden;
    }
    .table thead th {
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        color: white;
        border: none;
    }
    .table tbody tr:hover {
        background-color: rgba(255, 126, 95, 0.05);
        transition: 0.3s ease;
    }
    .btn-primary {
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #feb47b, #ff7e5f);
        transform: scale(1.02);
        transition: 0.3s ease;
    }
    .btn-warning, .btn-danger {
        border: none;
        transition: 0.3s ease;
    }
    .btn-warning:hover, .btn-danger:hover {
        transform: scale(1.05);
    }
    .badge {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 30px;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center">🍽 Manage Restaurant Tables</h2>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('showcreate') }}" class="btn btn-primary">➕ Add Table</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card-table">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tables as $table)
                        <tr>
                            <td>{{ $table->id }}</td>
                            <td>{{ $table->name }}</td>
                            <td>{{ $table->capacity }}</td>
                            <td>
                                <span class="badge bg-{{ $table->status == 'available' ? 'success' : ($table->status == 'reserved' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($table->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                             
    <a href="{{ route('tables.edit',$table->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>
    <a href="{{ route('tables.destroy',$table->id) }}" class="btn btn-sm btn-danger">🗑 Delete</a>


                                   
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
