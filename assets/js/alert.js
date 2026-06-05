function showScreen(screenId) {
  document.querySelectorAll('section[id]').forEach(s => s.classList.remove('active'));
  document.getElementById(screenId)?.classList.add('active');
  document.querySelectorAll('.section-nav button').forEach(b => b.classList.remove('active'));
  document.querySelector(`.section-nav button[onclick*="${screenId}"]`)?.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
  const prefForm = document.getElementById('preferences-form');
  if (prefForm) {
    prefForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const title = document.getElementById('job-title');
      const location = document.getElementById('location');
      let valid = true;

      if (!title.value.trim()) {
        document.getElementById('job-title-error').classList.add('active');
        valid = false;
      } else {
        document.getElementById('job-title-error').classList.remove('active');
      }
      if (!location.value.trim()) {
        document.getElementById('location-error').classList.add('active');
        valid = false;
      } else {
        document.getElementById('location-error').classList.remove('active');
      }

      if (valid) {
        const success = document.getElementById('alertSuccess');
        if (success) {
          success.style.display = 'block';
          setTimeout(() => { success.style.display = 'none'; }, 3000);
        }
      }
    });
  }

  document.querySelectorAll('#preferences-form input, #preferences-form select').forEach(el => {
    el.addEventListener('input', function() {
      const errId = this.id + '-error';
      document.getElementById(errId)?.classList.remove('active');
    });
  });
});
