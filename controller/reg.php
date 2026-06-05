<?php
session_start();
require_once '../model/user_model.php';

if (isset($_POST['submit'])) {
    $user_type = $_POST['user_type'] ?? '';

    if ($user_type === 'applicant') {
        $user = [
            'First_Name' => trim($_POST['First_Name']),
            'Last_Name'  => trim($_POST['Last_Name']),
            'Email'     => trim($_POST['Email']),
            'Password'  => $_POST['Password'],
            'Phone'     => trim($_POST['Phone']),
            'Address'   => trim($_POST['Address']),
            'Gender'    => trim($_POST['Gender'])
        ];

        if ($_POST['Password'] !== $_POST['confirm_password']) {
            $_SESSION['register_errors'][] = "Passwords do not match";
            header('Location: ../view/registration.php');
            exit();
        }

        $result = registerApplicant($user);
        if ($result === 'exists') {
            $_SESSION['register_errors'][] = "Email already registered";
        } elseif (!$result['success']) {
            $_SESSION['register_errors'][] = "Registration failed. Please try again.";
        } else {
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: ../view/login.php");
            exit();
        }
    } elseif ($user_type === 'employer') {
        $user = [
            'Company_Name' => trim($_POST['company_name']),
            'Email'     => trim($_POST['email']),
            'Password'  => $_POST['password'],
            'Phone'     => trim($_POST['phone']),
            'Address'   => trim($_POST['address']),
            'Industry'  => trim($_POST['industry']),
            'Website'   => trim($_POST['website'])
        ];

        if ($_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['register_errors'][] = "Passwords do not match";
            header('Location: ../view/registration.php');
            exit();
        }

        $result = registerEmployer($user);
        if ($result === 'exists') {
            $_SESSION['register_errors'][] = "Email already registered";
        } elseif (!$result['success']) {
            $_SESSION['register_errors'][] = "Registration failed. Please try again.";
        } else {
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: ../view/login.php");
            exit();
        }
    }

    header('Location: ../view/registration.php');
    exit();
} else {
    header('Location: ../view/registration.php');
    exit();
}
