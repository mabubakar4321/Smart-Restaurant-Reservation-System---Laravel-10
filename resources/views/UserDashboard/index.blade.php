<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
    }

    /* ===== Hero Section ===== */
    .hero {
      position: relative;
      height: 250px;
      background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 0 15px;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.55);
    }
    .hero h1 {
      position: relative;
      font-size: 2.5rem;
      font-weight: 700;
      color: #f8f9fa;
      animation: fadeDown 1s ease-in-out;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ===== Top Navigation Buttons ===== */
    .top-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      padding: 20px;
      flex-wrap: wrap;
    }

    .btn-nav {
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      transition: 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .btn-nav:hover {
      background: linear-gradient(90deg, #0072ff, #00c6ff);
      transform: scale(1.05);
    }

    .btn-profile {
      background: linear-gradient(90deg, #185a9d, #43cea2);
    }
    .btn-profile:hover {
      background: linear-gradient(90deg, #43cea2, #185a9d);
    }

    .btn-logout {
      background: linear-gradient(90deg, #ff7e5f, #feb47b);
    }
    .btn-logout:hover {
      background: linear-gradient(90deg, #feb47b, #ff7e5f);
    }

    /* ===== Messages ===== */
    .message {
      text-align: center;
      margin: 15px auto;
      padding: 12px;
      border-radius: 10px;
      font-weight: 500;
      max-width: 600px;
    }
    .success { background: rgba(46, 204, 113, 0.15); color: #2ecc71; }
    .error { background: rgba(231, 76, 60, 0.15); color: #e74c3c; }

    /* ===== Table Grid ===== */
    .table-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 25px;
      padding: 40px 20px;
    }

    .table-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 18px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.25);
      padding: 25px;
      text-align: center;
      transition: 0.4s ease;
      transform: translateY(0);
    }
    .table-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 15px 35px rgba(0,0,0,0.4);
    }

    .table-card h3 {
      font-weight: 600;
      color: #f8f9fa;
      margin-bottom: 12px;
    }

    .status {
      display: inline-block;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.85rem;
      margin-bottom: 12px;
      font-weight: 500;
    }
    .available { background: #2ecc71; color: white; }
    .reserved { background: #e74c3c; color: white; }

    /* ===== Form Styling ===== */
    form input, form button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 10px;
      border: none;
      font-size: 14px;
    }

    form input {
      background: rgba(255,255,255,0.15);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.2);
    }
    form input::placeholder { color: #ddd; }

    form button {
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
    }
    form button:hover {
      background: linear-gradient(90deg, #0072ff, #00c6ff);
      transform: scale(1.05);
    }

    .btn-disabled {
      background: #7f8c8d;
      color: white;
      padding: 10px;
      border-radius: 10px;
      cursor: not-allowed;
      width: 100%;
    }

    /* ===== Responsive Styles ===== */
    @media (max-width: 768px) {
      .hero {
        height: 180px;
      }
      .hero h1 {
        font-size: 1.8rem;
      }
      .top-actions {
        flex-direction: column;
        align-items: flex-end;
      }
      .btn-nav {
        width: 100%;
        text-align: center;
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .hero {
        height: 150px;
        padding: 0 10px;
      }
      .hero h1 {
        font-size: 1.5rem;
      }
      .table-card {
        padding: 18px;
      }
      form input, form button {
        font-size: 13px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>

  <!-- Top Actions (Home + Profile + Logout) -->
  <div class="top-actions">
    <a href="{{ route('user') }}" class="btn-nav">
      <i class="fas fa-home"></i> Home
    </a>

    <a href="{{ route('user.profile.edit') }}" class="btn-nav btn-profile">
      <i class="fas fa-user"></i> My Profile
    </a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn-nav btn-logout">
        <i class="fas fa-sign-out-alt"></i> Logout
      </button>
    </form>
  </div>

  <!-- Hero Section -->
  <div class="hero">
    <h1>🍽 Welcome to Your Dashboard</h1>
  </div>

  <!-- Messages -->
  @if(session('success'))
      <div class="message success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
      <div class="message error">{{ $errors->first() }}</div>
  @endif

  <!-- Table Grid -->
  <div class="table-grid">
      @foreach($tables as $table)
          <div class="table-card">
              <h3>Table #{{ $table->id }}</h3>
              <div class="status {{ strtolower($table->status) }}">
                  {{ ucfirst($table->status) }}
              </div>

              @if($table->status == 'available')
                  {{-- Reservation Form --}}
                  <form method="POST" action="{{ route('user.reservations.store') }}">
                      @csrf
                      <input type="hidden" name="table_id" value="{{ $table->id }}">
                      <input type="text" name="customer_name" placeholder="Your Name" required>
                      <input type="text" name="customer_phone" placeholder="Your Phone Number" required>
                      <input type="date" name="reservation_date" required>
                      <input type="time" name="reservation_time" required>
                      <input type="number" name="duration" placeholder="Duration (mins)" required>

                      <button type="submit">
                          <i class="fas fa-check-circle"></i> Reserve
                      </button>
                  </form>
              @else
                  @php
                      $userReservation = $reservations->where('table_id', $table->id)->first();
                  @endphp

                  @if($userReservation)
                      {{-- Cancel Button --}}
                      <form method="POST" action="{{ route('user.reservations.destroy', $userReservation->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" style="background: #e74c3c; color:white; padding:10px; border:none; border-radius:10px; cursor:pointer; width:100%;">
                              <i class="fas fa-times-circle"></i> Cancel Reservation
                          </button>
                      </form>
                  @else
                      {{-- Reserved by another user --}}
                      <button disabled class="btn-disabled">Reserved</button>
                  @endif
              @endif
          </div>
      @endforeach
  </div>

</body>
</html>
