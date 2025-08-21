<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

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
        header('Location: profile.php');
        exit;
    } else $err = 'Invalid credentials.';
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

<?php require_once __DIR__ . '/partials/footer.php'; ?>
