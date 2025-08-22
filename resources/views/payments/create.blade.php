@extends('AdminDashboard.layout')

@section('content')
<div class="container">
    <h3>Add Payment</h3>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Reservation</label>
            <select name="reservation_id" class="form-control">
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">
                        {{ $reservation->customer_name }} - {{ $reservation->reservation_date }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number"  name="amount" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
            </select>
        </div>

        <input type="hidden" name="payment_method" value="Cash">

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
