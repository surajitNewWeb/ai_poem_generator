
<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>

<div class="hero-section">
  <div class="hero-overlay">
    <div class="hero-content">
      <h1>Create beautiful poems with AI ✨</h1>
      <p class="hero-subtitle">Turn your ideas into verses in seconds</p>

      <!-- FORM -->
      <form action="generate.php" method="post" class="poem-form" autocomplete="off">
        <div class="form-row">
          <input name="theme" placeholder="Enter a theme (e.g., moonlight, love, ocean)" required>
          <select name="length">
            <option value="short">Short (4 lines)</option>
            <option value="medium" selected>Medium (8–12 lines)</option>
            <option value="long">Long (free verse)</option>
          </select>
          <select name="style">
            <option value="">— Choose Style —</option>
            <option value="romantic">Romantic</option>
            <option value="haiku">Haiku</option>
            <option value="modern">Modern</option>
            <option value="classic">Classic</option>
          </select>
        </div>

        <div class="form-actions">
          <button class="btn-gradientt" type="submit">✨ Generate Poem</button>
          <button class="btn-ghostt" type="button" onclick="fillSample()">🎨 Try Sample</button>
        </div>

      <div id="result" class="poem-result" style="display:none;">
      <h2>Generated Poem</h2>
      <pre id="poem"></pre>
      <h3>📌 Caption:</h3>
      <p id="caption"></p>
      <button id="newPoemBtn" class="btn-gradientt">Generate Another Poem</button>
      </div>

        <!-- Popular Tags -->
        <div class="popular-tags">
          <small>Popular themes:</small>
          <div class="tags">
            <button type="button" class="tag" onclick="pickTag('sunset over the sea')">🌅 sunset</button>
            <button type="button" class="tag" onclick="pickTag('first love')">💖 first love</button>
            <button type="button" class="tag" onclick="pickTag('monsoon rain')">🌧️ monsoon</button>
            <button type="button" class="tag" onclick="pickTag('lonely city')">🏙️ city</button>
            <button type="button" class="tag" onclick="pickTag('mountain breeze')">⛰️ mountain</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- RECENT CREATIONS -->
<div class="container">
  <?php
  require_once __DIR__ . '/../config/db.php';
  $stmt = $pdo->prepare("
      SELECT id, theme, content, style_label, length_label, created_at
      FROM poems
      ORDER BY created_at DESC
      LIMIT 3
  ");
  $stmt->execute();
  $poems = $stmt->fetchAll();
  ?>

  <section>
    <h2 class="section-title">Recent Creations 🌸</h2>
    <p class="section-subtitle">Fresh poems crafted by our community</p>

    <div class="poems-grid">
      <?php foreach ($poems as $poem): ?>
      <article class="poem-card">
        <header>
          <h4><?= htmlspecialchars(ucfirst($poem['theme'])) ?></h4>
          <small><?= date("M d, Y", strtotime($poem['created_at'])) ?></small>
        </header>

        <div class="poem-content">
          <pre><?= htmlspecialchars($poem['content']) ?></pre>
        </div>

        <footer>
          <div class="poem-meta">
            <?= htmlspecialchars($poem['style_label'] ?? '') ?> ·
            <?= htmlspecialchars($poem['length_label'] ?? '') ?>
          </div>
          <div class="poem-actions">
            <a class="btn" href="poem.php?id=<?= $poem['id'] ?>">Open</a>
            <a class="btn-ghost" href="export.php?id=<?= $poem['id'] ?>">Download</a>
          </div>
        </footer>
      </article>
      <?php endforeach; ?>
    </div>
  </section>
</div>


<!-- Scripts -->
<script>
  function fillSample() {
    document.querySelector('input[name="theme"]').value = 'sunset over the sea';
  }
  function pickTag(tag) {
    document.querySelector('input[name="theme"]').value = tag;
  }
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("poetryForm");
  const resultDiv = document.getElementById("result");
  const poemEl = document.getElementById("poem");
  const captionEl = document.getElementById("caption");
  const newPoemBtn = document.getElementById("newPoemBtn");

  async function generatePoem(theme, style) {
    try {
      const response = await fetch("public/generate.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ theme, style })
      });

      const data = await response.json();
      if (data.poem) {
        poemEl.textContent = data.poem;
        captionEl.textContent = data.caption;
        resultDiv.style.display = "block";
      } else {
        poemEl.textContent = "❌ No poem generated. Try again.";
      }
    } catch (err) {
      console.error("Error:", err);
      poemEl.textContent = "⚠️ Error generating poem.";
    }
  }

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const theme = document.getElementById("theme").value.trim();
    const style = document.getElementById("style").value;
    generatePoem(theme, style);
  });

  newPoemBtn.addEventListener("click", () => {
    const theme = document.getElementById("theme").value.trim();
    const style = document.getElementById("style").value;
    generatePoem(theme, style);
  });
});

