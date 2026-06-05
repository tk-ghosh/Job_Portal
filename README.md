# Employify - Job Portal

A full-featured web-based job portal built with **vanilla PHP, MySQL, HTML, CSS, and JavaScript**. Employify connects job seekers with employers through a comprehensive platform featuring job listings, applications, resume building, interview scheduling, salary estimation, and more.

---

## Features

### For Job Seekers (Applicants)

| Feature | Description |
|---|---|
| **User Registration & Login** | Secure signup/login with password hashing (bcrypt) and session management |
| **Job Board** | Browse, search, and filter job listings by keyword, location, category, and experience level |
| **Job Applications** | Apply to jobs with one click; track application status (applied, review, interview, offer, rejected) |
| **Saved Jobs** | Bookmark interesting jobs and view them later from your profile |
| **Profile Management** | Edit personal details, upload profile picture, view dashboard with stats |
| **Resume/CV Builder** | Create a professional resume using the built-in builder; upload existing PDF/DOC files; track profile completeness |
| **Job Alerts** | Set alert preferences by job title, location, and type; receive email/app notifications; view recommended jobs |
| **Salary Estimator** | Estimate compensation by position and location; compare job offers side-by-side; view benefits breakdown |
| **Interview Scheduler** | Sync calendar, select availability, and book interviews |
| **Career Resources** | Access articles on resume tips, interview prep, and career advice |
| **Password Reset** | Multi-step password recovery flow with email verification |

### For Employers

| Feature | Description |
|---|---|
| **Company Registration** | Register with company details, industry, and website |
| **Employer Dashboard** | Full analytics dashboard with total jobs, active listings, and applicant counts |
| **Job Posting Manager** | Create, edit, view, activate/close, and delete job listings |
| **Applicant Pipeline** | View all applicants filterable by job; update application statuses (review, interview, offer, rejected) |
| **Company Profile** | Public company profile page with overview, stats, and open positions |

### Common Features

- **Role-based access control** — separate experiences for applicants and employers
- **Responsive design** — works on desktop, tablet, and mobile
- **Form validation** — client-side (JavaScript) and server-side (PHP) validation
- **Contact form** — users can submit inquiries which are stored in the database

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP (vanilla, no framework) |
| **Frontend** | HTML5, CSS3, Vanilla JavaScript |
| **Database** | MySQL (via MySQLi) |
| **Architecture** | MVC-inspired (Model-View-Controller) |
| **Server** | Apache (XAMPP / WAMP / LAMP) |
| **Password Hashing** | bcrypt (`password_hash` / `password_verify`) |

---

## Project Structure

```
Job_Portal/
├── index.php                    # Entry point → redirects to home.php
├── README.md
│
├── assets/
│   ├── css/                     # Page-specific stylesheets (17 files)
│   │   ├── home.css, jobs.css, login.css, profile.css
│   │   ├── admin.css, about.css, contact.css, resume.css
│   │   ├── salary.css, interview.css, alert.css
│   │   ├── company.css, company-profile.css
│   │   ├── registration.css, forgot-password.css
│   │   ├── nav-footer.css, style.css, career-resources.css
│   ├── js/                      # Client-side JavaScript (14 files)
│   │   ├── about.js, alert.js, blog-posts.js
│   │   ├── company.js, company-profile.js, contact.js
│   │   ├── forgot-password.js, interview.js, jobs.js
│   │   ├── login.js, profile.js, registration.js
│   │   ├── resume.js, salary.js
│   └── image/                   # Static images (123.jpg, g.png, m.png)
│
├── controller/                  # Request handlers (PHP)
│   ├── logincheck.php           # Authentication logic
│   ├── reg.php                  # Registration handler
│   ├── registration_validation.php  # Server-side validation
│   ├── update_profile.php       # Profile update (AJAX)
│   ├── contact_submit.php       # Contact form processing
│   ├── job_api.php              # Public API (list, detail, apply, save, unsave)
│   └── employer_job_api.php     # Employer API (CRUD jobs, manage applicants)
│
├── model/                       # Data layer (PHP + SQL)
│   ├── db.php                   # Database connection (MySQLi)
│   ├── user_model.php           # User CRUD operations
│   ├── Job.php                  # Job class (getAll, create, apply, save, etc.)
│   ├── validation.php           # Validation utilities
│   ├── create_tables.sql        # Database schema (DDL)
│   ├── setup_database.php       # Schema installer
│   ├── seed_data.php            # Test data seeder
│   ├── seed_bulk.php            # Bulk test data seeder
│   └── check_data.php           # Data inspection utility
│
└── view/                        # Presentation layer (PHP templates)
    ├── navbar.php               # Shared navigation bar
    ├── home.php                 # Landing page
    ├── login.php                # Applicant/Employer login
    ├── registration.php         # Applicant/Employer registration
    ├── jobs.php                 # Job board with search & filters
    ├── Profile.php              # User profile & dashboard
    ├── employer_dashboard.php   # Employer admin panel
    ├── resume.php               # CV/Resume builder
    ├── alert.php                # Job alerts & notifications
    ├── salary.php               # Salary estimator & comparison
    ├── interview.php            # Interview scheduler
    ├── company.php              # Featured companies
    ├── company_profile.php      # Individual company detail
    ├── about.php                # About us page
    ├── contact.php              # Contact form page
    ├── career-resources.php     # Career advice blog
    ├── forgetpass.php           # Password reset flow
    └── logout.php               # Session destroy & redirect
```

