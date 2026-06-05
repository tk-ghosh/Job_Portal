<?php
session_start();
header('Content-Type: application/json');
require_once '../model/user_model.php';

if (!isset($_SESSION['status']) || $_SESSION['user_type'] !== 'applicant') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'address' => trim($_POST['address'] ?? '')
    ];
    $result = updateApplicantProfile($_SESSION['user_id'], $data);
    echo json_encode(['success' => $result]);
} else {
    echo json_encode(['success' => false]);
}
