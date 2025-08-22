<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Admin Dashboard</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Delete Icon -->
<i class="bi bi-trash" style="color:red; font-size:20px; cursor:pointer;"></i>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        /* Sidebar */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #ff5722, #e64a19);
            padding-top: 20px;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
        }
        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: #f1f1f1;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
            border-radius: 6px;
            margin: 4px 8px;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }
        /* Navbar */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-left: 240px;
            padding: 0.8rem 1.5rem;
        }
        /* Profile */
        .profile-box {
            display: flex;
            align-items: center;
            background: #f1f3f5;
            padding: 6px 14px;
            border-radius: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            transition: 0.3s;
        }
        .profile-box:hover {
            background: #e9ecef;
        }
        .profile-box img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            margin-right: 10px;
        }
        .profile-box span {
            font-weight: 500;
            font-size: 0.95rem;
            color: #495057;
        }
        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }
        /* Logout Button */
        .logout-btn {
            border: none;
            background: transparent;
            color: #dc3545;
            font-weight: 600;
            transition: 0.3s;
        }
        .logout-btn:hover {
            color: #ff0000;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center">🍽 Admin Panel</h4>
    <a href="{{ route('admin') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="{{ route('reservations.index') }}"><i class="fas fa-utensils me-2"></i> Reservations</a>
    <a href="{{ route('index') }}"><i class="fas fa-chair me-2"></i> Tables</a>
    <a href="{{ route('customers.index') }}"><i class="fas fa-users me-2"></i> Customers</a>
    <a href="{{ route('payments.index') }}"><i class="fas fa-credit-card me-2"></i> Payments</a>
    <a href="{{ route('reports.index') }}"><i class="fas fa-file-alt me-2"></i> Reports</a>
    <a href="{{ route('settings.users') }}"><i class="fas fa-cogs me-2"></i> Settings</a>
</div>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <h5 class="mb-0 fw-bold text-danger">Restaurant Table Reservation</h5>
        
        <div class="d-flex align-items-center gap-3">
            <div class="profile-box">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin Avatar">
                <span>Welcome, {{ Auth::user()->name }}</span>
            </div>
            
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <!-- Add CSRF token if Laravel -->
                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
