<?php

function validateEmail($email) {
    $email = trim($email);
    if(empty($email)) return "Email is required";
    if(!strpos($email, '@') || !strpos($email, '.')) return "Invalid email format";
    return "";
}

function validatePassword($password) {
    $password = trim($password);
    if(empty($password)) return "Password is required";
    if(strlen($password) < 6) return "Password must be at least 6 characters long";
    return "";
}

function validateName($name, $field = "Name") {
    $name = trim($name);
    if(empty($name)) return "$field is required";
    if(strlen($name) < 2) return "$field is too short";
    return "";
}

function validatePhone($phone) {
    $phone = trim($phone);
    if(empty($phone)) return "Phone number is required";
    $phone = str_replace(['-', ' ', '(', ')', '+'], '', $phone);
    if(!ctype_digit($phone)) return "Phone number should contain only digits";
    if(strlen($phone) < 10 || strlen($phone) > 15) return "Phone should be between 10-15 digits";
    return "";
}

function validateAddress($address) {
    $address = trim($address);
    if(empty($address)) return "Address is required";
    if(strlen($address) < 5) return "Address is too short";
    return "";
}

function validateCompanyName($name) {
    $name = trim($name);
    if(empty($name)) return "Company name is required";
    if(strlen($name) < 2) return "Company name is too short";
    return "";
}
