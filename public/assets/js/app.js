// app.js - tiny interactions
document.addEventListener('DOMContentLoaded', function () {
  // copy button
  const copyBtn = document.getElementById('copyBtn');
  if (copyBtn) {
    copyBtn.addEventListener('click', function () {
      const id = copyBtn.dataset.target;
      const el = document.getElementById(id);
      if (!el) return;
      navigator.clipboard.writeText(el.innerText).then(() => {
        const old = copyBtn.innerText;
        copyBtn.innerText = 'Copied!';
        setTimeout(() => copyBtn.innerText = old, 1400);
      }).catch(() => alert('Copy failed'));
    });
  }
});
function subscribeNewsletter(e) {
  e.preventDefault();
  const email = e.target.querySelector("input").value;
  if (email) {
    alert("Thanks for subscribing, " + email + "!");
    e.target.reset();
  }
}
