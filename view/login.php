<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Employify</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <div class="welcome-section">
            <h2>Welcome to Employify</h2>
            <p>Please sign in to continue</p>
        </div>
        <?php if (isset($_SESSION['success'])): ?>
            <div style="background:#4CAF50;color:white;padding:10px;border-radius:5px;margin-bottom:15px;text-align:center;">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div style="background:#f44336;color:white;padding:10px;border-radius:5px;margin-bottom:15px;text-align:center;">
                <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
            </div>
        <?php endif; ?>
        <div class="login-options">
            <button class="login-option active" data-type="applicant">Applicant Login</button>
            <button class="login-option" data-type="employer">Employer Login</button>
        </div>
        <div class="login-panels">
            <div class="login-panel active" id="applicantLogin">
                <form action="../controller/logincheck.php" method="POST">
                    <input type="hidden" name="user_type" value="applicant">
                    <div class="input-group">
                        <label for="applicantEmail"><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" id="applicantEmail" name="email" required>
                        <div class="validation-message" style="color:red;font-size:12px;display:none;"></div>
                    </div>
                    <div class="input-group">
                        <label for="applicantPassword"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="applicantPassword" name="password" required>
                        <div class="validation-message" style="color:red;font-size:12px;display:none;"></div>
                    </div>
                    <div class="form-actions">
                        <a href="forgetpass.php" class="password-reset-link">Forgot Password?</a>
                        <button type="submit" class="submit-button" name="submit">Login as Applicant</button>
                    </div>
                </form>
            </div>
            <div class="login-panel" id="employerLogin">
                <form action="../controller/logincheck.php" method="POST">
                    <input type="hidden" name="user_type" value="employer">
                    <div class="input-group">
                        <label for="employerEmail"><i class="fas fa-envelope"></i> Company Email</label>
                        <input type="email" id="employerEmail" name="email" required>
                        <div class="validation-message" style="color:red;font-size:12px;display:none;"></div>
                    </div>
                    <div class="input-group">
                        <label for="employerPassword"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" id="employerPassword" name="password" required>
                        <div class="validation-message" style="color:red;font-size:12px;display:none;"></div>
                    </div>
                    <div class="form-actions">
                        <a href="forgetpass.php" class="password-reset-link">Forgot Password?</a>
                        <button type="submit" class="submit-button" name="submit">Login as Employer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="registration-link">
            <p>New to Employify? <a href="registration.php">Create an account</a></p>
        </div>
    </div>
    <script src="../assets/js/login.js"></script>
</body>
</html>
