<?php
require_once __DIR__ . '/../config/db.php';
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

    <!-- 🔥 Custom Animated AI Orb -->
    <div class="hero-art">
      <div class="ai-visual">
        <svg class="ai-orb" viewBox="0 0 600 600" aria-hidden="true" role="img">
          <defs>
            <!-- Core glow -->
            <radialGradient id="core" cx="50%" cy="50%" r="60%">
              <stop offset="0%"  stop-color="#00E7FF" stop-opacity="0.95"/>
              <stop offset="45%" stop-color="#0BA9C9" stop-opacity="0.6"/>
              <stop offset="75%" stop-color="#0B2238" stop-opacity="0.25"/>
              <stop offset="100%" stop-color="#08131E" stop-opacity="0"/>
            </radialGradient>

            <!-- Energy sweep -->
            <linearGradient id="ring" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%"   stop-color="#00E7FF"/>
              <stop offset="33%"  stop-color="#00FFA8"/>
              <stop offset="66%"  stop-color="#FF5CF4"/>
              <stop offset="100%" stop-color="#00E7FF"/>
            </linearGradient>

            <!-- Glow -->
            <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
              <feGaussianBlur stdDeviation="18" result="b"/>
              <feMerge>
                <feMergeNode in="b"/>
                <feMergeNode in="SourceGraphic"/>
              </feMerge>
            </filter>
          </defs>

          <!-- luminous core -->
          <circle cx="300" cy="300" r="220" fill="url(#core)" filter="url(#glow)"></circle>

          <!-- rotating rings -->
          <g class="ring r1">
            <circle cx="300" cy="300" r="160" fill="none" stroke="url(#ring)" stroke-width="3" opacity="0.85"/>
          </g>
          <g class="ring r2">
            <circle cx="300" cy="300" r="220" fill="none" stroke="url(#ring)" stroke-width="2"
                    stroke-dasharray="6 14" opacity="0.5"/>
          </g>
          <g class="ring r3">
            <circle cx="300" cy="300" r="110" fill="none" stroke="url(#ring)" stroke-width="2"
                    stroke-dasharray="2 10" opacity="0.6"/>
          </g>

          <!-- orbiting dots -->
          <g class="orbit o1" transform="translate(300 300)">
            <circle class="dot" cx="0" cy="-160" r="5"/>
          </g>
          <g class="orbit o2" transform="translate(300 300)">
            <circle class="dot" cx="0" cy="-220" r="4"/>
          </g>
          <g class="orbit o3" transform="translate(300 300)">
            <circle class="dot" cx="0" cy="-110" r="3.5"/>
          </g>

          <!-- neural lines -->
          <g class="links" opacity="0.35">
            <line x1="170" y1="330" x2="430" y2="270" />
            <line x1="260" y1="150" x2="380" y2="450" />
            <line x1="180" y1="220" x2="470" y2="350" />
          </g>
        </svg>
      </div>
    </div>
  </div>

<!-- Features -->
<div class="wrap">
  <div class="section-title">
    <div class="tag">Why Choose Us</div>
    <h2>Supercharge Your Content</h2>
  </div>

  <div class="features">
    <!-- Feature 1 -->
    <div class="feature">
      <div class="icon">
        <!-- Lightning Bolt SVG -->
        <svg viewBox="0 0 24 24" class="svg-icon">
          <path d="M13 2L3 14h7l-1 8 10-12h-7z"/>
        </svg>
      </div>
      <h4>Lightning Fast</h4>
      <p>Generate full articles in seconds with AI.</p>
    </div>

    <!-- Feature 2 -->
    <div class="feature">
      <div class="icon">
        <!-- SEO Globe SVG -->
        <svg viewBox="0 0 24 24" class="svg-icon">
          <circle cx="12" cy="12" r="10"/>
          <path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20"/>
        </svg>
      </div>
      <h4>SEO Optimized</h4>
      <p>Rank higher with AI-powered SEO suggestions.</p>
    </div>

    <!-- Feature 3 -->
    <div class="feature">
      <div class="icon">
        <!-- Shield Check SVG -->
        <svg viewBox="0 0 24 24" class="svg-icon">
          <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z"/>
          <path d="M9 12l2 2 4-4"/>
        </svg>
      </div>
      <h4>Plagiarism Free</h4>
      <p>Unique, original content every time.</p>
    </div>

    <!-- Feature 4 -->
    <div class="feature">
      <div class="icon">
        <!-- Smiley Face SVG -->
        <svg viewBox="0 0 24 24" class="svg-icon">
          <circle cx="12" cy="12" r="10"/>
          <circle cx="9" cy="10" r="1.5"/>
          <circle cx="15" cy="10" r="1.5"/>
          <path d="M8 15c1.5 1 6.5 1 8 0"/>
        </svg>
      </div>
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
