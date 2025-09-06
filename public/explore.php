<?php
require_once __DIR__ . '/../config/db.php';

require_once __DIR__ . '/partials/header.php';

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

<div class="poem-page">
  <section class="card">
    <h2>🌙 Explore Poems</h2>
    <p class="muted">
      Discover poems by theme, style, or mood. Try searching for 
      <em>dreams</em>, <em>stars</em>, or <em>friendship</em>.
    </p>

    <!-- Search -->
    <form method="get" class="searchbar">
      <input 
        type="text" 
        name="q" 
        placeholder="Search poems..." 
        value="<?= htmlspecialchars($q) ?>"
      >
      <button class="btn-accent" type="submit">🔍 Search</button>
    </form>

    <!-- Search Results -->
    <?php if ($q): ?>
      <h3>Search results for “<?= htmlspecialchars($q) ?>”</h3>
      <?php if (count($rows) === 0): ?>
        <p class="muted">❌ No poems found. Try another word.</p>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Poems Grid -->
    <div class="grid poems-grid" id="poemGrid">
      <?php foreach ($rows as $index => $r): ?>
        <article class="card small poem-card <?= $index >= 6 ? 'hidden' : '' ?>">
          <header class="poem-header">
            <h3><?= htmlspecialchars(ucfirst($r['theme'])) ?></h3>
            <p class="time"><?= date("M j, Y", strtotime($r['created_at'])) ?></p>
          </header>

          <pre><?= htmlspecialchars(substr($r['content'], 0, 200)) ?><?= strlen($r['content']) > 200 ? '...' : '' ?></pre>
          
          <?php if (!empty($r['caption'])): ?>
            <p class="caption">“<?= htmlspecialchars($r['caption']) ?>”</p>
          <?php endif; ?>

          <small class="meta">
            <?= htmlspecialchars($r['style_label'] ?? '—') ?> · <?= htmlspecialchars($r['length_label'] ?? '—') ?>
          </small>

          <div class="actions">
            <a class="btn-accent small" href="poem.php?id=<?= $r['id'] ?>">📖 Open</a>
            <a class="btn-outline small" href="export.php?id=<?= $r['id'] ?>">⬇️ Download</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (count($rows) > 6): ?>
      <div class="show-all-wrapper">
        <button class="btn-accent" id="showAllBtn">Show All Poems</button>
      </div>
    <?php endif; ?>
  </section>
</div>

<script>
  const showBtn = document.getElementById("showAllBtn");
  if (showBtn) {
    showBtn.addEventListener("click", () => {
      document.querySelectorAll(".poem-card.hidden").forEach(el => el.classList.remove("hidden"));
      showBtn.style.display = "none";
    });
  }
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>


<!-- Styles -->
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

.poem-page {
  background: var(--bg);
  padding: 2rem 1rem;
  min-height: 100vh;
  max-width: 1200px;
  margin: 0 auto;
}

.poem-page .card {
  background: #141a25;
  border-radius: var(--radius);
  padding: 1.5rem;
  box-shadow: var(--shadow);
  margin-bottom: 1.5rem;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.poem-page .card:hover {
  transform: translateY(-4px);
  box-shadow: 0 0 25px rgba(0,224,255,0.25);
}

.poem-page h2, 
.poem-page h3 {
  color: var(--title);
  margin-bottom: 0.6rem;
}

.poem-page .muted {
  color: var(--muted);
}

.poem-page .searchbar {
  display: flex;
  gap: 0.5rem;
  margin: 1rem 0;
}

.poem-page .searchbar input {
  flex: 1;
  padding: 0.7rem 1rem;
  border: 2px solid transparent;
  border-radius: var(--radius);
  background: #1a2130;
  color: var(--text);
  font-size: 1rem;
  transition: border 0.3s;
}

.poem-page .searchbar input:focus {
  border: 2px solid var(--accent-2);
  outline: none;
}

.poem-page .grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
}

.poem-page .poem-card pre {
  font-family: inherit;
  white-space: pre-wrap;
  line-height: 1.6;
  color: var(--text);
  margin: 0.5rem 0;
}

.poem-page .poem-card .time {
  font-size: 0.85rem;
  color: var(--muted);
  margin-bottom: 0.5rem;
}

.poem-page .caption {
  font-style: italic;
  color: var(--accent-2);
  margin: 0.5rem 0;
}

.poem-page .meta {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.85rem;
  color: var(--muted);
}

.poem-page .actions {
  display: flex;
  gap: 0.5rem;
  margin-top: 0.8rem;
}

/* 🔘 Button Styles */
.btn-accent {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  border: none;
  border-radius: var(--radius);
  padding: 0.6rem 1.2rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  transition: transform 0.2s, box-shadow 0.2s;
}

.btn-accent:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 18px var(--accent-2);
}

.btn-outline {
  border: 2px solid var(--accent-2);
  background: transparent;
  color: var(--accent-2);
  padding: 0.5rem 1rem;
  border-radius: var(--radius);
  font-size: 0.9rem;
  font-weight: bold;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-outline:hover {
  background: var(--accent-2);
  color: #0b0f17;
}

.btn-accent.small, .btn-outline.small {
  padding: 0.4rem 0.9rem;
  font-size: 0.85rem;
}

.hidden {
  display: none;
}

.show-all-wrapper {
  text-align: center;
  margin-top: 1.5rem;
}
</style>
