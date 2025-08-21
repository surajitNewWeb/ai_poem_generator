<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/gemini.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<div class="card"><p>Invalid request. Please use the poem form.</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$theme  = trim($_POST['theme'] ?? '');
$style  = $_POST['style'] ?? 'classic';
$length = $_POST['length'] ?? 'medium';

if (!$theme) {
    echo '<div class="card"><p>Please enter a theme.</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

// ---- Prompt ----
$prompt = "Write a {$length} poem about '{$theme}' in a {$style} style. 
Return ONLY valid JSON in the following format:

{
  \"poem\": \"(the poem, multiline)\",
  \"caption\": \"(short catchy caption with hashtags)\"
}";

try {
    $response = gemini_generate($prompt);

    if (preg_match('/\{.*\}/s', $response, $matches)) {
        $response = $matches[0];
    }

    $data = json_decode($response, true);

    if (json_last_error() === JSON_ERROR_NONE && isset($data['poem'], $data['caption'])) {
        $poem = $data['poem'];
        $caption = $data['caption'];
    } else {
        $poem = $response;
        $caption = "⚠️ Caption not found (AI did not return JSON).";
    }
} catch (Exception $e) {
    echo '<div class="card"><p>Error: ' . htmlspecialchars($e->getMessage()) . '</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

// ---- Save to DB ----
try {
    $stmt = $pdo->prepare(
        'INSERT INTO poems (user_id, theme, prompt, content, style_label, length_label, caption) 
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $userId = $_SESSION['user_id'] ?? null;
    $stmt->execute([$userId, $theme, $prompt, $poem, $style, $length, $caption]);
    $poemId = $pdo->lastInsertId();
} catch (Exception $e) {
    echo '<div class="card"><p>Error saving: ' . htmlspecialchars($e->getMessage()) . '</p></div>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
?>
<div class="container">

  <!-- Result Card -->
  <div class="result-card">

    <!-- Header -->
    <header class="result-header">
      <h2>✨ Poem on <span class="accent">“<?= htmlspecialchars($theme) ?>”</span></h2>
    </header>

    <!-- Poem Content -->
    <div class="poem-box">
      <pre><?= htmlspecialchars($poem) ?></pre>
    </div>

    <!-- Caption Section -->
    <div class="caption-box">
      <h3>📌 Caption</h3>
      <p id="captionText"><?= htmlspecialchars(trim($caption)) ?></p>
    </div>

    <!-- Actions -->
    <div class="actions">
      <a class="btn small" href="poem_view.php?id=<?= $poemId ?>">View Full</a>
      <a class="btn small outline" href="poem_history.php">My Poems</a>
      <button class="btn small" id="copyBtn" data-target="captionText">Copy Caption</button>
    </div>

  </div>

  <!-- 🎭 Related Poems -->
  <section class="extra-section">
    <h3>🎭 Related Inspirations</h3>
    <div class="related">
      <div class="mini-card">🌌 Night Sky</div>
      <div class="mini-card">🌹 Love & Passion</div>
      <div class="mini-card">🌊 Ocean Dreams</div>
      <div class="mini-card">🔥 Courage & Hope</div>
    </div>
  </section>

  <!-- ✨ Writing Tips -->
  <section class="extra-section">
    <h3>🖊️ Quick Writing Tips</h3>
    <ul class="tips">
      <li>Keep your imagery vivid 🎨</li>
      <li>Use emotions to connect ❤️</li>
      <li>Experiment with rhythm 🎶</li>
      <li>End with a powerful thought 💡</li>
    </ul>
  </section>

  <!-- 📤 Share Section -->
  <section class="extra-section share-box">
    <h3>📤 Share Your Poem</h3>
    <p>Spread your words with friends and the world.</p>
    <div class="actions">
      <button class="btn small">Share on Twitter</button>
      <button class="btn small">Share on Instagram</button>
      <button class="btn small outline">Copy Link</button>
    </div>
  </section>

</div>

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

body {
  background: var(--bg);
  font-family: "Poppins", sans-serif;
  color: var(--text);
  margin: 0;
}

.container {
  max-width: 820px;
  margin: 3rem auto;
  padding: 0 1.2rem;
}

/* Card */
.result-card {
  background: #131a27;
  border-radius: var(--radius);
  padding: 2rem;
  box-shadow: var(--shadow);
  animation: fadeIn 0.6s ease;
}

.result-header {
  text-align: center;
  margin-bottom: 1.8rem;
}

.result-header h2 {
  font-size: 2rem;
  font-weight: 700;
  color: var(--title);
}

.result-header .accent {
  color: var(--accent);
}

/* Poem Box */
.poem-box {
  background: #1a2233;
  border-radius: var(--radius);
  padding: 1.6rem;
  margin-bottom: 1.6rem;
  font-size: 1.05rem;
  line-height: 1.75;
  white-space: pre-wrap;
}

/* Caption */
.caption-box {
  background: #1a2233;
  padding: 1.4rem;
  border-radius: var(--radius);
  margin-bottom: 2rem;
}

.caption-box h3 {
  margin: 0 0 0.6rem;
  color: var(--accent-2);
  font-size: 1.1rem;
}

.caption-box p {
  margin: 0;
  color: var(--muted);
}

/* Buttons */
.actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn {
  padding: 0.7rem 1.4rem;
  font-size: 0.95rem;
  border-radius: var(--radius);
  border: none;
  cursor: pointer;
  transition: all 0.25s ease;
  font-weight: 600;
}

.btn.small { font-size: 0.9rem; }

.btn {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  box-shadow: 0 3px 10px rgba(0,224,255,0.25);
}

.btn:hover {
  opacity: 0.9;
  transform: translateY(-2px);
}

.btn.outline {
  background: transparent;
  border: 2px solid var(--accent);
  color: var(--accent);
  box-shadow: none;
}

.btn.outline:hover {
  background: rgba(255,122,69,0.12);
  color: #fff;
}

/* Extra Sections */
.extra-section {
  margin-top: 2.5rem;
  padding: 1.5rem;
  background: #131a27;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
}

.extra-section h3 {
  margin-bottom: 1rem;
  color: var(--accent-2);
}

.related {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.mini-card {
  background: #1a2233;
  padding: 0.8rem 1.2rem;
  border-radius: var(--radius);
  flex: 1 1 auto;
  text-align: center;
}

.tips {
  margin: 0;
  padding-left: 1.2rem;
  color: var(--muted);
}

.share-box p {
  margin-bottom: 1rem;
  color: var(--muted);
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
