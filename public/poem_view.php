<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='card'><p>Missing poem ID.</p></div>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM poems WHERE id = ?");
$stmt->execute([$id]);
$poem = $stmt->fetch();

if (!$poem) {
    echo "<div class='card'><p>Poem not found.</p></div>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
?>

<section class="card">
  <h2>Poem about “<?= htmlspecialchars($poem['theme']) ?>”</h2>
  <div class="poem-block">
    <pre><?= htmlspecialchars($poem['content']) ?></pre>
  </div>

  <?php if (!empty($poem['caption'])): ?>
  <h3>Caption</h3>
  <p id="captionText"><?= nl2br(htmlspecialchars($poem['caption'])) ?></p>
  <button class="btn" id="copyBtn" data-target="captionText">Copy Caption</button>
  <?php endif; ?>

  <div class="row actions">
    <a class="btn" href="export.php?id=<?= $poem['id'] ?>">Download TXT</a>
    <a class="btn ghost" href="history.php">Back to My Poems</a>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
