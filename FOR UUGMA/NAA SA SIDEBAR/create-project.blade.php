<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Create Project</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --primary: #123F3A;
            --primary-hover: #1D4D48;
            --accent: #D7F56B;
            --background: #F5F4EE;
            --white: #FFFFFF;
            --secondary: #71817E;
            --muted: #8A9693;
            --border: #E0E1DA;
            --light-green: #EEF3DC;
            --motion: cubic-bezier(.22, 1, .36, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: var(--background);
            color: var(--primary);
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        /* SIDEBAR */

        .sidebar {
            width: 260px;
            min-width: 260px;
            height: 100vh;
            background: var(--primary);
            color: var(--white);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width .3s var(--motion),
                        min-width .3s var(--motion),
                        transform .3s var(--motion);
            z-index: 1000;
        }

        .sidebar-header {
            height: 80px;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            gap: 12px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            color: var(--white);
            text-decoration: none;
            font-size: 19px;
            font-weight: 700;
            white-space: nowrap;
            min-width: 0;
        }

        .highlight {
            color: var(--accent);
        }

        .sidebar-toggle {
            border: none;
            background: transparent;
            color: var(--white);
            cursor: pointer;
            font-size: 17px;
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 6px;
            transition: background .2s ease;
        }

        .sidebar-toggle:hover {
            background: var(--primary-hover);
        }

        .menu-title {
            padding: 25px 20px 10px;
            color: #A9BCB7;
            font-size: 10px;
            letter-spacing: 1.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .menu {
            display: flex;
            flex-direction: column;
            padding: 0 12px;
            gap: 4px;
        }

        .menu a {
            height: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 14px;
            border-radius: 7px;
            color: #D6E0DD;
            text-decoration: none;
            font-size: 13px;
            white-space: nowrap;
            transition: background .2s ease, color .2s ease;
        }

        .menu a:hover {
            background: var(--primary-hover);
            color: var(--white);
        }

        .menu a.active {
            background: var(--accent);
            color: var(--primary);
            font-weight: 700;
        }

        .menu-icon {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-label {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bottom-menu {
            margin-top: auto;
            padding-bottom: 18px;
        }

        .sidebar.sidebar-collapsed {
            width: 76px;
            min-width: 76px;
        }

        .sidebar.sidebar-collapsed .sidebar-header {
            padding: 0;
            justify-content: center;
        }

        .sidebar.sidebar-collapsed .sidebar-logo,
        .sidebar.sidebar-collapsed .menu-title,
        .sidebar.sidebar-collapsed .sidebar-label {
            display: none;
        }

        .sidebar.sidebar-collapsed .sidebar-toggle {
            transform: rotate(180deg);
        }

        .sidebar.sidebar-collapsed .menu {
            padding: 0 10px;
        }

        .sidebar.sidebar-collapsed .menu a {
            justify-content: center;
            padding: 0;
            gap: 0;
        }

        .sidebar.sidebar-collapsed .menu-icon {
            font-size: 18px;
        }

        .sidebar.sidebar-collapsed .bottom-menu {
            margin-top: auto;
        }

        /* MOBILE SIDEBAR CONTROLS */

        .hamburger {
            display: none;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--white);
            color: var(--primary);
            cursor: pointer;
            font-size: 19px;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1200;
        }

        .hamburger.menu-open {
            display: none;
        }

        .sidebar-overlay {
            display: none;
        }

        /* MAIN CONTENT */

        .main {
            flex: 1;
            min-width: 0;
            padding: 0 32px 40px;
        }

        .topbar {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid var(--border);
        }

        .page-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: var(--secondary);
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .notification {
            border: none;
            background: transparent;
            color: var(--secondary);
            font-size: 19px;
            cursor: pointer;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .avatar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--light-green);
            color: var(--primary);
            font-size: 14px;
            font-weight: 700;
        }

        /* CREATE PROJECT PAGE */

        .create-page {
            max-width: 1000px;
            margin: 35px auto 0;
        }

        .create-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 28px;
        }

        .create-heading h1 {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -.5px;
            margin-bottom: 9px;
        }

        .create-heading p {
            color: var(--secondary);
            font-size: 14px;
            line-height: 1.6;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s ease;
        }

        .back-button:hover {
            background: var(--light-green);
        }

        .create-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-heading {
            padding: 23px 26px;
            border-bottom: 1px solid var(--border);
        }

        .card-heading h2 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .card-heading p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .create-form {
            padding: 26px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 23px 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
            min-width: 0;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: #B94A48;
        }

        .form-control {
            width: 100%;
            min-height: 44px;
            padding: 11px 13px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--primary);
            font-size: 13px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .form-control::placeholder {
            color: #A0AAA7;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(18, 63, 58, .08);
        }

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control {
            cursor: pointer;
        }

        .form-hint {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-top: 25px;
            margin-top: 27px;
            border-top: 1px solid var(--border);
        }

        .btn {
            min-height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s ease, border-color .2s ease;
        }

        .btn-cancel {
            background: var(--white);
            border-color: var(--border);
            color: var(--secondary);
        }

        .btn-cancel:hover {
            background: var(--background);
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .form-message {
            display: none;
            margin-top: 20px;
            padding: 13px 15px;
            border: 1px solid #E6D6A8;
            border-radius: 7px;
            background: #FFF9E8;
            color: #775D1B;
            font-size: 12px;
            line-height: 1.6;
        }

        .form-message.show {
            display: block;
        }

        /* RESPONSIVE */

        @media (max-width: 1000px) {
            .main {
                padding-left: 24px;
                padding-right: 24px;
            }

            .create-page {
                margin-top: 28px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 260px;
                min-width: 260px;
                height: 100vh;
                height: 100dvh;
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 10px 0 35px rgba(0, 0, 0, .15);
            }

            .sidebar.sidebar-collapsed {
                width: 260px;
                min-width: 260px;
            }

            .sidebar.sidebar-collapsed .sidebar-header {
                padding: 0 20px;
                justify-content: space-between;
            }

            .sidebar.sidebar-collapsed .sidebar-logo,
            .sidebar.sidebar-collapsed .menu-title,
            .sidebar.sidebar-collapsed .sidebar-label {
                display: initial;
            }

            .sidebar.sidebar-collapsed .sidebar-toggle {
                transform: none;
            }

            .sidebar.sidebar-collapsed .menu {
                padding: 0 12px;
            }

            .sidebar.sidebar-collapsed .menu a {
                justify-content: flex-start;
                padding: 0 14px;
                gap: 14px;
            }

            .sidebar.sidebar-collapsed .menu-icon {
                font-size: 16px;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 900;
                background: rgba(10, 30, 27, .45);
                border: none;
                padding: 0;
                display: block;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity .3s ease, visibility .3s ease;
            }

            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }

            .hamburger {
                display: flex;
            }

            .main {
                width: 100%;
                padding: 0 18px 30px;
            }

            .topbar {
                min-height: 72px;
                padding-left: 48px;
            }

            .page-title {
                font-size: 10px;
                letter-spacing: 1px;
            }

            .user-area {
                gap: 13px;
            }

            .user {
                gap: 7px;
            }

            .avatar {
                width: 32px;
                height: 32px;
            }

            .create-page {
                margin-top: 25px;
            }

            .create-heading h1 {
                font-size: 24px;
            }

            .create-header {
                margin-bottom: 22px;
            }

            .card-heading {
                padding: 21px;
            }

            .create-form {
                padding: 21px;
            }

            .form-grid {
                gap: 20px 16px;
            }
        }

        @media (max-width: 520px) {
            .main {
                padding-left: 14px;
                padding-right: 14px;
            }

            .topbar {
                gap: 10px;
                padding-left: 47px;
            }

            .page-title {
                max-width: 125px;
                line-height: 1.5;
            }

            .user-area {
                gap: 10px;
            }

            .user {
                font-size: 12px;
            }

            .notification {
                font-size: 17px;
            }

            .create-header {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .create-heading h1 {
                font-size: 23px;
            }

            .back-button {
                align-self: flex-start;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .form-group.full-width {
                grid-column: auto;
            }

            .card-heading {
                padding: 18px;
            }

            .create-form {
                padding: 18px;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <button class="hamburger" id="hamburger" type="button"
            aria-label="Open sidebar" aria-expanded="false"
            aria-controls="sidebar">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <button class="sidebar-overlay" id="sidebarOverlay" type="button"
            aria-label="Close sidebar" tabindex="-1"></button>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-logo">
                <span class="sidebar-label">Project<span class="highlight">Manager</span></span>
            </a>

            <button class="sidebar-toggle" id="sidebarToggle" type="button"
                    aria-label="Expand sidebar" aria-expanded="false"
                    title="Expand sidebar">
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
                <i class="menu-icon fa-solid fa-map" aria-hidden="true"></i>
                <span class="sidebar-label">Project Map</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column" aria-hidden="true"></i>
                <span class="sidebar-label">Reports</span>
            </a>

            <div class="menu-title">ACCOUNT</div>

            <nav class="menu" aria-label="Account navigation">
                <a href="/settings">
                    <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                    <span class="sidebar-label">Settings</span>
                </a>

                <a href="/logout">
                    <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    <span class="sidebar-label">Log out</span>
                </a>
            </nav>
        </nav>
    </aside>

    <main class="main">

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

        <section class="create-page">

            <div class="create-header">
                <div class="create-heading">
                    <h1>Create Project</h1>
                    <p>Enter the project details to create a new project.</p>
                </div>
                <!-- EDIT TO CHANGE LOCATION -->
                <a href="/projects.blade.php" class="back-button">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    Back to Projects
                </a>
            </div>

            <div class="create-card">

                <div class="card-heading">
                    <h2>Project Information</h2>
                    <p>Complete the required fields marked with an asterisk (*).</p>
                </div>

                <form class="create-form" id="createProjectForm">

                    <div class="form-grid">

                        <div class="form-group full-width">
                            <label for="projectName">
                                Project Name <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="projectName"
                                name="project_name"
                                placeholder="Enter project name"
                                maxlength="150"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="projectType">
                                Project Type <span class="required">*</span>
                            </label>

                            <select
                                class="form-control"
                                id="projectType"
                                name="project_type"
                                required
                            >
                                <option value="">Select project type</option>
                                <option value="Building Construction">Building Construction</option>
                                <option value="Road Construction">Road Construction</option>
                                <option value="Bridge Construction">Bridge Construction</option>
                                <option value="Infrastructure">Infrastructure</option>
                                <option value="Renovation">Renovation</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectStatus">
                                Project Status <span class="required">*</span>
                            </label>

                            <select
                                class="form-control"
                                id="projectStatus"
                                name="status"
                                required
                            >
                                <option value="Planning" selected>Planning</option>
                                <option value="In Progress">In Progress</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="projectDescription">
                                Project Description <span class="required">*</span>
                            </label>

                            <textarea
                                class="form-control"
                                id="projectDescription"
                                name="description"
                                placeholder="Describe the purpose and scope of the project"
                                required
                            ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="startDate">
                                Start Date <span class="required">*</span>
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                id="startDate"
                                name="start_date"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="dueDate">
                                Due Date <span class="required">*</span>
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                id="dueDate"
                                name="due_date"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="budget">
                                Project Budget <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="budget"
                                name="budget"
                                placeholder="Enter project budget"
                                min="0"
                                step="0.01"
                                required
                            >

                            <span class="form-hint">
                                Enter the total estimated project budget.
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="projectManager">
                                Project Manager <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="projectManager"
                                name="project_manager"
                                placeholder="Enter project manager's name"
                                maxlength="100"
                                required
                            >
                        </div>

                    </div>

                    <div class="form-message" id="formMessage" role="status" aria-live="polite"></div>

                    <div class="form-actions">
                        <a href="/projects" class="btn btn-cancel">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i>
                            Create Project
                        </button>
                    </div>

                </form>
            </div>

        </section>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");

            function closeMobileSidebar() {
                sidebar.classList.remove("open");
                overlay.classList.remove("show");
                hamburger.classList.remove("menu-open");

                hamburger.setAttribute("aria-expanded", "false");
                hamburger.setAttribute("aria-label", "Open sidebar");
                overlay.setAttribute("tabindex", "-1");

                document.body.style.overflow = "";
            }

            function openMobileSidebar() {
                if (!mobileQuery.matches) return;

                sidebar.classList.add("open");
                overlay.classList.add("show");
                hamburger.classList.add("menu-open");

                hamburger.setAttribute("aria-expanded", "true");
                hamburger.setAttribute("aria-label", "Close sidebar");
                overlay.setAttribute("tabindex", "0");

                document.body.style.overflow = "hidden";
            }

            function setDesktopState() {
                sidebar.classList.remove("open");
                sidebar.classList.add("sidebar-collapsed");

                sidebarToggle.setAttribute("aria-expanded", "false");
                sidebarToggle.setAttribute("aria-label", "Expand sidebar");
                sidebarToggle.setAttribute("title", "Expand sidebar");
            }

            function updateViewport() {
                closeMobileSidebar();

                if (mobileQuery.matches) {
                    sidebar.classList.remove("sidebar-collapsed");
                } else {
                    setDesktopState();
                }
            }

            if (mobileQuery.matches) {
                sidebar.classList.remove("sidebar-collapsed");
            } else {
                setDesktopState();
            }

            hamburger.addEventListener("click", function () {
                if (!mobileQuery.matches) return;

                if (sidebar.classList.contains("open")) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            });

            overlay.addEventListener("click", closeMobileSidebar);

            sidebarToggle.addEventListener("click", function () {
                if (mobileQuery.matches) return;

                const isCollapsed = sidebar.classList.toggle("sidebar-collapsed");

                sidebarToggle.setAttribute("aria-expanded", String(!isCollapsed));
                sidebarToggle.setAttribute(
                    "aria-label",
                    isCollapsed ? "Expand sidebar" : "Collapse sidebar"
                );
                sidebarToggle.setAttribute(
                    "title",
                    isCollapsed ? "Expand sidebar" : "Collapse sidebar"
                );
            });

            sidebar.querySelectorAll(".menu a").forEach(function (link) {
                link.addEventListener("click", function () {
                    if (mobileQuery.matches) {
                        closeMobileSidebar();
                    }
                });
            });

            document.addEventListener("keydown", function (event) {
                if (event.key === "Escape" && sidebar.classList.contains("open")) {
                    closeMobileSidebar();
                    hamburger.focus();
                }
            });

            if (mobileQuery.addEventListener) {
                mobileQuery.addEventListener("change", updateViewport);
            } else {
                mobileQuery.addListener(updateViewport);
            }

            /* PROJECT FORM */

            const form = document.getElementById("createProjectForm");
            const startDate = document.getElementById("startDate");
            const dueDate = document.getElementById("dueDate");
            const formMessage = document.getElementById("formMessage");

            function validateDates() {
                if (startDate.value && dueDate.value) {
                    dueDate.min = startDate.value;

                    if (dueDate.value < startDate.value) {
                        dueDate.setCustomValidity(
                            "The due date cannot be earlier than the start date."
                        );
                    } else {
                        dueDate.setCustomValidity("");
                    }
                } else {
                    dueDate.setCustomValidity("");
                }
            }

            startDate.addEventListener("change", validateDates);
            dueDate.addEventListener("change", validateDates);

            form.addEventListener("submit", function (event) {
                event.preventDefault();
                validateDates();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                formMessage.textContent =
                    "The form is ready, but the project has not been saved. Connect this form to your Laravel route and database to store new projects.";

                formMessage.classList.add("show");
            });
        });
    </script>

</body>
</html>