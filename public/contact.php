<?php require_once __DIR__ . '/partials/header.php'; ?>
<section class="card">
  <h2>Contact</h2>
  <p>Have feedback or suggestions? Send a message.</p>
  <form method="post" action="#">
    <input name="name" placeholder="Your name" required>
    <input name="email" placeholder="Your email" required>
    <textarea name="message" placeholder="Message" rows="5" required></textarea>
    <button class="btn" type="submit">Send</button>
  </form>
</section>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
