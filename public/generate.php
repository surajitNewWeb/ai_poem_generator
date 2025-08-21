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
      <a class="btn-gradient small" href="poem_view.php?id=<?= $poemId ?>">View Full</a>
      <a class="btn-gradient small ghost" href="poem_history.php">My Poems</a>
      <button class="btn-gradient small" id="copyBtn" data-target="captionText">Copy Caption</button>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

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
  --transparent: #0b0f171d;
}

/* General */
body {
  background: var(--bg);
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  color: var(--text);
}

.container {
  max-width: 850px;
  margin: 3rem auto;
  padding: 0 1rem;
}

/* Card */
.result-card {
  background: rgba(11, 15, 23, 0.7);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 2.5rem;
  margin: 2rem auto;
  color: var(--text);
  backdrop-filter: blur(18px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  animation: fadeIn 0.8s ease;
  transition: transform 0.3s ease;
}

.result-card:hover {
  transform: translateY(-6px);
}

/* Animation */
@keyframes fadeIn {
  from {opacity:0; transform: translateY(25px);}
  to {opacity:1; transform: translateY(0);}
}

/* Header */
.result-header {
  text-align: center;
  margin-bottom: 2rem;
}

.result-header h2 {
  font-size: 2.2rem;
  color: var(--title);
  font-weight: 700;
  letter-spacing: .5px;
}

.result-header .accent {
  color: var(--accent);
  text-shadow: 0 0 10px rgba(255,122,69,0.6);
}

/* Poem Box */
.poem-box {
  background: linear-gradient(135deg, rgba(255,122,69,0.12), rgba(0,224,255,0.12));
  border-radius: var(--radius);
  padding: 2rem;
  margin-bottom: 2rem;
  font-size: 1.1rem;
  line-height: 1.8;
  white-space: pre-wrap;
  color: var(--text);
  border-left: 5px solid var(--accent);
  box-shadow: inset 0 0 25px rgba(0,224,255,0.08);
}

/* Caption Box */
.caption-box {
  background: rgba(255,255,255,0.06);
  border-left: 5px solid var(--accent-2);
  padding: 1.5rem;
  border-radius: var(--radius);
  margin-bottom: 2.5rem;
  box-shadow: inset 0 0 15px rgba(0,224,255,0.15);
}

.caption-box h3 {
  margin: 0 0 .8rem;
  color: var(--accent-2);
  font-size: 1.2rem;
  font-weight: 700;
  letter-spacing: .5px;
}

.caption-box p {
  color: var(--muted);
  font-size: 1rem;
  line-height: 1.6;
}

/* Actions */
.actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: center;
}

/* Buttons */
.btn-gradient.small {
  padding: .8rem 1.4rem;
  font-size: .95rem;
  border-radius: var(--radius);
}

.btn-gradient {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: var(--title);
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: transform 0.25s ease, opacity 0.25s ease, box-shadow 0.25s ease;
}

.btn-gradient:hover {
  opacity: 0.95;
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 8px 22px rgba(0, 224, 255, 0.35);
}

.btn-gradient.ghost {
  background: transparent;
  border: 2px solid var(--accent);
  color: var(--accent);
  transition: background 0.3s ease, color 0.3s ease;
}

.btn-gradient.ghost:hover {
  background: rgba(255,122,69,0.15);
  color: var(--title);
}
</style>
