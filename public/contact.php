<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/partials/header.php';
?>

<section class="contact-section">
  <div class="contact-wrapper">
    
    <!-- Left Info -->
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p class="intro">We’d love to hear from you! Whether you have feedback, suggestions, or just want to say hello, feel free to reach out.</p>
      
      <div class="info-item">
        <i class="fa-solid fa-envelope"></i>
        <span>surajitsamanta3401@gmail.com</span>
      </div>
      <div class="info-item">
        <i class="fa-solid fa-phone"></i>
        <span>+91-9735143401</span>
      </div>
      <div class="info-item">
        <i class="fa-solid fa-location-dot"></i>
        <span>New Town, West Bengal 700161</span>
      </div>

      <div class="socials">
        <a href="https://www.facebook.com/profile.php?id=100044907610039"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/surajit-samanta-a84225280/"><i class="fa-brands fa-linkedin-in"></i></a>
      </div>
    </div>

    <!-- Right Form -->
    <div class="contact-form-card">
      <h3>Send us a Message</h3>
      <form method="post" action="#" class="contact-form">
        <div class="row">
          <input name="name" placeholder="Your name" required>
          <input name="email" placeholder="Your email" required>
        </div>
        <input name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Message" rows="6" required></textarea>
        <button class="btn" type="submit">Send Message</button>
      </form>
    </div> 
  </div>
   <div class="location ">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3682.8715627888646!2d88.46226977530192!3d22.621270879456954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89fe42b4892fd%3A0x8565fde6341d4d83!2sTravarsa%20Private%20Limited!5e0!3m2!1sen!2sin!4v1755966106889!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</section>


<?php require_once __DIR__ . '/partials/footer.php'; ?>

<style>
:root {
  --bg: #0b0f17;
  --panel: #131826;
  --panel-2: #0f1422;
  --muted: #95a0b5;
  --text: #e9eefb;
  --title: #ffffff;
  --accent: #ff7a45;
  --accent-2: #00e0ff;
  --border: rgba(255, 255, 255, .08);
  --radius: 16px;
  --shadow: 0 12px 40px rgba(0, 0, 0, .45);
}

body {
  background: var(--bg);
  color: var(--text);
  font-family: "Poppins", sans-serif;
}
.location{
  padding: 4rem 2rem;
  display: flex;
  justify-content: center;
  max-width: 1200px;
  width: 100%;
  background: var(--panel);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
}
.location iframe{
width: 100%;
height: 400px;
border-radius: 10px;
}
/* Contact Section */
.contact-section {
  padding: 2rem 1rem;
  display: flex;
  justify-content: center;
  flex-direction:column;
  align-items: center;
  gap: 20px;
}

.contact-wrapper {
  max-width: 1200px;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2.5rem;
  background: var(--panel);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 3rem;
}

.contact-info h2 {
  color: var(--title);
  font-size: 2rem;
  margin-bottom: 1rem;
}

.contact-info .intro {
  color: var(--muted);
  margin-bottom: 2rem;
  font-size: 1rem;
  line-height: 1.6;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 1rem;
  color: var(--text);
}

.info-item i {
  color: var(--accent-2);
  font-size: 1.2rem;
}

.socials {
  margin-top: 2rem;
  display: flex;
  gap: 1rem;
}

.socials a {
  color: var(--text);
  font-size: 1.1rem;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--panel-2);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all .3s ease;
  text-decoration:none;
}

.socials a:hover {
  background: var(--accent-2);
  color: #fff;
}

/* Form Card */
.contact-form-card {
  background: var(--panel-2);
  border-radius: var(--radius);
  padding: 2rem;
  box-shadow: var(--shadow);
}

.contact-form-card h3 {
  margin-bottom: 1.5rem;
  color: var(--title);
  font-size: 1.5rem;
  text-align: center;
}

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.contact-form .row {
  display: flex;
  gap: 1rem;
}

.contact-form input,
.contact-form textarea {
  background: var(--panel);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 0.9rem 1rem;
  color: var(--text);
  font-size: 1rem;
  width: 100%;
  resize: none;
  outline: none;
  transition: border-color .2s ease;
}

.contact-form input:focus,
.contact-form textarea:focus {
  border-color: var(--accent-2);
}

/* Button */
.btn {
  background: linear-gradient(135deg, var(--accent), var(--accent-2));
  border: none;
  border-radius: var(--radius);
  padding: 0.9rem;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  transition: transform 0.2s ease, opacity 0.2s ease;
}

.btn:hover {
  transform: translateY(-2px);
  opacity: 0.95;
}

/* Responsive */
@media (max-width: 900px) {
  .contact-wrapper {
    grid-template-columns: 1fr;
    padding: 2rem;
  }
}
</style>
