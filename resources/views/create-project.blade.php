
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Create Project</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/pro-create.css') }}">
    @vite(['resources/css/pro-create.css', 'resources/js/pro-create.js'])
</head>

<body>

    <!-- MOBILE MENU -->
    <button class="hamburger" id="hamburger" aria-label="Open navigation menu">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <div class="logo-box"></div>
            Project<span>Manager</span>
        </div>

        <div class="menu-title">WORKSPACE</div>

        <nav class="menu">
            <a href="/dashboard.blade.php">
                <i class="menu-icon fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

            <a href="/projects.blade.php" class="active">
                <i class="menu-icon fa-solid fa-folder-open" aria-hidden="true"></i>
                <span>Projects (Create)</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-list-check" aria-hidden="true"></i>
                <span>Tasks</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-calendar-days" aria-hidden="true"></i>
                <span>Calendar</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-people-group" aria-hidden="true"></i>
                <span>Team</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-folder" aria-hidden="true"></i>
                <span>Files</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column" aria-hidden="true"></i>
                <span>Reports</span>
            </a>
        </nav>

        <div class="bottom-menu">
            <div class="menu-title">ACCOUNT</div>

            <nav class="menu">
                <a href="#">
                    <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                </a>

                <a href="welcome.blade.php">
                    <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    <span>Log out</span>
                </a>
            </nav>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="main" id="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="page-title">PROJECT WORKSPACE</div>

            <div class="user-area">
                <div class="notification" aria-label="Notifications">
                    <i class="fa-regular fa-bell" aria-hidden="true"></i>
                </div>

                <div class="user">
                    <div class="avatar">J</div>
                    <span>Jay</span>
                </div>
            </div>
        </header>

        <!-- CREATE PROJECT -->
        <div class="create-page">

            <div class="create-header">
                <div>
                    <div class="section-label">PROJECT MANAGEMENT</div>
                    <h1>Create New Project</h1>
                    <p>Add the basic information for a new project.</p>
                </div>

                <div class="header-icon">
                    <i class="fa-solid fa-folder-plus" aria-hidden="true"></i>
                </div>
            </div>

            <div class="form-card">

                <!-- PROJECT INFORMATION -->
                <section class="form-section">

                    <div class="form-section-heading">
                        <div class="section-icon">
                            <i class="fa-solid fa-file-lines" aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2>Project Information</h2>
                            <p>Enter the main details about your project.</p>
                        </div>
                    </div>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label for="projectName">Project Name <span>*</span></label>
                            <input
                                type="text"
                                id="projectName"
                                name="project_name"
                                placeholder="Enter project name"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="projectType">Project Type <span>*</span></label>
                            <select id="projectType" name="project_type" required>
                                <option value="">Select project type</option>
                                <option value="Road Development">Road Development</option>
                                <option value="Bridge Construction">Bridge Construction</option>
                                <option value="Public Facility">Public Facility</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Initial Status</label>
                            <select id="status" name="status">
                                <option value="Planning">Planning</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                        </div>

                        <div class="form-group full">
                            <label for="description">Project Description</label>
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Describe the project, its goals, and expected outcomes..."
                                rows="5"
                            ></textarea>
                        </div>

                    </div>
                </section>

                <!-- PROJECT SCHEDULE -->
                <section class="form-section">

                    <div class="form-section-heading">
                        <div class="section-icon">
                            <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2>Project Schedule</h2>
                            <p>Set the planned start and expected completion dates.</p>
                        </div>
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="startDate">Start Date <span>*</span></label>
                            <input
                                type="date"
                                id="startDate"
                                name="start_date"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="endDate">Expected End Date <span>*</span></label>
                            <input
                                type="date"
                                id="endDate"
                                name="end_date"
                                required
                            >
                        </div>

                    </div>
                </section>

                <!-- PROJECT LOCATION -->
                <section class="form-section">

                    <div class="form-section-heading">
                        <div class="section-icon">
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2>Project Location</h2>
                            <p>Specify where the project will take place.</p>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group full">
                            <label for="location">Location <span>*</span></label>

                            <div class="input-with-icon">
                                <i class="fa-solid fa-map-pin" aria-hidden="true"></i>
                                <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    placeholder="Enter project location"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ACTIONS -->
                <div class="form-actions">
                    <a href="/projects.blade.php" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="button" class="save-btn" id="createProjectBtn">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                        Create Project
                    </button>
                </div>

            </div>

            <div class="form-footer">
                <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                <span>Make sure the project details are correct before creating it.</span>
            </div>

        </div>

    </main>

    <!-- JAVASCRIPT -->
    
    <script src="{{ asset('js/pro-create.js') }}"></script>
</body>
</html>