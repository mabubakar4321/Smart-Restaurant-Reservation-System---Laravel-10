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
    .card-customers {
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
        background: linear-gradient(90deg, #36d1dc, #5b86e5);
        color: white;
        border: none;
    }
    .table tbody tr:hover {
        background-color: rgba(91, 134, 229, 0.05);
        transition: 0.3s ease;
    }
    .search-input {
        border-radius: 30px;
        padding: 10px 20px;
        border: 1px solid #ddd;
        transition: 0.3s;
    }
    .search-input:focus {
        border-color: #5b86e5;
        box-shadow: 0 0 8px rgba(91, 134, 229, 0.4);
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center">👥 Customers</h2>

    <form method="GET" action="{{ route('customers.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="🔍 Search customers..." 
               class="form-control search-input" />
    </form>

    <div class="card-customers">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Total Reservations</th>
                        <th>Last Reservation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $index }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                            <td>
                                {{ \App\Models\Reservation::where('customer_phone', $customer->customer_phone)->count() }}
                            </td>
                            <td>
                                {{ \App\Models\Reservation::where('customer_phone', $customer->customer_phone)
                                    ->latest('reservation_date')
                                    ->value('reservation_date') ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No Customers Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination links --}}
        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
