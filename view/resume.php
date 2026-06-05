<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Builder - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/resume.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main style="max-width:1200px;margin:100px auto 2rem;padding:0 1rem;">
        <section id="progressSection">
            <h3>Profile Completeness</h3>
            <progress id="progressBar" value="0" max="100"></progress>
            <p id="progressText">0% Complete</p>
            <p>Complete your profile to improve your visibility!</p>
        </section>

        <section id="builderSection">
            <h3>Resume Builder</h3>
            <form id="resumeForm">
                <p>
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" placeholder="John Doe" required>
                    <span id="fullNameError" class="error"></span>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="john.doe@example.com" required>
                    <span id="emailError" class="error"></span>
                </p>
                <p>
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" placeholder="+880 123 456 789">
                    <span id="phoneError" class="error"></span>
                </p>
                <p>
                    <label for="experience">Work Experience</label>
                    <textarea id="experience" rows="4" placeholder="Describe your work experience..."></textarea>
                    <span id="experienceError" class="error"></span>
                </p>
                <p>
                    <label for="education">Education</label>
                    <textarea id="education" rows="4" placeholder="List your education..."></textarea>
                    <span id="educationError" class="error"></span>
                </p>
                <p>
                    <label for="skills">Skills</label>
                    <textarea id="skills" rows="3" placeholder="List your key skills..."></textarea>
                </p>
                <button type="submit">Save Resume</button>
            </form>
            <div id="resumeSuccess" style="display:none;background:#4CAF50;color:white;padding:10px;border-radius:5px;margin-top:15px;text-align:center;">Resume saved successfully!</div>
        </section>

        <section id="uploaderSection">
            <h3>Upload Existing Resume</h3>
            <p id="dropZone">Drag and drop your resume (PDF/DOC) here or click to upload</p>
            <input type="file" id="resumeFile" accept=".pdf,.doc,.docx">
            <p id="uploadStatus"></p>
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

    <script src="../assets/js/resume.js"></script>
</body>
</html>
