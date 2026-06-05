document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.sidebar-section').forEach(section => {
    section.addEventListener('click', function() {
      document.querySelectorAll('.sidebar-section').forEach(s => s.classList.remove('active'));
      this.classList.add('active');
      document.querySelectorAll('.profile-section').forEach(p => p.classList.remove('active'));
      const sectionId = this.dataset.section;
      document.getElementById(sectionId + 'Section').classList.add('active');
    });
  });

  loadApplications();
  loadSavedJobs();

  const profileForm = document.getElementById('profileForm');
  if (profileForm) {
    profileForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch('../controller/update_profile.php', {
        method: 'POST',
        body: formData
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          alert('Profile updated successfully!');
        } else {
          alert('Failed to update profile.');
        }
      });
    });
  }
});

function loadApplications() {
  fetch('../controller/job_api.php?action=applications')
    .then(r => r.json())
    .then(data => {
      const container = document.getElementById('applicationsList');
      if (data.success && data.applications.length > 0) {
        container.innerHTML = data.applications.map(app => `
          <div class="job-item">
            <div class="job-title">${escapeHtml(app.title)} at ${escapeHtml(app.company)}</div>
            <div class="job-status" style="color:${getStatusColor(app.status)};">${capitalize(app.status)}</div>
            <div class="job-date">${new Date(app.applied_at).toLocaleDateString()}</div>
          </div>
        `).join('');
        document.getElementById('appliedJobs').textContent = data.applications.length;
        document.getElementById('dashApplied').textContent = data.applications.length;
      } else {
        container.innerHTML = '<p>No applications yet. <a href="jobs.php">Browse jobs</a></p>';
      }
    });
}

function loadSavedJobs() {
  fetch('../controller/job_api.php?action=saved')
    .then(r => r.json())
    .then(data => {
      const container = document.getElementById('savedJobsList');
      if (data.success && data.jobs.length > 0) {
        container.innerHTML = data.jobs.map(job => `
          <div class="job-item">
            <div class="job-title">${escapeHtml(job.title)} at ${escapeHtml(job.company)}</div>
            <div class="job-status">Saved</div>
            <div class="job-date">${escapeHtml(job.location)}</div>
          </div>
        `).join('');
        document.getElementById('savedJobs').textContent = data.jobs.length;
        document.getElementById('dashSaved').textContent = data.jobs.length;
      } else {
        container.innerHTML = '<p>No saved jobs yet. <a href="jobs.php">Browse jobs</a></p>';
      }
    });
}

function getStatusColor(status) {
  const colors = {applied:'#1976D2', review:'#FF9800', interview:'#4CAF50', offer:'#9C27B0', rejected:'#f44336'};
  return colors[status] || '#666';
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function escapeHtml(text) {
  if (!text) return '';
  const d = document.createElement('div');
  d.textContent = text;
  return d.innerHTML;
}
