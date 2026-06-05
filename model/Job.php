<?php
require_once __DIR__ . '/db.php';

class Job {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function getAll($filters = []) {
        $sql = "SELECT * FROM jobs WHERE status = 'active'";
        $params = [];
        $types = "";

        if (!empty($filters['search'])) {
            $sql .= " AND (title LIKE ? OR company LIKE ? OR location LIKE ?)";
            $search = "%" . $filters['search'] . "%";
            $params[] = $search; $params[] = $search; $params[] = $search;
            $types .= "sss";
        }
        if (!empty($filters['location'])) {
            $sql .= " AND LOWER(location) = LOWER(?)";
            $params[] = $filters['location'];
            $types .= "s";
        }
        if (!empty($filters['category'])) {
            $sql .= " AND category = ?";
            $params[] = $filters['category'];
            $types .= "s";
        }
        if (!empty($filters['experience'])) {
            $sql .= " AND experience = ?";
            $params[] = $filters['experience'];
            $types .= "s";
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = mysqli_prepare($this->conn, $sql);
        if ($params) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $jobs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $jobs;
    }

    public function getById($id) {
        $sql = "SELECT * FROM jobs WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $job = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $job;
    }

    public function create($data) {
        $sql = "INSERT INTO jobs (employer_id, title, company, location, category, experience, type, description, requirements, salary_range)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "isssssssss",
            $data['employer_id'], $data['title'], $data['company'], $data['location'],
            $data['category'], $data['experience'], $data['type'], $data['description'],
            $data['requirements'], $data['salary_range']
        );
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function apply($jobId, $applicantId) {
        $check = "SELECT id FROM job_applications WHERE job_id = ? AND applicant_id = ?";
        $stmt = mysqli_prepare($this->conn, $check);
        mysqli_stmt_bind_param($stmt, "ii", $jobId, $applicantId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);
            return 'already_applied';
        }
        mysqli_stmt_close($stmt);

        $sql = "INSERT INTO job_applications (job_id, applicant_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $jobId, $applicantId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result ? 'success' : 'fail';
    }

    public function saveJob($jobId, $applicantId) {
        $sql = "INSERT IGNORE INTO saved_jobs (applicant_id, job_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $applicantId, $jobId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function unsaveJob($jobId, $applicantId) {
        $sql = "DELETE FROM saved_jobs WHERE applicant_id = ? AND job_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $applicantId, $jobId);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function getSavedJobs($applicantId) {
        $sql = "SELECT j.* FROM jobs j INNER JOIN saved_jobs sj ON j.id = sj.job_id WHERE sj.applicant_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $applicantId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $jobs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $jobs;
    }

    public function getApplications($applicantId) {
        $sql = "SELECT ja.*, j.title, j.company, j.location FROM job_applications ja
                INNER JOIN jobs j ON ja.job_id = j.id
                WHERE ja.applicant_id = ? ORDER BY ja.applied_at DESC";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $applicantId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $apps = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $apps[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $apps;
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }
}
