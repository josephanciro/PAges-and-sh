
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Project Timeline</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/pro-timeline.css') }}">
    @vite(['resources/css/pro-timeline.css', 'resources/js/pro-timeline.js'])
</head>

<body>
    <!-- MOBILE MENU BUTTON -->
    <button class="hamburger" id="hamburger"
        aria-label="Open navigation menu"
        aria-controls="sidebar"
        aria-expanded="false">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard.blade.php" class="sidebar-logo">
                <img src="logo.png" alt="Project Manager logo">
                <span>Project<span class="highlight">Manager</span></span>
            </a>

            <button class="sidebar-toggle" id="sidebarToggle"
                aria-label="Collapse sidebar"
                aria-expanded="true">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>

        <div class="menu-title">WORKSPACE</div>

        <nav class="menu">
            <a href="/dashboard.blade.php">
                <i class="menu-icon fa-solid fa-gauge-high"></i>
                <span class="sidebar-label">Dashboard</span>
            </a>

            <a href="/projects.blade.php" class="active">
                <i class="menu-icon fa-regular fa-folder-open"></i>
                <span class="sidebar-label">Projects</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-list-check"></i>
                <span class="sidebar-label">Tasks</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-regular fa-calendar-days"></i>
                <span class="sidebar-label">Calendar</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-people-group"></i>
                <span class="sidebar-label">Team</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-regular fa-folder"></i>
                <span class="sidebar-label">Files</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column"></i>
                <span class="sidebar-label">Reports</span>
            </a>
        </nav>

        <div class="bottom-menu">
            <div class="menu-title">ACCOUNT</div>

            <nav class="menu">
                <a href="#">
                    <i class="menu-icon fa-solid fa-gear"></i>
                    <span class="sidebar-label">Settings</span>
                </a>

                <a href="welcome.blade.php">
                    <i class="menu-icon fa-solid fa-right-from-bracket"></i>
                    <span class="sidebar-label">Log out</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="page-title">
                PROJECT WORKSPACE
            </div>

            <div class="user-area">
                <div class="notification" aria-label="Notifications">
                    <i class="fa-regular fa-bell"></i>
                </div>

                <div class="user">
                    <div class="avatar">J</div>
                    Jay
                </div>
            </div>
        </div>

        <!-- TIMELINE PAGE -->
        <div class="timeline-page">
            <div class="timeline-header">
                <a href="/project-details.blade.php" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Project
                </a>

                <h1>Project Timeline</h1>

                <p>
                    Riverside Bridge project schedule and progress.
                </p>
            </div>

            <!-- TIMELINE -->
            <div class="timeline-card">
                <div class="timeline">

                    <!-- STEP 1 -->
                    <div class="timeline-item completed">
                        <div class="timeline-dot"></div>

                        <div class="timeline-date">
                            September 01, 2026
                        </div>

                        <h2>Project Started</h2>

                        <p>
                            The Riverside Bridge project officially started.
                            Initial planning and preparation activities were completed.
                        </p>

                        <span class="timeline-status completed-status">
                            COMPLETED
                        </span>
                    </div>

                    <!-- STEP 2 -->
                    <div class="timeline-item completed">
                        <div class="timeline-dot"></div>

                        <div class="timeline-date">
                            September 05, 2026
                        </div>

                        <h2>Site Preparation</h2>

                        <p>
                            The project area was prepared and the required
                            materials and equipment were organized.
                        </p>

                        <span class="timeline-status completed-status">
                            COMPLETED
                        </span>
                    </div>

                    <!-- STEP 3 -->
                    <div class="timeline-item current">
                        <div class="timeline-dot"></div>

                        <div class="timeline-date">
                            September 15, 2026
                        </div>

                        <h2>Bridge Construction</h2>

                        <p>
                            Main construction activities are currently being
                            performed. Structural work is in progress.
                        </p>

                        <span class="timeline-status current-status">
                            IN PROGRESS
                        </span>
                    </div>

                    <!-- STEP 4 -->
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>

                        <div class="timeline-date">
                            October 10, 2026
                        </div>

                        <h2>Safety Inspection</h2>

                        <p>
                            The completed construction sections will be checked
                            for safety and quality.
                        </p>

                        <span class="timeline-status upcoming-status">
                            UPCOMING
                        </span>
                    </div>

                    <!-- STEP 5 -->
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>

                        <div class="timeline-date">
                            October 24, 2026
                        </div>

                        <h2>Project Completion</h2>

                        <p>
                            Final inspection and project completion are scheduled
                            for this date.
                        </p>

                        <span class="timeline-status upcoming-status">
                            UPCOMING
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- JAVASCRIPT -->
    

    <script src="{{ asset('js/pro-timeline.js') }}"></script>
</body>
</html>