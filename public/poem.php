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
<div class="container">
  <section class="poem-card">
    <h1 class="poem-title"><?= htmlspecialchars($poem['theme']) ?></h1>

    <div class="poem-meta">
      <?= htmlspecialchars($poem['style_label']) ?> · 
      <?= htmlspecialchars($poem['length_label']) ?> · 
      <?= date("M j, Y", strtotime($poem['created_at'])) ?>
    </div>

    <?php if (!empty($poem['caption'])): ?>
      <p class="poem-caption">“<?= htmlspecialchars($poem['caption']) ?>”</p>
    <?php endif; ?>

    <pre class="poem-text"><?= htmlspecialchars($poem['content']) ?></pre>

    <div class="poem-actions">
      <button class="btn-gradient" onclick="copyPoem()">📋 Copy</button>
      <a class="btn-gradient" href="export.php?id=<?= $poem['id'] ?>">⬇ Download</a>
      <a class="btn-gradient ghost" href="explore.php">← Back</a>
    </div>
  </section>
</div>

<script>
function copyPoem() {
  const text = document.querySelector(".poem-text").innerText;
  navigator.clipboard.writeText(text).then(() => {
    alert("✅ Poem copied to clipboard!");
  });
}
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
<style>:root {
  --bg: #0b0f17;
  --text: #e9eefb;
  --title: #ffffff;
  --muted: #a0accf;
  --accent: #ff7a45;
  --accent-2: #00e0ff;
  --radius: 14px;
  --shadow: 0 6px 18px rgba(0,0,0,0.35);
}

/* Container */
.container {
  max-width: 800px;
  margin: 2rem auto;
  padding: 0 1rem;
}

/* Card */
.poem-card {
  background: #141a29;
  border-radius: var(--radius);
  padding: 2rem;
  box-shadow: var(--shadow);
  color: var(--text);
  text-align: center;
}

/* Title */
.poem-title {
  font-size: 2rem;
  color: var(--title);
  margin-bottom: 0.5rem;
}

/* Meta */
.poem-meta {
  font-size: 0.9rem;
  color: var(--muted);
  margin-bottom: 1rem;
}

/* Caption */
.poem-caption {
  font-style: italic;
  color: var(--accent-2);
  margin-bottom: 1.5rem;
}

/* Poem text */
.poem-text {
  white-space: pre-wrap;
  font-size: 1.1rem;
  line-height: 1.8;
  padding: 1.5rem;
  background: #1c2235;
  border-radius: var(--radius);
  text-align: left;
  margin-bottom: 2rem;
  color: var(--text);
}

/* Buttons */
.poem-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 1rem;
}

.btn-gradient {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  padding: 0.7rem 1.5rem;
  border-radius: var(--radius);
  text-decoration: none;
  font-weight: bold;
  box-shadow: var(--shadow);
  transition: 0.3s ease;
}

.btn-gradient:hover {
  opacity: 0.85;
}

.btn-gradient.ghost {
  background: transparent;
  border: 2px solid var(--accent-2);
  color: var(--accent-2);
}
</style>