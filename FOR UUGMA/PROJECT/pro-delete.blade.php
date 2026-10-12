
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Delete Project</title>

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

        button, a, input {
            -webkit-tap-highlight-color: transparent;
        }

        button:focus-visible, a:focus-visible, input:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        button { font: inherit; }

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

        /* PROJECT DELETE PAGE */

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

        .delete-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, .8fr);
            gap: 24px;
            align-items: start;
        }

        .delete-card {
            min-width: 0;
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            animation: cardEntrance .65s var(--motion) both;
        }

        .delete-card:nth-child(2) { animation-delay: .15s; }

        .delete-icon {
            display: grid;
            width: 58px;
            height: 58px;
            margin-bottom: 22px;
            place-items: center;
            border-radius: 12px;
            color: #A33B32;
            background: #FFF0EE;
            font-size: 24px;
        }

        .delete-card h2 {
            font-size: 21px;
            font-weight: 600;
            line-height: 1.4;
        }

        .delete-description {
            margin-top: 12px;
            color: #64748B;
            font-size: 13px;
            line-height: 1.8;
        }

        .warning-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 22px;
            padding: 15px;
            border: 1px solid #F0D8B0;
            border-radius: 8px;
            color: #80551A;
            background: #FFFAEB;
            font-size: 12px;
            line-height: 1.7;
        }

        .warning-box i {
            margin-top: 2px;
            font-size: 15px;
        }

        .project-summary {
            margin-top: 25px;
            padding: 20px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #FCFCF9;
        }

        .project-summary-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .project-summary h3 {
            font-size: 17px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .project-type {
            margin-top: 6px;
            color: var(--secondary);
            font-size: 12px;
        }

        .project-status {
            flex-shrink: 0;
            padding: 6px 10px;
            border-radius: 20px;
            color: #1D4ED8;
            background: #DBEAFE;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .project-summary-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .summary-item span {
            display: block;
            color: var(--secondary);
            font-size: 11px;
        }

        .summary-item strong {
            display: block;
            margin-top: 7px;
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .delete-confirmation {
            margin-top: 24px;
        }

        .delete-confirmation label {
            display: block;
            margin-bottom: 9px;
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
            line-height: 1.6;
        }

        .delete-confirmation input {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #D9DDD6;
            border-radius: 7px;
            outline: none;
            color: var(--primary);
            background: white;
            font-size: 12px;
            transition: border-color .25s ease, box-shadow .25s ease;
        }

        .delete-confirmation input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(18, 63, 58, .08);
        }

        .delete-confirmation input::placeholder { color: #A0AAA6; }

        .delete-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }

        .delete-btn {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 17px;
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--primary);
            background: white;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition:
                color .25s ease,
                background .25s ease,
                border-color .25s ease,
                transform .25s var(--motion);
        }

        .delete-btn:hover {
            background: var(--light-green);
            border-color: #C8D5BC;
            transform: translateY(-2px);
        }

        .delete-btn:active { transform: scale(.97); }

        .delete-btn.danger {
            color: white;
            border-color: #A33B32;
            background: #A33B32;
        }

        .delete-btn.danger:hover {
            border-color: #8C2821;
            background: #8C2821;
        }

        .delete-btn.danger:disabled {
            border-color: #D5B7B4;
            background: #D5B7B4;
            cursor: not-allowed;
            transform: none;
        }

        .delete-btn.danger:disabled:hover {
            border-color: #D5B7B4;
            background: #D5B7B4;
        }

        .delete-info-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-top: 25px;
        }

        .delete-info-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
        }

        .delete-info-icon {
            display: grid;
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            place-items: center;
            border-radius: 8px;
            color: var(--primary);
            background: var(--light-green);
            font-size: 14px;
        }

        .delete-info-item h3 {
            font-size: 12px;
            font-weight: bold;
        }

        .delete-info-item p {
            margin-top: 5px;
            color: var(--secondary);
            font-size: 11px;
            line-height: 1.7;
        }

        .delete-message {
            display: none;
            margin-top: 18px;
            padding: 13px 14px;
            border: 1px solid #F0D8B0;
            border-radius: 7px;
            color: #80551A;
            background: #FFFAEB;
            font-size: 12px;
            line-height: 1.6;
        }

        .delete-message.show { display: block; }

        .delete-message.success {
            border-color: #C8DCC1;
            color: var(--primary);
            background: var(--light-green);
        }

        /* TABLET */

        @media (max-width: 1050px) {
            .main { padding: 30px; }

            .delete-layout {
                grid-template-columns: 1fr;
            }
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

            .delete-card { padding: 22px; }

            .delete-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .delete-actions .delete-btn { width: 100%; }
        }

        @media (max-width: 500px) {
            .main { padding: 16px; }

            .user-area { gap: 10px; }

            .page-title {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .delete-card { padding: 18px; }

            .project-summary { padding: 15px; }

            .project-summary-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .project-summary-details {
                grid-template-columns: 1fr;
                gap: 14px;
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
            <a href="/dashboard.blade.php" class="sidebar-logo">
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

        <!-- PROJECT DELETE PAGE CONTENT -->
        <div class="projects-page">
            <div class="projects-header">
                <div>
                    <h1>Delete Project</h1>
                    <p>Review the project information before confirming deletion.</p>
                </div>
            </div>

            <div class="delete-layout">

                <!-- DELETE CONFIRMATION -->
                <section class="delete-card">
                    <div class="delete-icon">
                        <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    </div>

                    <h2>Are you sure you want to delete this project?</h2>

                    <p class="delete-description">
                        You are about to delete the selected project from your
                        Project Manager workspace. Review the project details
                        carefully before proceeding.
                    </p>

                    <div class="warning-box">
                        <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                        <p>
                            <strong>Warning:</strong> Deleting a project may
                            permanently remove its related tasks, records, and
                            associated information, depending on your application
                            setup. This action should not be performed unless
                            you are certain.
                        </p>
                    </div>

                    <!-- SAMPLE PROJECT INFORMATION -->
                    <div class="project-summary">
                        <div class="project-summary-heading">
                            <div>
                                <h3 id="projectName">Riverside Bridge</h3>
                                <p class="project-type">Bridge Construction</p>
                            </div>

                            <span class="project-status">IN PROGRESS</span>
                        </div>

                        <div class="project-summary-details">
                            <div class="summary-item">
                                <span>Project ID</span>
                                <strong id="projectId">PRJ-001</strong>
                            </div>

                            <div class="summary-item">
                                <span>Progress</span>
                                <strong>72%</strong>
                            </div>

                            <div class="summary-item">
                                <span>Start Date</span>
                                <strong>September 01, 2026</strong>
                            </div>

                            <div class="summary-item">
                                <span>Due Date</span>
                                <strong>October 24, 2026</strong>
                            </div>
                        </div>
                    </div>

                    <form id="deleteForm" class="delete-confirmation">
                        <label for="confirmProjectName">
                            Type <span id="requiredProjectName">Riverside Bridge</span>
                            to confirm that you want to delete this project.
                        </label>

                        <input
                            type="text"
                            id="confirmProjectName"
                            name="confirmProjectName"
                            placeholder="Enter the project name"
                            autocomplete="off"
                            required
                        >
                    <!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION -->
                        <div class="delete-actions">
                            <a href="/projects.blade.php" class="delete-btn">
                                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                                Cancel
                            </a>

                            <button class="delete-btn danger" id="confirmDeleteBtn" type="submit" disabled>
                                <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                                Delete Project
                            </button>
                        </div>

                        <div class="delete-message" id="deleteMessage" role="status"></div>
                    </form>
                </section>

                <!-- ADDITIONAL INFORMATION -->
                <section class="delete-card">
                    <h2>Before You Delete</h2>

                    <p class="delete-description">
                        Make sure that deleting this project is the correct
                        decision for your workspace.
                    </p>

                    <div class="delete-info-list">
                        <div class="delete-info-item">
                            <div class="delete-info-icon">
                                <i class="fa-solid fa-clipboard-check" aria-hidden="true"></i>
                            </div>

                            <div>
                                <h3>Review Project Records</h3>
                                <p>
                                    Check the project's tasks, progress, documents,
                                    and other related information before deletion.
                                </p>
                            </div>
                        </div>

                        <div class="delete-info-item">
                            <div class="delete-info-icon">
                                <i class="fa-solid fa-people-group" aria-hidden="true"></i>
                            </div>

                            <div>
                                <h3>Check Team Assignments</h3>
                                <p>
                                    Review the personnel assigned to this project
                                    and determine whether their assignments need
                                    to be transferred.
                                </p>
                            </div>
                        </div>

                        <div class="delete-info-item">
                            <div class="delete-info-icon">
                                <i class="fa-solid fa-file-shield" aria-hidden="true"></i>
                            </div>

                            <div>
                                <h3>Keep Important Information</h3>
                                <p>
                                    Save any records or documents you may need
                                    for future reference before removing the project.
                                </p>
                            </div>
                        </div>

                        <div class="delete-info-item">
                            <div class="delete-info-icon">
                                <i class="fa-solid fa-rotate-left" aria-hidden="true"></i>
                            </div>

                            <div>
                                <h3>Consider Other Options</h3>
                                <p>
                                    If the project is temporarily inactive, consider
                                    updating its status instead of deleting it.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="warning-box">
                        <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                        <p>
                            If you only need to change project information,
                            use the Project Edit page instead.
                        </p>
                    </div>
<!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION -->
                    <div class="delete-actions">
                        <a href="/projects.blade.php" class="delete-btn">
                            <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                            Back to Projects
                        </a>

                        <a href="/pro-edit.blade.php" class="delete-btn">
                            <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            Edit Project
                        </a>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <!-- SHARED SIDEBAR JAVASCRIPT + DELETE CONFIRMATION -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");

            const reduceMotion = window.matchMedia(
                "(prefers-reduced-motion: reduce)"
            ).matches;

            /* SHARED SIDEBAR */

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

            /* DELETE CONFIRMATION */

            const deleteForm = document.getElementById("deleteForm");
            const confirmInput = document.getElementById("confirmProjectName");
            const deleteButton = document.getElementById("confirmDeleteBtn");
            const deleteMessage = document.getElementById("deleteMessage");

            const projectName = document.getElementById("projectName").textContent.trim();
            const requiredProjectName = document.getElementById("requiredProjectName");

            requiredProjectName.textContent = projectName;

            function updateDeleteButton() {
                deleteButton.disabled =
                    confirmInput.value.trim() !== projectName;
            }

            confirmInput.addEventListener("input", function () {
                deleteMessage.classList.remove("show", "success");
                deleteMessage.textContent = "";
                updateDeleteButton();
            });

            deleteForm.addEventListener("submit", function (event) {
                event.preventDefault();

                if (confirmInput.value.trim() !== projectName) {
                    deleteMessage.textContent =
                        "The project name does not match. Please enter the exact project name.";
                    deleteMessage.classList.add("show");
                    deleteMessage.classList.remove("success");
                    return;
                }

                /*
                 * This is a front-end demonstration only.
                 * Connect this form to a Laravel DELETE route and controller
                 * before using it to delete a real project.
                 */

                deleteMessage.textContent =
                    "Confirmation successful. No project has been deleted. Connect this page to your Laravel delete route to perform the actual deletion.";

                deleteMessage.classList.add("show");
                deleteMessage.classList.remove("success");
            });

            updateDeleteButton();
        });
    </script>
</body>
</html>
