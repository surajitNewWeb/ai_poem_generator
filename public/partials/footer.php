<style>
  /* Footer */
.footer {
  background: linear-gradient(to top, var(--panel), var(--panel-2));
  border-top: 1px solid var(--border);
  margin-top: 60px;
  color: var(--muted);
}

.footer-inner {
  max-width: 1200px;
  margin: auto;
  padding: 50px 24px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 40px;
}

.footer-brand .brand {
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 800;
  font-size: 1.3rem;
  text-decoration: none;
  color: var(--title);
  margin-bottom: 14px;
}

.footer-brand p {
  font-size: 0.95rem;
  line-height: 1.5;
  color: var(--muted);
}

.footer-links h4,
.footer-newsletter h4 {
  font-size: 1rem;
  margin-bottom: 12px;
  color: var(--title);
}

.footer-links nav {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.footer-links a {
  color: var(--muted);
  text-decoration: none;
  font-size: 0.9rem;
  transition: color .2s ease;
}

.footer-links a:hover {
  color: var(--accent-2);
}

.newsletter-form {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.newsletter-form input {
  flex: 1;
  padding: 10px 14px;
  border-radius: var(--radius);
  border: 1px solid var(--border);
  background: var(--panel);
  color: var(--text);
}

.footer-bottom {
  border-top: 1px solid var(--border);
  padding: 18px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: auto;
}

.socials a {
  color: var(--muted);
  margin-left: 14px;
  font-size: 1.2rem;
  transition: color .2s ease;
}

.socials a:hover {
  color: var(--accent);
}

</style>
<footer class="footer">
  <div class="footer-inner">
    
    <!-- Brand / About -->
    <div class="footer-brand">
     <a href="index.php" class="brand">
      <img src="assets/img/logo.png" alt="Logo">
      Poet<span style="color:var(--accent-2)">AI</span>
    </a>
      <p>Where imagination meets technology. Turning your words into timeless poetry, instantly.</p>
    </div>

    <!-- Links -->
    <div class="footer-links">
      <h4>Quick Links</h4>
      <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="explore.php">Explore</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
      </nav>
    </div>

    <div class="footer-links">
      <h4>Resources</h4>
      <nav>
        <a href="service.php">Create a Poem</a>
        <a href="history.php">Poem History</a>
        <a href="profile.php">Profile</a>
        <a href="export.php">Export Poems</a>
      </nav>
    </div>

    <!-- Newsletter -->
    <div class="footer-newsletter">
      <h4>Stay Inspired</h4>
      <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
        <input type="email" placeholder="Your email" required>
        <button type="submit" class="btn">Subscribe</button>
      </form>
    </div>
  </div>

  <!-- Bottom -->
  <div class="footer-bottom">
    <p>© <?php echo date("Y"); ?> PoetAI — All Rights Reserved.</p>
    <div class="socials">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-github"></i></a>
    </div>
  </div>
</footer>

<script>
function subscribeNewsletter(e) {
  e.preventDefault();
  const email = e.target.querySelector("input").value;
  alert(`Thanks for subscribing, ${email}!`);
  e.target.reset();
}
</script>
