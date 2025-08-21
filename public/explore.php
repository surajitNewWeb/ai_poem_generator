<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$q = trim($_GET['q'] ?? '');
$rows = [];

if ($q) {
    $stmt = $pdo->prepare("
        SELECT id, theme, content, caption, style_label, length_label, created_at 
        FROM poems 
        WHERE theme LIKE ? OR content LIKE ? 
        ORDER BY created_at DESC 
        LIMIT 200
    ");
    $stmt->execute(["%$q%", "%$q%"]);
    $rows = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("
        SELECT id, theme, content, caption, style_label, length_label, created_at 
        FROM poems 
        ORDER BY created_at DESC 
        LIMIT 100
    ");
    $rows = $stmt->fetchAll();
}
?>

<div class="container">
  <section class="card">
    <h2>Explore Poems</h2>
    <p class="muted">
      Browse poems by theme, style, or mood. Try searching for <em>love</em>, <em>moonlight</em>, or <em>friendship</em>.
    </p>

    <!-- Search Section -->
    <form method="get" class="searchbar">
      <input 
        type="text" 
        name="q" 
        placeholder="Search poems..." 
        value="<?= htmlspecialchars($q) ?>"
      >
      <button class="btn-gradient" type="submit">Search</button>
    </form>

    <!-- Results -->
    <?php if ($q): ?>
      <h3>Search results for “<?= htmlspecialchars($q) ?>”</h3>
      <?php if (count($rows) === 0): ?>
        <p class="muted">❌ No poems found. Try another keyword.</p>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Grid -->
    <div class="grid">
      <?php foreach ($rows as $r): ?>
        <article class="card small">
          <h3><?= htmlspecialchars(ucfirst($r['theme'])) ?></h3>
          <p class="time"><?= date("M j, Y", strtotime($r['created_at'])) ?></p>

          <pre><?= htmlspecialchars(substr($r['content'], 0, 200)) ?><?= strlen($r['content']) > 200 ? '...' : '' ?></pre>
          
          <?php if (!empty($r['caption'])): ?>
            <p class="caption"><?= htmlspecialchars($r['caption']) ?></p>
          <?php endif; ?>

          <small class="meta">
            <?= htmlspecialchars($r['style_label'] ?? '—') ?> · <?= htmlspecialchars($r['length_label'] ?? '—') ?>
          </small>

          <div class="actions">
            <a class="btn-gradient small" href="poem.php?id=<?= $r['id'] ?>">Open</a>
            <a class="btn-gradient small ghost" href="export.php?id=<?= $r['id'] ?>">Download</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
