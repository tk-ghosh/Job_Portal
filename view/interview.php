<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Scheduler - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/interview.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main style="max-width:800px;margin:100px auto;padding:20px;">
        <h1>Interview Scheduler</h1>

        <section id="calendar-sync" class="active">
            <h2>Sync Your Calendar</h2>
            <p>Connect your calendar to share your availability.</p>
            <button onclick="syncCalendar()">Sync Calendar</button>
        </section>

        <section id="availability">
            <h2>Select Your Availability</h2>
            <form>
                <label for="date-input">Date:</label>
                <input type="date" id="date-input" min="2025-05-06">
                <br>
                <label for="time-input">Time:</label>
                <input type="time" id="time-input">
            </form>
            <p id="error-message" class="error">Please select a valid date and time.</p>
            <button onclick="bookInterview()">Book Interview</button>
        </section>

        <section id="confirmation">
            <h2>Booking Confirmed!</h2>
            <p id="confirmation-details"></p>
            <p id="calendar-invite">Calendar invite sent!</p>
            <button onclick="startOver()">Schedule Another</button>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Employify</h3>
                <p>Find your dream job with Employify.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="jobs.php">Find a Job</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/interview.js"></script>
</body>
</html>
