<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luxury Restaurant</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #fff;
      color: #333;
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 100vh;
      background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.6);
    }
    .hero-content {
      position: relative;
      text-align: center;
      z-index: 1;
      animation: fadeUp 1.2s ease;
    }
    .hero-content h1 {
      font-size: 3.5rem;
      margin-bottom: 15px;
      font-weight: 700;
    }
    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 25px;
    }
    .btn-primary {
      padding: 12px 30px;
      border-radius: 8px;
      background: linear-gradient(90deg, #ff512f, #dd2476);
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      transition: transform 0.3s;
      display: inline-block;
    }
    .btn-primary:hover {
      transform: scale(1.05);
    }

    /* My Profile Button */
    .btn-profile {
      padding: 12px 30px;
      border-radius: 8px;
      background: linear-gradient(90deg, #1e3c72, #2a5298);
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      margin-left: 15px;
      transition: transform 0.3s;
      display: inline-block;
    }
    .btn-profile:hover {
      transform: scale(1.05);
    }

    /* Section Base */
    section {
      padding: 80px 20px;
      text-align: center;
    }
    section h2 {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }
    section p {
      max-width: 700px;
      margin: auto;
      font-size: 1.1rem;
      line-height: 1.6;
      color: #555;
    }

    /* About */
    .about {
      background: #f8f8f8;
    }

    /* Menu Section */
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 40px;
    }
    .menu-item {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      padding: 20px;
      transition: transform 0.3s;
    }
    .menu-item:hover {
      transform: translateY(-8px);
    }
    .menu-item img {
      width: 100%;
      border-radius: 10px;
      height: 180px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    /* Testimonials */
    .testimonials {
      background: #333;
      color: white;
    }
    .testimonial-box {
      max-width: 600px;
      margin: auto;
      font-style: italic;
      font-size: 1.2rem;
      animation: fadeUp 1.5s ease;
    }

    /* Contact */
    .contact {
      background: #f0f0f0;
    }

    /* Logout Button */
    .logout-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #ff3d3d;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      z-index: 1000;
      transition: background 0.3s;
    }
    .logout-btn:hover {
      background: darkred;
    }

    /* Animations */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .hero-content h1 { font-size: 2.2rem; }
      section h2 { font-size: 2rem; }
    }
  </style>
</head>
<body>

  <!-- Logout -->
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
  </form>
  
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Fine Dining Redefined</h1>
      <p>Luxury flavors, elegant ambiance & unforgettable experiences</p>
      <a href="{{ route('user.dashboard') }}" class="btn-primary">Book Your Table</a>
      <a href="{{ route('user.profile.edit') }}" class="btn-profile">
        <i class="fa fa-user"></i> My Profile
      </a>  
    </div>
  </section>

  <!-- About -->
  <section class="about">
    <h2>About Us</h2>
    <p>Our restaurant blends modern elegance with timeless tradition. With master chefs and premium ingredients, we bring flavors that tell a story of passion and perfection.</p>
  </section>

  <!-- Menu -->
  <section>
    <h2>Our Signature Dishes</h2>
    <div class="menu">
      <div class="menu-item">
        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092" alt="Dish">
        <h3>Steak Excellence</h3>
        <p>Grilled to perfection with rich seasoning and gourmet sides.</p>
      </div>
      <div class="menu-item">
        <img src="https://images.unsplash.com/photo-1529042410759-befb1204b468" alt="Dish">
        <h3>Seafood Platter</h3>
        <p>A luxurious selection of the ocean’s freshest treasures.</p>
      </div>
      <div class="menu-item">
        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092" alt="Dish">
        <h3>Exotic Desserts</h3>
        <p>Sweet indulgence crafted with love and artistic flair.</p>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials">
    <h2>What Our Guests Say</h2>
    <div class="testimonial-box">
      “Absolutely the best dining experience I've ever had. Every dish is a masterpiece, and the ambiance makes it unforgettable.”
      <br>– Sarah A.
    </div>
  </section>

  <!-- Contact -->
  <section class="contact">
    <h2>Contact Us</h2>
    <p>📍 123 Food Street, Faisalabad</p>
    <p>📞 0326-0228648</p>
    <p>📧 info@restaurant.com</p>
  </section>

</body>
</html>
