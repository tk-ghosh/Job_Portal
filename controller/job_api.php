<?php
session_start();
header('Content-Type: application/json');
require_once '../model/Job.php';

$jobModel = new Job();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        $filters = [];
        if (!empty($_GET['search'])) $filters['search'] = $_GET['search'];
        if (!empty($_GET['location'])) $filters['location'] = $_GET['location'];
        if (!empty($_GET['category'])) $filters['category'] = $_GET['category'];
        if (!empty($_GET['experience'])) $filters['experience'] = $_GET['experience'];
        $jobs = $jobModel->getAll($filters);
        echo json_encode(['success' => true, 'jobs' => $jobs]);
        break;

    case 'detail':
        $id = intval($_GET['id'] ?? 0);
        $job = $jobModel->getById($id);
        echo json_encode(['success' => !!$job, 'job' => $job]);
        break;

    case 'apply':
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== true || $_SESSION['user_type'] !== 'applicant') {
            echo json_encode(['success' => false, 'message' => 'Please login as applicant']);
            exit();
        }
        $jobId = intval($_POST['job_id'] ?? 0);
        $applicantId = $_SESSION['user_id'];
        $result = $jobModel->apply($jobId, $applicantId);
        if ($result === 'already_applied') {
            echo json_encode(['success' => false, 'message' => 'Already applied']);
        } elseif ($result === 'success') {
            echo json_encode(['success' => true, 'message' => 'Application submitted']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to apply']);
        }
        break;

    case 'save':
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== true || $_SESSION['user_type'] !== 'applicant') {
            echo json_encode(['success' => false]);
            exit();
        }
        $jobId = intval($_POST['job_id'] ?? 0);
        $applicantId = $_SESSION['user_id'];
        $result = $jobModel->saveJob($jobId, $applicantId);
        echo json_encode(['success' => $result]);
        break;

    case 'unsave':
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
            echo json_encode(['success' => false]);
            exit();
        }
        $jobId = intval($_POST['job_id'] ?? 0);
        $applicantId = $_SESSION['user_id'];
        $result = $jobModel->unsaveJob($jobId, $applicantId);
        echo json_encode(['success' => $result]);
        break;

    case 'saved':
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== true || $_SESSION['user_type'] !== 'applicant') {
            echo json_encode(['success' => false, 'jobs' => []]);
            exit();
        }
        $jobs = $jobModel->getSavedJobs($_SESSION['user_id']);
        echo json_encode(['success' => true, 'jobs' => $jobs]);
        break;

    case 'applications':
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== true || $_SESSION['user_type'] !== 'applicant') {
            echo json_encode(['success' => false, 'applications' => []]);
            exit();
        }
        $apps = $jobModel->getApplications($_SESSION['user_id']);
        echo json_encode(['success' => true, 'applications' => $apps]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action']);
}