</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>


<!-- Redesigned Styles -->
<style>
:root {
  --bg: #0b0f17;
  --text: #e9eefb;
  --title: #fff;
  --muted: #95a0b5;
  --accent: #ff7a45;
  --accent-2: #00e0ff;
  --radius: 18px;
  --shadow: 0 12px 35px rgba(0, 0, 0, 0.45);
  --transparent:#0b0f171d;
}


/* Hero Section */
.hero-section {
  background: url('assets/img/ai2.png') center/cover no-repeat;
  padding: 2rem 1rem;
  position: relative;
}
.hero-overlay {
  background: rgba(11, 15, 23, 0.7);
  padding: 3rem;
  border-radius: var(--radius);
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
  box-shadow: var(--shadow);
}
.hero-content h1 {
  font-size: 2.7rem;
  color: var(--title);
  margin-bottom: .5rem;
}
.hero-subtitle {
  color: var(--muted);
  margin-bottom: 2rem;
  font-size: 1.2rem;
}

/* Form */
.poem-form {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}
.form-row {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}
.form-row select option{
  background-color: #171f2fa5;
}
.poem-form input,
.poem-form select {
  flex: 1;
  padding: 0.9rem 1rem;
  border-radius: var(--radius);
  border: none;
  background: rgba(255,255,255,0.08);
  color: var(--text);
}
.form-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

/* Buttons */
.btn-gradientt {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  border: none;
  padding: 0.8rem 1.5rem;
  border-radius: 40px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: transform 0.3s, opacity 0.3s;
}
.btn-gradientt:hover {
  transform: translateY(-3px);
  opacity: 0.9;
}
.btn-ghostt {
  border: 1px solid var(--accent);
  background: transparent;
  color: var(--accent);
  border-radius: 40px;
  padding: 0.8rem 1.5rem;
  transition: 0.3s;
}
.btn-ghostt:hover {
  background: rgba(255,255,255,0.07);
}

/* Tags */
.popular-tags {
  margin-top: 1rem;
}
.tags {
  display: flex;
  flex-wrap: wrap;
  gap: .6rem;
  justify-content: center;
}
.tag {
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.1);
  padding: .4rem .9rem;
  border-radius: 20px;
  cursor: pointer;
  color: #e9eefb;
}
.tag:hover {
  border-color: var(--accent);
  color: var(--accent);
}

/* Container */
.container {
  max-width: 1200px;
  margin: 4rem auto;
  padding: 0 1rem;
}

/* Sections */
.section-title {
  font-size: 2rem;
  margin-bottom: .5rem;
  text-align: center;
  color: var(--title);
}
.section-subtitle {
  text-align: center;
  color: var(--muted);
  margin-bottom: 2rem;
}

/* Poems Grid */
.poems-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
  gap: 1.8rem;
}
.poem-card {
  background: rgba(19,24,38,0.9);
  border-radius: var(--radius);
  padding: 1.5rem;
  box-shadow: var(--shadow);
  transition: transform 0.3s, box-shadow 0.3s;
}
.poem-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 30px rgba(0,0,0,0.6), 0 0 15px var(--accent-2);
}
.poem-card header {
  display: flex;
  justify-content: space-between;
  margin-bottom: .8rem;
}
.poem-card h4 {
  color: var(--accent);
  margin: 0;
}
.poem-content {
  background: rgba(255,255,255,0.05);
  padding: 1rem;
  border-radius: var(--radius);
  margin-bottom: 1rem;
  max-height: 200px;
  overflow-y: auto;
}
.poem-content pre {
  white-space: pre-wrap;
  margin: 0;
  color: var(--text);
}
.poem-meta {
  color: var(--muted);
  font-size: .85rem;
  margin-bottom: 1rem;
}
.poem-actions {
  display: flex;
  gap: .6rem;
}
</style>
