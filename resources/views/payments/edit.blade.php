@extends('AdminDashboard.layout')

@section('content')
<div class="container">
    <h3>Edit Payment</h3>
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Reservation</label>
            <select name="reservation_id" class="form-control">
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}" {{ $payment->reservation_id == $reservation->id ? 'selected' : '' }}>
                        {{ $reservation->customer_name }} - {{ $reservation->reservation_date }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ $payment->amount }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Paid" {{ $payment->status == 'Paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
