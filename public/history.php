<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$userId = $_SESSION['user_id'] ?? null;
if ($userId) {
    $stmt = $pdo->prepare('SELECT * FROM poems WHERE user_id = ? ORDER BY created_at DESC');
    $stmt->execute([$userId]);
} else {
    $stmt = $pdo->query('SELECT * FROM poems ORDER BY created_at DESC LIMIT 100');
}
$rows = $stmt->fetchAll();
?>
<section class="card container">
  <h2 class="section-title">📜 Poem History</h2>

  <?php if (!$rows): ?>
    <p class="empty-msg">No poems yet. Start creating your first masterpiece!</p>
  <?php else: ?>
    <div class="grid poems-grid">
      <?php foreach ($rows as $r): ?>
        <article class="card poem-card">
          <header class="poem-header">
            <h3 class="poem-title"><?= htmlspecialchars($r['theme']) ?></h3>
            <p class="time"><?= date("F j, Y, g:i a", strtotime($r['created_at'])) ?></p>
          </header>

          <pre class="poem-excerpt"><?= htmlspecialchars(substr($r['content'],0,200)) ?><?= strlen($r['content'])>200?'...':'' ?></pre>

          <?php if (!empty($r['caption'])): ?>
            <p class="caption"><span>💡 Caption:</span> <?= htmlspecialchars($r['caption']) ?></p>
          <?php endif; ?>

            <div class="row actions">
            <a class="btn-gradient small" href="poem.php?id=<?= $r['id'] ?>">View</a>
            <a class="btn-gradient small ghost" href="export.php?id=<?= $r['id'] ?>">Download</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
