@extends('AdminDashboard.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Reservation #{{ $reservation->id }}</h2>

    {{-- Error Messages --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            {{-- Table --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Table</label>
                <select name="table_id" class="form-select" required>
                    @foreach($tables as $table)
                        <option value="{{ $table->id }}" {{ $table->id == $reservation->table_id ? 'selected' : '' }}>
                            {{ $table->name }} ({{ $table->capacity ?? '—' }} seats)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Customer Name --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Customer Name</label>
                <input name="customer_name" value="{{ old('customer_name', $reservation->customer_name) }}" class="form-control" placeholder="John Doe" required>
            </div>

            {{-- Customer Phone --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Customer Phone</label>
                <input name="customer_phone" value="{{ old('customer_phone', $reservation->customer_phone) }}" class="form-control" placeholder="+1234567890" required>
            </div>

            {{-- Date --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Date</label>
                <input name="reservation_date" type="date" value="{{ old('reservation_date', $reservation->reservation_date) }}" class="form-control" required>
            </div>

            {{-- Time --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Time</label>
                <input name="reservation_time" type="time" value="{{ old('reservation_time', substr($reservation->reservation_time, 0, 5)) }}" class="form-control" required>
            </div>

            {{-- Duration --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Duration (mins)</label>
                <input name="duration" type="number" value="{{ old('duration', $reservation->duration) }}" min="15" class="form-control" required>
            </div>

            {{-- Status --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending" {{ old('status', $reservation->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ old('status', $reservation->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Done" {{ old('status', $reservation->status) == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-12 text-end">
                <button class="btn btn-success px-4">Update Reservation</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
