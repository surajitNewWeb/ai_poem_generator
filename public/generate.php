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

<section class="result-card">
  <div class="result-header">
    <h2>✨ Poem about <span>“<?= htmlspecialchars($theme) ?>”</span></h2>
  </div>

  <div class="poem-box">
    <pre><?= htmlspecialchars($poem) ?></pre>
  </div>

  <div class="caption-box">
    <h3>📌 Caption</h3>
    <p id="captionText"><?= htmlspecialchars(trim($caption)) ?></p>
  </div>

  <div class="row actions">
    <a class="btn-gradient small" href="poem_view.php?id=<?= $poemId ?>">View Full</a>
    <a class="btn-gradient small ghost" href="poem_history.php">My Poems</a>
    <button class="btn" id="copyBtn" data-target="captionText">Copy Caption</button>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
