<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    
</head>

<body>

    <!-- MOBILE MENU BUTTON -->
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
            <a href="/dashboard.blade.php" class="sidebar-logo">
                <img src="logo.png" alt="Project Manager logo">
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
                title="Collapse sidebar"
            >
                <i class="fa-solid fa-angles-left" aria-hidden="true"></i>
            </button>
        </div>

        <div class="menu-title">WORKSPACE</div>

        <nav class="menu" aria-label="Workspace navigation">
            <a href="/dashboard.blade.php" class="active">
                <i class="menu-icon fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span class="sidebar-label">Dashboard</span>
            </a>

            <a href="/projects.blade.php">
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

        <!-- BOTTOM SIDEBAR -->

        <div class="bottom-menu">
            <div class="menu-title">ACCOUNT</div>

            <nav class="menu" aria-label="Account navigation">
                <a href="#">
                    <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                    <span class="sidebar-label">Settings</span>
                </a>
                
                <a href="Welcome.blade.php">
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

        <!-- WELCOME -->
        <section class="welcome">
            <h1>Good morning, Jay</h1>
            <p>Here's what's happening with your projects.</p>
        </section>

        <!-- STATISTICS -->
        <section class="stats">
            <div class="stat-card">
                <div class="stat-label">ACTIVE PROJECTS</div>
                <div class="stat-number">8</div>
                <div class="stat-small">Projects currently active</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">IN PROGRESS</div>
                <div class="stat-number">3</div>
                <div class="stat-small">Projects being worked on</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">TASKS DUE</div>
                <div class="stat-number">12</div>
                <div class="stat-small">Tasks requiring attention</div>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="content-grid">

            <!-- ACTIVE PROJECTS -->
            <div class="card">
                <div class="card-header">
                    <h2>Active Projects</h2>
                    <a href="#" class="view-all">View all →</a>
                </div>

                <div class="project">
                    <div class="project-top">
                        <div class="project-name">Riverside Bridge</div>
                        <div class="status">IN PROGRESS</div>
                    </div>
                    <div class="project-type">Bridge Construction</div>
                    <div class="progress-bar">
                        <div class="progress" style="width: 72%;"></div>
                    </div>
                    <div class="project-bottom">
                        <span>72% complete</span>
                        <span>Due Oct 24, 2026</span>
                    </div>
                </div>

                <div class="project">
                    <div class="project-top">
                        <div class="project-name">City Road Improvement</div>
                        <div class="status">IN PROGRESS</div>
                    </div>
                    <div class="project-type">Road Development</div>
                    <div class="progress-bar">
                        <div class="progress" style="width: 48%;"></div>
                    </div>
                    <div class="project-bottom">
                        <span>48% complete</span>
                        <span>Due Nov 12, 2026</span>
                    </div>
                </div>

                <div class="project">
                    <div class="project-top">
                        <div class="project-name">Community Center</div>
                        <div class="status">PLANNING</div>
                    </div>
                    <div class="project-type">Public Facility</div>
                    <div class="progress-bar">
                        <div class="progress" style="width: 24%;"></div>
                    </div>
                    <div class="project-bottom">
                        <span>24% complete</span>
                        <span>Due Dec 05, 2026</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div>

                <!-- UPCOMING TASKS -->
                <div class="card">
                    <div class="card-header">
                        <h2>Upcoming Tasks</h2>
                        <a href="#" class="view-all">View all →</a>
                    </div>

                    <div class="task">
                        <div class="task-icon">
                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="task-info">
                            <div class="task-name">Inspect bridge site</div>
                            <div class="task-date">Today · 2:00 PM</div>
                        </div>
                    </div>

                    <div class="task">
                        <div class="task-icon">
                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="task-info">
                            <div class="task-name">Submit road report</div>
                            <div class="task-date">Tomorrow</div>
                        </div>
                    </div>

                    <div class="task">
                        <div class="task-icon">
                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="task-info">
                            <div class="task-name">Review project plans</div>
                            <div class="task-date">Oct 04, 2026</div>
                        </div>
                    </div>
                </div>

                <!-- RECENT ACTIVITY -->
                <div class="card activity">
                    <div class="card-header">
                        <h2>Recent Activity</h2>
                    </div>

                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div>
                            <div class="activity-text">
                                Riverside Bridge project was updated.
                            </div>
                            <div class="activity-time">10 minutes ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div>
                            <div class="activity-text">
                                Task "Site inspection" was completed.
                            </div>
                            <div class="activity-time">1 hour ago</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div>
                            <div class="activity-text">
                                New team member was added.
                            </div>
                            <div class="activity-time">3 hours ago</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>
</html>

