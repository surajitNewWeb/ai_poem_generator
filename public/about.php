<?php require_once __DIR__ . '/partials/header.php'; ?>

<div class="container">

  <!-- Hero -->
  <section class="about-hero card">
    <h1>About <span>PoetAI</span></h1>
    <p>Where imagination meets technology. Turning your words into timeless poetry, instantly.</p>
    <a href="create.php" class="btn-accent">Start Creating ✨</a>
  </section>

  <!-- Story -->
  <section class="about-grid">
    <div class="about-text card">
      <h2>Our Story</h2>
      <p>
        PoetAI was born from the idea that poetry should be accessible to everyone, not just seasoned writers. 
        Using AI, our app transforms your thoughts into expressive verses — whether you’re seeking 
        romantic poetry, motivational lines, or haikus inspired by your mood.
      </p>
    </div>
    <div class="about-image card">
      <img src="https://images.unsplash.com/photo-1509021436665-8f07dbf5bf1d?auto=format&fit=crop&w=900&q=80" alt="AI Poetry Illustration">
    </div>
  </section>

  <!-- Mission & Vision -->
  <section class="mv-grid">
    <div class="mv-card card">
      <h2>Our Mission</h2>
      <p>
        We believe poetry is a universal language of emotion. Our mission is to empower people 
        everywhere to express themselves and connect through creativity.
      </p>
    </div>
    <div class="mv-card card">
      <h2>Our Vision</h2>
      <p>
        To become the world’s most inspiring platform where every thought, dream, and feeling can 
        be transformed into poetry — bridging imagination with expression through AI.
      </p>
    </div>
  </section>

  <!-- Features -->
  <section class="features card">
    <h2>What Makes Us Unique</h2>
    <ul>
      <li>✨ <strong>Personalized Poetry</strong> — Poems tailored to your prompts, mood, or style.</li>
      <li>⚡ <strong>Instant Creativity</strong> — Generate beautiful verses in seconds.</li>
      <li>🌎 <strong>Global Inspiration</strong> — Multilingual support for poetry lovers everywhere.</li>
      <li>🎨 <strong>Modern Design</strong> — Minimalist and elegant, focusing on words that matter.</li>
      <li>🤝 <strong>Community Driven</strong> — Share, explore, and get inspired by other poets.</li>
    </ul>
  </section>

  <!-- How It Works -->
  <section class="how-it-works card">
    <h2>How It Works</h2>
    <ol>
      <li>📝 Enter a theme, mood, or even just a word.</li>
      <li>⚙️ Our AI instantly generates unique and expressive verses.</li>
      <li>🎭 Personalize or edit the poem to reflect your voice.</li>
      <li>📤 Save, share, or download your masterpiece.</li>
    </ol>
    <div class="cta">
      <a href="create.php" class="btn-accent">Write Your Poem Now 🚀</a>
    </div>
  </section>

</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
<style>
  /* General Containers */
.container {
  padding: 2rem 1rem;
  max-width: 1200px;
  margin: 0 auto;
}
.card {
  background: var(--panel);
  border-radius: var(--radius);
  padding: 2rem;
  box-shadow: var(--shadow);
  border: 1px solid var(--border);
  margin-bottom: 2rem;
}

/* Hero */
.about-hero {
  text-align: center;
  padding: 4rem 2rem;
}
.about-hero h1 {
  font-size: 3rem;
  font-weight: 800;
  color: var(--title);
}
.about-hero h1 span {
  color: var(--accent);
}
.about-hero p {
  max-width: 700px;
  margin: 1rem auto 2rem;
  color: var(--muted);
  font-size: 1.2rem;
}
.btn-accent {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  color: #fff;
  padding: 0.9rem 2rem;
  border-radius: 40px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}
.btn-accent:hover {
  opacity: 0.9;
  transform: translateY(-3px);
}

/* About Grid */
.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}
.about-text h2 {
  color: var(--title);
  margin-bottom: 1rem;
}
.about-text p {
  color: var(--muted);
  line-height: 1.6;
}
.about-image img {
  width: 100%;
  border-radius: var(--radius);
  display: block;
}

/* Mission & Vision */
.mv-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}
.mv-card h2 {
  color: var(--accent-2);
  margin-bottom: 0.8rem;
}
.mv-card p {
  color: var(--muted);
  line-height: 1.6;
}

/* Features */
.features h2 {
  text-align: center;
  color: var(--title);
  margin-bottom: 1.5rem;
}
.features ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.features li {
  color: var(--text);
  margin-bottom: 1rem;
  padding-left: 1.5rem;
  position: relative;
}
.features li::before {
  content: "•";
  color: var(--accent);
  position: absolute;
  left: 0;
  top: 0;
}

/* How It Works */
.how-it-works h2 {
  text-align: center;
  color: var(--accent-2);
  margin-bottom: 1.5rem;
}
.how-it-works ol {
  max-width: 700px;
  margin: 0 auto;
  color: var(--text);
  line-height: 1.6;
}
.how-it-works li {
  margin-bottom: 1rem;
}
.how-it-works .cta {
  text-align: center;
  margin-top: 2rem;
}

/* Responsive */
@media (max-width: 900px) {
  .about-grid {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .about-image img {
    margin-top: 1rem;
  }
}

</style>