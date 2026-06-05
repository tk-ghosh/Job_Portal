<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit();
}
require_once '../model/user_model.php';
$user = getUserById($_SESSION['user_id'], $_SESSION['user_type']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css" />
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="main-content">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:20px;">
            <div class="profile-container" style="padding-top:80px;">
                <div class="profile-header">
                    <div class="profile-image">
                        <img src="../assets/image/default-avatar.png" alt="Profile" id="profilePic" onerror="this.src='https://via.placeholder.com/150?text=User'">
                    </div>
                    <div class="profile-info">
                        <h1 id="userName"><?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?></h1>
                        <p id="userRole"><?php echo ucfirst($_SESSION['user_type']); ?></p>
                        <div class="profile-stats">
                            <div class="stat-item">
                                <span class="stat-number" id="appliedJobs">0</span>
                                <span class="stat-label">Applied Jobs</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number" id="savedJobs">0</span>
                                <span class="stat-label">Saved Jobs</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="profile-sidebar">
                        <div class="sidebar-section active" data-section="dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></div>
                        <div class="sidebar-section" data-section="profile"><i class="fas fa-user"></i> <span>Profile</span></div>
                        <div class="sidebar-section" data-section="applications"><i class="fas fa-file-alt"></i> <span>Applications</span></div>
                        <div class="sidebar-section" data-section="saved"><i class="fas fa-heart"></i> <span>Saved Jobs</span></div>
                    </div>

                    <div class="profile-main">
                        <div class="profile-section active" id="dashboardSection">
                            <h2>Dashboard</h2>
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">
                                <div style="background:#e3f2fd;padding:25px;border-radius:10px;text-align:center;">
                                    <h3 style="font-size:2rem;color:#1976D2;" id="dashApplied">0</h3>
                                    <p>Applications</p>
                                </div>
                                <div style="background:#fff3e0;padding:25px;border-radius:10px;text-align:center;">
                                    <h3 style="font-size:2rem;color:#ff9800;" id="dashSaved">0</h3>
                                    <p>Saved Jobs</p>
                                </div>
                            </div>
                        </div>

                        <div class="profile-section" id="profileSection">
                            <h2>Profile Information</h2>
                            <form class="profile-form" id="profileForm">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="<?php echo htmlspecialchars($user['Email'] ?? ''); ?>" disabled style="background:#f5f5f5;">
                                </div>
                                <?php if ($_SESSION['user_type'] === 'applicant'): ?>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['First_Name'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['Last_Name'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['Phone'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo htmlspecialchars($user['Address'] ?? ''); ?>">
                                </div>
                                <?php else: ?>
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" value="<?php echo htmlspecialchars($user['Company_Name'] ?? ''); ?>" disabled style="background:#f5f5f5;">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" value="<?php echo htmlspecialchars($user['Phone'] ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Industry</label>
                                    <input type="text" value="<?php echo htmlspecialchars($user['Industry'] ?? ''); ?>" disabled style="background:#f5f5f5;">
                                </div>
                                <?php endif; ?>
                                <button type="submit" class="save-btn">Save Changes</button>
                            </form>
                        </div>

                        <div class="profile-section" id="applicationsSection">
                            <h2>My Applications</h2>
                            <div id="applicationsList"><p>Loading...</p></div>
                        </div>

                        <div class="profile-section" id="savedSection">
                            <h2>Saved Jobs</h2>
                            <div id="savedJobsList"><p>Loading...</p></div>
                        </div>
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

    <script src="../assets/js/profile.js"></script>
</body>
</html>
