
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Project Details</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pro-details.css') }}">
    @vite(['resources/css/pro-details.css', 'resources/js/pro-details.js'])
</head>

<body>

    <!-- MOBILE MENU BUTTON -->
    <button
        class="hamburger"
        id="hamburger"
        type="button"
        aria-label="Open sidebar"
        aria-expanded="false"
    >
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <a href="/dashboard.blade.php" class="sidebar-logo">
                <img src="logo.png" alt="ProjectManager logo">

                <span class="sidebar-label">
                    Project<span class="highlight">Manager</span>
                </span>
            </a>

            <button
                class="sidebar-toggle"
                id="sidebarToggle"
                type="button"
                aria-label="Collapse sidebar"
                aria-expanded="true"
            >
                <i class="fa-solid fa-angles-left" aria-hidden="true"></i>
            </button>
        </div>

        <div class="menu-title">WORKSPACE</div>

        <nav class="menu" aria-label="Workspace navigation">

            <a href="/dashboard.blade.php">
                <i class="menu-icon fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span class="sidebar-label">Dashboard</span>
            </a>

            <a href="/projects.blade.php" class="active">
                <i class="menu-icon fa-solid fa-folder-open" aria-hidden="true"></i>
                <span class="sidebar-label">Projects</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-list-check" aria-hidden="true"></i>
                <span class="sidebar-label">Tasks</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-calendar-days" aria-hidden="true"></i>
                <span class="sidebar-label">Calendar</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-people-group" aria-hidden="true"></i>
                <span class="sidebar-label">Team</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-folder" aria-hidden="true"></i>
                <span class="sidebar-label">Files</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column" aria-hidden="true"></i>
                <span class="sidebar-label">Reports</span>
            </a>

        </nav>

        <div class="bottom-menu">
            <div class="menu-title">ACCOUNT</div>

            <nav class="menu" aria-label="Account navigation">

                <a href="#">
                    <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                    <span class="sidebar-label">Settings</span>
                </a>

                <a href="welcome.blade.php">
                    <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
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

                <button
                    class="notification"
                    type="button"
                    aria-label="Notifications"
                >
                    <i class="fa-regular fa-bell" aria-hidden="true"></i>
                </button>

                <div class="user">
                    <div class="avatar">J</div>
                    <span>Jay</span>
                </div>

            </div>

        </div>

        <!-- PROJECT DETAILS -->
        <div class="project-details-page">

            <a href="/projects.blade.php" class="back-link">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                Back to Projects
            </a>

            <!-- PROJECT HEADER -->
            <div class="project-header">

                <div>
                    <h1>Riverside Bridge</h1>
                    <p>Bridge Construction</p>
                </div>

                <span class="status">IN PROGRESS</span>

            </div>

            <!-- DETAILS GRID -->
            <div class="details-grid">

                <!-- LEFT COLUMN -->
                <div>

                    <!-- PROJECT DESCRIPTION -->
                    <div class="details-card">

                        <h2>
                            <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                            &nbsp; Project Description
                        </h2>

                        <p class="description">
                            Construction and improvement of the Riverside
                            Bridge to improve transportation and public access.
                            The project includes structural improvements,
                            road connections, and safety improvements around
                            the bridge area.
                        </p>

                    </div>

                    <!-- PROJECT PROGRESS -->
                    <div class="details-card" style="margin-top: 20px;">

                        <h2>
                            <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                            &nbsp; Project Progress
                        </h2>

                        <div class="progress-info">
                            <span>Overall Progress</span>
                            <strong>72%</strong>
                        </div>

                        <div
                            class="progress-bar"
                            role="progressbar"
                            aria-valuenow="72"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            aria-label="Overall project progress"
                        >
                            <div class="progress"></div>
                        </div>

                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="action-buttons">

                        <a href="#" class="primary-btn">
                            <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            Edit Project
                        </a>

                        <a href="/pro-timeline.blade.php" class="secondary-btn">
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                            View Timeline
                        </a>

                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="details-card">

                    <h2>
                        <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                        &nbsp; Project Information
                    </h2>

                    <div class="info-list">

                        <div class="info-item">
                            <span class="info-label">Project Type</span>
                            <span class="info-value">Bridge Construction</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="info-value">In Progress</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Start Date</span>
                            <span class="info-value">Sep 01, 2026</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Expected End</span>
                            <span class="info-value">Oct 24, 2026</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Location</span>
                            <span class="info-value">Riverside Area</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Project Manager</span>
                            <span class="info-value">Jay</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

    <!-- JAVASCRIPT -->
    
    <script src="{{ asset('js/pro-details.js') }}"></script>

</body>
</html>