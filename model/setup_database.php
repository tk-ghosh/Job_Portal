<?php
require_once 'db.php';

function setupDatabase() {
    $con = mysqli_connect("127.0.0.1", "root", "");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = file_get_contents(__DIR__ . '/create_tables.sql');

    if (mysqli_multi_query($con, $sql)) {
        do {
            if ($result = mysqli_store_result($con)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($con));
        echo "Database setup completed successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
}

setupDatabase();
