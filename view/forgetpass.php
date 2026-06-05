<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Employify</title>
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-box">
            <h1><i class="fas fa-lock"></i> Forgot Password</h1>
            <div class="progress-steps">
                <div class="step active" id="step1">
                    <div class="step-number">1</div>
                    <div class="step-text">Email Verification</div>
                </div>
                <div class="step" id="step2">
                    <div class="step-number">2</div>
                    <div class="step-text">Reset Password</div>
                </div>
                <div class="step" id="step3">
                    <div class="step-number">3</div>
                    <div class="step-text">Done</div>
                </div>
            </div>

            <form id="emailForm" class="form active">
                <p class="form-text">Enter your email address to receive a verification code.</p>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Verification Code</button>
                <div class="form-footer">
                    Remember your password? <a href="login.php">Login here</a>
                </div>
            </form>

            <form id="resetPasswordForm" class="form">
                <p class="form-text">Create a new password for your account.</p>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" class="form-control" required>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" id="confirmPassword" class="form-control" required>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                <div class="form-footer">
                    <a href="login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/forgot-password.js"></script>
</body>
</html>
