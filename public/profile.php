<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

$stmt2 = $pdo->prepare('SELECT * FROM poems WHERE user_id = ? ORDER BY created_at DESC');
$stmt2->execute([$userId]);
$poems = $stmt2->fetchAll();
?>
<section class="profile-container">
  <div class="profile-header card">
    <div class="avatar">
      <span><?= strtoupper(substr($user['username'],0,1)) ?></span>
    </div>
    <div class="user-info">
      <h2><?= htmlspecialchars($user['username']) ?></h2>
      <p class="email"><?= htmlspecialchars($user['email']) ?></p>
    </div>
  </div>

  <div class="poems-section">
    <h3>Your Poems</h3>
    <?php if ($poems): ?>
      <div class="grid poems-grid">
        <?php foreach ($poems as $p): ?>
          <article class="card poem-card">
            <h4><?= htmlspecialchars($p['theme']) ?></h4>
            <pre><?= htmlspecialchars(substr($p['content'],0,180)) ?><?= strlen($p['content'])>180?'...':'' ?></pre>
            <div class="row actions">
              <a class="btn-gradient small" href="poem.php?id=<?= $p['id'] ?>">Open</a>
              <a class="btn-gradient small ghost" href="export.php?id=<?= $p['id'] ?>">Download</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="empty">You haven’t created any poems yet. <a href="generate.php" class="btn small">Create your first</a></p>
    <?php endif; ?>
  </div>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
