<?php require_once __DIR__ . '/partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>AI Poem Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    :root {
      --accent: rgb(112, 114, 228);
      --accent-2: #0097ffc4;
      --accent-3: #0f172a;
      /* Cyan */
      --muted: #64748b;
      --card-bg: #ffffff;
      --card-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
      --gradient-bg: linear-gradient(135deg, #f8fafc, #f9fafb, #ffffff);
    }

    .container {
      max-width: 1300px;
      margin: 2rem auto;
      padding: 1rem;
    }

    /* Hero */
    .hero {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 2rem;
    }

    .title {
      font-size: 2.4rem;
      font-weight: 800;
      margin: 0 0 0.8rem;
      background: linear-gradient(90deg, var(--accent), var(--accent-2), var(--accent-3));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .subtitle {
      color: var(--muted);
      margin-bottom: 1rem;
    }

    .form-hero input,
    .form-hero select {
      width: 100%;
      padding: 0.9rem;
      border-radius: 10px;
      border: 1px solid #e2e8f0;
      font-size: 0.95rem;
      background: #fff;
      color: #000000;
    }

    .form-hero input:focus,
    .form-hero select:focus {
      border-color: var(--accent);
      outline: none;
    }

    .row {
      display: flex;
      gap: 0.8rem;
    }

    /* Features */
    .features {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-top: 1.4rem;
    }

    .feature {
      border-radius: 10px;
      padding: 1rem;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .feature h4 {
      margin: 0 0 .4rem;
      font-size: 1.05rem;
      color: var(--accent);
    }

    .feature p {
      margin: 0;
      font-size: 0.9rem;
      color: var(--muted);
    }

    /* Sample Poem */
    .sample {
      margin-top: .6rem;
      padding: 1rem;
      border-radius: 10px;
      background: #f8fafc;
      white-space: pre-wrap;
      font-style: normal;
    }

    /* Steps */
    .steps {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }

    .step {
      flex: 1;
      padding: 1rem;
      border-radius: 10px;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
      text-align: center;
    }

    .step .num {
      background: var(--accent);
      color: #fff;
      display: inline-block;
      padding: 0.35rem 0.6rem;
      border-radius: 6px;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    /* Tags */
    .tags {
      display: flex;
      gap: 0.6rem;
      flex-wrap: wrap;
      margin-top: .8rem;
    }

    .tag {
      background: #fff;
      border: 1px solid #e2e8f0;
      padding: 0.4rem 0.7rem;
      border-radius: 999px;
      font-size: 0.85rem;
      color: var(--muted);
      cursor: pointer;
    }

    .tag:hover {
      background: var(--accent);
      color: #fff;
      border-color: var(--accent);
    }

    

    /* Testimonials */
.hero-right {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}
.card {
  background: #fff;
  padding: 1.5rem;
  border-radius: 1rem;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}
.card h3, .card h4 {
  margin-bottom: .8rem;
  color: #4f46e5;
}
.sample {
  font-style: italic;
  color: #374151;
  background: #f9fafb;
  padding: 1rem;
  border-radius: .8rem;
  line-height: 1.6;
}
.actions {
  display: flex;
  gap: .6rem;
  margin-top: .8rem;
  flex-wrap: wrap;
}
.btn-gradient.small {
  padding: .5rem 1rem;
  font-size: .85rem;
  border-radius: 25px;
  border: none;
  cursor: pointer;
}
.btn-gradient.ghost {
  background: #f9fafb;
  color: #4f46e5;
  border: 1px solid #4f46e5;
}
.testimonials {
  position: relative;
  min-height: 120px;
}
.testimonial {
  display: none;
  color: #475569;
}
.testimonial.active {
  display: block;
  animation: fadeIn .5s ease-in-out;
}
.testimonial-nav {
  display: flex;
  justify-content: flex-end;
  gap: .5rem;
  margin-top: .5rem;
}
.testimonial-nav button {
  background: #4f46e5;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  cursor: pointer;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

    /* Responsive */
    @media (max-width: 900px) {
      .hero {
        grid-template-columns: 1fr;
      }

      .hero-right {
        order: 2;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- HERO -->
    <section class="hero">
      <!-- Left -->
      <div class="hero-left">
        <div class="card">
          <h1 class="title">Create beautiful poems using AI — instantly.</h1>
          <p class="subtitle">Type a theme, choose style & length, and get a share-ready caption alongside your poem.
          </p>

          <form action="generate.php" method="post" class="form-hero" autocomplete="off">
            <input name="theme" placeholder="Theme (e.g., moonlight, love, ocean)" required aria-label="Poem theme">
            <div class="row">
              <select name="length" aria-label="Poem length">
                <option value="short">Short (4 lines)</option>
                <option value="medium" selected>Medium (8–12 lines)</option>
                <option value="long">Long (free verse)</option>
              </select>
              <select name="style" aria-label="Poem style">
                <option value="">— Style —</option>
                <option value="romantic">Romantic</option>
                <option value="haiku">Haiku</option>
                <option value="modern">Modern</option>
                <option value="classic">Classic</option>
              </select>
            </div>

            <div style="display:flex;gap:.6rem;margin-top:.8rem;align-items:center;">
              <button class="btn-gradient small" type="submit">Generate Poem</button>
              <button class="btn-gradient small ghost" type="button" onclick="fillSample()">Try sample</button>
              <div style="margin-left:auto;color:var(--muted);font-size:.9rem;">Saved to <a
                  href="history.php">History</a></div>
            </div>

            <div style="margin-top:.8rem;">
              <small style="color:var(--muted)">Popular themes:</small>
              <div class="tags">
                <button type="button" class="tag" onclick="pickTag('sunset over the sea')">sunset</button>
                <button type="button" class="tag" onclick="pickTag('first love')">first love</button>
                <button type="button" class="tag" onclick="pickTag('monsoon rain')">monsoon</button>
                <button type="button" class="tag" onclick="pickTag('lonely city')">city</button>
                <button type="button" class="tag" onclick="pickTag('mountain breeze')">mountain</button>
              </div>
            </div>
          </form>

          <div class="features">
            <div class="feature">
              <h4>🎨 Flexible styles</h4>
              <p>From haiku to modern free verse — customize tone and mood.</p>
            </div>
            <div class="feature">
              <h4>⚡ Fast results</h4>
              <p>Generates poem + a shareable caption in seconds.</p>
            </div>
            <div class="feature">
              <h4>💾 Save & export</h4>
              <p>All your poems and captions are stored to revisit later.</p>
            </div>
            <div class="feature">
              <h4>🔗 Share-ready</h4>
              <p>Copy caption, download TXT or open poem view for social posts.</p>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:1rem;">
          <h3 style="margin:0 0 .6rem;">How it works</h3>
          <div class="steps">
            <div class="step">
              <div class="num">1</div>
              <p>Type a theme and pick a style.</p>
            </div>
            <div class="step">
              <div class="num">2</div>
              <p>AI generates a poem and caption.</p>
            </div>
            <div class="step">
              <div class="num">3</div>
              <p>Save, copy, or download for sharing.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right -->
<aside class="hero-right">
  <!-- Featured Poem -->
  <div class="card">
    <h3>🌟 Featured Poem</h3>
    <div class="sample" id="samplePoem">
      Golden shore at dusk,  
      Waves whisper secrets to the sand,  
      A gull sketches the wind,  
      You and the sea, hand in hand.
    </div>
    <div class="actions">
      <button class="btn-gradient small" onclick="copyText('#samplePoem')">📋 Copy Poem</button>
      <button class="btn-gradient small ghost" onclick="copySampleCaption()">💬 Copy Caption</button>
      <a class="btn-gradient small ghost" href="explore.php">🔍 Explore</a>
    </div>
  </div>

  <!-- Testimonials -->
  <div class="card testimonials-card">
    <h4>💭 What People Say</h4>
    <div class="testimonials" id="testimonials">
      <div class="testimonial active">
        <strong>Riya</strong>
        <p>"Beautiful poems in seconds — I use the captions directly on my feed."</p>
      </div>
      <div class="testimonial">
        <strong>Arjun</strong>
        <p>"Saved my favourite pieces and reused them later. Simple and quick."</p>
      </div>
      <div class="testimonial">
        <strong>Sofia</strong>
        <p>"PoetAI turned my late-night thoughts into beautiful verses."</p>
      </div>
    </div>
    <div class="testimonial-nav">
      <button onclick="prevTestimonial()">◀</button>
      <button onclick="nextTestimonial()">▶</button>
    </div>
  </div>
</aside>
    </section>

    <!-- Recent Creations -->
    <?php
require_once __DIR__ . '/../config/db.php';

// Fetch latest 6 poems
$stmt = $pdo->prepare("
    SELECT id, theme, content, caption, style_label, length_label, created_at
    FROM poems
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$poems = $stmt->fetchAll();
?>

    <section style="margin-top:1.5rem;">
      <div class="card">
        <h3 style="margin:0 0 .6rem;">Recent creations</h3>
        <p style="color:var(--muted);margin-bottom:1rem;">
          A peek at recently generated poems.
        </p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
          <?php foreach ($poems as $poem): ?>
          <article class="card" style="padding:1rem;">
            <h4 style="margin-top:0;">
              <?= htmlspecialchars(ucfirst($poem['theme'])) ?>
            </h4>
            <pre style="margin:0;height:90px;overflow:hidden;white-space:pre-wrap;">
        <?= htmlspecialchars($poem['content']) ?>
          </pre>
            <small style="color:gray;display:block;margin:.5rem 0;">
              <?= htmlspecialchars($poem['style_label'] ?? '') ?> ·
              <?= htmlspecialchars($poem['length_label'] ?? '') ?>
            </small>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
              <a class="btn-gradient small" href="poem.php?id=<?= $poem['id'] ?>">Open</a>
              <a class="btn-gradient small ghost" href="export.php?id=<?= $poem['id'] ?>">Download</a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </div>
<script>
/* Testimonials logic */
let currentTestimonial = 0;
const testimonials = document.querySelectorAll(".testimonial");

function showTestimonial(index) {
  testimonials.forEach((t, i) => {
    t.classList.toggle("active", i === index);
  });
}

function nextTestimonial() {
  currentTestimonial = (currentTestimonial + 1) % testimonials.length;
  showTestimonial(currentTestimonial);
}

function prevTestimonial() {
  currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
  showTestimonial(currentTestimonial);
}

/* Auto rotate every 5s */
setInterval(nextTestimonial, 5000);

/* Copy Logic */
function copyText(selector) {
  const text = document.querySelector(selector).innerText;
  navigator.clipboard.writeText(text);
  alert("Poem copied!");
}
function copySampleCaption() {
  navigator.clipboard.writeText("✨ Generated with PoetAI ✨");
  alert("Caption copied!");
}
</script>
  <script>
    function copyText(selector) {
      const el = document.querySelector(selector);
      if (!el) return;
      navigator.clipboard.writeText(el.innerText.trim()).then(() => alert('Copied!'));
    }
    function copySampleCaption() {
      navigator.clipboard.writeText("Golden shore at dusk... #poetry #sunset").then(() => alert('Caption copied!'));
    }
    function fillSample() {
      document.querySelector('input[name="theme"]').value = 'sunset over the sea';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    function pickTag(tag) {
      document.querySelector('input[name="theme"]').value = tag;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>
</body>

</html>

<?php require_once __DIR__ . '/partials/footer.php'; ?>