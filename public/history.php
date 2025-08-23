<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';

// Handle search
$search = $_GET['q'] ?? '';
$userId = $_SESSION['user_id'] ?? null;

if ($userId) {
    $stmt = $pdo->prepare('SELECT * FROM poems WHERE user_id = ? AND (theme LIKE ? OR content LIKE ?) ORDER BY created_at DESC');
    $stmt->execute([$userId, "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->prepare('SELECT * FROM poems WHERE (theme LIKE ? OR content LIKE ?) ORDER BY created_at DESC LIMIT 100');
    $stmt->execute(["%$search%", "%$search%"]);
}
$rows = $stmt->fetchAll();
?>

<section class="poem-history">
  <div class="container">
    <h2 class="section-title">📜 Poem History</h2>

    <!-- Search bar -->
    <form method="get" class="search-bar">
      <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search poems...">
      <button type="submit" class="btn-gradient">Search</button>
    </form>

    <?php if (!$rows): ?>
      <p class="empty-msg">No poems found. Try writing or searching again!</p>
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

            <div class="actions">
              <a class="btn-gradient small" href="poem.php?id=<?= $r['id'] ?>">View</a>
              <a class="btn-gradient small ghost" href="export.php?id=<?= $r['id'] ?>">Download</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
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

/* Layout */
.poem-history {
  padding: 2rem 1rem;
  background: var(--bg);
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 1.5rem;
}

/* Title */
.section-title {
  font-size: 2rem;
  color: var(--title);
  margin-bottom: 1.5rem;
  font-weight: 700;
  text-align: center;
}

/* Search bar */
.search-bar {
  display: flex;
  justify-content: center;
  gap: 0.6rem;
  margin-bottom: 2rem;
}

.search-bar input {
  flex: 1;
  max-width: 400px;
  padding: 0.6rem 1rem;
  border: 2px solid var(--accent-2);
  border-radius: var(--radius);
  background: #1a2133;
  color: var(--text);
  font-size: 1rem;
}

.search-bar input:focus {
  outline: none;
  border-color: var(--accent);
}

/* Empty */
.empty-msg {
  color: var(--muted);
  text-align: center;
  padding: 2rem;
  font-size: 1rem;
}

/* Grid */
.grid.poems-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

/* Card */
.poem-card {
  background: #1a2133;
  border-radius: var(--radius);
  padding: 1.5rem;
  box-shadow: var(--shadow);
  color: var(--text);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.poem-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.45);
}

/* Header */
.poem-header {
  margin-bottom: 0.8rem;
}

.poem-title {
  font-size: 1.4rem;
  color: var(--title);
  margin-bottom: 0.2rem;
}

.poem-card .time {
  font-size: 0.85rem;
  color: var(--muted);
}

/* Excerpt */
.poem-excerpt {
  font-size: 1rem;
  color: var(--text);
  white-space: pre-wrap;
  margin: 0.8rem 0;
  flex-grow: 1;
  line-height: 1.5;
}

/* Caption */
.caption {
  font-size: 0.9rem;
  color: var(--accent-2);
  margin: 0.5rem 0;
}

.caption span {
  font-weight: bold;
  color: var(--accent);
}

/* Actions */
.actions {
  display: flex;
  gap: 0.8rem;
  margin-top: 1rem;
  justify-content: flex-end;
}

.btn-gradient {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  padding: 0.55rem 1.2rem;
  border-radius: var(--radius);
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  transition: opacity 0.25s ease, transform 0.2s;
}

.btn-gradient:hover {
  opacity: 0.9;
  transform: scale(1.05);
}

.btn-gradient.small {
  padding: 0.45rem 1rem;
  font-size: 0.8rem;
}

.btn-gradient.ghost {
  background: transparent;
  border: 2px solid var(--accent-2);
  color: var(--accent-2);
}

.btn-gradient.ghost:hover {
  background: var(--accent-2);
  color: #0b0f17;
}
</style>
