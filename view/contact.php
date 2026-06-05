<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="main-content">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:100px 20px 40px;">
            <div class="contact-section">
                <div class="contact-header">
                    <h1>Contact Us</h1>
                    <p>Get in touch with us for any inquiries or support</p>
                </div>
                <div class="contact-content">
                    <div class="contact-info">
                        <div class="info-card">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-details">
                                <h3>Our Location</h3>
                                <p>3/4/a Ecb chattor<br>Dhaka, Bangladesh 1205</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-phone"></i>
                            <div class="info-details">
                                <h3>Phone</h3>
                                <p>+880 123 456 7890</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-envelope"></i>
                            <div class="info-details">
                                <h3>Email</h3>
                                <p>contact@employify.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <?php if (isset($_SESSION['contact_success'])): ?>
                            <div style="background:#4CAF50;color:white;padding:10px;border-radius:5px;margin-bottom:15px;"><?php echo $_SESSION['contact_success']; unset($_SESSION['contact_success']); ?></div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['contact_error'])): ?>
                            <div style="background:#f44336;color:white;padding:10px;border-radius:5px;margin-bottom:15px;"><?php echo $_SESSION['contact_error']; unset($_SESSION['contact_error']); ?></div>
                        <?php endif; ?>
                        <form id="contactForm" class="form" action="../controller/contact_submit.php" method="POST">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select Subject</option>
                                    <option value="job">Job Inquiry</option>
                                    <option value="support">Support</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Send Message</button>
                        </form>
                        <div id="contactMessage" style="display:none;padding:10px;border-radius:5px;margin-top:15px;"></div>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="../assets/js/contact.js"></script>
</body>
</html>
