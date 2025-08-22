@extends('AdminDashboard.layout')

@section('content')
<div class="container">
    <h2>Reports Dashboard</h2>

    <div class="mb-3">
        <p><strong>Total Reservations:</strong> {{ $totalReservations }}</p>
        <a href="{{ route('reports.export.reservations') }}" class="btn btn-primary">Download Reservations CSV</a>
    </div>

    <div class="mb-3">
        <p><strong>Total Revenue:</strong> {{ $totalRevenue }}</p>
        <a href="{{ route('reports.export.revenue') }}" class="btn btn-success">Download Revenue CSV</a>
    </div>

    <div class="mb-3">
        <p><strong>Customers with Reservations</strong></p>
        <a href="{{ route('reports.export.customers') }}" class="btn btn-info">Download Customers CSV</a>
    </div>

    <h3>Customer Reservation Details</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Reservation Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->customer_email ?? 'N/A' }}</td>
                <td>{{ $customer->customer_phone ?? 'N/A' }}</td>
                <td>{{ $customer->reservation_date }}</td>
                <td>{{ $customer->payment->amount ?? 0 }}</td>
                <td>{{ $customer->payment->status ?? 'Not Paid' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
