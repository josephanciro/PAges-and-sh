
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
    @vite(['resources/css/projects.css', 'resources/js/projects.js'])
</head>

<body>
    <!-- MOBILE HAMBURGER BUTTON -->
    <button
        class="hamburger"
        id="hamburger"
        type="button"
        aria-label="Open sidebar"
        aria-expanded="false"
        aria-controls="sidebar"
    >
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <button
        class="sidebar-overlay"
        id="sidebarOverlay"
        type="button"
        aria-label="Close sidebar"
        tabindex="-1"
    ></button>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-logo">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Project Manager logo"
                >
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

            <a href="/projects.blade.php" class="active" aria-current="page">
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

                <a href="/Welcome.blade.php">
                    <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    <span class="sidebar-label">Log out</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">
        <!-- TOP BAR -->
        <div class="topbar">
            <div class="page-title">PROJECT WORKSPACE</div>

            <div class="user-area">
                <button class="notification" type="button" aria-label="Notifications">
                    <i class="fa-regular fa-bell" aria-hidden="true"></i>
                </button>

                <div class="user">
                    <div class="avatar">J</div>
                    <span>Jay</span>
                </div>
            </div>
        </div>

        <!-- PROJECTS PAGE -->
        <div class="projects-page">
            <!-- HEADER -->
            <div class="projects-header">
                <div>
                    <h1>Projects</h1>
                    <p>Manage and monitor your current projects.</p>
                </div>

                <a href="/create-project.blade.php" class="create-btn">
                    + Create New Project
                </a>
            </div>

            <!-- FILTERS -->
            <div class="project-filters" role="group" aria-label="Filter projects">
                <button class="active" type="button" data-filter="all" aria-pressed="true">
                    All Projects
                </button>

                <button type="button" data-filter="progress" aria-pressed="false">
                    In Progress
                </button>

                <button type="button" data-filter="planning" aria-pressed="false">
                    Planning
                </button>

                <button type="button" data-filter="completed" aria-pressed="false">
                    Completed
                </button>
            </div>

            <!-- PROJECT LIST -->
            <div class="projects-list" id="projectsList">
                <!-- PROJECT 1 -->
                <article class="project-card" data-status="progress">
                    <div class="project-card-top">
                        <div>
                            <h2>Riverside Bridge</h2>
                            <div class="project-type">Bridge Construction</div>
                        </div>

                        <span class="project-status status-progress">IN PROGRESS</span>
                    </div>

                    <p class="project-description">
                        Construction and improvement of the Riverside Bridge
                        to improve transportation and public access.
                    </p>

                    <div class="progress-info">
                        <span>Progress</span>
                        <strong>72%</strong>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="--progress-width: 72%;"></div>
                    </div>

                    <div class="project-details">
                        <span>Start: Sep 01, 2026</span>
                        <span>Due: Oct 24, 2026</span>
                    </div>

                    <a href="/project-details.blade.php" class="view-project">
                        View Project →
                    </a>
                </article>

                <!-- PROJECT 2 -->
                <article class="project-card" data-status="progress">
                    <div class="project-card-top">
                        <div>
                            <h2>City Road Improvement</h2>
                            <div class="project-type">Road Development</div>
                        </div>

                        <span class="project-status status-progress">IN PROGRESS</span>
                    </div>

                    <p class="project-description">
                        Improvement of existing roads and drainage systems
                        to improve transportation within the community.
                    </p>

                    <div class="progress-info">
                        <span>Progress</span>
                        <strong>48%</strong>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="--progress-width: 48%;"></div>
                    </div>

                    <div class="project-details">
                        <span>Start: Sep 15, 2026</span>
                        <span>Due: Nov 12, 2026</span>
                    </div>

                    <a href="#" class="view-project">
                        View Project →
                    </a>
                </article>

                <!-- PROJECT 3 -->
                <article class="project-card" data-status="planning">
                    <div class="project-card-top">
                        <div>
                            <h2>Community Center</h2>
                            <div class="project-type">Public Facility</div>
                        </div>

                        <span class="project-status status-planning">PLANNING</span>
                    </div>

                    <p class="project-description">
                        Development of a community center that will provide
                        services and spaces for local residents.
                    </p>

                    <div class="progress-info">
                        <span>Progress</span>
                        <strong>24%</strong>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="--progress-width: 24%;"></div>
                    </div>

                    <div class="project-details">
                        <span>Start: Oct 01, 2026</span>
                        <span>Due: Dec 05, 2026</span>
                    </div>

                    <a href="#" class="view-project">
                        View Project →
                    </a>
                </article>

                <!-- PROJECT 4 -->
                <article class="project-card" data-status="completed">
                    <div class="project-card-top">
                        <div>
                            <h2>Public Market Renovation</h2>
                            <div class="project-type">Public Facility</div>
                        </div>

                        <span class="project-status status-completed">COMPLETED</span>
                    </div>

                    <p class="project-description">
                        Renovation and improvement of the existing public
                        market facilities.
                    </p>

                    <div class="progress-info">
                        <span>Progress</span>
                        <strong>100%</strong>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="--progress-width: 100%;"></div>
                    </div>

                    <div class="project-details">
                        <span>Start: Jun 10, 2026</span>
                        <span>Completed: Sep 20, 2026</span>
                    </div>

                    <a href="#" class="view-project">
                        View Project →
                    </a>
                </article>
            </div>
        </div>
    </main>

    

    <script src="{{ asset('js/projects.js') }}"></script>
</body>
</html>