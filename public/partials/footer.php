<footer class="footer">
  <div class="footer-inner">
    
    <!-- Brand / About -->
    <div class="footer-brand">
      <a href="index.php" class="brand">
        <div class="logo"></div>
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
        <a href="generate.php">Create a Poem</a>
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
