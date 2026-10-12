
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Edit Project</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

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

        html { scroll-behavior: smooth; }

        body {
            display: flex;
            min-height: 100vh;
            color: var(--primary);
            background: var(--background);
            overflow-x: hidden;
        }

        button, a, input, select, textarea {
            -webkit-tap-highlight-color: transparent;
        }

        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        button, input, select, textarea { font: inherit; }

        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes sidebarEntrance {
            from { opacity: 0; transform: translateX(-18px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(24px) scale(.985);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes notificationPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(215, 245, 107, 0); }
            50% { box-shadow: 0 0 0 5px rgba(215, 245, 107, .2); }
        }

        /* SHARED SIDEBAR */

        .sidebar {
            position: relative;
            z-index: 1000;
            display: flex;
            flex: 0 0 260px;
            width: 260px;
            min-width: 260px;
            min-height: 100vh;
            flex-direction: column;
            padding: 24px 16px 18px;
            overflow: hidden;
            color: white;
            background: var(--primary);
            transition:
                width .3s var(--motion),
                min-width .3s var(--motion),
                flex-basis .3s var(--motion),
                padding .3s ease,
                transform .35s var(--motion);
        }

        .sidebar-header {
            display: flex;
            min-height: 40px;
            align-items: center;
            margin-bottom: 42px;
        }

        .sidebar-logo {
            display: flex;
            min-width: 0;
            align-items: center;
            gap: 11px;
            color: white;
            font-size: 17px;
            font-weight: bold;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            opacity: 1;
            transition: opacity .2s ease, transform .3s ease;
        }

        .sidebar-logo img {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 8px;
            object-fit: contain;
        }

        .sidebar-logo .highlight { color: var(--accent); }

        .sidebar-toggle {
            display: grid;
            width: 34px;
            height: 34px;
            margin-left: auto;
            padding: 7px;
            flex-shrink: 0;
            place-items: center;
            border: none;
            border-radius: 8px;
            background: transparent;
            cursor: pointer;
            transition: background .25s ease, transform .25s ease;
        }

        .sidebar-toggle:hover { background: var(--primary-hover); }
        .sidebar-toggle:active { transform: scale(.92); }

        .sidebar-toggle i {
            color: var(--accent);
            font-size: 18px;
            transition: transform .35s var(--motion);
        }

        .menu-title {
            margin: 0 12px 12px;
            color: #78928E;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1.5px;
            white-space: nowrap;
            transition: opacity .2s ease, margin .25s ease;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            position: relative;
            display: flex;
            width: 100%;
            height: 44px;
            flex-shrink: 0;
            align-items: center;
            gap: 13px;
            padding: 0 12px;
            border-radius: 8px;
            color: #B8CECA;
            font-size: 12px;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            transition:
                color .25s ease,
                background .25s ease,
                transform .25s ease,
                padding .3s ease;
        }

        .menu a:hover {
            color: white;
            background: var(--primary-hover);
            transform: translateX(2px);
        }

        .menu a.active {
            color: var(--primary);
            background: var(--accent);
            font-weight: bold;
        }

        .menu-icon {
            display: inline-flex;
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
            align-items: center;
            justify-content: center;
            color: #B8CECA;
            font-size: 16px;
            line-height: 1;
            transition: color .25s ease, transform .3s var(--motion);
        }

        .menu a:hover .menu-icon {
            color: white;
            transform: translateY(-1px) scale(1.06);
        }

        .menu a.active .menu-icon { color: var(--primary); }

        .sidebar-label {
            overflow: hidden;
            text-overflow: ellipsis;
            opacity: 1;
            transition: opacity .18s ease, transform .25s ease;
        }

        .bottom-menu {
            display: block;
            margin-top: auto;
            padding-top: 28px;
        }

        /* DESKTOP COLLAPSED SIDEBAR */

        .sidebar.sidebar-collapsed {
            flex-basis: 76px;
            width: 76px;
            min-width: 76px;
            padding-right: 12px;
            padding-left: 12px;
        }

        .sidebar.sidebar-collapsed .sidebar-header {
            justify-content: center;
        }

        .sidebar.sidebar-collapsed .sidebar-logo {
            position: absolute;
            width: 32px;
            opacity: 0;
            pointer-events: none;
            transform: translateX(-8px);
        }

        .sidebar.sidebar-collapsed .sidebar-toggle {
            margin-right: auto;
            margin-left: auto;
        }

        .sidebar.sidebar-collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar.sidebar-collapsed .sidebar-label,
        .sidebar.sidebar-collapsed .menu-title {
            width: 0;
            margin-left: 0;
            margin-right: 0;
            opacity: 0;
            pointer-events: none;
        }

        .sidebar.sidebar-collapsed .menu a {
            justify-content: center;
            gap: 0;
            padding-right: 0;
            padding-left: 0;
        }

        .sidebar.sidebar-collapsed .menu a:hover { transform: scale(1.04); }
        .sidebar.sidebar-collapsed .menu-icon { transform: none; }

        .sidebar.sidebar-collapsed .menu a:hover .menu-icon {
            transform: scale(1.1);
        }

        .hamburger, .sidebar-overlay { display: none; }

        /* SHARED MAIN AND TOPBAR */

        .main {
            min-width: 0;
            flex: 1;
            padding: 35px 45px;
            overflow-x: hidden;
            animation: pageFadeIn .7s .1s ease both;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            animation: fadeDown .6s .15s ease both;
        }

        .page-title {
            color: #708D87;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification {
            display: flex;
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border: 1px solid #D9DDD6;
            border-radius: 7px;
            background: white;
            color: var(--primary);
            font-size: 15px;
            cursor: pointer;
            transition: background .25s ease, transform .25s ease;
        }

        .notification:hover {
            background: var(--light-green);
            transform: translateY(-2px);
            animation: notificationPulse .8s ease;
        }

        .notification:active { transform: scale(.93); }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: bold;
        }

        .avatar {
            display: flex;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--accent);
            background: var(--primary);
            font-weight: bold;
            transition: transform .25s var(--motion);
        }

        .avatar:hover { transform: scale(1.08) rotate(5deg); }

        /* PROJECT EDIT PAGE CONTENT */

        .projects-page { padding: 30px 0; }

        .projects-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            animation: fadeDown .65s .2s ease both;
        }

        .projects-header h1 {
            font-size: 36px;
            font-weight: 500;
            letter-spacing: -1px;
        }

        .projects-header p {
            margin-top: 6px;
            color: #64748B;
            font-size: 14px;
            line-height: 1.6;
        }

        .edit-form-card {
            width: 100%;
            max-width: 1050px;
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            animation: cardEntrance .65s var(--motion) both;
        }

        .form-section + .form-section {
            margin-top: 30px;
            padding-top: 27px;
            border-top: 1px solid var(--border);
        }

        .form-section-title {
            margin-bottom: 7px;
            font-size: 16px;
            font-weight: bold;
        }

        .form-section-description {
            margin-bottom: 22px;
            color: var(--secondary);
            font-size: 12px;
            line-height: 1.7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 9px;
        }

        .form-group.full-width { grid-column: 1 / -1; }

        .form-group label {
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
        }

        .required { color: #C24135; }

        .form-control {
            width: 100%;
            min-width: 0;
            min-height: 44px;
            padding: 11px 13px;
            border: 1px solid #D9DDD6;
            border-radius: 7px;
            outline: none;
            color: var(--primary);
            background: white;
            font-size: 12px;
            transition: border-color .25s ease, box-shadow .25s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(18, 63, 58, .08);
        }

        .form-control::placeholder { color: #A0AAA6; }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
            line-height: 1.7;
        }

        select.form-control { cursor: pointer; }

        .form-help {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .form-footer {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 28px;
            padding: 14px 16px;
            border: 1px solid #DDE6C8;
            border-radius: 8px;
            color: var(--secondary);
            background: var(--light-green);
            font-size: 11px;
            line-height: 1.7;
        }

        .form-footer i {
            margin-top: 2px;
            color: var(--primary);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .form-btn {
            display: inline-flex;
            min-height: 43px;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 20px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition:
                background .25s ease,
                color .25s ease,
                border-color .25s ease,
                transform .25s var(--motion);
        }

        .form-btn:active { transform: scale(.97); }

        .cancel-btn {
            border-color: var(--border);
            color: var(--primary);
            background: white;
        }

        .cancel-btn:hover { background: var(--background); }

        .save-btn {
            color: var(--primary);
            background: var(--accent);
        }

        .save-btn:hover { background: #C9E85A; }

        .form-message {
            display: none;
            margin-top: 18px;
            padding: 13px 15px;
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--secondary);
            background: var(--background);
            font-size: 12px;
            line-height: 1.7;
        }

        .form-message.show { display: block; }

        /* TABLET */

        @media (max-width: 1050px) {
            .main { padding: 30px; }
        }

        /* MOBILE */

        @media (max-width: 768px) {
            body { display: block; }

            .hamburger {
                position: fixed;
                z-index: 1002;
                top: 15px;
                left: 15px;
                display: grid;
                width: 45px;
                height: 45px;
                padding: 11px;
                place-items: center;
                border: none;
                border-radius: 8px;
                background: var(--primary);
                cursor: pointer;
                transition: background .25s ease, transform .25s ease;
            }

            .hamburger:hover { background: var(--primary-hover); }
            .hamburger:active { transform: scale(.95); }

            .hamburger i {
                color: var(--accent);
                font-size: 22px;
                transition: transform .3s ease;
            }

            .hamburger[aria-expanded="true"] i {
                transform: rotate(90deg);
            }

            .hamburger.menu-open {
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
            }

            .sidebar,
            .sidebar.sidebar-collapsed {
                position: fixed;
                z-index: 1001;
                top: 0;
                left: 0;
                flex-basis: 260px;
                width: 260px;
                min-width: 260px;
                height: 100vh;
                min-height: 100vh;
                padding: 24px 16px 18px;
                overflow-x: hidden;
                overflow-y: auto;
                transform: translateX(-100%);
                box-shadow: 10px 0 35px rgba(0, 0, 0, .12);
                transition: transform .35s var(--motion);
            }

            .sidebar.open,
            .sidebar.sidebar-collapsed.open {
                transform: translateX(0);
            }

            .sidebar.sidebar-collapsed .sidebar-header {
                justify-content: space-between;
            }

            .sidebar.sidebar-collapsed .sidebar-logo {
                position: static;
                width: auto;
                opacity: 1;
                pointer-events: auto;
                transform: none;
            }

            .sidebar.sidebar-collapsed .sidebar-label {
                width: auto;
                margin: 0;
                opacity: 1;
                pointer-events: auto;
            }

            .sidebar.sidebar-collapsed .menu-title {
                width: auto;
                margin: 0 12px 12px;
                opacity: 1;
                pointer-events: auto;
            }

            .sidebar.sidebar-collapsed .menu a {
                justify-content: flex-start;
                gap: 13px;
                padding: 0 12px;
            }

            .sidebar.sidebar-collapsed .sidebar-toggle,
            .sidebar-toggle {
                display: none;
            }

            .sidebar-overlay {
                position: fixed;
                z-index: 1000;
                inset: 0;
                display: block;
                width: 100%;
                height: 100%;
                border: none;
                background: rgba(0, 0, 0, .5);
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

            .main {
                width: 100%;
                margin-left: 0;
                padding: 25px 20px;
            }

            .topbar {
                min-height: 45px;
                margin-bottom: 20px;
                padding-left: 60px;
            }

            .projects-page { padding: 20px 0; }

            .projects-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .projects-header h1 { font-size: 30px; }

            .edit-form-card { padding: 24px; }

            .form-grid { grid-template-columns: 1fr; }

            .form-group.full-width { grid-column: auto; }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .form-btn { width: 100%; }
        }

        @media (max-width: 500px) {
            .main { padding: 16px; }

            .user-area { gap: 10px; }

            .page-title {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .edit-form-card { padding: 18px; }

            .form-grid { gap: 18px; }

            .form-section + .form-section {
                margin-top: 24px;
                padding-top: 22px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-delay: 0ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <!-- SHARED MOBILE HAMBURGER -->
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

    <!-- SHARED MOBILE OVERLAY -->
    <button
        class="sidebar-overlay"
        id="sidebarOverlay"
        type="button"
        aria-label="Close sidebar"
        tabindex="-1"
    ></button>

    <!-- SHARED SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-logo">
                

                <span class="sidebar-label">
                    Project<span class="highlight">Manager</span>
                </span>
            </a>

            <button
                class="sidebar-toggle"
                id="sidebarToggle"
                type="button"
                aria-label="Expand sidebar"
                aria-expanded="false"
                title="Expand sidebar"
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
                <i class="menu-icon fa-solid fa-map" aria-hidden="true"></i>
                <span class="sidebar-label">Project Map</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column" aria-hidden="true"></i>
                <span class="sidebar-label">Reports</span>
            </a>

            <div class="bottom-menu">
                <div class="menu-title">ACCOUNT</div>

                <nav class="menu" aria-label="Account navigation">
                    <a href="/settings.blade.php">
                        <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                        <span class="sidebar-label">Settings</span>
                    </a>

                    <a href="/">
                        <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                        <span class="sidebar-label">Log out</span>
                    </a>
                </nav>
            </div>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- SHARED TOPBAR -->
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

        <!-- PROJECT EDIT PAGE CONTENT -->
        <div class="projects-page">

            <div class="projects-header">
                <div>
                    <h1>Edit Project</h1>
                    <p>Update the project information and save your changes.</p>
                </div>
            </div>

            <form id="editProjectForm" class="edit-form-card">

                <!-- PROJECT INFORMATION -->
                <section class="form-section">
                    <h2 class="form-section-title">Project Information</h2>
                    <p class="form-section-description">
                        Edit the basic information and description of your project.
                    </p>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="projectName">
                                Project Name <span class="required">*</span>
                            </label>
                            <input
                                class="form-control"
                                type="text"
                                id="projectName"
                                name="projectName"
                                value="Riverside Bridge"
                                placeholder="Enter project name"
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
                                name="projectType"
                                required
                            >
                                <option value="">Select project type</option>
                                <option value="Infrastructure" selected>Infrastructure</option>
                                <option value="Public Facility">Public Facility</option>
                                <option value="Road Construction">Road Construction</option>
                                <option value="Bridge Construction">Bridge Construction</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label for="projectDescription">
                                Project Description <span class="required">*</span>
                            </label>
                            <textarea
                                class="form-control"
                                id="projectDescription"
                                name="projectDescription"
                                placeholder="Describe the project"
                                required
                            >Construction and improvement of the Riverside Bridge to provide safer and more efficient transportation.</textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="projectLocation">
                                Project Location <span class="required">*</span>
                            </label>
                            <input
                                class="form-control"
                                type="text"
                                id="projectLocation"
                                name="projectLocation"
                                value="Riverside District"
                                placeholder="Enter project location"
                                required
                            >
                        </div>

                    </div>
                </section>

                <!-- PROJECT SCHEDULE -->
                <section class="form-section">
                    <h2 class="form-section-title">Project Schedule</h2>
                    <p class="form-section-description">
                        Update the planned start date, deadline, and current status.
                    </p>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="startDate">
                                Start Date <span class="required">*</span>
                            </label>
                            <input
                                class="form-control"
                                type="date"
                                id="startDate"
                                name="startDate"
                                value="2026-09-01"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="dueDate">
                                Due Date <span class="required">*</span>
                            </label>
                            <input
                                class="form-control"
                                type="date"
                                id="dueDate"
                                name="dueDate"
                                value="2026-10-24"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="projectStatus">
                                Project Status <span class="required">*</span>
                            </label>
                            <select
                                class="form-control"
                                id="projectStatus"
                                name="projectStatus"
                                required
                            >
                                <option value="Planning">Planning</option>
                                <option value="In Progress" selected>In Progress</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="projectProgress">Progress (%)</label>
                            <input
                                class="form-control"
                                type="number"
                                id="projectProgress"
                                name="projectProgress"
                                min="0"
                                max="100"
                                value="72"
                                placeholder="Enter progress from 0 to 100"
                            >
                            <span class="form-help">
                                Enter a number from 0 to 100.
                            </span>
                        </div>

                    </div>
                </section>

                <!-- PROJECT BUDGET -->
                <section class="form-section">
                    <h2 class="form-section-title">Budget Information</h2>
                    <p class="form-section-description">
                        Update the approved budget and assigned project manager.
                    </p>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="projectBudget">
                                Project Budget (₱) <span class="required">*</span>
                            </label>
                            <input
                                class="form-control"
                                type="number"
                                id="projectBudget"
                                name="projectBudget"
                                min="0"
                                step="0.01"
                                value="2500000"
                                placeholder="Enter project budget"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="projectManager">Project Manager</label>
                            <input
                                class="form-control"
                                type="text"
                                id="projectManager"
                                name="projectManager"
                                value="Jay"
                                placeholder="Enter project manager"
                            >
                        </div>

                    </div>
                </section>

                <div class="form-footer">
                    <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                    <span>
                        Review the updated details before saving. This page currently
                        uses sample project information; connect it to your Laravel
                        database to load and save actual project records.
                    </span>
                </div>
                <!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION -->
                <div class="form-actions">
                    <a href="/project-details.blade.php" class="form-btn cancel-btn">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                        Cancel
                    </a>

                    <button type="submit" class="form-btn save-btn">
                        <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
                        Save Changes
                    </button>
                </div>

                <div class="form-message" id="formMessage" role="status"></div>

            </form>
        </div>
    </main>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");

            /* SHARED SIDEBAR BEHAVIOR */

            function closeMobileSidebar() {
                sidebar.classList.remove("open");
                overlay.classList.remove("show");
                hamburger.classList.remove("menu-open");

                hamburger.setAttribute("aria-expanded", "false");
                hamburger.setAttribute("aria-label", "Open sidebar");
                document.body.style.overflow = "";
            }

            function openMobileSidebar() {
                if (!mobileQuery.matches) return;

                sidebar.classList.add("open");
                overlay.classList.add("show");
                hamburger.classList.add("menu-open");

                hamburger.setAttribute("aria-expanded", "true");
                hamburger.setAttribute("aria-label", "Close sidebar");
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

                const isCollapsed =
                    sidebar.classList.toggle("sidebar-collapsed");

                sidebarToggle.setAttribute(
                    "aria-expanded",
                    String(!isCollapsed)
                );

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
                if (
                    event.key === "Escape" &&
                    sidebar.classList.contains("open")
                ) {
                    closeMobileSidebar();
                    hamburger.focus();
                }
            });

            if (mobileQuery.addEventListener) {
                mobileQuery.addEventListener("change", updateViewport);
            } else {
                mobileQuery.addListener(updateViewport);
            }

            /* EDIT FORM VALIDATION */

            const editForm = document.getElementById("editProjectForm");
            const startDate = document.getElementById("startDate");
            const dueDate = document.getElementById("dueDate");
            const progress = document.getElementById("projectProgress");
            const formMessage = document.getElementById("formMessage");

            function validateDates() {
                dueDate.setCustomValidity("");

                if (
                    startDate.value &&
                    dueDate.value &&
                    dueDate.value < startDate.value
                ) {
                    dueDate.setCustomValidity(
                        "The due date cannot be earlier than the start date."
                    );
                }
            }

            startDate.addEventListener("change", validateDates);
            dueDate.addEventListener("change", validateDates);

            editForm.addEventListener("submit", function (event) {
                event.preventDefault();

                validateDates();

                if (!editForm.reportValidity()) {
                    return;
                }

                if (
                    progress.value !== "" &&
                    (
                        Number(progress.value) < 0 ||
                        Number(progress.value) > 100
                    )
                ) {
                    progress.setCustomValidity(
                        "Progress must be between 0 and 100."
                    );
                    progress.reportValidity();
                    progress.setCustomValidity("");
                    return;
                }

                /*
                 * Front-end demonstration only.
                 * Connect this form to your Laravel update route and controller
                 * to save the edited information in your database.
                 */

                formMessage.textContent =
                    "The form is valid, but the changes have not been saved to the database yet. Connect this form to your Laravel update route to save the project.";

                formMessage.classList.add("show");
            });
        });
    </script>

</body>
</html>
