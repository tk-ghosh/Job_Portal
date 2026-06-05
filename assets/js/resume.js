document.addEventListener('DOMContentLoaded', function() {
  const progressBar = document.getElementById('progressBar');
  const progressText = document.getElementById('progressText');

  function updateProgress() {
    const name = document.getElementById('fullName')?.value.trim();
    const email = document.getElementById('email')?.value.trim();
    const phone = document.getElementById('phone')?.value.trim();
    const exp = document.getElementById('experience')?.value.trim();
    const edu = document.getElementById('education')?.value.trim();
    const skills = document.getElementById('skills')?.value.trim();

    let filled = 0;
    if (name) filled++;
    if (email) filled++;
    if (phone) filled++;
    if (exp) filled++;
    if (edu) filled++;
    if (skills) filled++;

    const pct = Math.round((filled / 6) * 100);
    if (progressBar) progressBar.value = pct;
    if (progressText) progressText.textContent = pct + '% Complete';
  }

  document.querySelectorAll('#resumeForm input, #resumeForm textarea').forEach(el => {
    el.addEventListener('input', updateProgress);
  });

  const resumeForm = document.getElementById('resumeForm');
  if (resumeForm) {
    resumeForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let valid = true;

      const name = document.getElementById('fullName');
      const email = document.getElementById('email');
      const nameErr = document.getElementById('fullNameError');
      const emailErr = document.getElementById('emailError');

      if (!name.value.trim()) {
        nameErr.textContent = 'Name is required';
        nameErr.style.display = 'block';
        valid = false;
      } else {
        nameErr.style.display = 'none';
      }

      if (!email.value.trim() || !email.value.includes('@')) {
        emailErr.textContent = 'Valid email is required';
        emailErr.style.display = 'block';
        valid = false;
      } else {
        emailErr.style.display = 'none';
      }

      if (valid) {
        const success = document.getElementById('resumeSuccess');
        if (success) {
          success.style.display = 'block';
          setTimeout(() => { success.style.display = 'none'; }, 3000);
        }
        localStorage.setItem('resume_data', JSON.stringify({
          name: name.value,
          email: email.value,
          phone: document.getElementById('phone')?.value,
          experience: document.getElementById('experience')?.value,
          education: document.getElementById('education')?.value,
          skills: document.getElementById('skills')?.value
        }));
      }
    });
  }

  const dropZone = document.getElementById('dropZone');
  const fileInput = document.getElementById('resumeFile');
  const uploadStatus = document.getElementById('uploadStatus');

  if (dropZone && fileInput) {
    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('active');
    });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('active'));
    dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('active');
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        if (uploadStatus) uploadStatus.textContent = 'File selected: ' + fileInput.files[0].name;
      }
    });
    fileInput.addEventListener('change', () => {
      if (fileInput.files.length && uploadStatus) {
        uploadStatus.textContent = 'File selected: ' + fileInput.files[0].name;
      }
    });
  }

  const saved = localStorage.getItem('resume_data');
  if (saved) {
    try {
      const data = JSON.parse(saved);
      if (document.getElementById('fullName')) document.getElementById('fullName').value = data.name || '';
      if (document.getElementById('email')) document.getElementById('email').value = data.email || '';
      if (document.getElementById('phone')) document.getElementById('phone').value = data.phone || '';
      if (document.getElementById('experience')) document.getElementById('experience').value = data.experience || '';
      if (document.getElementById('education')) document.getElementById('education').value = data.education || '';
      if (document.getElementById('skills')) document.getElementById('skills').value = data.skills || '';
    } catch(e) {}
    updateProgress();
  }

  updateProgress();
});
