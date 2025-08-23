<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo "<div class='card'><p>Please log in to see your poems.</p></div>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM poems WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$poems = $stmt->fetchAll();
?>

<section class="card">
  <h2>My Poems</h2>

  <?php if (!$poems): ?>
    <p>You haven’t generated any poems yet.</p>
  <?php else: ?>
    <ul class="poem-list">
      <?php foreach ($poems as $p): ?>
        <li>
          <h3><a href="poem_view.php?id=<?= $p['id'] ?>">
            <?= htmlspecialchars($p['theme']) ?>
          </a></h3>
          <pre class="preview"><?= htmlspecialchars(substr($p['content'], 0, 120)) ?>...</pre>

          <?php if (!empty($p['caption'])): ?>
            <p class="caption-preview"><strong>Caption:</strong> <?= htmlspecialchars(substr($p['caption'], 0, 80)) ?>...</p>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
