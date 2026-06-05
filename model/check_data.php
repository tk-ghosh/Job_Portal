<?php
require_once __DIR__ . '/db.php';
$c = getConnection();
$tables = ['applicantreg', 'employerreg', 'jobs', 'job_applications'];
foreach ($tables as $t) {
    $r = mysqli_query($c, "SELECT COUNT(*) AS c FROM $t");
    $n = mysqli_fetch_assoc($r)['c'];
    echo "$t: $n\n";
}
