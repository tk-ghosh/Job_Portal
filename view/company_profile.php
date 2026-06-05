<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/company-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="company-profile" style="max-width:1200px;margin:100px auto 40px;padding:0 20px;">
        <div class="company-banner" style="background:linear-gradient(135deg,#2196F3,#1976D2);color:white;padding:40px;border-radius:15px;margin-bottom:30px;">
            <div class="company-info" style="display:flex;align-items:center;gap:30px;">
                <div class="company-logo" style="width:100px;height:100px;background:white;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-building" style="font-size:3rem;color:#2196F3;"></i>
                </div>
                <div class="company-details">
                    <h1 class="company-name" style="font-size:2rem;">Tech Solutions</h1>
                    <div class="company-stats" style="display:flex;gap:20px;margin-top:10px;">
                        <span><i class="fas fa-users"></i> 500+ Employees</span>
                        <span><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</span>
                        <span><i class="fas fa-star"></i> 4.5 Rating</span>
                    </div>
                </div>
            </div>
        </div>

        <section class="company-overview" style="background:white;padding:30px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);margin-bottom:30px;">
            <h2>Company Overview</h2>
            <p style="color:#666;line-height:1.8;">Tech Solutions is a leading technology company dedicated to delivering innovative software solutions. We specialize in web development, mobile applications, and enterprise software. Our team of talented professionals works together to create products that make a difference.</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:20px;">
                <div style="text-align:center;padding:15px;background:#f8f9fa;border-radius:8px;">
                    <h3 style="color:#2196F3;">Industry</h3>
                    <p style="color:#666;">Information Technology</p>
                </div>
                <div style="text-align:center;padding:15px;background:#f8f9fa;border-radius:8px;">
                    <h3 style="color:#2196F3;">Founded</h3>
                    <p style="color:#666;">2015</p>
                </div>
                <div style="text-align:center;padding:15px;background:#f8f9fa;border-radius:8px;">
                    <h3 style="color:#2196F3;">Website</h3>
                    <p style="color:#666;">techsolutions.com</p>
                </div>
            </div>
        </section>

        <section class="open-positions" style="background:white;padding:30px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);">
            <h2>Open Positions</h2>
            <div class="job-list" style="display:grid;gap:15px;">
                <div style="padding:20px;border:1px solid #eee;border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <h3>Senior Software Engineer</h3>
                        <p style="color:#666;">Full Time - Dhaka</p>
                    </div>
                    <a href="jobs.php" style="padding:10px 20px;background:#2196F3;color:white;border-radius:5px;text-decoration:none;">Apply Now</a>
                </div>
                <div style="padding:20px;border:1px solid #eee;border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                    <div>
                        <h3>Frontend Developer</h3>
                        <p style="color:#666;">Full Time - Remote</p>
                    </div>
                    <a href="jobs.php" style="padding:10px 20px;background:#2196F3;color:white;border-radius:5px;text-decoration:none;">Apply Now</a>
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
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@employify.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
