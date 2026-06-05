document.addEventListener('DOMContentLoaded', function() {
  const emailForm = document.getElementById('emailForm');
  const resetForm = document.getElementById('resetPasswordForm');

  if (emailForm) {
    emailForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const errorDiv = document.getElementById('emailError');
      if (!email || !email.includes('@')) {
        if (errorDiv) { errorDiv.textContent = 'Please enter a valid email'; errorDiv.style.display = 'block'; }
        return;
      }
      if (errorDiv) errorDiv.style.display = 'none';
      document.getElementById('step1').classList.remove('active');
      document.getElementById('step2').classList.add('active');
      emailForm.classList.remove('active');
      resetForm.classList.add('active');
      alert('Verification code sent to ' + email + ' (demo mode)');
    });
  }

  if (resetForm) {
    resetForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const pass = document.getElementById('newPassword').value;
      const confirm = document.getElementById('confirmPassword').value;
      const passErr = document.getElementById('passwordError');
      const confirmErr = document.getElementById('confirmPasswordError');

      if (!pass || pass.length < 6) {
        if (passErr) { passErr.textContent = 'Password must be at least 6 characters'; passErr.style.display = 'block'; }
        return;
      }
      if (passErr) passErr.style.display = 'none';

      if (pass !== confirm) {
        if (confirmErr) { confirmErr.textContent = 'Passwords do not match'; confirmErr.style.display = 'block'; }
        return;
      }
      if (confirmErr) confirmErr.style.display = 'none';

      document.getElementById('step2').classList.remove('active');
      document.getElementById('step3').classList.add('active');
      resetForm.classList.remove('active');
      document.querySelector('.form-text')?.classList.add('active');
      alert('Password has been reset successfully! (demo mode)');
      window.location.href = 'login.php';
    });
  }

  document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function() {
      const input = this.previousElementSibling;
      if (input.type === 'password') { input.type = 'text'; this.classList.replace('fa-eye', 'fa-eye-slash'); }
      else { input.type = 'password'; this.classList.replace('fa-eye-slash', 'fa-eye'); }
    });
  });
});
