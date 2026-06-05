<?php
require_once 'db.php';

$con = getConnection();

$pass1 = password_hash('admin123', PASSWORD_DEFAULT);
$pass2 = password_hash('user123', PASSWORD_DEFAULT);
$pass3 = password_hash('emp123', PASSWORD_DEFAULT);

mysqli_query($con, "INSERT IGNORE INTO employerreg (Company_Name, Email, Password, Phone, Address, Industry) VALUES ('Tech Solutions', 'admin@employify.com', '$pass1', '+8801711111111', 'Dhaka, Bangladesh', 'IT')");

mysqli_query($con, "INSERT IGNORE INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender) VALUES ('John', 'Doe', 'user@employify.com', '$pass2', '+8801711111112', 'Dhaka, Bangladesh', 'male')");

mysqli_query($con, "INSERT IGNORE INTO employerreg (Company_Name, Email, Password, Phone, Address, Industry) VALUES ('Finance Corp', 'emp@employify.com', '$pass3', '+8801711111113', 'Chittagong, Bangladesh', 'Finance')");

mysqli_query($con, "INSERT IGNORE INTO jobs (employer_id, title, company, location, category, experience, type, description, requirements, salary_range) VALUES (1, 'Senior Software Engineer', 'Tech Solutions', 'Dhaka', 'it', 'senior', 'Full Time', 'We are looking for a senior software engineer to join our growing team.', '5+ years experience in PHP, MySQL, JavaScript', '120000-180000')");

mysqli_query($con, "INSERT IGNORE INTO jobs (employer_id, title, company, location, category, experience, type, description, requirements, salary_range) VALUES (1, 'Frontend Developer', 'Tech Solutions', 'Remote', 'it', 'mid', 'Full Time', 'Join our frontend team building modern web applications.', '3+ years experience in React, JavaScript, CSS', '80000-130000')");

mysqli_query($con, "INSERT IGNORE INTO jobs (employer_id, title, company, location, category, experience, type, description, requirements, salary_range) VALUES (2, 'Marketing Manager', 'Finance Corp', 'Chittagong', 'marketing', 'senior', 'Full Time', 'Lead our marketing team to drive brand growth.', '5+ years marketing experience, team management', '100000-150000')");

mysqli_close($con);
echo "Test users and jobs created successfully!\n";
echo "Employer: admin@employify.com / admin123\n";
echo "Applicant: user@employify.com / user123\n";
echo "Employer: emp@employify.com / emp123\n";
