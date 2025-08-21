<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

// Stats
$totalPoems = $pdo->query('SELECT COUNT(*) AS c FROM poems')->fetch()['c'];
$totalUsers = $pdo->query('SELECT COUNT(*) AS c FROM users')->fetch()['c'];
$recent = $pdo->query('SELECT * FROM poems ORDER BY created_at DESC LIMIT 8')->fetchAll();
?>

<section class="dashboard-container">
  <h2 class="section-title">📊 Admin Dashboard</h2>

  <!-- Stats Row -->
  <div class="stats-row">
    <div class="stat-card">
      <h3><?= $totalPoems ?></h3>
      <p>Poems</p>
    </div>
    <div class="stat-card">
      <h3><?= $totalUsers ?></h3>
      <p>Users</p>
    </div>
  </div>

  <!-- Recent Poems -->
  <h3 class="recent-title">📝 Recent Poems</h3>
  <div class="recent-grid">
    <?php foreach ($recent as $r): ?>
      <article class="recent-card">
        <h4><?= htmlspecialchars($r['theme']) ?></h4>
        <pre><?= htmlspecialchars(substr($r['content'],0,120)) ?><?= strlen($r['content'])>120?'...':'' ?></pre>
        <p class="time">⏰ <?= date("M j, Y g:i a", strtotime($r['created_at'])) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

<style>
:root {
  --bg: #0b0f17;
  --text: #e9eefb;
  --title: #ffffff;
  --muted: #a0accf;
  --accent: #ff7a45;
  --accent-2: #00e0ff;
  --radius: 14px;
  --shadow: 0 6px 18px rgba(0,0,0,0.35);
}

body {
  background: var(--bg);
  color: var(--text);
  font-family: "Segoe UI", sans-serif;
  margin: 0;
  padding: 0;
}

.dashboard-container {
  max-width: 1100px;
  margin: 2rem auto;
  padding: 0 1rem;
}

.section-title {
  font-size: 2rem;
  margin-bottom: 1.5rem;
  color: var(--title);
  text-align: center;
}

.stats-row {
  display: flex;
  gap: 1.5rem;
  justify-content: center;
  margin-bottom: 2.5rem;
}

.stat-card {
  flex: 1;
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  border-radius: var(--radius);
  padding: 1.8rem;
  text-align: center;
  box-shadow: var(--shadow);
  transition: transform 0.3s ease;
}
.stat-card:hover {
  transform: translateY(-6px);
}
.stat-card h3 {
  font-size: 2.2rem;
  margin: 0 0 .5rem;
}

.recent-title {
  margin-bottom: 1rem;
  color: var(--accent-2);
  font-size: 1.6rem;
}

.recent-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.5rem;
}

.recent-card {
  background: #141a29;
  padding: 1.2rem;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  transition: transform 0.25s ease;
}
.recent-card:hover {
  transform: translateY(-5px);
}
.recent-card h4 {
  margin: 0 0 .6rem;
  font-size: 1.2rem;
  color: var(--accent);
}
.recent-card pre {
  font-size: .9rem;
  color: var(--muted);
  white-space: pre-wrap;
  max-height: 110px;
  overflow: hidden;
  margin-bottom: .8rem;
}
.recent-card .time {
  font-size: .8rem;
  color: var(--accent-2);
}
</style>
