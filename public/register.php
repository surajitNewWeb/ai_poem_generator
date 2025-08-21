<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$username || !$email || !$password) $errors[] = 'All fields required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$username, $email, $hash]);
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
