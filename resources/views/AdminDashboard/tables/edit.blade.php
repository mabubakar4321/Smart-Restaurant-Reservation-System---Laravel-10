@extends('AdminDashboard.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Table</h2>
    <form action="{{ route('tables.update', $table->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Table Name</label>
            <input type="text" name="name" class="form-control" value="{{ $table->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $table->capacity }}" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $table->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="reserved" {{ $table->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                <option value="occupied" {{ $table->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
