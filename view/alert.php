<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alerts - Employify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <nav class="section-nav" style="margin-top:80px;">
        <button onclick="showScreen('alert-preferences')" class="active">Alert Preferences</button>
        <button onclick="showScreen('notification-center')">Notification Center</button>
        <button onclick="showScreen('recommended-jobs')">Recommended Jobs</button>
    </nav>

    <section id="alert-preferences" class="active">
        <h2>Alert Preferences</h2>
        <form id="preferences-form">
            <label for="job-title">Job Title:</label>
            <input type="text" id="job-title" placeholder="e.g., Software Engineer">
            <label for="location">Location:</label>
            <input type="text" id="location" placeholder="e.g., Dhaka">
            <label for="job-type">Job Type:</label>
            <select id="job-type">
                <option value="">Select</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="contract">Contract</option>
            </select>
            <label for="notification-method">Notification Method:</label>
            <select id="notification-method">
                <option value="email">Email</option>
                <option value="app">App</option>
                <option value="both">Both</option>
            </select>
            <button type="submit">Save Preferences</button>
        </form>
        <div id="alertSuccess" style="display:none;background:#4CAF50;color:white;padding:10px;border-radius:5px;margin-top:10px;text-align:center;">Preferences saved!</div>
    </section>

    <section id="notification-center">
        <h2>Notification Center</h2>
        <article id="notifications">
            <p>No notifications yet.</p>
        </article>
    </section>

    <section id="recommended-jobs">
        <h2>Recommended Jobs</h2>
        <article id="jobs">
            <p>Complete your profile to get recommendations.</p>
        </article>
    </section>

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

    <script src="../assets/js/alert.js"></script>
</body>
</html>
