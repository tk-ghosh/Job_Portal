<?php
require_once 'db.php';

function registerApplicant($user) {
    $con = getConnection();
    $fname = mysqli_real_escape_string($con, $user['First_Name']);
    $lname = mysqli_real_escape_string($con, $user['Last_Name']);
    $email = mysqli_real_escape_string($con, $user['Email']);
    $pass = password_hash($user['Password'], PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($con, $user['Phone']);
    $address = mysqli_real_escape_string($con, $user['Address']);
    $gender = mysqli_real_escape_string($con, $user['Gender']);

    $check = "SELECT id FROM applicantreg WHERE Email = '$email'";
    $result = mysqli_query($con, $check);
    if (mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        return 'exists';
    }

    $sql = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender)
            VALUES ('$fname', '$lname', '$email', '$pass', '$phone', '$address', '$gender')";
    $success = mysqli_query($con, $sql);
    $id = $success ? mysqli_insert_id($con) : null;
    mysqli_close($con);
    return $success ? ['success' => true, 'id' => $id] : ['success' => false];
}

function registerEmployer($user) {
    $con = getConnection();
    $company = mysqli_real_escape_string($con, $user['Company_Name']);
    $email = mysqli_real_escape_string($con, $user['Email']);
    $pass = password_hash($user['Password'], PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($con, $user['Phone']);
    $address = mysqli_real_escape_string($con, $user['Address']);
    $industry = mysqli_real_escape_string($con, $user['Industry'] ?? '');
    $website = mysqli_real_escape_string($con, $user['Website'] ?? '');

    $check = "SELECT id FROM employerreg WHERE Email = '$email'";
    $result = mysqli_query($con, $check);
    if (mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        return 'exists';
    }

    $sql = "INSERT INTO employerreg (Company_Name, Email, Password, Phone, Address, Industry, Website)
            VALUES ('$company', '$email', '$pass', '$phone', '$address', '$industry', '$website')";
    $success = mysqli_query($con, $sql);
    mysqli_close($con);
    return $success ? ['success' => true] : ['success' => false];
}

function loginUser($email, $password, $user_type) {
    $con = getConnection();
    $email = mysqli_real_escape_string($con, $email);

    if ($user_type === 'applicant') {
        $sql = "SELECT * FROM applicantreg WHERE Email = '$email'";
    } else {
        $sql = "SELECT * FROM employerreg WHERE Email = '$email'";
    }

    $result = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['Password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_type'] = $user_type;
            if ($user_type === 'applicant') {
                $_SESSION['name'] = $row['First_Name'] . ' ' . $row['Last_Name'];
            } else {
                $_SESSION['name'] = $row['Company_Name'];
            }
            $_SESSION['status'] = true;
            mysqli_close($con);
            return true;
        }
    }
    mysqli_close($con);
    return false;
}

function getUserById($id, $type) {
    $con = getConnection();
    if ($type === 'applicant') {
        $sql = "SELECT * FROM applicantreg WHERE id = ?";
    } else {
        $sql = "SELECT * FROM employerreg WHERE id = ?";
    }
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $user;
}

function updateApplicantProfile($id, $data) {
    $con = getConnection();
    $fname = mysqli_real_escape_string($con, $data['first_name']);
    $lname = mysqli_real_escape_string($con, $data['last_name']);
    $phone = mysqli_real_escape_string($con, $data['phone']);
    $address = mysqli_real_escape_string($con, $data['address']);

    $sql = "UPDATE applicantreg SET First_Name='$fname', Last_Name='$lname', Phone='$phone', Address='$address' WHERE id=$id";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    return $result;
}
