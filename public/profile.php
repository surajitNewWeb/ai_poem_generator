<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/partials/header.php'; 
require_once __DIR__ . '/../config/db.php';

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch user
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Fetch poems
$stmt2 = $pdo->prepare('SELECT * FROM poems WHERE user_id = ? ORDER BY created_at DESC');
$stmt2->execute([$userId]);
$poems = $stmt2->fetchAll();
?>

<section class="profile-container">
  <!-- Profile Header -->
  <div class="card profile-header">
    <div class="avatar">
      <span><?= strtoupper(substr($user['username'],0,1)) ?></span>
    </div>
    <div class="user-info">
      <h2><?= htmlspecialchars($user['username']) ?></h2>
      <p class="email"><?= htmlspecialchars($user['email']) ?></p>
      <a href="logout.php" class="btn btn-gradient small">Logout</a>
    </div>
  </div>

  <!-- Poems -->
  <div class="poems-section">
    <h3>📜 Your Poems</h3>
    <?php if ($poems): ?>
      <div class="poems-grid">
        <?php foreach ($poems as $p): ?>
          <article class="card poem-card">
            <h4><?= htmlspecialchars($p['theme']) ?></h4>
            <pre><?= htmlspecialchars(substr($p['content'],0,180)) ?><?= strlen($p['content'])>180?'...':'' ?></pre>
            <div class="actions">
              <a class="btn btn-gradient small" href="poem.php?id=<?= $p['id'] ?>">Open</a>
              <a class="btn btn-ghost small" href="export.php?id=<?= $p['id'] ?>">Download</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="empty">
        You haven’t created any poems yet.<br>
        <a href="generate.php" class="btn btn-gradient small">Create your first</a>
      </p>
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

  body {
    font-family: 'Segoe UI', sans-serif;
    background: var(--bg);
    margin: 0;
    padding: 0;
    color: var(--text);
  }

  .profile-container {
    max-width: 1100px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  .card {
    background: #141a29;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 1.8rem;
    transition: transform .2s ease, box-shadow .2s ease;
  }

  .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.5);
  }

  .profile-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
  }

  .avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 2.2rem;
    font-weight: bold;
    flex-shrink: 0;
  }

  .user-info h2 {
    margin: 0;
    font-size: 1.8rem;
    color: var(--title);
  }

  .user-info .email {
    color: var(--muted);
    font-size: .95rem;
    margin-top: .2rem;
  }

  .btn {
    display: inline-block;
    padding: .55rem 1.2rem;
    border-radius: .6rem;
    font-size: .9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.25s ease;
    cursor: pointer;
  }

  .btn-gradient {
    background: linear-gradient(135deg, var(--accent), var(--accent-2));
    color: #fff;
    border: none;
  }

  .btn-gradient:hover {
    opacity: 0.9;
    transform: translateY(-2px);
  }

  .btn-ghost {
    background: transparent;
    border: 1.5px solid var(--accent-2);
    color: var(--accent-2);
  }

  .btn-ghost:hover {
    background: var(--accent-2);
    color: #0b0f17;
  }

  .btn.small {
    font-size: .8rem;
    padding: .4rem .9rem;
  }

  .poems-section h3 {
    font-size: 1.4rem;
    margin-bottom: 1.2rem;
    color: var(--title);
  }

  .poems-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap: 1.5rem;
  }

  .poem-card h4 {
    margin: 0 0 .5rem;
    font-size: 1.15rem;
    color: var(--title);
  }

  .poem-card pre {
    font-size: .9rem;
    color: var(--muted);
    white-space: pre-wrap;
    margin-bottom: 1rem;
    line-height: 1.4;
    max-height: 140px;
    overflow: hidden;
  }

  .actions {
    display: flex;
    gap: .6rem;
  }

  .empty {
    margin-top: 1.5rem;
    text-align: center;
    color: var(--muted);
    font-size: .95rem;
  }

  .empty a {
    display: inline-block;
    margin-top: .7rem;
  }
</style>
