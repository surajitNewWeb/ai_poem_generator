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

  <!-- Core Values -->
  <section class="values card">
    <h2>Our Core Values</h2>
    <div class="values-grid">
      <div class="value-item">
        <span>💡</span>
        <h4>Innovation</h4>
        <p>Pushing creative boundaries with cutting-edge AI.</p>
      </div>
      <div class="value-item">
        <span>❤️</span>
        <h4>Passion</h4>
        <p>Every verse we generate is crafted with care.</p>
      </div>
      <div class="value-item">
        <span>🌍</span>
        <h4>Inclusivity</h4>
        <p>Poetry for everyone, in every language.</p>
      </div>
      <div class="value-item">
        <span>🤝</span>
        <h4>Community</h4>
        <p>We grow stronger together as creators.</p>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="team card">
    <h2>Meet the Team</h2>
    <div class="team-grid">
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Founder">
        <h4>Arjun Mehta</h4>
        <p>Founder & Visionary</p>
      </div>
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Designer">
        <h4>Sophia Roy</h4>
        <p>Creative Designer</p>
      </div>
      <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Engineer">
        <h4>Rahul Sen</h4>
        <p>AI Engineer</p>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials card">
    <h2>What Our Users Say</h2>
    <div class="testimonial-grid">
      <div class="testimonial">
        <p>"PoetAI turned my raw emotions into beautiful poetry. Truly magical!"</p>
        <span>- Priya Sharma</span>
      </div>
      <div class="testimonial">
        <p>"As a songwriter, this has boosted my creativity like never before."</p>
        <span>- Arman Khan</span>
      </div>
      <div class="testimonial">
        <p>"Perfect for when I need instant poetic inspiration for my blog."</p>
        <span>- Riya Das</span>
      </div>
    </div>
  </section>

  <!-- Future Goals -->
  <section class="future card">
    <h2>Our Future Goals</h2>
    <ul>
      <li>🚀 Expand AI to support 50+ languages worldwide</li>
      <li>🎤 Launch AI-powered poetry readings & voiceovers</li>
      <li>📚 Introduce personalized poetry books on-demand</li>
      <li>🤝 Build the world’s largest community of AI poets</li>
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
/* General */
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
  background: linear-gradient(135deg, #ff7eb3, #ff758c);
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

/* Values */
.values h2 {
  text-align: center;
  margin-bottom: 2rem;
  color: var(--title);
}
.values-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem;
}
.value-item {
  text-align: center;
}
.value-item span {
  font-size: 2rem;
  display: block;
  margin-bottom: 0.5rem;
}

/* Team */
.team h2 {
  text-align: center;
  margin-bottom: 2rem;
}
.team-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  text-align: center;
}
.team-member img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
}

/* Testimonials */
.testimonials h2 {
  text-align: center;
  margin-bottom: 2rem;
}
.testimonial-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}
.testimonial {
  background: #fff2f7;
  border-radius: var(--radius);
  padding: 1.5rem;
  font-style: italic;
  box-shadow: var(--shadow);
}

/* Future Goals */
.future h2 {
  text-align: center;
  margin-bottom: 1.5rem;
}
.future ul {
  list-style: none;
  padding: 0;
  margin: 0 auto;
  max-width: 600px;
}
.future li {
  margin-bottom: 1rem;
  font-size: 1.1rem;
  color: var(--text);
}

/* How it works */
.how-it-works h2 {
  text-align: center;
  color: var(--accent-2);
  margin-bottom: 1.5rem;
}
.how-it-works ol {
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
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
