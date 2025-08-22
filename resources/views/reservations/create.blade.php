@extends('AdminDashboard.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Create Reservation</h2>

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

    <form action="{{ route('reservations.store') }}" method="POST" class="card shadow-sm p-4 rounded-4">
        @csrf

        <div class="row g-3">
            {{-- Table Selection --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Table</label>
                <select name="table_id" class="form-select" required>
                    <option value="">Select available table</option>
                    @foreach($tables as $table)
                        <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                            {{ $table->name }} ({{ $table->capacity ?? '—' }} seats)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Customer Name --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Customer Name</label>
                <input name="customer_name" value="{{ old('customer_name') }}" class="form-control" placeholder="John Doe" required>
            </div>

            {{-- Customer Phone --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Customer Phone</label>
                <input name="customer_phone" value="{{ old('customer_phone') }}" class="form-control" placeholder="+1234567890" required>
            </div>

            {{-- Date --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Date</label>
                <input name="reservation_date" type="date" value="{{ old('reservation_date') }}" class="form-control" required>
            </div>

            {{-- Time --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Time</label>
                <input name="reservation_time" type="time" value="{{ old('reservation_time') }}" class="form-control" required>
            </div>

            {{-- Duration --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Duration (mins)</label>
                <input name="duration" type="number" value="{{ old('duration', 60) }}" min="15" class="form-control" required>
            </div>

            {{-- Status --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-12 text-end">
                <button class="btn btn-success px-4">Create Reservation</button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
