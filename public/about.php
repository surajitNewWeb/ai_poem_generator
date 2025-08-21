<?php require_once __DIR__ . '/partials/header.php'; ?>

<!-- Hero Section -->
<section class="about-hero">
  <div class="hero-inner container">
    <h1>About <span>PoetAI</span></h1>
    <p>Where imagination meets technology. Turning your words into timeless poetry, instantly.</p>
    <a href="create.php" class="btn-gradient">Start Creating ✨</a>
  </div>
</section>

<!-- About Content -->
<section class="about-content container">
  <div class="about-wrapper">
    <!-- Story -->
    <div class="about-text">
      <h2>Our Story</h2>
      <p>
        PoetAI was born from the idea that poetry should be accessible to everyone, not just seasoned writers. 
        Using cutting-edge AI, our app transforms your thoughts into expressive verses — whether you’re seeking 
        romantic poetry, motivational lines, or haikus inspired by your mood.
      </p>
    </div>

    <!-- Image -->
    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1509021436665-8f07dbf5bf1d?auto=format&fit=crop&w=900&q=80" alt="AI Poetry Illustration">
    </div>
  </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision container">
  <div class="mv-grid">
    <div class="mv-card">
      <h2>Our Mission</h2>
      <p>
        We believe poetry is a universal language of emotion. Our mission is to empower people across the globe 
        to express themselves, heal through words, and connect with others through creativity. 
      </p>
    </div>
    <div class="mv-card">
      <h2>Our Vision</h2>
      <p>
        To become the world’s most inspiring platform where every thought, dream, and feeling can be transformed 
        into poetry — bridging imagination with expression through AI.
      </p>
    </div>
  </div>
</section>

<!-- Unique Features -->
<section class="features container">
  <h2>What Makes Us Unique</h2>
  <ul class="features-list">
    <li>✨ <strong>Personalized Poetry</strong> — Poems tailored to your prompts, mood, or style.</li>
    <li>⚡ <strong>Instant Creativity</strong> — Generate beautiful verses in seconds.</li>
    <li>🌎 <strong>Global Inspiration</strong> — Multilingual support for poetry lovers everywhere.</li>
    <li>🎨 <strong>Modern Design</strong> — Minimalist and elegant, focusing on words that matter.</li>
    <li>🤝 <strong>Community Driven</strong> — Share, explore, and get inspired by other poets.</li>
  </ul>
</section>

<!-- How It Works -->
<section class="how-it-works container">
  <h2>How It Works</h2>
  <ol>
    <li>📝 Enter a theme, mood, or even just a word.</li>
    <li>⚙️ Our AI instantly generates unique and expressive verses.</li>
    <li>🎭 Personalize or edit the poem to reflect your voice.</li>
    <li>📤 Save, share, or download your masterpiece.</li>
  </ol>
  <div class="cta">
    <a href="create.php" class="btn-gradient">Write Your Poem Now 🚀</a>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>


<style>
/* ===== Hero Section ===== */
.about-hero {
  background: linear-gradient(135deg, #4f46e5, #9333ea);
  color: #fff;
  text-align: center;
  padding: 4rem 1rem 5rem;
  border-radius: 0 0 3rem 3rem;
  position: relative;
  overflow: hidden;
}
.about-hero::after {
  content: "";
  position: absolute;
  top: -80px;
  left: -80px;
  width: 200px;
  height: 200px;
  background: rgba(250, 204, 21, 0.3);
  border-radius: 50%;
  filter: blur(100px);
}
.about-hero h1 {
  font-size: 3rem;
  font-weight: 800;
  margin-bottom: 1rem;
}
.about-hero h1 span {
  color: #facc15;
  text-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
}
.about-hero p {
  font-size: 1.25rem;
  max-width: 700px;
  margin: 0 auto 2rem;
  line-height: 1.7;
  opacity: 0.95;
}
.about-hero .btn-gradient {
  background: linear-gradient(135deg, #facc15, #f97316);
  color: #1e293b;
  padding: 14px 32px;
  border-radius: 40px;
  font-size: 1.05rem;
  font-weight: bold;
  text-decoration: none;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
  transition: 0.3s ease;
}
.about-hero .btn-gradient:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* ===== About Content ===== */
.about-content {
  padding: 5rem 1rem;
}
.about-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}
.about-text h2 {
  font-size: 2.3rem;
  margin-bottom: 1.2rem;
  color: #111827;
  font-weight: 700;
  position: relative;
}
.about-text h2::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background: #4f46e5;
  margin-top: 10px;
  border-radius: 3px;
}
.about-text p {
  color: #475569;
  line-height: 1.8;
  font-size: 1.1rem;
}
.about-image img {
  width: 100%;
  border-radius: 1.8rem;
  box-shadow: 0 15px 30px rgba(0,0,0,0.18);
  transition: 0.4s ease;
}
.about-image img:hover {
  transform: scale(1.03);
}

/* ===== Mission & Vision ===== */
.mission-vision {
  padding: 5rem 1rem;
  background: #f9fafb;
  border-radius: 2rem;
}
.mv-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2.5rem;
}
.mv-card {
  background: #fff;
  padding: 2.5rem;
  border-radius: 1.2rem;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  text-align: center;
  transition: 0.3s ease;
}
.mv-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}
.mv-card h2 {
  font-size: 1.7rem;
  color: #4f46e5;
  margin-bottom: 1rem;
  font-weight: 700;
}
.mv-card p {
  color: #475569;
  line-height: 1.7;
  font-size: 1.05rem;
}

/* ===== Features Section ===== */
.features {
  padding: 2rem 1rem;
  text-align: center;
}
.features h2 {
  font-size: 2.2rem;
  margin-bottom: 2.5rem;
  font-weight: 700;
}
.features-list {
  list-style: none;
  padding: 0;
  max-width: 750px;
  margin: 0 auto;
  text-align: left;
}
.features-list li {
  margin-bottom: 1.2rem;
  font-size: 1.1rem;
  color: #374151;
  padding-left: 2rem;
  position: relative;
}
.features-list li::before {
  content: "✔";
  color: #9333ea;
  font-weight: bold;
  position: absolute;
  left: 0;
  top: 0;
}

/* ===== How It Works ===== */
.how-it-works {
  padding: 5rem 1rem;
  text-align: center;
  background: linear-gradient(135deg, #f9fafb, #eef2ff);
  border-radius: 2rem;
}
.how-it-works h2 {
  font-size: 2.2rem;
  margin-bottom: 2.5rem;
  font-weight: 700;
  color: #111827;
}
.how-it-works ol {
  text-align: left;
  max-width: 700px;
  margin: 0 auto 2.5rem;
  padding-left: 1.5rem;
  color: #374151;
  font-size: 1.1rem;
}
.how-it-works ol li {
  margin-bottom: 1.2rem;
  line-height: 1.7;
  padding-left: 5px;
}
.how-it-works .cta {
  margin-top: 2rem;
}
.how-it-works .btn-gradient {
  background: linear-gradient(135deg, #4f46e5, #9333ea);
  color: #fff;
  padding: 15px 35px;
  border-radius: 40px;
  font-size: 1.1rem;
  font-weight: bold;
  text-decoration: none;
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
  transition: 0.3s ease;
}
.how-it-works .btn-gradient:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 0 10px 28px rgba(0,0,0,0.3);
}

/* ===== Responsive ===== */
@media (max-width: 900px) {
  .about-wrapper {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .about-image img {
    max-width: 95%;
    margin: 0 auto;
  }
  .about-text h2::after {
    margin-left: auto;
    margin-right: auto;
  }
}


</style>
