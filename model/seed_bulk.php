<?php
require_once __DIR__ . '/db.php';

$con = getConnection();

echo "=== Existing Employers ===\n";
$r = mysqli_query($con, "SELECT id, Company_Name, Email FROM employerreg");
$employers = [];
while ($x = mysqli_fetch_assoc($r)) {
    $employers[] = $x;
    echo "ID {$x['id']}: {$x['Company_Name']} ({$x['Email']})\n";
}

if (count($employers) === 0) {
    echo "No employers found. Please run seed_data.php first.\n";
    exit();
}

echo "\n=== Existing Applicants ===\n";
$r = mysqli_query($con, "SELECT id, Email FROM applicantreg");
$existing = [];
while ($x = mysqli_fetch_assoc($r)) {
    $existing[] = $x['Email'];
    echo "ID {$x['id']}: {$x['Email']}\n";
}

echo "\n--- Creating 7 Applicants ---\n";
$applicants = [
    ['First_Name' => 'Alice', 'Last_Name' => 'Johnson', 'Email' => 'alice@test.com', 'Phone' => '+8801711111121', 'Address' => 'Dhaka, Bangladesh', 'Gender' => 'female'],
    ['First_Name' => 'Bob', 'Last_Name' => 'Smith', 'Email' => 'bob@test.com', 'Phone' => '+8801711111122', 'Address' => 'Chittagong, Bangladesh', 'Gender' => 'male'],
    ['First_Name' => 'Charlie', 'Last_Name' => 'Brown', 'Email' => 'charlie@test.com', 'Phone' => '+8801711111123', 'Address' => 'Sylhet, Bangladesh', 'Gender' => 'male'],
    ['First_Name' => 'Diana', 'Last_Name' => 'Prince', 'Email' => 'diana@test.com', 'Phone' => '+8801711111124', 'Address' => 'Khulna, Bangladesh', 'Gender' => 'female'],
    ['First_Name' => 'Eve', 'Last_Name' => 'Davis', 'Email' => 'eve@test.com', 'Phone' => '+8801711111125', 'Address' => 'Rajshahi, Bangladesh', 'Gender' => 'female'],
    ['First_Name' => 'Frank', 'Last_Name' => 'Miller', 'Email' => 'frank@test.com', 'Phone' => '+8801711111126', 'Address' => 'Barisal, Bangladesh', 'Gender' => 'male'],
    ['First_Name' => 'Grace', 'Last_Name' => 'Wilson', 'Email' => 'grace@test.com', 'Phone' => '+8801711111127', 'Address' => 'Dhaka, Bangladesh', 'Gender' => 'female'],
];

$appIds = [];
foreach ($applicants as $a) {
    if (in_array($a['Email'], $existing)) {
        echo "SKIP: {$a['Email']} already exists\n";
        $r2 = mysqli_query($con, "SELECT id FROM applicantreg WHERE Email = '{$a['Email']}'");
        $appIds[] = mysqli_fetch_assoc($r2)['id'];
        continue;
    }
    $pass = password_hash('test123', PASSWORD_DEFAULT);
    $sql = "INSERT INTO applicantreg (First_Name, Last_Name, Email, Password, Phone, Address, Gender) VALUES (
        '{$a['First_Name']}', '{$a['Last_Name']}', '{$a['Email']}', '$pass', '{$a['Phone']}', '{$a['Address']}', '{$a['Gender']}'
    )";
    if (mysqli_query($con, $sql)) {
        $appIds[] = mysqli_insert_id($con);
        echo "CREATED: {$a['First_Name']} {$a['Last_Name']} ({$a['Email']} / test123)\n";
    } else {
        echo "ERROR: " . mysqli_error($con) . "\n";
    }
}

