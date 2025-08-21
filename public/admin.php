<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

$totalPoems = $pdo->query('SELECT COUNT(*) AS c FROM poems')->fetch()['c'];
$totalUsers = $pdo->query('SELECT COUNT(*) AS c FROM users')->fetch()['c'];
$recent = $pdo->query('SELECT * FROM poems ORDER BY created_at DESC LIMIT 8')->fetchAll();
?>
<section class="card">
  <h2>Admin Dashboard</h2>
  <div class="row stats">
    <div class="stat card small"><h3><?= $totalPoems ?></h3><p>Poems</p></div>
    <div class="stat card small"><h3><?= $totalUsers ?></h3><p>Users</p></div>
  </div>
  <h3>Recent Poems</h3>
  <div class="grid">
    <?php foreach ($recent as $r): ?>
      <article class="card small">
        <h4><?= htmlspecialchars($r['theme']) ?></h4>
        <pre><?= htmlspecialchars(substr($r['content'],0,150)) ?></pre>
        <p class="time"><?= $r['created_at'] ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
