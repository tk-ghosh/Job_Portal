<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Resources - Employify</title>
    <link rel="stylesheet" href="../assets/css/nav-footer.css">
    <link rel="stylesheet" href="../assets/css/career-resources.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main class="main-content">
        <div class="container" style="padding-top:100px;">
            <h1 style="text-align:center;margin-bottom:20px;">Career Resources</h1>
            <p style="text-align:center;color:#666;margin-bottom:40px;">Tips and guides to help you succeed in your career journey</p>

            <div id="blogModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <div class="modal-header">
                        <h2 id="modalTitle"></h2>
                        <p class="post-date" id="modalDate"></p>
                    </div>
                    <div class="modal-body" id="modalContent"></div>
                </div>
            </div>

            <div class="posts-grid">
                <div class="post">
                    <h2>How to Craft a Winning Resume in 2025</h2>
                    <p class="post-date"><em>May 5, 2025</em></p>
                    <p class="post-content">Learn essential tips for creating a modern, effective resume that will stand out to recruiters in today's competitive job market.</p>
                    <button class="read-more-btn" data-title="How to Craft a Winning Resume in 2025" data-date="May 5, 2025" data-content="A well-crafted resume is your ticket to landing your dream job. In this comprehensive guide, we'll cover everything you need to know to create a resume that stands out. From choosing the right format to highlighting your achievements, we'll help you build a document that showcases your skills and experience in the best possible light.\n\nKey Topics Covered:\n- Choosing the right resume format\n- Writing compelling bullet points\n- Highlighting relevant experience\n- Using keywords effectively\n- Formatting tips for visual appeal\n- Common mistakes to avoid\n\nWhether you're a recent graduate or a seasoned professional, this guide will provide you with the tools you need to create a resume that gets noticed.">Read More</button>
                </div>
                <div class="post">
                    <h2>The Ultimate Guide to Job Interview Success</h2>
                    <p class="post-date"><em>May 4, 2025</em></p>
                    <p class="post-content">Discover proven strategies for acing your next job interview, from preparation to follow-up, with expert advice.</p>
                    <button class="read-more-btn" data-title="The Ultimate Guide to Job Interview Success" data-date="May 4, 2025" data-content="Discover proven strategies for acing your next job interview, from preparation to follow-up, with real-world examples and expert advice. Learn how to prepare effectively, answer common interview questions, and make a lasting impression on potential employers.">Read More</button>
                </div>
                <div class="post">
                    <h2>Top 10 Skills Employers Look for in 2025</h2>
                    <p class="post-date"><em>May 3, 2025</em></p>
                    <p class="post-content">Stay ahead in your career by developing these critical skills that are in high demand across industries.</p>
                    <button class="read-more-btn" data-title="Top 10 Skills Employers Look for in 2025" data-date="May 3, 2025" data-content="In today's fast-paced job market, it's essential to stay ahead of the curve by developing the skills that employers are looking for. We'll cover the top 10 skills that are in high demand across industries, from technical expertise to soft skills.">Read More</button>
                </div>
                <div class="post">
                    <h2>Networking 101: Building Professional Connections</h2>
                    <p class="post-date"><em>May 2, 2025</em></p>
                    <p class="post-content">Learn effective networking strategies to expand your professional network and open up new career opportunities.</p>
                    <button class="read-more-btn" data-title="Networking 101: Building Professional Connections" data-date="May 2, 2025" data-content="Learn effective networking strategies to expand your professional network and open up new career opportunities. From industry events to online platforms, discover the best ways to connect with professionals in your field.">Read More</button>
                </div>
                <div class="post">
                    <h2>Salary Negotiation Tips for New Graduates</h2>
                    <p class="post-date"><em>May 1, 2025</em></p>
                    <p class="post-content">Get expert advice on how to approach salary negotiations with practical tips and real-world examples.</p>
                    <button class="read-more-btn" data-title="Salary Negotiation Tips for New Graduates" data-date="May 1, 2025" data-content="Get expert advice on how to approach salary negotiations as a new graduate, with practical tips and real-world examples. Learn how to research market rates, make your case, and reach a fair agreement.">Read More</button>
                </div>
                <div class="post">
                    <h2>Remote Work Survival Guide</h2>
                    <p class="post-date"><em>April 30, 2025</em></p>
                    <p class="post-content">Discover essential tips for succeeding in a remote work environment, from time management to work-life balance.</p>
                    <button class="read-more-btn" data-title="Remote Work Survival Guide" data-date="April 30, 2025" data-content="Discover essential tips for succeeding in a remote work environment, from time management to maintaining work-life balance. Learn how to stay productive, communicate effectively, and build relationships with your team.">Read More</button>
                </div>
            </div>
        </div>
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
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@employify.com</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Employify. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/blog-posts.js"></script>
</body>
</html>