echo "\n--- Creating 10 Jobs ---\n";
$jobData = [
    ['Software Engineer', 'Dhaka', 'it', 'mid', 'Full Time', 'Build and maintain web applications.', 'PHP, MySQL, JavaScript, 2+ years exp', '60000-90000'],
    ['Data Analyst', 'Remote', 'it', 'entry', 'Full Time', 'Analyze business data and generate reports.', 'Excel, SQL, Python basics', '40000-65000'],
    ['Graphic Designer', 'Dhaka', 'design', 'mid', 'Full Time', 'Create visually stunning designs for clients.', 'Photoshop, Illustrator, Figma, 3+ years', '50000-80000'],
    ['Accountant', 'Chittagong', 'finance', 'mid', 'Full Time', 'Manage financial records and reporting.', 'CA/ACCA, Tally, Excel, 3+ years', '55000-85000'],
    ['Digital Marketing Specialist', 'Remote', 'marketing', 'entry', 'Part Time', 'Manage social media and ad campaigns.', 'SEO, Google Ads, Facebook Ads', '30000-50000'],
    ['UI/UX Designer', 'Dhaka', 'design', 'senior', 'Full Time', 'Design intuitive user interfaces for web/mobile.', 'Figma, Adobe XD, 5+ years, portfolio', '90000-140000'],
    ['DevOps Engineer', 'Remote', 'it', 'senior', 'Full Time', 'Manage cloud infrastructure and CI/CD.', 'AWS, Docker, Kubernetes, Linux', '120000-180000'],
    ['Content Writer', 'Remote', 'marketing', 'entry', 'Internship', 'Write engaging blog posts and articles.', 'Excellent writing, SEO basics', '15000-25000'],
    ['HR Manager', 'Dhaka', 'other', 'lead', 'Full Time', 'Oversee recruitment and employee relations.', 'MBA, 5+ years HR experience', '100000-150000'],
    ['Junior Web Developer', 'Sylhet', 'it', 'entry', 'Full Time', 'Assist in developing web applications.', 'HTML, CSS, JS, PHP basics', '30000-50000'],
];

foreach ($jobData as $ji => $jd) {
    $emp = $employers[$ji % count($employers)];
    $title = $jd[0];
    $loc = $jd[1];
    $cat = $jd[2];
    $exp = $jd[3];
    $type = $jd[4];
    $desc = $jd[5];
    $req = $jd[6];
    $sal = $jd[7];

    $check = mysqli_query($con, "SELECT id FROM jobs WHERE title = '$title' AND employer_id = {$emp['id']} LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
        echo "SKIP: '$title' already exists for {$emp['Company_Name']}\n";
        continue;
    }

    $company_name = mysqli_real_escape_string($con, $emp['Company_Name']);
    $sql = "INSERT INTO jobs (employer_id, title, company, location, category, experience, type, description, requirements, salary_range) VALUES (
        {$emp['id']}, '$title', '$company_name', '$loc', '$cat', '$exp', '$type', '$desc', '$req', '$sal'
    )";
    if (mysqli_query($con, $sql)) {
        echo "CREATED: '$title' by {$emp['Company_Name']}\n";
    } else {
        echo "ERROR: " . mysqli_error($con) . "\n";
    }
}

echo "\n--- Creating Some Applications ---\n";
$r = mysqli_query($con, "SELECT id FROM jobs WHERE status = 'active'");
$allJobs = [];
while ($x = mysqli_fetch_assoc($r)) $allJobs[] = $x['id'];

$existingApps = [];
$r = mysqli_query($con, "SELECT CONCAT(job_id, '-', applicant_id) AS j FROM job_applications");
while ($x = mysqli_fetch_assoc($r)) $existingApps[$x['j']] = true;

$count = 0;
foreach ($allJobs as $jobId) {
    $numApps = min(rand(1, 3), count($appIds));
    $pool = $appIds;
    shuffle($pool);
    for ($i = 0; $i < $numApps && $i < count($pool); $i++) {
        $aid = $pool[$i];
        $key = $jobId . '-' . $aid;
        if (isset($existingApps[$key])) continue;
        $statuses = ['applied', 'applied', 'applied', 'review', 'interview'];
        $status = $statuses[array_rand($statuses)];
        $sql = "INSERT INTO job_applications (job_id, applicant_id, status) VALUES ($jobId, $aid, '$status')";
        if (mysqli_query($con, $sql)) {
            $count++;
            $existingApps[$key] = true;
        }
    }
}
echo "Created $count applications\n";

mysqli_close($con);

echo "\n=== Login Credentials ===\n";
echo "Employer: admin@employify.com / admin123\n";
echo "Employer: emp@employify.com / emp123\n";
echo "Applicants: alice@test.com through grace@test.com / test123\n";
echo "Applicant: user@employify.com / user123\n";
