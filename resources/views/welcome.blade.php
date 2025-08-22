<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delicious Restaurant</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff8f0;
    }

    /* Transparent Glass Navbar */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      z-index: 1000;
      transition: all 0.3s ease;
    }
    .navbar.scrolled {
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .navbar-brand {
      font-weight: 700;
      color: #ff5722 !important;
      font-size: 1.5rem;
    }
    .nav-link {
      color: white !important;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    .scrolled .nav-link {
      color: #333 !important;
    }
    .nav-link:hover {
      color: #ff5722 !important;
    }
    .btn-login {
      border: 2px solid #ff5722;
      color: #ff5722;
      background: transparent;
      transition: 0.3s;
    }
    .btn-login:hover {
      background: #ff5722;
      color: white;
    }
    .btn-register {
      background: #ff5722;
      color: white;
      transition: 0.3s;
    }
    .btn-register:hover {
      background: #e64a19;
    }

    /* Hero Section */
    .hero {
      background: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5') center/cover no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      color: white;
      position: relative;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .hero h1 {
      font-size: 3.2rem;
      font-weight: 700;
    }
    .hero p {
      font-size: 1.2rem;
    }
    .btn-main {
      background: #ff5722;
      color: white;
      padding: 10px 25px;
      border-radius: 30px;
      transition: 0.3s;
    }
    .btn-main:hover {
      background: #e64a19;
    }

    /* Sections */
    .section-title {
      font-weight: 700;
      color: #333;
      margin-bottom: 20px;
    }
    .menu-card {
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      transition: 0.3s;
    }
    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .btn-logout {
  border: 2px solid #ff5722;
  background: #ff5722;
  color: white;
  transition: 0.3s;
  border-radius: 5px;
  padding: 5px 15px;
}

.btn-logout:hover {
  background: #e64a19;
  border-color: #e64a19;
  color: white;
}

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg py-3">
    <div class="container">
      <a class="navbar-brand" href="#">🍽 Grill & Gather</a>
      <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
           @auth
    <li class="nav-item">
      <a class="nav-link" href="#contact">Welcome , {{ Auth::user()->name }}</a>
    </li>
@endauth

          
        </ul>
        <div class="d-flex">
    @auth
        <!-- If user is logged in, show Logout button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    @else
        <!-- If user is NOT logged in, show Login/Register buttons -->
        <a href="{{ route('login') }}" class="btn btn-login me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
    @endauth
</div>

      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <div class="container text-center hero-content">
      <h1 class="animate__animated animate__fadeInDown">Welcome to Grill & Gather</h1>
      <p class="animate__animated animate__fadeInUp animate__delay-1s">Where taste meets perfection 🍕🍔🍝</p>
      <a href="#menu" class="btn-main animate__animated animate__zoomIn animate__delay-2s">Explore Menu</a>
    </div>
  </section>

  <!-- Menu Section -->
  <section class="py-5" id="menu">
    <div class="container text-center">
      <h2 class="section-title animate__animated animate__fadeInDown">Our Special Menu</h2>
      <div class="row g-4 mt-4">
        <div class="col-md-4 animate__animated animate__fadeInUp">
          <div class="card menu-card">
            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092" class="card-img-top" alt="Pizza">
            <div class="card-body">
              <h5 class="card-title">Italian Pizza</h5>
              <p class="card-text">Crispy crust, fresh toppings, and mouth-watering cheese.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
          <div class="card menu-card">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="card-img-top" alt="Burger">
            <div class="card-body">
              <h5 class="card-title">Juicy Burger</h5>
              <p class="card-text">Perfectly grilled patty with fresh veggies and sauces.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
          <div class="card menu-card">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="card-img-top" alt="Pasta">
            <div class="card-body">
              <h5 class="card-title">Creamy Pasta</h5>
              <p class="card-text">Rich, creamy sauce with perfectly cooked pasta.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-5 bg-light" id="about">
    <div class="container text-center">
      <h2 class="section-title animate__animated animate__fadeInDown">About Us</h2>
      <p class="animate__animated animate__fadeInUp">
        At Delicious Restaurant, we serve love on a plate. Our chefs use fresh, high-quality ingredients to create meals that will keep you coming back for more.
      </p>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="py-5" id="contact">
    <div class="container text-center">
      <h2 class="section-title animate__animated animate__fadeInDown">Contact Us</h2>
      <p class="animate__animated animate__fadeInUp">📍 123 Food Street, New York | 📞 (123) 456-7890</p>
      <a href="mailto:info@delicious.com" class="btn-main animate__animated animate__zoomIn">Email Us</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-3 bg-dark text-white text-center">
    <p class="mb-0">&copy; 2025 Delicious Restaurant. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Scroll Effect Script -->
  <script>
    window.addEventListener('scroll', function () {
      let navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>

</body>
</html>
