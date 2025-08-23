
<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AI Content Generator</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Hero -->
  <div class="wrap hero">
    <div>
      <div class="badge">AI powered</div>
      <h1>Generate Content 10x Faster</h1>
      <p>Create blog posts, social media content, and more with our AI assistant. Save time and boost creativity
        instantly.</p>
      <div class="hero-cta">
        <a href="service.php" class="btn">Start Generating</a>
        <a href="#" class="btn-ghost">Learn More</a>
      </div>
      <div class="rating">⭐⭐⭐⭐⭐ Loved by 2,000+ creators</div>
      <div class="logos">
        <div class="logo-badge">GPT-4 Powered</div>
        <div class="logo-badge">Fast & Secure</div>
      </div>
    </div>
    <div class="hero-art">
      <div class="disc"></div>
    </div>
  </div>

  <!-- Features -->
  <div class="wrap">
    <div class="section-title">
      <div class="tag">Why Choose Us</div>
      <h2>Supercharge Your Content</h2>
    </div>
    <div class="features">
      <div class="feature">
        <div class="icon"></div>
        <h4>Lightning Fast</h4>
        <p>Generate full articles in seconds with AI.</p>
      </div>
      <div class="feature">
        <div class="icon"></div>
        <h4>SEO Optimized</h4>
        <p>Rank higher with AI-powered SEO suggestions.</p>
      </div>
      <div class="feature">
        <div class="icon"></div>
        <h4>Plagiarism Free</h4>
        <p>Unique, original content every time.</p>
      </div>
      <div class="feature">
        <div class="icon"></div>
        <h4>Easy to Use</h4>
        <p>User-friendly dashboard for fast results.</p>
      </div>
    </div>
  </div>

  <!-- Split Content -->
  <div class="wrap split">
    <div class="img-card"></div>
    <div class="copy-card">
      <h3>Work Smarter with AI</h3>
      <p>Stop wasting hours writing content manually. Let our AI tool help you brainstorm, draft, and finalize
        high-quality content effortlessly.</p>
      <a href="service.php" class="btn">Try it Now</a>
    </div>
  </div>

  <!-- Testimonials -->
  <div class="wrap testimonials">
    <div class="section-title">
      <div class="tag">What People Say</div>
      <h2>Trusted by Creators Worldwide</h2>
    </div>
    <div class="testimonial-grid">
      <div class="testimonial">
        <p>"This AI has completely transformed the way I create content. I can produce articles in minutes!"</p>
        <h4>— Sarah L, Blogger</h4>
      </div>
      <div class="testimonial">
        <p>"The SEO optimization feature helped my website rank higher on Google within weeks."</p>
        <h4>— Raj P, Digital Marketer</h4>
      </div>
      <div class="testimonial">
        <p>"Easy to use, plagiarism free, and very fast. Highly recommended for content creators!"</p>
        <h4>— Emily R, Freelancer</h4>
      </div>
    </div>
  </div>

  <!-- Pricing -->
  <div class="wrap pricing">
    <div class="section-title">
      <div class="tag">Plans</div>
      <h2>Choose Your Plan</h2>
    </div>
    <div class="pricing-grid">
      <div class="price-card">
        <h3>Starter</h3>
        <p class="price">$9<span>/mo</span></p>
        <ul>
          <li>50 AI generations</li>
          <li>Basic support</li>
          <li>Community access</li>
        </ul>
        <a href="#" class="btn">Get Started</a>
      </div>
      <div class="price-card popular">
        <h3>Pro</h3>
        <p class="price">$29<span>/mo</span></p>
        <ul>
          <li>500 AI generations</li>
          <li>Priority support</li>
          <li>SEO optimization</li>
        </ul>
        <a href="#" class="btn">Go Pro</a>
      </div>
      <div class="price-card">
        <h3>Enterprise</h3>
        <p class="price">Custom</p>
        <ul>
          <li>Unlimited generations</li>
          <li>Dedicated manager</li>
          <li>Custom integrations</li>
        </ul>
        <a href="#" class="btn">Contact Us</a>
      </div>
    </div>
  </div>

  <!-- Call to Action -->
  <div class="wrap cta">
    <h2>Start Writing Smarter, Today 🚀</h2>
    <p>Join thousands of creators who save time and boost creativity with AI.</p>
    <a href="service.php" class="btn">Get Started Free</a>
  </div>

  <!-- Stats -->
  <div class="wrap stats">
    <div class="stat">
      <div class="num">2K+</div>
      <div class="lbl">Happy Users</div>
    </div>
    <div class="stat">
      <div class="num">10x</div>
      <div class="lbl">Faster Writing</div>
    </div>
    <div class="stat">
      <div class="num">98%</div>
      <div class="lbl">Satisfaction</div>
    </div>
    <div class="stat">
      <div class="num">24/7</div>
      <div class="lbl">Support</div>
    </div>
  </div>
</body>

</html>
<?php require_once __DIR__ . '/partials/footer.php'; ?>