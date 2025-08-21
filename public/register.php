<?php
require_once __DIR__ . '/../config/db.php';

// Start session before any HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$email || !$password) {
        $errors[] = 'All fields are required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, $hash]);

            // ✅ Show success and stop execution BEFORE including footer
            echo '<section class="card auth success">
                    <h2>Registration Successful 🎉</h2>
                    <p>You can now <a href="login.php" class="btn-gradient small">Login here</a>.</p>
                  </section>';
            require_once __DIR__ . '/partials/footer.php';
            exit;
        } catch (Exception $e) {
            $errors[] = 'Error: ' . $e->getMessage();
        }
    }
}

// Include header after logic
require_once __DIR__ . '/partials/header.php';
?>

<section class="auth-container">
  <div class="card auth">
    <h2>Create Your Account</h2>
    <p class="subtitle">Join <strong>PoetAI</strong> and start generating beautiful poetry in seconds.</p>

    <?php if ($errors): ?>
      <div class="error-box">
        <?php foreach ($errors as $err): ?>
          <p><?= htmlspecialchars($err) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" class="auth-form">
      <input name="username" placeholder="Username" required>
      <input name="email" placeholder="Email" type="email" required>
      <input name="password" placeholder="Password" type="password" required>
      <button class="btn-gradient" type="submit">Sign up</button>
    </form>

    <p class="switch-auth">Already have an account? <a href="login.php">Login</a></p>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

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
