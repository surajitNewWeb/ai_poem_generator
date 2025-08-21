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
      <button class="btn-accent" type="submit">Search</button>
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
        <article class="card small poem-card <?= $index >= 4 ? 'hidden' : '' ?>">
          <h3><?= htmlspecialchars(ucfirst($r['theme'])) ?></h3>
          <p class="time"><?= date("M j, Y", strtotime($r['created_at'])) ?></p>

          <pre><?= htmlspecialchars(substr($r['content'], 0, 200)) ?><?= strlen($r['content']) > 200 ? '...' : '' ?></pre>
          
          <?php if (!empty($r['caption'])): ?>
            <p class="caption">“<?= htmlspecialchars($r['caption']) ?>”</p>
          <?php endif; ?>

          <small class="meta">
            <?= htmlspecialchars($r['style_label'] ?? '—') ?> · <?= htmlspecialchars($r['length_label'] ?? '—') ?>
          </small>

          <div class="actions">
            <a class="btn-accent small" href="poem.php?id=<?= $r['id'] ?>">Open</a>
            <a class="btn-outline small" href="export.php?id=<?= $r['id'] ?>">Download</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (count($rows) > 4): ?>
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
<style>
  /* Container */
.container {
  max-width: 1100px;
  margin: 2rem auto;
  padding: 0 1rem;
}

/* Section Card */
.card {
  background: #141a29;
  border-radius: var(--radius);
  padding: 2rem;
  margin-bottom: 2rem;
  box-shadow: var(--shadow);
  color: var(--text);
}

.card h2 {
  color: var(--title);
  font-size: 1.6rem;
  margin-bottom: 0.5rem;
}

.card p.muted {
  color: var(--muted);
  font-size: 0.95rem;
}

/* Searchbar */
.searchbar {
  display: flex;
  gap: 0.8rem;
  margin: 1.5rem 0;
  flex-wrap: wrap;
}

.searchbar input {
  flex: 1;
  padding: 0.8rem 1rem;
  border-radius: var(--radius);
  border: none;
  outline: none;
  font-size: 1rem;
  background: #1c2235;
  color: var(--text);
}

.searchbar input::placeholder {
  color: var(--muted);
}

.searchbar button {
  padding: 0.8rem 1.5rem;
  border-radius: var(--radius);
  border: none;
  font-weight: bold;
  cursor: pointer;
}

/* Grid Layout */
.grid.poems-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.5rem;
  margin-top: 1.5rem;
}

/* Individual Poem Card */
.poem-card {
  background: #1a2133;
  border-radius: var(--radius);
  padding: 1.2rem;
  color: var(--text);
  box-shadow: var(--shadow);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.poem-card h3 {
  font-size: 1.2rem;
  color: var(--title);
  margin-bottom: 0.3rem;
}

.poem-card pre {
  font-size: 0.95rem;
  color: var(--text);
  white-space: pre-wrap;
  margin: 0.8rem 0;
  flex-grow: 1;
}

.poem-card .time {
  font-size: 0.8rem;
  color: var(--muted);
}

.poem-card .caption {
  font-style: italic;
  color: var(--accent-2);
  margin: 0.5rem 0;
}

.poem-card .meta {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.8rem;
  color: var(--muted);
}

/* Actions inside cards */
.poem-card .actions {
  display: flex;
  gap: 0.6rem;
  margin-top: 1rem;
}

/* Buttons */
.btn-accent {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: var(--radius);
  font-weight: bold;
  text-decoration: none;
  transition: 0.3s ease;
  cursor: pointer;
}

.btn-accent.small {
  padding: 0.4rem 0.9rem;
  font-size: 0.85rem;
}

.btn-accent:hover {
  opacity: 0.9;
}

.btn-outline {
  border: 2px solid var(--accent-2);
  background: transparent;
  color: var(--accent-2);
  padding: 0.4rem 0.9rem;
  border-radius: var(--radius);
  font-size: 0.85rem;
  font-weight: bold;
  text-decoration: none;
  cursor: pointer;
}

.btn-outline:hover {
  background: var(--accent-2);
  color: #0b0f17;
}

/* Show all button */
.show-all-wrapper {
  text-align: center;
  margin-top: 1.5rem;
}

.hidden {
  display: none;
}

</style>