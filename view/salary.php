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
    <title>Salary Estimator - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/salary.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="margin-top:100px;">
        <h1>Salary Range Estimator</h1>
        <div class="tab">
            <button class="tablink active" onclick="openSection('estimator')">Compensation Estimator</button>
            <button class="tablink" onclick="openSection('comparison')">Role Comparison Tool</button>
            <button class="tablink" onclick="openSection('benefits')">Benefits Breakdown</button>
        </div>

        <div id="estimator" class="section active">
            <h2>Compensation Estimator</h2>
            <div class="form-group">
                <label for="position">Position</label>
                <select id="position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <select id="location">
                    <option value="dhaka">Dhaka</option>
                    <option value="chittagong">Chittagong</option>
                    <option value="remote">Remote</option>
                </select>
            </div>
            <button onclick="estimateSalary()">Estimate Salary</button>
            <div id="estimator-result" class="result"></div>
        </div>

        <div id="comparison" class="section">
            <h2>Role Comparison Tool</h2>
            <div class="form-group">
                <label for="offer1-position">Offer 1: Position</label>
                <select id="offer1-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="offer1-salary">Offer 1: Base Salary ($)</label>
                <input type="number" id="offer1-salary" placeholder="Enter base salary">
            </div>
            <div class="form-group">
                <label for="offer1-bonus">Offer 1: Bonus ($)</label>
                <input type="number" id="offer1-bonus" placeholder="Enter bonus">
            </div>
            <div class="form-group">
                <label for="offer2-position">Offer 2: Position</label>
                <select id="offer2-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="offer2-salary">Offer 2: Base Salary ($)</label>
                <input type="number" id="offer2-salary" placeholder="Enter base salary">
            </div>
            <div class="form-group">
                <label for="offer2-bonus">Offer 2: Bonus ($)</label>
                <input type="number" id="offer2-bonus" placeholder="Enter bonus">
            </div>
            <button onclick="compareOffers()">Compare Offers</button>
            <table id="comparison-table" class="comparison-table" style="display:none;">
                <thead><tr><th>Offer</th><th>Position</th><th>Base Salary</th><th>Bonus</th><th>Total</th></tr></thead>
                <tbody id="comparison-result"></tbody>
            </table>
        </div>

        <div id="benefits" class="section">
            <h2>Benefits Breakdown</h2>
            <div class="form-group">
                <label for="benefits-position">Position</label>
                <select id="benefits-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <button onclick="showBenefits()">Show Benefits</button>
            <ul id="benefits-list" class="benefits-list"></ul>
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

    <script src="../assets/js/salary.js"></script>
</body>
</html>
