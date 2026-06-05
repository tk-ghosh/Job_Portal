<?php
session_start();
require_once '../model/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['contact_error'] = "Please fill in all required fields";
        header('Location: ../view/contact.php');
        exit();
    }

    $con = getConnection();
    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);
    $subject = mysqli_real_escape_string($con, $subject);
    $message = mysqli_real_escape_string($con, $message);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['contact_success'] = "Message sent successfully!";
    } else {
        $_SESSION['contact_error'] = "Failed to send message. Please try again.";
    }
    mysqli_close($con);
    header('Location: ../view/contact.php');
    exit();
} else {
    header('Location: ../view/contact.php');
    exit();
}