---

## Database Schema

**Database:** `Employify`

### Tables

| Table | Purpose |
|---|---|
| `applicantreg` | Job seeker accounts (name, email, password, phone, address, gender, profile_pic) |
| `employerreg` | Employer accounts (company name, email, password, phone, industry, website, logo) |
| `jobs` | Job listings (title, company, location, category, experience, type, description, requirements, salary_range, status) |
| `job_applications` | Applications linking applicants to jobs with status tracking |
| `saved_jobs` | Bookmarked jobs for applicants |
| `contact_messages` | Contact form submissions |
| `password_resets` | Password reset tokens |

---

## Installation & Setup

### Prerequisites

- PHP 7.4+ (with MySQLi extension)
- MySQL 5.7+ / MariaDB 10.3+
- Apache web server (or any PHP-capable server)
- [XAMPP](https://www.apachefriends.org/) / [WAMP](http://www.wampserver.com/) / [LAMP](https://bitnami.com/stack/lamp) recommended

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Iftekhar-Tasnim/Job_Portal_webtech_project.git
   ```
   Or copy the project folder to your web server's document root (e.g., `htdocs/` for XAMPP).

2. **Configure database connection**
   Edit `model/db.php`:
   ```php
   $host = "127.0.0.1";     // or "localhost"
   $dbuser = "root";         // your MySQL username
   $dbpass = "";             // your MySQL password
   $dbname = "Employify";    // database name
   ```

3. **Set up the database**
   - Open phpMyAdmin or MySQL CLI
   - Run `model/create_tables.sql` to create the database and all tables
   - OR access via browser: `http://localhost/Job_Portal/model/setup_database.php`

4. **(Optional) Seed test data**
   - Run `model/seed_data.php` via browser or CLI to populate sample data

5. **Start the application**
   - Navigate to `http://localhost/Job_Portal/` in your browser

### Default Test Credentials

| Role | Email | Password |
|---|---|---|
| Employer | `admin@employify.com` | `admin123` |
| Applicant | `user@employify.com` | `user123` |
| Employer | `emp@employify.com` | `emp123` |

---

## API Endpoints

### Public Job API (`controller/job_api.php`)

| Action | Method | Parameters | Description |
|---|---|---|---|
| `list` | GET | `search`, `location`, `category`, `experience` | Fetch filtered job listings |
| `detail` | GET | `id` | Get single job details |
| `apply` | POST | `job_id` | Apply to a job (requires applicant session) |
| `save` | POST | `job_id` | Save/bookmark a job |
| `unsave` | POST | `job_id` | Unsave a job |
| `saved` | GET | — | List saved jobs for current user |
| `applications` | GET | — | List applications for current user |

### Employer API (`controller/employer_job_api.php`)

| Action | Method | Parameters | Description |
|---|---|---|---|
| `list` | GET | — | List employer's jobs |
| `create` | POST | `title`, `location`, `category`, `experience`, `type`, `description`, `requirements`, `salary_range` | Post a new job |
| `update` | POST | `id`, + all create fields | Update a job listing |
| `delete` | POST | `id` | Delete a job |
| `detail` | GET | `id` | Get job details |
| `toggle_status` | POST | `id`, `status` | Activate/close a job |
| `stats` | GET | — | Get dashboard statistics |
| `applicants` | GET | `job_id` | Get applicants for a job |
| `update_status` | POST | `application_id`, `status` | Update application status |

---

## Security

- Passwords hashed with **bcrypt** via `password_hash()`
- **Prepared statements** (MySQLi) used for all database queries to prevent SQL injection
- **Session-based authentication** with role validation
- Input sanitized with `htmlspecialchars()` on output
- Server-side **form validation** in addition to client-side validation

---

## Acknowledgements

- [Font Awesome](https://fontawesome.com/) for icons
- Placeholder images from placeholder services

---

## License

This project was developed as a web technology course project. All rights reserved.
