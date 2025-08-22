@extends('AdminDashboard.layout')

@section('content')
<style>
    .add-table-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 30px;
        transition: transform 0.3s ease;
    }
    .add-table-card:hover {
        transform: translateY(-3px);
    }
    .form-label {
        font-weight: 600;
        color: #333;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #ddd;
    }
    .form-control:focus {
        border-color: #ff7e5f;
        box-shadow: 0 0 0 0.2rem rgba(255,126,95,0.25);
    }
    .btn-custom {
        background: linear-gradient(90deg, #ff7e5f, #feb47b);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background: linear-gradient(90deg, #feb47b, #ff7e5f);
        transform: translateY(-2px);
    }
    .btn-cancel {
        background-color: #6c757d;
        border-radius: 8px;
        padding: 10px 20px;
        color: #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-cancel:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }
</style>

<div class="container mt-5">
    <div class="add-table-card">
        <h2 class="mb-4 text-center" style="color: #ff7e5f;">Add New Table</h2>
        <form action="{{ route('tables.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Table Name</label>
                <input type="text" name="name" class="form-control"  required>
            </div>
            <div class="mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" name="capacity" class="form-control" min="1" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-custom">💾 Save</button>
                <a href="{{ route('index') }}" class="btn btn-cancel">✖ Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
