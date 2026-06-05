<?php
session_start();
require_once '../model/user_model.php';

if (isset($_POST['submit'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $user_type = trim($_POST['user_type'] ?? '');

    if (empty($email) || empty($password) || !in_array($user_type, ['applicant', 'employer'])) {
        $_SESSION['login_error'] = "Please fill in all fields";
        header('Location: ../view/login.php');
        exit();
    }

    if (loginUser($email, $password, $user_type)) {
        $_SESSION['last_activity'] = time();
        $_SESSION['expire_time'] = 30 * 60;
        $redirect = ($user_type === 'employer') ? '../view/employer_dashboard.php' : '../view/home.php';
        header('Location: ' . $redirect);
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password!";
        header('Location: ../view/login.php');
        exit();
    }
} else {
    $_SESSION['login_error'] = "Please submit the form properly!";
    header('Location: ../view/login.php');
    exit();
}
