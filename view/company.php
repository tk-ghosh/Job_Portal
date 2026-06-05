<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profiles - Employify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/company.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="company-page" style="max-width:1200px;margin:100px auto 40px;padding:0 20px;">
        <h1 style="margin-bottom:30px;">Featured Companies</h1>
        <div class="companies-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
            <div class="company-card" style="background:white;padding:25px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);text-align:center;">
                <div style="font-size:3rem;color:#2196F3;margin-bottom:15px;"><i class="fas fa-building"></i></div>
                <h3>Tech Solutions</h3>
                <p style="color:#666;">Information Technology</p>
                <p style="color:#666;font-size:0.9em;">Dhaka, Bangladesh</p>
                <a href="company_profile.php?id=1" style="display:inline-block;margin-top:15px;padding:10px 20px;background:#2196F3;color:white;border-radius:5px;text-decoration:none;">View Profile</a>
            </div>
            <div class="company-card" style="background:white;padding:25px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);text-align:center;">
                <div style="font-size:3rem;color:#4CAF50;margin-bottom:15px;"><i class="fas fa-chart-line"></i></div>
                <h3>Finance Corp</h3>
                <p style="color:#666;">Finance</p>
                <p style="color:#666;font-size:0.9em;">Chittagong, Bangladesh</p>
                <a href="company_profile.php?id=2" style="display:inline-block;margin-top:15px;padding:10px 20px;background:#2196F3;color:white;border-radius:5px;text-decoration:none;">View Profile</a>
            </div>
            <div class="company-card" style="background:white;padding:25px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);text-align:center;">
                <div style="font-size:3rem;color:#FF9800;margin-bottom:15px;"><i class="fas fa-bullhorn"></i></div>
                <h3>Marketing Pro</h3>
                <p style="color:#666;">Marketing</p>
                <p style="color:#666;font-size:0.9em;">Sylhet, Bangladesh</p>
                <a href="company_profile.php?id=3" style="display:inline-block;margin-top:15px;padding:10px 20px;background:#2196F3;color:white;border-radius:5px;text-decoration:none;">View Profile</a>
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
