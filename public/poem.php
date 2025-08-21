<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    echo '<div class="card"><p>Invalid poem ID.</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM poems WHERE id = ?');
$stmt->execute([$id]);
$poem = $stmt->fetch();
if (!$poem) {
    echo '<div class="card"><p>Poem not found.</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
?>
<section class="card poem-view">
  <h2><?= htmlspecialchars($poem['theme']) ?></h2>
  <div class="meta">Style: <?= htmlspecialchars($poem['style_label']) ?> • Generated: <?= $poem['created_at'] ?></div>
  <pre class="poem-text"><?= htmlspecialchars($poem['content']) ?></pre>
  <div class="row actions">
    <a class="btn" href="export.php?id=<?= $poem['id'] ?>">Download TXT</a>
    <a class="btn ghost" href="explore.php">Back to Explore</a>
  </div>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
