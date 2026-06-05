<?php
session_start();
header('Content-Type: application/json');
require_once '../model/Job.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true || $_SESSION['user_type'] !== 'employer') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$jobModel = new Job();
$action = $_GET['action'] ?? '';
$employerId = $_SESSION['user_id'];
$company = $_SESSION['name'];

switch ($action) {
    case 'list':
        $sql = "SELECT * FROM jobs WHERE employer_id = ? ORDER BY created_at DESC";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $employerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $jobs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => true, 'jobs' => $jobs]);
        break;

    case 'create':
        $data = [
            'employer_id' => $employerId,
            'title' => $_POST['title'] ?? '',
            'company' => $company,
            'location' => $_POST['location'] ?? '',
            'category' => $_POST['category'] ?? '',
            'experience' => $_POST['experience'] ?? '',
            'type' => $_POST['type'] ?? 'Full Time',
            'description' => $_POST['description'] ?? '',
            'requirements' => $_POST['requirements'] ?? '',
            'salary_range' => $_POST['salary_range'] ?? ''
        ];
        $result = $jobModel->create($data);
        echo json_encode(['success' => $result]);
        break;

    case 'update':
        $id = intval($_POST['id'] ?? 0);
        $sql = "UPDATE jobs SET title=?, location=?, category=?, experience=?, type=?, description=?, requirements=?, salary_range=? WHERE id=? AND employer_id=?";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssii",
            $_POST['title'], $_POST['location'], $_POST['category'], $_POST['experience'],
            $_POST['type'], $_POST['description'], $_POST['requirements'], $_POST['salary_range'],
            $id, $employerId
        );
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => $result]);
        break;

    case 'toggle_status':
        $id = intval($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'active';
        $sql = "UPDATE jobs SET status=? WHERE id=? AND employer_id=?";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sii", $status, $id, $employerId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => $result]);
        break;

    case 'delete':
        $id = intval($_POST['id'] ?? 0);
        $sql = "DELETE FROM jobs WHERE id=? AND employer_id=?";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $id, $employerId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => $result]);
        break;

    case 'detail':
        $id = intval($_GET['id'] ?? 0);
        $sql = "SELECT * FROM jobs WHERE id=? AND employer_id=?";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $id, $employerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $job = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => !!$job, 'job' => $job]);
        break;

    case 'applicants':
        $jobId = intval($_GET['job_id'] ?? 0);
        $sql = "SELECT ja.*, a.First_Name, a.Last_Name, a.Email, a.Phone, a.Address 
                FROM job_applications ja 
                INNER JOIN applicantreg a ON ja.applicant_id = a.id 
                INNER JOIN jobs j ON ja.job_id = j.id 
                WHERE ja.job_id = ? AND j.employer_id = ?
                ORDER BY ja.applied_at DESC";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $jobId, $employerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $applicants = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $applicants[] = $row;
        }
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => true, 'applicants' => $applicants]);
        break;

    case 'update_status':
        $appId = intval($_POST['application_id'] ?? 0);
        $status = $_POST['status'] ?? 'applied';
        $sql = "UPDATE job_applications ja 
                INNER JOIN jobs j ON ja.job_id = j.id 
                SET ja.status=? 
                WHERE ja.id=? AND j.employer_id=?";
        $stmt = mysqli_prepare($jobModel->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sii", $status, $appId, $employerId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo json_encode(['success' => $result]);
        break;

    case 'stats':
        $totalJobs = 0; $activeJobs = 0; $totalApplicants = 0;
        $res = mysqli_query($jobModel->conn, "SELECT COUNT(*) as c FROM jobs WHERE employer_id=$employerId");
        if ($row = mysqli_fetch_assoc($res)) $totalJobs = $row['c'];
        $res = mysqli_query($jobModel->conn, "SELECT COUNT(*) as c FROM jobs WHERE employer_id=$employerId AND status='active'");
        if ($row = mysqli_fetch_assoc($res)) $activeJobs = $row['c'];
        $res = mysqli_query($jobModel->conn, "SELECT COUNT(*) as c FROM job_applications ja INNER JOIN jobs j ON ja.job_id=j.id WHERE j.employer_id=$employerId");
        if ($row = mysqli_fetch_assoc($res)) $totalApplicants = $row['c'];
        echo json_encode(['success' => true, 'totalJobs' => $totalJobs, 'activeJobs' => $activeJobs, 'totalApplicants' => $totalApplicants]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action']);
}
