<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <section class="about-section" style="padding-top:100px;">
            <div class="about-header">
                <h1>About Employify</h1>
                <p>Connecting talented professionals with their dream careers since 2025</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-search"></i>
                    <h3>Smart Job Search</h3>
                    <p>Our advanced search algorithm helps you find the perfect job match based on your skills and preferences.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-file-alt"></i>
                    <h3>Resume Builder</h3>
                    <p>Create professional resumes with our easy-to-use builder and stand out to employers.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell"></i>
                    <h3>Job Alerts</h3>
                    <p>Never miss an opportunity with personalized job alerts that match your career goals.</p>
                </div>
            </div>
            <div class="mission-vision">
                <h2>Our Mission &amp; Vision</h2>
                <div class="mission-vision-content">
                    <div class="mission">
                        <h3>Our Mission</h3>
                        <p>To empower job seekers and employers with innovative tools that make the hiring process more efficient.</p>
                    </div>
                    <div class="vision">
                        <h3>Our Vision</h3>
                        <p>To become the leading job portal that transforms how people find meaningful careers.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
</body>
</html>
