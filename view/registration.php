<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Employify</title>
    <link rel="stylesheet" href="../assets/css/registration.css" />
</head>
<body>
    <section class="login-container">
        <?php if (isset($_SESSION['register_errors']) && !empty($_SESSION['register_errors'])): ?>
            <div style="background:#f44336;color:white;padding:10px;border-radius:5px;margin-bottom:15px;">
                <?php foreach ($_SESSION['register_errors'] as $err): ?>
                    <p><?php echo htmlspecialchars($err); ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['register_errors']); ?>
            </div>
        <?php endif; ?>
        <div class="user-type-selector">
            <button class="user-type-btn active" onclick="showForm('applicant')">Applicant</button>
            <button class="user-type-btn" onclick="showForm('employer')">Employer</button>
        </div>

        <div id="applicant-form" class="registration-form active">
            <form action="../controller/reg.php" method="POST">
                <input type="hidden" name="user_type" value="applicant">
                <fieldset class="login-box">
                    <legend class="login-title">Applicant Registration</legend>
                    <label>First Name</label>
                    <input type="text" name="First_Name" class="input-field" placeholder="First Name" required>
                    <label>Last Name</label>
                    <input type="text" name="Last_Name" class="input-field" placeholder="Last Name" required>
                    <label>Email</label>
                    <input type="email" name="Email" class="input-field" placeholder="Email" required>
                    <label>Phone Number</label>
                    <input type="tel" name="Phone" class="input-field" placeholder="Phone Number" required>
                    <label>Address</label>
                    <input type="text" name="Address" class="input-field" placeholder="Address" required>
                    <label>Gender</label>
                    <select name="Gender" class="input-field" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <label>Password</label>
                    <input type="password" name="Password" class="input-field" placeholder="Password" required>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
                    <div class="button-container">
                        <button type="submit" class="login-button" name="submit">Sign Up</button>
                    </div>
                    <p class="login_page">Already have an account? <a href="login.php">Login here</a></p>
                </fieldset>
            </form>
        </div>

        <div id="employer-form" class="registration-form">
            <form action="../controller/reg.php" method="POST">
                <input type="hidden" name="user_type" value="employer">
                <fieldset class="login-box">
                    <legend class="login-title">Employer Registration</legend>
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="input-field" placeholder="Company Name" required>
                    <label>Company Email</label>
                    <input type="email" name="email" class="input-field" placeholder="Company Email" required>
                    <label>Company Phone</label>
                    <input type="tel" name="phone" class="input-field" placeholder="Company Phone" required>
                    <label>Company Address</label>
                    <input type="text" name="address" class="input-field" placeholder="Company Address" required>
                    <label>Industry</label>
                    <select name="industry" class="input-field" required>
                        <option value="" disabled selected>Select Industry</option>
                        <option value="it">Information Technology</option>
                        <option value="finance">Finance</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="education">Education</option>
                        <option value="other">Other</option>
                    </select>
                    <label>Company Website</label>
                    <input type="url" name="website" class="input-field" placeholder="Company Website">
                    <label>Password</label>
                    <input type="password" name="password" class="input-field" placeholder="Password" required>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
                    <div class="button-container">
                        <button type="submit" class="login-button" name="submit">Register as Employer</button>
                    </div>
                    <p class="login_page">Already have an account? <a href="login.php">Login here</a></p>
                </fieldset>
            </form>
        </div>
    </section>
    <script>
        function showForm(type) {
            document.querySelectorAll('.user-type-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.registration-form').forEach(f => f.classList.remove('active'));
            if (type === 'applicant') {
                document.querySelector('.user-type-btn:first-child').classList.add('active');
                document.getElementById('applicant-form').classList.add('active');
            } else {
                document.querySelector('.user-type-btn:last-child').classList.add('active');
                document.getElementById('employer-form').classList.add('active');
            }
        }
    </script>
</body>
</html>
