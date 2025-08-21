<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start(); // start output buffering
?>
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>AI Poem Studio</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    /* Header */
    .site-header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: linear-gradient(145deg, #0097ffc4, #0f172a);
      color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.25);
    }
    .header-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0.8rem 1rem;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      gap: 1rem;
    }

    /* Branding */
    .brand a {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1.4rem;
      font-weight: 700;
      text-decoration: none;
    }
    .brand .logo {
      height: 38px;
      width: 38px;
      border-radius: 50%;
      background: #fff;
      object-fit: cover;
      padding: 3px;
    }
    .brand a h2 {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: .5rem;
  color: #fff;
}
.brand a h2 span {
  color: #38bdf8; /* sky-blue highlight */
}

    /* Navigation Center */
    .nav-center {
      display: flex;
      justify-content: center;
      gap: 1.2rem;
    }
    .nav-center a {
      color: #f3f4f6;
      text-decoration: none;
      font-weight: 500;
      padding: 0.5rem 0.9rem;
      border-radius: 6px;
      transition: background 0.25s ease, color 0.25s ease;
    }
    .nav-center a:hover {
      background: rgba(250, 204, 21, 0.15);
      color: #facc15;
    }

    /* Auth Buttons Right */
    .auth-links {
      display: flex;
      justify-content: flex-end;
      gap: 0.8rem;
    }
    .auth-links a {
      padding: 0.45rem 0.9rem;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.25s ease;
    }
    .auth-links a:first-child {
      background: transparent;
      color: #f3f4f6;
      border: 1px solid #475569;
    }
    .auth-links a:first-child:hover {
      background: #475569;
      color: #fff;
    }
    .auth-links a:last-child {
      background: transparent;
      color: #ffffffff;
    border: 1px solid #475569;
    }
    .auth-links a:last-child:hover {
      background: #088fe9ff;
    }

    /* Mobile Menu */
    .menu-toggle {
      display: none;
      font-size: 1.6rem;
      cursor: pointer;
      color: #ffffffff;
    }
    @media (max-width: 900px) {
      .header-inner {
        grid-template-columns: 1fr auto;
      }
      .nav-center, .auth-links {
        display: none;
        flex-direction: column;
        background: #0f172a;
        position: absolute;
        top: 100%;
        right: 0;
        width: 220px;
        padding: 1rem;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.35);
      }
      .nav-center a, .auth-links a {
        display: block;
        margin: 0.4rem 0;
      }
      .nav-center.active, .auth-links.active {
        display: flex;
      }
      .menu-toggle {
        display: block;
      }
    }
  </style>
</head>
<body>
<header class="site-header">
  <div class="header-inner">
    <!-- Left: Logo -->
    <div class="brand">
      <a href="index.php">
        <img src="assets/img/logo.png" alt="logo" class="logo" onerror="this.style.display='none'">
         <h2>Poet<span>AI</span></h2>
      </a>
    </div>

    <!-- Middle: Navigation -->
    <nav class="nav-center" id="navMenu">
      <a href="index.php">Home</a>
      <a href="generate.php">Generate</a>
      <a href="explore.php">Explore</a>
      <a href="history.php">History</a>
      <a href="about.php">About</a>
    </nav>

    <!-- Right: Auth Links -->
    <div class="auth-links" id="authMenu">
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Sign up</a>
      <?php endif; ?>
    </div>

    <!-- Mobile Toggle -->
    <i class="fa-solid fa-bars menu-toggle" id="menuToggle"></i>
  </div>
</header>

<script>
  const toggle = document.getElementById("menuToggle");
  const navMenu = document.getElementById("navMenu");
  const authMenu = document.getElementById("authMenu");

  toggle.addEventListener("click", () => {
    navMenu.classList.toggle("active");
    authMenu.classList.toggle("active");
  });
</script>
