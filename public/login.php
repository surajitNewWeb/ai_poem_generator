<?php
require_once __DIR__ . '/../config/db.php';

// Start session before any HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $u = $stmt->fetch();

    if ($u && password_verify($password, $u['password'])) {
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['username'] = $u['username'];
        header('Location: index.php');
        exit;
    } else {
        $err = 'Invalid credentials.';
    }
}
?>

<section class="auth-container">
  <div class="card auth">
    <h2>Welcome Back</h2>
    <p class="subtitle">Login to continue generating poetry with <strong>PoetAI</strong>.</p>

    <?php if ($err): ?>
      <div class="error-box">
        <p><?= htmlspecialchars($err) ?></p>
      </div>
    <?php endif; ?>

    <form method="post" class="auth-form">
      <input name="email" placeholder="Email" type="email" required>
      <input name="password" placeholder="Password" type="password" required>
      <button class="btn-gradient" type="submit">Login</button>
    </form>

    <p class="switch-auth">No account? <a href="register.php">Sign up</a></p>
  </div>
</section>

<style>
:root {
  --bg: #0b0f17;
  --text: #e9eefb;
  --title: #fff;
  --muted: #95a0b5;
  --accent: #ff7a45;
  --accent-2: #00e0ff;
  --radius: 18px;
  --shadow: 0 12px 35px rgba(0, 0, 0, 0.45);
  --transparent:#0b0f171d;
}

body {
  background: var(--bg);
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  color: var(--text);
}

.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
  padding: 2rem;
}

.card.auth {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(12px);
  border-radius: var(--radius);
  padding: 2.5rem;
  width: 100%;
  max-width: 420px;
  box-shadow: var(--shadow);
  text-align: center;
}

.card.auth h2 {
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
  color: var(--title);
}

.card.auth .subtitle {
  font-size: 0.95rem;
  color: var(--muted);
  margin-bottom: 1.8rem;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.auth-form input {
  padding: 0.9rem 1rem;
  border-radius: var(--radius);
  border: 1px solid rgba(255,255,255,0.15);
  background: var(--transparent);
  color: var(--text);
  font-size: 1rem;
  outline: none;
}

.auth-form input:focus {
  border-color: var(--accent);
}

.btn-gradient {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  border: none;
  color: white;
  padding: 0.9rem;
  border-radius: var(--radius);
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s ease;
}

.btn-gradient:hover {
  opacity: 0.9;
}

.error-box {
  background: rgba(255, 0, 0, 0.1);
  border-left: 3px solid #ff4d4f;
  color: #ff8080;
  padding: 0.7rem 1rem;
  border-radius: var(--radius);
  margin-bottom: 1.2rem;
  text-align: left;
}

.switch-auth {
  margin-top: 1.5rem;
  font-size: 0.95rem;
  color: var(--muted);
}

.switch-auth a {
  color: var(--accent-2);
  font-weight: 600;
  text-decoration: none;
}

.switch-auth a:hover {
  text-decoration: underline;
}
</style>
