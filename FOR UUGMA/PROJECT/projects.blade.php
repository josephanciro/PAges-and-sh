
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Projects</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">

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

        button, a { -webkit-tap-highlight-color: transparent; }

        button:focus-visible, a:focus-visible {
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

        /* PROJECTS PAGE */

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
        }

        .create-btn {
            display: inline-block;
            flex-shrink: 0;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            background: var(--primary);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition:
                background .25s ease,
                transform .25s var(--motion),
                box-shadow .25s ease;
        }

        .create-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 7px 16px rgba(18, 63, 58, .15);
        }

        .create-btn:active { transform: translateY(0) scale(.98); }

        /* PROJECT FILTERS */

        .project-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 25px;
            animation: fadeDown .65s .3s ease both;
        }

        .project-filters button {
            padding: 9px 16px;
            border: 1px solid #D1D5DB;
            border-radius: 7px;
            color: var(--primary);
            background: white;
            cursor: pointer;
            white-space: nowrap;
            transition:
                color .25s ease,
                background .25s ease,
                border-color .25s ease,
                transform .25s var(--motion),
                box-shadow .25s ease;
        }

        .project-filters button:hover {
            color: white;
            border-color: var(--primary);
            background: var(--primary);
            transform: translateY(-2px);
        }

        .project-filters button.active {
            color: var(--primary);
            border-color: var(--accent);
            background: var(--accent);
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(18, 63, 58, .08);
        }

        .project-filters button.active:hover {
            color: var(--primary);
            border-color: var(--accent);
            background: var(--accent);
        }

        .project-filters button:active { transform: scale(.96); }

        /* PROJECT CARDS */

        .projects-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .project-card {
            min-width: 0;
            padding: 22px;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            background: white;
            animation: cardEntrance .65s var(--motion) both;
            transition:
                transform .3s var(--motion),
                box-shadow .3s ease,
                border-color .3s ease,
                opacity .22s ease;
        }

        .project-card:nth-child(1) { animation-delay: .35s; }
        .project-card:nth-child(2) { animation-delay: .45s; }
        .project-card:nth-child(3) { animation-delay: .55s; }
        .project-card:nth-child(4) { animation-delay: .65s; }

        .project-card:hover {
            border-color: #CDD9C0;
            box-shadow: 0 12px 28px rgba(18, 63, 58, .09);
            transform: translateY(-5px);
        }

        .project-card.filter-hidden { display: none; }

        .project-card.filter-exit {
            opacity: 0;
            transform: translateY(10px) scale(.98);
            pointer-events: none;
        }

        .project-card.filter-enter {
            display: block;
            opacity: 0;
            transform: translateY(12px) scale(.98);
            animation: none;
        }

        .project-card.filter-enter.filter-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .project-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .project-card h2 {
            font-size: 20px;
            transition: color .25s ease;
        }

        .project-card:hover h2 { color: #527B44; }

        .project-type {
            margin-top: 6px;
            color: #64748B;
            font-size: 14px;
        }

        .project-status {
            flex-shrink: 0;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
            transition: transform .25s var(--motion);
        }

        .project-card:hover .project-status { transform: translateY(-2px); }

        .status-progress { color: #1D4ED8; background: #DBEAFE; }
        .status-planning { color: #92400E; background: #FEF3C7; }
        .status-completed { color: #166534; background: #DCFCE7; }

        .project-description {
            margin: 20px 0;
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
            font-size: 13px;
        }

        .progress-bar {
            height: 8px;
            overflow: hidden;
            border-radius: 10px;
            background: #E5E7EB;
        }

        .progress {
            height: 100%;
            width: 0;
            border-radius: 10px;
            background: var(--primary);
            transition: width 1.2s var(--motion);
        }

        .progress.animate-progress { width: var(--progress-width); }

        .project-details {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #E5E7EB;
            color: #64748B;
            font-size: 13px;
        }

        .view-project {
            display: inline-block;
            margin-top: 18px;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: color .25s ease, transform .25s var(--motion);
        }

        .view-project:hover {
            color: #66813C;
            transform: translateX(5px);
        }

        /* SCROLL REVEAL */

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity .7s ease, transform .7s var(--motion);
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* TABLET */

        @media (max-width: 1050px) {
            .main { padding: 30px; }
            .projects-list { grid-template-columns: 1fr; }
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

            .create-btn {
                width: 100%;
                text-align: center;
            }

            .project-filters {
                flex-wrap: nowrap;
                padding-bottom: 5px;
                overflow-x: auto;
                scrollbar-width: thin;
            }

            .projects-list { grid-template-columns: 1fr; }
        }

        @media (max-width: 500px) {
            .main { padding: 16px; }

            .user-area { gap: 10px; }

            .page-title {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .project-card { padding: 18px; }

            .project-card-top { flex-direction: column; }

            .project-details {
                flex-direction: column;
                gap: 6px;
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

            .project-card { opacity: 1; }

            .reveal-on-scroll {
                opacity: 1;
                transform: none;
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

            <a href="/projects.blade.php"  aria-current="page">
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

        <!-- PROJECTS PAGE CONTENT -->
        <div class="projects-page">
            <div class="projects-header">
                <div>
                    <h1>Projects</h1>
                    <p>Manage and monitor your current projects.</p>
                </div>

                <a href="/create-project.blade.php" class="create-btn">
                    + Create New Project
                </a>
            </div>

            <!-- PROJECT FILTERS -->
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
                        <!-- EDIT TO CHANGE LOCATION -->
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

    <!-- SHARED SIDEBAR JAVASCRIPT + PROJECT FILTERS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");

            const filterButtons = document.querySelectorAll(".project-filters button");
            const projectCards = Array.from(document.querySelectorAll(".project-card"));
            const progressBars = document.querySelectorAll(".progress");

            const reduceMotion = window.matchMedia(
                "(prefers-reduced-motion: reduce)"
            ).matches;

            let filterRun = 0;

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

            /* ANIMATED PROGRESS BARS */

            function animateProgressBars() {
                progressBars.forEach(function (bar, index) {
                    if (reduceMotion) {
                        bar.classList.add("animate-progress");
                        return;
                    }

                    window.setTimeout(function () {
                        bar.classList.add("animate-progress");
                    }, 350 + index * 100);
                });
            }

            animateProgressBars();

            /* PROJECT FILTERS */

            function showCard(card) {
                card.classList.remove("filter-hidden", "filter-exit");
                card.classList.add("filter-enter");

                if (reduceMotion) {
                    card.classList.add("filter-visible");
                    return;
                }

                void card.offsetWidth;

                requestAnimationFrame(function () {
                    card.classList.add("filter-visible");
                });
            }

            function hideCard(card, currentRun) {
                card.classList.remove("filter-enter", "filter-visible");

                if (reduceMotion) {
                    card.classList.add("filter-hidden");
                    card.classList.remove("filter-exit");
                    return;
                }

                card.classList.add("filter-exit");

                window.setTimeout(function () {
                    if (currentRun !== filterRun) return;

                    card.classList.add("filter-hidden");
                    card.classList.remove("filter-exit");
                }, 230);
            }

            filterButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const selectedFilter = button.dataset.filter;
                    const currentRun = ++filterRun;

                    filterButtons.forEach(function (item) {
                        item.classList.remove("active");
                        item.setAttribute("aria-pressed", "false");
                    });

                    button.classList.add("active");
                    button.setAttribute("aria-pressed", "true");

                    projectCards.forEach(function (card) {
                        const matches =
                            selectedFilter === "all" ||
                            selectedFilter === card.dataset.status;

                        if (matches) {
                            if (card.classList.contains("filter-hidden")) {
                                showCard(card);
                            } else if (card.classList.contains("filter-exit")) {
                                showCard(card);
                            }
                        } else if (!card.classList.contains("filter-hidden")) {
                            hideCard(card, currentRun);
                        }
                    });
                });
            });

            /* SCROLL REVEAL */

            if ("IntersectionObserver" in window && !reduceMotion) {
                const revealTargets = document.querySelectorAll(
                    ".project-details, .project-description"
                );

                revealTargets.forEach(function (element) {
                    element.classList.add("reveal-on-scroll");
                });

                const revealObserver = new IntersectionObserver(
                    function (entries, observer) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add("revealed");
                                observer.unobserve(entry.target);
                            }
                        });
                    },
                    {
                        threshold: 0.12,
                        rootMargin: "0px 0px -25px 0px"
                    }
                );

                revealTargets.forEach(function (element) {
                    revealObserver.observe(element);
                });
            }
        });
    </script>
</body>
</html>
