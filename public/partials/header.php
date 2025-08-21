<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>AI Poem Studio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

  <style>
    :root {
      --bg: #0b0f17;
      --panel: #131826;
      --panel-2: #0f1422;
      --muted: #95a0b5;
      --text: #e9eefb;
      --title: #ffffff;
      --accent: #ff7a45;
      --accent-2: #00e0ff;
      --border: rgba(255, 255, 255, .08);
      --radius: 16px;
      --shadow: 0 12px 40px rgba(0, 0, 0, .45);
    }

    /* Nav */
    .nav {
      position: sticky;
      top: 0;
      z-index: 50;
      backdrop-filter: blur(8px);
      background: linear-gradient(to bottom, rgba(10, 12, 20, .75), rgba(10, 12, 20, .35));
      border-bottom: 1px solid var(--border);
    }
    .nav-inner {
      max-width: 1200px;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 24px;
    }

    /* Left - Brand */
    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      letter-spacing: .3px;
      text-decoration: none;
      color: var(--title);
    }
    .brand .logo {
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: radial-gradient(circle at 30% 30%, #ffb17c, #ff7a45 45%, #c13b22 70%);
      box-shadow: 0 0 24px rgba(255, 122, 69, .45);
    }

    /* Middle - Nav Links */
    .nav-center {
      flex: 1;
      display: flex;
      justify-content: center;
    }
    .nav-links {
      display: flex;
      gap: 26px;
    }
    .nav-links a {
      color: #cfd7ea;
      text-decoration: none;
      font-weight: 500;
      font-size: .95rem;
      transition: color .2s ease;
    }
    .nav-links a:hover {
      color: #fff;
    }

    /* Right - Auth Buttons */
    .nav-auth {
      display: flex;
      gap: 14px;
      align-items: center;
    }
    .btn-nav {
      padding: 8px 17px;
      border-radius: 999px;
      border: 1px solid var(--border);
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      background: linear-gradient(135deg, var(--accent), var(--accent));
  color: #fff;
      box-shadow: 0 10px 26px rgba(255, 122, 69, .35);
      transition: transform .15s ease, filter .2s ease;
    }
    .btn-nav:hover {
      transform: translateY(-2px);
      filter: saturate(1.1);
    }
.btn-sign{
   padding: 8px 17px;
      border-radius: 999px;
      border: 1px solid var(--accent-2);
      background: transparent;
      color: var(--accent-2);
      text-decoration: none;
}
.btn-sign:hover{
    transform: translateY(-2px);
      filter: saturate(1.1);
      background: var(--accent-2);
      color: rgb(255, 255, 255);
}
    /* Mobile */
    .menu-toggle {
      display: none;
      font-size: 1.5rem;
      color: var(--text);
      cursor: pointer;
    }
    @media (max-width: 900px) {
      .nav-center {
        display: none;
      }
      .menu-toggle {
        display: block;
      }
    }
  </style>
</head>
<body style="background: var(--bg); color: var(--text);">

<header class="nav">
  <div class="nav-inner">
    
    <!-- Left: Brand -->
    <a href="index.php" class="brand">
      <div class="logo"></div>
      Poet<span style="color:var(--accent-2)">AI</span>
    </a>

    <!-- Middle: Nav Links -->
    <div class="nav-center">
      <nav class="nav-links" id="navMenu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="service.php">Service</a>
        <a href="generate.php">Generate</a>
        <a href="explore.php">Explore</a>
        <a href="history.php">History</a>
      
      </nav>
    </div>

    <!-- Right: Auth -->
    <div class="nav-auth">
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="profile.php"class="btn-sign">Profile</a>
        <a href="logout.php" class="btn-nav">Logout</a>
      <?php else: ?>
        <a href="register.php" class="btn-sign">Sign Up</a>
        <a href="login.php" class="btn-nav">Login</a>
        
      <?php endif; ?>
      <i class="fa-solid fa-bars menu-toggle" id="menuToggle"></i>
    </div>

  </div>
</header>

<script>
  const toggle = document.getElementById("menuToggle");
  const navMenu = document.getElementById("navMenu");

  toggle.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });
</script>
