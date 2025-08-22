<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Delicious Restaurant</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ff5722, #ff8a50);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 50px;   /* Space above */
      padding-bottom: 50px; /* Space below */
    }
    .register-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 25px rgba(0,0,0,0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }
    .register-card h3 {
      font-weight: 700;
      color: #ff5722;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-register {
      background: #ff5722;
      color: white;
      border-radius: 10px;
      padding: 10px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-register:hover {
      background: #e64a19;
    }
  </style>
</head>
<body>

  <div class="register-card">
    <h3>Create Account</h3>
    <form method="post" action="{{ route('dataregister') }}">
        @csrf
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter password" name="password" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
      </div>
      <button type="submit" class="btn btn-register w-100">Register</button>
    </form>
    <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}" style="color:#ff5722;">Login</a></p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
