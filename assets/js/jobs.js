const jobList = document.getElementById('jobList');
const searchInput = document.getElementById('searchInput');
const locationFilter = document.getElementById('locationFilter');
const categoryFilter = document.getElementById('categoryFilter');
const experienceFilter = document.getElementById('experienceFilter');
const modal = document.getElementById('jobDetailsModal');
const loading = document.getElementById('loading');
let currentJobs = [];

function loadJobs(filters = {}) {
  if (loading) loading.style.display = 'block';
  if (jobList) jobList.innerHTML = '';

  const params = new URLSearchParams();
  params.set('action', 'list');
  if (filters.search) params.set('search', filters.search);
  if (filters.location) params.set('location', filters.location);
  if (filters.category) params.set('category', filters.category);
  if (filters.experience) params.set('experience', filters.experience);

  fetch('../controller/job_api.php?' + params.toString())
    .then(r => r.json())
    .then(data => {
      if (loading) loading.style.display = 'none';
      if (data.success && data.jobs.length > 0) {
        currentJobs = data.jobs;
        displayJobs(data.jobs);
      } else {
        jobList.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:40px;color:#666;"><i class="fas fa-search" style="font-size:2rem;display:block;margin-bottom:10px;"></i>No jobs found</div>';
      }
    })
    .catch(err => {
      if (loading) loading.style.display = 'none';
      jobList.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:40px;color:#f44336;">Error loading jobs. Please try again.</div>';
    });
}

function displayJobs(jobs) {
  jobList.innerHTML = '';
  jobs.forEach(job => {
    const card = document.createElement('div');
    card.className = 'job-card';
    card.innerHTML = `
      <div class="job-header">
        <h3>${escapeHtml(job.title)}</h3>
        <span>${escapeHtml(job.company)}</span>
      </div>
      <div class="job-info">
        <span>${escapeHtml(job.location)}</span>
        <span>${getCategoryName(job.category)}</span>
        <span>${getExperienceLevel(job.experience)}</span>
      </div>
      <div class="job-actions">
        <button class="apply-btn" onclick="event.stopPropagation();openApply(${job.id})">Apply Now</button>
        <button class="save-btn" onclick="event.stopPropagation();toggleSave(${job.id}, this)"><i class="fas fa-bookmark"></i> Save</button>
      </div>
    `;
    card.addEventListener('click', () => showJobDetails(job.id));
    jobList.appendChild(card);
  });
}

function showJobDetails(id) {
  const job = currentJobs.find(j => j.id == id);
  if (!job) return;
  document.getElementById('modalJobTitle').textContent = job.title;
  document.getElementById('modalJobDetails').innerHTML = `
    <h3>${escapeHtml(job.company)}</h3>
    <p><i class="fas fa-map-marker-alt"></i> ${escapeHtml(job.location)}</p>
    <p><strong>Type:</strong> ${job.type || 'Full Time'}</p>
    <p><strong>Experience:</strong> ${getExperienceLevel(job.experience)}</p>
    <hr style="margin:15px 0;">
    <h4>Description</h4>
    <p>${escapeHtml(job.description || 'No description provided.')}</p>
    <h4>Requirements</h4>
    <p>${escapeHtml(job.requirements || 'No specific requirements listed.')}</p>
    ${job.salary_range ? '<p><strong>Salary Range:</strong> ' + escapeHtml(job.salary_range) + '</p>' : ''}
  `;
  document.getElementById('modalApplyBtn').onclick = () => openApply(job.id);
  document.getElementById('modalSaveBtn').onclick = () => toggleSave(job.id, document.getElementById('modalSaveBtn'));
  modal.style.display = 'block';
}

function openApply(jobId) {
  const job = currentJobs.find(j => j.id == jobId);
  if (!job) return;
  if (!document.querySelector('.apply-modal')) {
    const m = document.createElement('div');
    m.className = 'apply-modal';
    m.innerHTML = `
      <div class="modal-content">
        <h2>Apply for ${escapeHtml(job.title)}</h2>
        <p>Are you sure you want to apply for this position at ${escapeHtml(job.company)}?</p>
        <div class="modal-actions">
          <button onclick="confirmApply(${jobId})">Confirm</button>
          <button onclick="closeApplyModal(this)">Cancel</button>
        </div>
      </div>
    `;
    document.body.appendChild(m);
  }
  if (modal) modal.style.display = 'none';
}

function confirmApply(jobId) {
  fetch('../controller/job_api.php?action=apply', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'job_id=' + jobId
  })
  .then(r => r.json())
  .then(data => {
    closeApplyModal(document.querySelector('.apply-modal'));
    if (data.success) {
      alert('Application submitted successfully!');
    } else if (data.message === 'Already applied') {
      alert('You have already applied for this job.');
    } else {
      alert(data.message || 'Please login as an applicant to apply.');
    }
  });
}

function closeApplyModal(el) {
  if (el) el.remove();
}

function toggleSave(jobId, btn) {
  const action = btn.classList.contains('saved') ? 'unsave' : 'save';
  fetch('../controller/job_api.php?action=' + action, {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'job_id=' + jobId
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      btn.classList.toggle('saved');
      if (action === 'save') {
        btn.innerHTML = '<i class="fas fa-check"></i> Saved';
        btn.style.backgroundColor = '#4CAF50';
      } else {
        btn.innerHTML = '<i class="fas fa-bookmark"></i> Save';
        btn.style.backgroundColor = '';
      }
    } else {
      alert('Please login to save jobs');
    }
  });
}

function filterJobs() {
  const filters = {};
  if (searchInput && searchInput.value) filters.search = searchInput.value.trim();
  if (locationFilter && locationFilter.value) filters.location = locationFilter.value;
  if (categoryFilter && categoryFilter.value) filters.category = categoryFilter.value;
  if (experienceFilter && experienceFilter.value) filters.experience = experienceFilter.value;
  loadJobs(filters);
}

function getCategoryName(cat) {
  const map = {it:'IT', finance:'Finance', marketing:'Marketing', design:'Design'};
  return map[cat] || cat;
}

function getExperienceLevel(level) {
  const map = {entry:'Entry Level', mid:'Mid Level', senior:'Senior Level'};
  return map[level] || level;
}

function escapeHtml(text) {
  if (!text) return '';
  const d = document.createElement('div');
  d.textContent = text;
  return d.innerHTML;
}

if (document.getElementById('searchBtn')) {
  document.getElementById('searchBtn').addEventListener('click', filterJobs);
}
if (searchInput) {
  searchInput.addEventListener('keyup', function(e) { if (e.key === 'Enter') filterJobs(); });
  searchInput.addEventListener('input', filterJobs);
}
if (locationFilter) locationFilter.addEventListener('change', filterJobs);
if (categoryFilter) categoryFilter.addEventListener('change', filterJobs);
if (experienceFilter) experienceFilter.addEventListener('change', filterJobs);

const resetBtn = document.getElementById('resetFilters');
if (resetBtn) {
  resetBtn.addEventListener('click', function() {
    if (searchInput) searchInput.value = '';
    if (locationFilter) locationFilter.value = '';
    if (categoryFilter) categoryFilter.value = '';
    if (experienceFilter) experienceFilter.value = '';
    loadJobs({});
  });
}

document.querySelector('.close')?.addEventListener('click', () => { modal.style.display = 'none'; });
window.addEventListener('click', (e) => { if (e.target === modal) modal.style.display = 'none'; });

loadJobs();
