document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('contactForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      const name = document.getElementById('name');
      const email = document.getElementById('email');
      const message = document.getElementById('message');
      let valid = true;

      if (!name.value.trim()) { valid = false; }
      if (!email.value.trim() || !email.value.includes('@')) { valid = false; }
      if (!message.value.trim()) { valid = false; }

      if (!valid) {
        e.preventDefault();
        const msgDiv = document.getElementById('contactMessage');
        if (msgDiv) {
          msgDiv.style.display = 'block';
          msgDiv.style.backgroundColor = '#f44336';
          msgDiv.style.color = 'white';
          msgDiv.textContent = 'Please fill in all required fields.';
        }
      }
    });
  }
});
