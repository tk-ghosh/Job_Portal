<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Jobs - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/jobs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="job-container" style="margin-top:80px;">
        <div class="job-header">
            <h1>Job Listings</h1>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search jobs...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="filters">
            <div class="filter-group">
                <label>Location:</label>
                <select id="locationFilter">
                    <option value="">All Locations</option>
                    <option value="dhaka">Dhaka</option>
                    <option value="chittagong">Chittagong</option>
                    <option value="sylhet">Sylhet</option>
                    <option value="remote">Remote</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Category:</label>
                <select id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="it">Information Technology</option>
                    <option value="finance">Finance</option>
                    <option value="marketing">Marketing</option>
                    <option value="design">Design</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Experience:</label>
                <select id="experienceFilter">
                    <option value="">All Levels</option>
                    <option value="entry">Entry Level</option>
                    <option value="mid">Mid Level</option>
                    <option value="senior">Senior Level</option>
                </select>
            </div>
            <div class="filter-group reset-group">
                <button id="resetFilters" class="reset-btn"><i class="fas fa-sync-alt"></i> Reset Filters</button>
            </div>
        </div>

        <div id="loading" style="text-align:center;padding:40px;display:none;">
            <i class="fas fa-spinner fa-spin" style="font-size:2rem;color:#2196F3;"></i>
            <p>Loading jobs...</p>
        </div>
        <div class="job-list" id="jobList"></div>
    </div>

    <div id="jobDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalJobTitle"></h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body" id="modalJobDetails"></div>
            <div class="modal-actions" style="display:flex;gap:10px;justify-content:center;margin-top:20px;">
                <button id="modalApplyBtn" class="apply-btn" style="max-width:200px;">Apply Now</button>
                <button id="modalSaveBtn" class="save-btn" style="max-width:200px;"><i class="fas fa-bookmark"></i> Save</button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Employify</h3>
                <p>Find your dream job with Employify.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="jobs.php">Find a Job</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@employify.com</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/jobs.js"></script>
</body>
</html>
