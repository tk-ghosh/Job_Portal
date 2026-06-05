<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['user_type'] !== 'employer') {
    header('Location: login.php');
    exit();
}
$name = $_SESSION['name'];
$initial = strtoupper(substr($name, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Employify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="dashboard-layout">
        <aside class="dashboard-sidebar" id="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-briefcase" style="font-size:1.5rem;color:var(--primary-light);"></i>
                <h2>Employify</h2>
            </div>
            <div class="sidebar-user">
                <div class="sidebar-avatar"><?php echo $initial; ?></div>
                <div class="sidebar-user-info">
                    <h4><?php echo htmlspecialchars($name); ?></h4>
                    <span>Employer</span>
                </div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">Main</div>
                <a href="#" class="active" data-page="overview"><i class="fas fa-th-large"></i> Overview</a>
                <a href="#" data-page="jobs"><i class="fas fa-list"></i> My Jobs</a>
                <a href="#" data-page="add-job"><i class="fas fa-plus-circle"></i> Post New Job</a>
                <div class="nav-section">Applicants</div>
                <a href="#" data-page="applicants"><i class="fas fa-users"></i> All Applicants</a>
                <div class="nav-section">Settings</div>
                <a href="home.php"><i class="fas fa-globe"></i> View Site</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <button class="mobile-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>

            <!-- Overview Page -->
            <div class="page active" id="page-overview">
                <div class="dashboard-header">
                    <div>
                        <h1>Welcome back, <?php echo htmlspecialchars($name); ?></h1>
                        <p class="header-subtitle">Here's what's happening with your job listings.</p>
                    </div>
                    <div class="header-actions">
                        <a href="#" class="btn btn-primary" onclick="navigateTo('add-job')"><i class="fas fa-plus"></i> Post New Job</a>
                    </div>
                </div>
                <div class="stats-grid" id="statsGrid">
                    <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-briefcase"></i></div><div class="stat-info"><h3 id="statTotal">0</h3><p>Total Jobs</p></div></div>
                    <div class="stat-card"><div class="stat-icon green"><i class="fas fa-check-circle"></i></div><div class="stat-info"><h3 id="statActive">0</h3><p>Active Jobs</p></div></div>
                    <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-users"></i></div><div class="stat-info"><h3 id="statApplicants">0</h3><p>Total Applicants</p></div></div>
                </div>
                <div class="card">
                    <div class="card-header"><h2><i class="fas fa-clock" style="color:var(--primary);margin-right:8px;"></i> Recent Jobs</h2><a href="#" class="btn btn-sm btn-secondary" onclick="navigateTo('jobs')">View All</a></div>
                    <div id="recentJobsList"><div class="empty-state"><i class="fas fa-briefcase"></i><h3>No jobs posted yet</h3><p>Post your first job to start receiving applications.</p><a href="#" class="btn btn-primary" onclick="navigateTo('add-job')">Post a Job</a></div></div>
                </div>
            </div>

            <!-- My Jobs Page -->
            <div class="page" id="page-jobs">
                <div class="dashboard-header">
                    <div>
                        <h1>My Jobs</h1>
                        <p class="header-subtitle">Manage all your job listings.</p>
                    </div>
                    <div class="header-actions">
                        <a href="#" class="btn btn-primary" onclick="navigateTo('add-job')"><i class="fas fa-plus"></i> Post New Job</a>
                    </div>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Applicants</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="jobsTableBody">
                                <tr><td colspan="7"><div class="empty-state"><i class="fas fa-briefcase"></i><h3>No jobs yet</h3></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add/Edit Job Page -->
            <div class="page" id="page-add-job">
                <div class="dashboard-header">
                    <div>
                        <h1 id="jobFormTitle">Post New Job</h1>
                        <p class="header-subtitle">Fill in the details below to create a job listing.</p>
                    </div>
                </div>
                <div class="card">
                    <form id="jobForm" onsubmit="return saveJob(event)">
                        <input type="hidden" name="id" id="jobId" value="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="title">Job Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required placeholder="e.g. Senior Software Engineer">
                            </div>
                            <div class="form-group">
                                <label for="location">Location *</label>
                                <input type="text" class="form-control" id="location" name="location" required placeholder="e.g. Dhaka, Remote">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="category">Category *</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="it">Information Technology</option>
                                    <option value="finance">Finance</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="design">Design</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="education">Education</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="experience">Experience Level *</label>
                                <select class="form-control" id="experience" name="experience" required>
                                    <option value="">Select Experience</option>
                                    <option value="entry">Entry Level</option>
                                    <option value="mid">Mid Level</option>
                                    <option value="senior">Senior Level</option>
                                    <option value="lead">Lead / Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="type">Employment Type *</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Remote">Remote</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary_range">Salary Range</label>
                                <input type="text" class="form-control" id="salary_range" name="salary_range" placeholder="e.g. 50000-80000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Job Description *</label>
                            <textarea class="form-control" id="description" name="description" required placeholder="Describe the role, responsibilities, and what makes this opportunity great..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="requirements">Requirements</label>
                            <textarea class="form-control" id="requirements" name="requirements" placeholder="List key requirements, skills, and qualifications..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="navigateTo('jobs')">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="jobSubmitBtn"><i class="fas fa-check"></i> Post Job</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Applicants Page -->
            <div class="page" id="page-applicants">
                <div class="dashboard-header">
                    <div>
                        <h1>All Applicants</h1>
                        <p class="header-subtitle">View applicants for your jobs.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group" style="max-width:300px;">
                        <label>Filter by Job</label>
                        <select class="form-control" id="applicantJobFilter" onchange="loadApplicants()">
                            <option value="">All Jobs</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Applicant</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Job</th>
                                    <th>Applied</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="applicantsTableBody">
                                <tr><td colspan="7"><div class="empty-state"><i class="fas fa-users"></i><h3>No applicants yet</h3></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- View Applicant Modal -->
    <div class="modal-overlay" id="applicantModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Applicant Details</h2>
                <button class="modal-close" onclick="closeModal('applicantModal')">&times;</button>
            </div>
            <div id="applicantDetailContent"></div>
        </div>
    </div>

    <!-- View Job Modal -->
    <div class="modal-overlay" id="jobDetailModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 id="detailJobTitle">Job Details</h2>
                <button class="modal-close" onclick="closeModal('jobDetailModal')">&times;</button>
            </div>
            <div id="jobDetailContent"></div>
        </div>
    </div>

    <script>
        const API = '../controller/employer_job_api.php';

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }
        document.getElementById('sidebarOverlay')?.addEventListener('click', toggleSidebar);

        function navigateTo(page) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));
            document.querySelector(`.sidebar-nav a[data-page="${page}"]`)?.classList.add('active');
            document.getElementById('page-' + page)?.classList.add('active');
            if (page === 'add-job') {
                document.getElementById('jobFormTitle').textContent = 'Post New Job';
                document.getElementById('jobId').value = '';
                document.getElementById('jobForm').reset();
                document.getElementById('jobSubmitBtn').innerHTML = '<i class="fas fa-check"></i> Post Job';
            }
            if (page === 'overview') loadStats();
            if (page === 'jobs') loadJobs();
            if (page === 'applicants') loadApplicants();
            if (window.innerWidth <= 768) toggleSidebar();
        }

        function loadStats() {
            fetch(API + '?action=stats').then(r => r.json()).then(d => {
                if (d.success) {
                    document.getElementById('statTotal').textContent = d.totalJobs;
                    document.getElementById('statActive').textContent = d.activeJobs;
                    document.getElementById('statApplicants').textContent = d.totalApplicants;
                }
            });
            fetch(API + '?action=list').then(r => r.json()).then(d => {
                const container = document.getElementById('recentJobsList');
                if (d.success && d.jobs.length > 0) {
                    container.innerHTML = d.jobs.slice(0, 5).map(j => `
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid var(--border);">
                            <div>
                                <strong style="font-size:0.95rem;">${esc(j.title)}</strong>
                                <p style="font-size:0.8rem;color:var(--text-secondary);margin-top:2px;">${esc(j.location)} &middot; <span class="badge badge-${j.type === 'Full Time' ? 'fulltime' : j.type === 'Part Time' ? 'parttime' : 'contract'}">${esc(j.type)}</span></p>
                            </div>
                            <span class="badge ${j.status === 'active' ? 'badge-active' : 'badge-closed'}">${j.status}</span>
                        </div>
                    `).join('');
                }
            });
        }

        function loadJobs() {
            fetch(API + '?action=list').then(r => r.json()).then(d => {
                const tbody = document.getElementById('jobsTableBody');
                if (d.success && d.jobs.length > 0) {
                    const filterSelect = document.getElementById('applicantJobFilter');
                    filterSelect.innerHTML = '<option value="">All Jobs</option>' + d.jobs.map(j => `<option value="${j.id}">${esc(j.title)}</option>`).join('');
                    tbody.innerHTML = d.jobs.map(j => `
                        <tr>
                            <td class="job-title-cell">${esc(j.title)}</td>
                            <td class="company-cell">${esc(j.location)}</td>
                            <td><span class="badge badge-${j.type === 'Full Time' ? 'fulltime' : j.type === 'Part Time' ? 'parttime' : 'contract'}">${esc(j.type)}</span></td>
                            <td>${esc(j.category)}</td>
                            <td><a href="#" onclick="navigateTo('applicants');return false;" style="color:var(--primary);font-weight:600;">View</a></td>
                            <td><span class="badge ${j.status === 'active' ? 'badge-active' : 'badge-closed'}" id="status-${j.id}">${j.status}</span></td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <button class="btn btn-sm btn-secondary" onclick="viewJob(${j.id})" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-secondary" onclick="editJob(${j.id})" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm ${j.status === 'active' ? 'btn-secondary' : 'btn-success'}" onclick="toggleStatus(${j.id},'${j.status === 'active' ? 'closed' : 'active'}')" title="${j.status === 'active' ? 'Close' : 'Activate'}">
                                        ${j.status === 'active' ? '<i class="fas fa-times"></i>' : '<i class="fas fa-check"></i>'}
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteJob(${j.id})" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    `).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="7"><div class="empty-state"><i class="fas fa-briefcase"></i><h3>No jobs posted yet</h3><p>Click "Post New Job" to create your first listing.</p></div></td></tr>';
                }
            });
        }

        function viewJob(id) {
            fetch(API + '?action=detail&id=' + id).then(r => r.json()).then(d => {
                if (d.success) {
                    const j = d.job;
                    document.getElementById('detailJobTitle').textContent = j.title;
                    document.getElementById('jobDetailContent').innerHTML = `
                        <div class="job-detail-label">Company</div><div class="job-detail-value">${esc(j.company)}</div>
                        <div class="job-detail-label">Location</div><div class="job-detail-value"><i class="fas fa-map-marker-alt" style="color:var(--primary);margin-right:6px;"></i>${esc(j.location)}</div>
                        <div class="job-detail-label">Type</div><div class="job-detail-value"><span class="badge badge-${j.type === 'Full Time' ? 'fulltime' : 'parttime'}">${esc(j.type)}</span></div>
                        <div class="job-detail-label">Category</div><div class="job-detail-value">${esc(j.category)}</div>
                        <div class="job-detail-label">Experience</div><div class="job-detail-value">${esc(j.experience)}</div>
                        ${j.salary_range ? '<div class="job-detail-label">Salary Range</div><div class="job-detail-value">' + esc(j.salary_range) + '</div>' : ''}
                        <div class="job-detail-label">Status</div><div class="job-detail-value"><span class="badge ${j.status === 'active' ? 'badge-active' : 'badge-closed'}">${j.status}</span></div>
                        <div class="job-detail-label">Description</div><div class="job-detail-value" style="white-space:pre-wrap;">${esc(j.description)}</div>
                        ${j.requirements ? '<div class="job-detail-label">Requirements</div><div class="job-detail-value" style="white-space:pre-wrap;">' + esc(j.requirements) + '</div>' : ''}
                        <div class="job-detail-label">Posted</div><div class="job-detail-value">${new Date(j.created_at).toLocaleDateString()}</div>
                    `;
                    openModal('jobDetailModal');
                }
            });
        }

        function editJob(id) {
            fetch(API + '?action=detail&id=' + id).then(r => r.json()).then(d => {
                if (d.success) {
                    const j = d.job;
                    document.getElementById('jobFormTitle').textContent = 'Edit Job';
                    document.getElementById('jobId').value = j.id;
                    document.getElementById('title').value = j.title;
                    document.getElementById('location').value = j.location;
                    document.getElementById('category').value = j.category;
                    document.getElementById('experience').value = j.experience;
                    document.getElementById('type').value = j.type;
                    document.getElementById('salary_range').value = j.salary_range || '';
                    document.getElementById('description').value = j.description;
                    document.getElementById('requirements').value = j.requirements || '';
                    document.getElementById('jobSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Update Job';
                    navigateTo('add-job');
                }
            });
        }

        function saveJob(e) {
            e.preventDefault();
            const id = document.getElementById('jobId').value;
            const action = id ? 'update' : 'create';
            const formData = new FormData(document.getElementById('jobForm'));
            if (id) formData.set('id', id);

            fetch(API + '?action=' + action, { method: 'POST', body: new URLSearchParams(formData) })
                .then(r => r.json()).then(d => {
                    if (d.success) {
                        showToast(action === 'create' ? 'Job posted successfully!' : 'Job updated successfully!', 'success');
                        navigateTo('jobs');
                        loadStats();
                    } else {
                        showToast('Failed to save job', 'error');
                    }
                });
            return false;
        }

        function toggleStatus(id, status) {
            if (!confirm('Are you sure you want to ' + status + ' this job?')) return;
            fetch(API + '?action=toggle_status', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'id=' + id + '&status=' + status })
                .then(r => r.json()).then(d => {
                    if (d.success) { showToast('Job ' + status + '!', 'success'); loadJobs(); loadStats(); }
                });
        }

        function deleteJob(id) {
            if (!confirm('Delete this job permanently?')) return;
            fetch(API + '?action=delete', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'id=' + id })
                .then(r => r.json()).then(d => {
                    if (d.success) { showToast('Job deleted!', 'success'); loadJobs(); loadStats(); }
                });
        }

        function loadApplicants() {
            const filter = document.getElementById('applicantJobFilter')?.value || '';
            let url = API + '?action=applicants';
            if (filter) url += '&job_id=' + filter;
            fetch(url).then(r => r.json()).then(d => {
                const tbody = document.getElementById('applicantsTableBody');
                if (d.success && d.applicants?.length > 0) {
                    tbody.innerHTML = d.applicants.map(a => `
                        <tr>
                            <td><strong>${esc(a.First_Name)} ${esc(a.Last_Name)}</strong></td>
                            <td>${esc(a.Email)}</td>
                            <td>${esc(a.Phone || 'N/A')}</td>
                            <td style="font-size:0.85rem;">Job #${a.job_id}</td>
                            <td style="font-size:0.85rem;color:var(--text-secondary);">${new Date(a.applied_at).toLocaleDateString()}</td>
                            <td><span class="badge badge-${a.status === 'applied' ? 'pending' : a.status === 'interview' ? 'active' : a.status === 'offer' ? 'success' : 'closed'}" id="appStatus-${a.id}">${a.status}</span></td>
                            <td>
                                <select class="form-control" style="width:auto;padding:4px 8px;font-size:0.8rem;" onchange="updateAppStatus(${a.id}, this.value)">
                                    <option value="applied" ${a.status === 'applied' ? 'selected' : ''}>Applied</option>
                                    <option value="review" ${a.status === 'review' ? 'selected' : ''}>Review</option>
                                    <option value="interview" ${a.status === 'interview' ? 'selected' : ''}>Interview</option>
                                    <option value="offer" ${a.status === 'offer' ? 'selected' : ''}>Offer</option>
                                    <option value="rejected" ${a.status === 'rejected' ? 'selected' : ''}>Rejected</option>
                                </select>
                            </td>
                        </tr>
                    `).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="7"><div class="empty-state"><i class="fas fa-users"></i><h3>No applicants yet</h3><p>When applicants apply for your jobs, they will appear here.</p></div></td></tr>';
                }
            });
        }

        function updateAppStatus(id, status) {
            fetch(API + '?action=update_status', { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'}, body: 'application_id=' + id + '&status=' + status })
                .then(r => r.json()).then(d => {
                    if (d.success) { showToast('Status updated!', 'success'); loadApplicants(); }
                });
        }

        function openModal(id) { document.getElementById(id).classList.add('active'); }
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        function showToast(msg, type) {
            const t = document.createElement('div');
            t.className = 'toast toast-' + type;
            t.innerHTML = (type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>') + ' ' + msg;
            document.body.appendChild(t);
            setTimeout(() => { t.style.opacity = '0'; t.style.transition = 'opacity 0.3s'; setTimeout(() => t.remove(), 300); }, 3000);
        }

        function esc(s) { if (!s) return ''; const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
            document.querySelectorAll('.sidebar-nav a[data-page]').forEach(a => {
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    navigateTo(this.dataset.page);
                });
            });
        });
    </script>
</body>
</html>
