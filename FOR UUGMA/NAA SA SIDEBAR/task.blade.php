
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Tasks</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --primary: #123F3A;
            --primary-hover: #1D4D48;
            --lime: #D7F56B;
            --background: #F5F4EE;
            --white: #FFFFFF;
            --text: #263532;
            --secondary: #71817E;
            --muted: #8A9693;
            --border: #E0E1DA;
            --light-green: #EEF3DC;
            --danger: #C94C4C;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 76px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            height: 100vh;
            height: 100dvh;
            background: var(--primary);
            color: var(--white);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-x: hidden;
            overflow-y: auto;
            transition: width 0.3s ease, transform 0.3s ease;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-hover) var(--primary);
        }

        .sidebar-header {
            min-height: 82px;
            padding: 20px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
        }

        .logo-image {
            width: 36px;
            height: 36px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .logo-text {
            color: var(--white);
            font-size: 17px;
            font-weight: 700;
            white-space: nowrap;
        }

        .logo-text span {
            color: var(--lime);
        }

        .sidebar-toggle {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: var(--white);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .sidebar-toggle:hover {
            background: var(--primary-hover);
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 12px;
        }

        .menu-title {
            padding: 0 12px;
            margin: 0 0 12px;
            color: #A9B9B4;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            white-space: nowrap;
        }

        .menu-item {
            min-height: 44px;
            padding: 0 12px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 7px;
            color: #D4DFDC;
            font-size: 13px;
            white-space: nowrap;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .menu-item i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .menu-item:hover {
            background: var(--primary-hover);
            color: var(--white);
        }

        .menu-item.active {
            background: var(--lime);
            color: var(--primary);
            font-weight: 700;
        }

        .menu-item.active i {
            color: var(--primary);
        }

        .sidebar-bottom {
            padding: 14px 12px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* DESKTOP COLLAPSED SIDEBAR */

        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }

        body.sidebar-collapsed .logo-text,
        body.sidebar-collapsed .menu-title,
        body.sidebar-collapsed .menu-item span {
            display: none;
        }

        body.sidebar-collapsed .sidebar-header {
            padding: 20px 0;
            justify-content: center;
            flex-direction: column;
        }

        body.sidebar-collapsed .logo-container {
            display: none;
        }

        body.sidebar-collapsed .sidebar-toggle {
            margin: 0 auto;
        }

        body.sidebar-collapsed .sidebar-menu,
        body.sidebar-collapsed .sidebar-bottom {
            padding-left: 10px;
            padding-right: 10px;
        }

        body.sidebar-collapsed .menu-item {
            justify-content: center;
            padding: 0;
            gap: 0;
        }

        body.sidebar-collapsed .menu-item i {
            margin: 0;
        }

        /* MAIN CONTENT */

        .main {
            min-height: 100vh;
            min-width: 0;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        body.sidebar-collapsed .main {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        /* TOPBAR */

        .topbar {
            min-height: 76px;
            padding: 15px 30px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .desktop-toggle {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--primary);
            border-radius: 7px;
            font-size: 16px;
        }

        .desktop-toggle:hover {
            background: var(--light-green);
        }

        .workspace-label {
            color: var(--secondary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-button {
            position: relative;
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            color: var(--secondary);
            font-size: 18px;
        }

        .notification-dot {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--lime);
            border: 1px solid var(--white);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-green);
            color: var(--primary);
            font-weight: 700;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .user-name {
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .user-role {
            color: var(--muted);
            font-size: 11px;
        }

        /* MOBILE SIDEBAR CONTROLS */

        .mobile-menu-button {
            display: none;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--primary);
            font-size: 18px;
        }

        .sidebar-overlay {
            display: none;
        }

        /* PAGE CONTENT */

        .page-content {
            padding: 30px;
            min-width: 0;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            margin-bottom: 8px;
            color: var(--primary);
            font-size: 27px;
            font-weight: 500;
        }

        .page-heading p {
            color: var(--secondary);
            font-size: 13px;
            line-height: 1.6;
        }

        .primary-button {
            min-height: 42px;
            padding: 0 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: none;
            border-radius: 7px;
            background: var(--primary);
            color: var(--white);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            transition: background 0.2s ease;
        }

        .primary-button:hover {
            background: var(--primary-hover);
        }

        /* SUMMARY CARDS */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .summary-card {
            min-width: 0;
            padding: 22px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 18px;
        }

        .summary-label {
            color: var(--secondary);
            font-size: 12px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--light-green);
            color: var(--primary);
            font-size: 16px;
        }

        .summary-number {
            margin-bottom: 6px;
            color: var(--primary);
            font-size: 29px;
            font-weight: 700;
        }

        .summary-description {
            color: var(--muted);
            font-size: 11px;
        }

        /* TASK PANEL */

        .task-panel {
            min-width: 0;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .panel-header {
            padding: 22px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 1px solid var(--border);
        }

        .panel-header h2 {
            color: var(--primary);
            font-size: 17px;
            font-weight: 600;
        }

        .panel-header p {
            margin-top: 6px;
            color: var(--secondary);
            font-size: 12px;
        }

        /* FILTERS */

        .filter-section {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--border);
        }

        .search-box {
            position: relative;
            flex: 1 1 220px;
            min-width: 0;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 13px;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
        }

        .search-box input {
            width: 100%;
            height: 40px;
            padding: 0 12px 0 37px;
            border: 1px solid var(--border);
            border-radius: 7px;
            outline: none;
            color: var(--text);
            background: var(--white);
            font-size: 12px;
        }

        .search-box input:focus,
        .filter-select:focus {
            border-color: var(--primary);
        }

        .filter-select {
            height: 40px;
            min-width: 140px;
            padding: 0 30px 0 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            outline: none;
            background: var(--white);
            color: var(--secondary);
            font-size: 12px;
        }

        .reset-button {
            height: 40px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--secondary);
            font-size: 12px;
        }

        .reset-button:hover {
            background: var(--background);
            color: var(--primary);
        }

        /* TABLE: HORIZONTAL SCROLL STAYS INSIDE THE PANEL */

        .table-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .task-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            text-align: left;
        }

        .task-table thead {
            background: #FAFAF7;
        }

        .task-table th {
            padding: 15px 18px;
            color: var(--secondary);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        .task-table td {
            padding: 17px 18px;
            border-bottom: 1px solid var(--border);
            color: var(--secondary);
            font-size: 12px;
            white-space: nowrap;
        }

        .task-table tbody tr:last-child td {
            border-bottom: none;
        }

        .task-table tbody tr:hover {
            background: #FCFCF9;
        }

        .task-name {
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .task-project {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        .assignee {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .assignee-avatar {
            width: 29px;
            height: 29px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--light-green);
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
        }

        .priority,
        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 9px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
        }

        .priority-high {
            background: #FBE8E6;
            color: #B7463D;
        }

        .priority-medium {
            background: #FFF2D8;
            color: #A36A12;
        }

        .priority-low {
            background: #E8F0F9;
            color: #426A9A;
        }

        .status-progress {
            background: #E8F0F9;
            color: #426A9A;
        }

        .status-todo {
            background: #F0F0EC;
            color: #6F7774;
        }

        .status-completed {
            background: #E7F3E8;
            color: #3F8050;
        }

        .status-hold {
            background: #FFF2D8;
            color: #A36A12;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-button {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            color: var(--secondary);
            font-size: 12px;
        }

        .action-button:hover {
            background: var(--light-green);
            color: var(--primary);
        }

        .action-button.delete:hover {
            background: #FBE8E6;
            color: var(--danger);
        }

        .empty-state {
            padding: 35px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        .table-footer {
            padding: 15px 24px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 11px;
        }

        /* TABLET */

        @media (max-width: 1100px) and (min-width: 769px) {
            .page-content {
                padding: 24px;
            }

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .topbar {
                padding: 15px 24px;
            }
        }

        /* MOBILE */

        @media (max-width: 768px) {
            html,
            body {
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
            }

            .sidebar {
                width: 260px;
                max-width: 85vw;
                transform: translateX(-100%);
                visibility: hidden;
                pointer-events: none;
            }

            body.mobile-sidebar-open .sidebar {
                transform: translateX(0);
                visibility: visible;
                pointer-events: auto;
            }

            body.mobile-sidebar-open .sidebar-header {
                justify-content: space-between;
                flex-direction: row;
                padding: 20px 18px;
            }

            body.mobile-sidebar-open .logo-container {
                display: flex;
            }

            body.mobile-sidebar-open .logo-text {
                display: inline;
            }

            body.mobile-sidebar-open .menu-title {
                display: block;
            }

            body.mobile-sidebar-open .menu-item span {
                display: inline;
            }

            body.mobile-sidebar-open .menu-item {
                justify-content: flex-start;
                padding: 0 12px;
                gap: 14px;
            }

            body.mobile-sidebar-open .sidebar-menu,
            body.mobile-sidebar-open .sidebar-bottom {
                padding-left: 12px;
                padding-right: 12px;
            }

            body.mobile-sidebar-open .sidebar-toggle {
                margin: 0;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                display: block;
                background: rgba(0, 0, 0, 0.45);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                z-index: 999;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            body.mobile-sidebar-open .sidebar-overlay {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }

            /* Prevent desktop collapse from affecting mobile layout */
            body.sidebar-collapsed .sidebar {
                width: 260px;
                max-width: 85vw;
            }

            body.sidebar-collapsed .sidebar-header {
                padding: 20px 18px;
            }

            body.sidebar-collapsed .logo-container {
                display: flex;
            }

            body.sidebar-collapsed .logo-text {
                display: inline;
            }

            body.sidebar-collapsed .menu-title {
                display: block;
            }

            body.sidebar-collapsed .menu-item span {
                display: inline;
            }

            body.sidebar-collapsed .menu-item {
                justify-content: flex-start;
                padding: 0 12px;
                gap: 14px;
            }

            body.sidebar-collapsed .sidebar-menu,
            body.sidebar-collapsed .sidebar-bottom {
                padding-left: 12px;
                padding-right: 12px;
            }

            body.sidebar-collapsed .sidebar-toggle {
                margin: 0;
            }

            .main,
            body.sidebar-collapsed .main {
                width: 100%;
                max-width: 100%;
                min-width: 0;
                margin-left: 0;
                overflow-x: clip;
            }

            .topbar {
                min-height: 68px;
                padding: 12px 16px;
                gap: 10px;
            }

            .topbar-left {
                gap: 10px;
            }

            .mobile-menu-button {
                display: flex;
            }

            .desktop-toggle {
                display: none;
            }

            .workspace-label {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .topbar-right {
                gap: 10px;
            }

            .user-info {
                display: none;
            }

            .page-content {
                width: 100%;
                max-width: 100%;
                padding: 22px 16px;
                overflow-x: clip;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
                margin-bottom: 22px;
            }

            .page-heading h1 {
                font-size: 24px;
            }

            .page-heading .primary-button {
                width: 100%;
            }

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                margin-bottom: 20px;
            }

            .summary-card {
                padding: 16px;
            }

            .summary-top {
                align-items: flex-start;
                margin-bottom: 13px;
            }

            .summary-label {
                font-size: 11px;
                line-height: 1.4;
            }

            .summary-icon {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .summary-number {
                font-size: 25px;
            }

            .summary-description {
                font-size: 10px;
                line-height: 1.4;
            }

            .panel-header {
                padding: 18px 16px;
            }

            .filter-section {
                padding: 15px 16px;
                gap: 10px;
            }

            .search-box {
                flex: 1 1 100%;
            }

            .filter-select {
                flex: 1 1 40%;
                min-width: 0;
                max-width: 100%;
            }

            .reset-button {
                flex: 0 0 auto;
            }

            .table-wrapper {
                width: 100%;
                max-width: 100%;
                overflow-x: auto;
                overflow-y: hidden;
            }

            .task-table {
                min-width: 900px;
            }

            .table-footer {
                padding: 14px 16px;
            }
        }

        /* SMALL PHONES */

        @media (max-width: 380px) {
            .topbar {
                padding: 12px;
            }

            .workspace-label {
                font-size: 8px;
                letter-spacing: 0.6px;
            }

            .topbar-right {
                gap: 5px;
            }

            .page-content {
                padding: 18px 12px;
            }

            .summary-grid {
                gap: 9px;
            }

            .summary-card {
                padding: 12px;
            }

            .summary-icon {
                width: 28px;
                height: 28px;
            }

            .summary-number {
                font-size: 23px;
            }

            .filter-section {
                padding: 13px 12px;
            }

            .filter-select {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <a href="/dashboard" class="logo-container">
                

                <div class="logo-text">
                    Project<span>Manager</span>
                </div>
            </a>

            <button class="sidebar-toggle"
                    id="sidebarToggle"
                    type="button"
                    aria-label="Collapse sidebar">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>

        <nav class="sidebar-menu">

            <div class="menu-title">MAIN MENU</div>

            <a href="/dashboard" class="menu-item">
                <i class="fa-solid fa-table-columns"></i>
                <span>Dashboard</span>
            </a>

            <a href="/projects" class="menu-item">
                <i class="fa-solid fa-folder-open"></i>
                <span>Projects</span>
            </a>

            <a href="/tasks" class="menu-item active">
                <i class="fa-solid fa-list-check"></i>
                <span>Tasks</span>
            </a>

            <a href="/calendar" class="menu-item">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Calendar</span>
            </a>

            <a href="/team" class="menu-item">
                <i class="fa-solid fa-users"></i>
                <span>Team</span>
            </a>

            <a href="/files" class="menu-item">
                <i class="fa-solid fa-folder"></i>
                <span>Files</span>
            </a>

            <a href="/reports" class="menu-item">
                <i class="fa-solid fa-chart-column"></i>
                <span>Reports</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <a href="/settings" class="menu-item">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>

            <a href="/logout" class="menu-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Log out</span>
            </a>

        </div>

    </aside>

    <!-- MOBILE OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="main" id="mainContent">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">

                <button class="mobile-menu-button"
                        id="mobileMenuButton"
                        type="button"
                        aria-label="Open navigation menu"
                        aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <button class="desktop-toggle"
                        id="desktopToggle"
                        type="button"
                        aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="workspace-label">PROJECT WORKSPACE</div>

            </div>

            <div class="topbar-right">

                <button class="notification-button"
                        type="button"
                        aria-label="Notifications"
                        onclick="window.location.href='/notifications'">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>

                <div class="user-profile">
                    <div class="user-avatar">J</div>

                    <div class="user-info">
                        <span class="user-name">Jay</span>
                        <span class="user-role">Project Manager</span>
                    </div>
                </div>

            </div>

        </header>

        <!-- PAGE CONTENT -->
        <section class="page-content">

            <div class="page-heading">

                <div>
                    <h1>Task Management</h1>
                    <p>Manage tasks, monitor progress, and keep your projects organized.</p>
                </div>

                <button class="primary-button"
                        type="button"
                        onclick="window.location.href='/tasks/create'">
                    <i class="fa-solid fa-plus"></i>
                    Create Task
                </button>

            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-top">
                        <span class="summary-label">Total Tasks</span>
                        <div class="summary-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                    </div>

                    <div class="summary-number" id="totalTasks">5</div>
                    <div class="summary-description">All listed tasks</div>
                </div>

                <div class="summary-card">
                    <div class="summary-top">
                        <span class="summary-label">In Progress</span>
                        <div class="summary-icon">
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                    </div>

                    <div class="summary-number" id="progressTasks">2</div>
                    <div class="summary-description">Tasks currently ongoing</div>
                </div>

                <div class="summary-card">
                    <div class="summary-top">
                        <span class="summary-label">Completed</span>
                        <div class="summary-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>

                    <div class="summary-number" id="completedTasks">1</div>
                    <div class="summary-description">Finished tasks</div>
                </div>

                <div class="summary-card">
                    <div class="summary-top">
                        <span class="summary-label">To Do</span>
                        <div class="summary-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </div>

                    <div class="summary-number" id="todoTasks">1</div>
                    <div class="summary-description">Tasks waiting to start</div>
                </div>

            </div>

            <!-- TASK TABLE PANEL -->
            <div class="task-panel">

                <div class="panel-header">
                    <div>
                        <h2>All Tasks</h2>
                        <p>View and manage your project tasks.</p>
                    </div>
                </div>

                <!-- SEARCH AND FILTERS -->
                <div class="filter-section">

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input type="text"
                               id="taskSearch"
                               placeholder="Search tasks or projects..."
                               aria-label="Search tasks or projects">
                    </div>

                    <select class="filter-select"
                            id="statusFilter"
                            aria-label="Filter by status">
                        <option value="">All Statuses</option>
                        <option value="progress">In Progress</option>
                        <option value="todo">To Do</option>
                        <option value="completed">Completed</option>
                        <option value="hold">On Hold</option>
                    </select>

                    <select class="filter-select"
                            id="priorityFilter"
                            aria-label="Filter by priority">
                        <option value="">All Priorities</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>

                    <button class="reset-button"
                            type="button"
                            id="resetFilters">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </button>

                </div>

                <!-- TABLE SCROLL CONTAINER -->
                <div class="table-wrapper">

                    <table class="task-table">

                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Assigned To</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody id="taskTableBody">

                            <tr data-status="progress" data-priority="high">
                                <td>
                                    <div class="task-name">Review construction plans</div>
                                    <span class="task-project">Riverside Bridge</span>
                                </td>

                                <td>
                                    <div class="assignee">
                                        <div class="assignee-avatar">JD</div>
                                        <span>John Dela Cruz</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="priority priority-high">High</span>
                                </td>

                                <td>
                                    <span class="status status-progress">In Progress</span>
                                </td>

                                <td>Oct 15, 2026</td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="/tasks/1/edit"
                                           class="action-button"
                                           aria-label="Edit task">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button class="action-button delete delete-task"
                                                type="button"
                                                aria-label="Delete task">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr data-status="todo" data-priority="medium">
                                <td>
                                    <div class="task-name">Prepare material inventory</div>
                                    <span class="task-project">Riverside Bridge</span>
                                </td>

                                <td>
                                    <div class="assignee">
                                        <div class="assignee-avatar">MS</div>
                                        <span>Maria Santos</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="priority priority-medium">Medium</span>
                                </td>

                                <td>
                                    <span class="status status-todo">To Do</span>
                                </td>

                                <td>Oct 18, 2026</td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="/tasks/2/edit"
                                           class="action-button"
                                           aria-label="Edit task">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button class="action-button delete delete-task"
                                                type="button"
                                                aria-label="Delete task">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr data-status="progress" data-priority="high">
                                <td>
                                    <div class="task-name">Inspect foundation work</div>
                                    <span class="task-project">Riverside Bridge</span>
                                </td>

                                <td>
                                    <div class="assignee">
                                        <div class="assignee-avatar">AR</div>
                                        <span>Alex Reyes</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="priority priority-high">High</span>
                                </td>

                                <td>
                                    <span class="status status-progress">In Progress</span>
                                </td>

                                <td>Oct 20, 2026</td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="/tasks/3/edit"
                                           class="action-button"
                                           aria-label="Edit task">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button class="action-button delete delete-task"
                                                type="button"
                                                aria-label="Delete task">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr data-status="completed" data-priority="low">
                                <td>
                                    <div class="task-name">Submit initial project report</div>
                                    <span class="task-project">Road Improvement</span>
                                </td>

                                <td>
                                    <div class="assignee">
                                        <div class="assignee-avatar">JC</div>
                                        <span>James Cruz</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="priority priority-low">Low</span>
                                </td>

                                <td>
                                    <span class="status status-completed">Completed</span>
                                </td>

                                <td>Oct 10, 2026</td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="/tasks/4/edit"
                                           class="action-button"
                                           aria-label="Edit task">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button class="action-button delete delete-task"
                                                type="button"
                                                aria-label="Delete task">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr data-status="hold" data-priority="medium">
                                <td>
                                    <div class="task-name">Confirm equipment delivery</div>
                                    <span class="task-project">Community Center</span>
                                </td>

                                <td>
                                    <div class="assignee">
                                        <div class="assignee-avatar">LM</div>
                                        <span>Luis Mendoza</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="priority priority-medium">Medium</span>
                                </td>

                                <td>
                                    <span class="status status-hold">On Hold</span>
                                </td>

                                <td>Oct 22, 2026</td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="/tasks/5/edit"
                                           class="action-button"
                                           aria-label="Edit task">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button class="action-button delete delete-task"
                                                type="button"
                                                aria-label="Delete task">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="empty-state" id="emptyState" hidden>
                    No tasks found matching your search or filters.
                </div>

                <div class="table-footer" id="tableFooter">
                    Showing 5 tasks
                </div>

            </div>

        </section>

    </main>

    <script>
        const body = document.body;
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const desktopToggle = document.getElementById("desktopToggle");
        const mobileMenuButton = document.getElementById("mobileMenuButton");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        const mobileBreakpoint = 768;

        function isMobileView() {
            return window.innerWidth <= mobileBreakpoint;
        }

        /* MOBILE SIDEBAR */

        function openMobileSidebar() {
            if (!isMobileView()) return;

            body.classList.add("mobile-sidebar-open");
            mobileMenuButton.setAttribute("aria-expanded", "true");

            /* Hide the hamburger while the sidebar is open */
            mobileMenuButton.style.visibility = "hidden";
            mobileMenuButton.style.pointerEvents = "none";
        }

        function closeMobileSidebar() {
            body.classList.remove("mobile-sidebar-open");
            mobileMenuButton.setAttribute("aria-expanded", "false");

            mobileMenuButton.style.visibility = "visible";
            mobileMenuButton.style.pointerEvents = "auto";
        }

        mobileMenuButton.addEventListener("click", function () {
            if (body.classList.contains("mobile-sidebar-open")) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }
        });

        sidebarOverlay.addEventListener("click", closeMobileSidebar);

        sidebarToggle.addEventListener("click", function () {
            if (isMobileView()) {
                closeMobileSidebar();
            } else {
                toggleDesktopSidebar();
            }
        });

        /* DESKTOP SIDEBAR COLLAPSE */

        function toggleDesktopSidebar() {
            body.classList.toggle("sidebar-collapsed");

            const isCollapsed = body.classList.contains("sidebar-collapsed");

            sidebarToggle.innerHTML = isCollapsed
                ? '<i class="fa-solid fa-angles-right"></i>'
                : '<i class="fa-solid fa-angles-left"></i>';

            sidebarToggle.setAttribute(
                "aria-label",
                isCollapsed ? "Expand sidebar" : "Collapse sidebar"
            );
        }

        desktopToggle.addEventListener("click", toggleDesktopSidebar);

        /* CLOSE MOBILE SIDEBAR WITH ESCAPE */

        document.addEventListener("keydown", function (event) {
            if (
                event.key === "Escape" &&
                body.classList.contains("mobile-sidebar-open")
            ) {
                closeMobileSidebar();
            }
        });

        /* CLOSE MOBILE SIDEBAR AFTER NAVIGATION */

        sidebar.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (isMobileView()) {
                    closeMobileSidebar();
                }
            });
        });

        /* HANDLE RESIZING BETWEEN MOBILE AND DESKTOP */

        let wasMobile = isMobileView();

        window.addEventListener("resize", function () {
            const nowMobile = isMobileView();

            if (nowMobile !== wasMobile) {
                closeMobileSidebar();
                wasMobile = nowMobile;
            }
        });

        /* TASK SEARCH AND FILTERS */

        const taskSearch = document.getElementById("taskSearch");
        const statusFilter = document.getElementById("statusFilter");
        const priorityFilter = document.getElementById("priorityFilter");
        const resetFilters = document.getElementById("resetFilters");
        const taskTableBody = document.getElementById("taskTableBody");
        const emptyState = document.getElementById("emptyState");
        const tableFooter = document.getElementById("tableFooter");

        function updateTaskSummary() {
            const rows = Array.from(taskTableBody.querySelectorAll("tr"));

            let progressCount = 0;
            let completedCount = 0;
            let todoCount = 0;

            rows.forEach(function (row) {
                const status = row.dataset.status;

                if (status === "progress") progressCount++;
                if (status === "completed") completedCount++;
                if (status === "todo") todoCount++;
            });

            document.getElementById("totalTasks").textContent = rows.length;
            document.getElementById("progressTasks").textContent = progressCount;
            document.getElementById("completedTasks").textContent = completedCount;
            document.getElementById("todoTasks").textContent = todoCount;
        }

        function filterTasks() {
            const searchValue = taskSearch.value.trim().toLowerCase();
            const selectedStatus = statusFilter.value;
            const selectedPriority = priorityFilter.value;

            const rows = Array.from(taskTableBody.querySelectorAll("tr"));
            let visibleCount = 0;

            rows.forEach(function (row) {
                const rowText = row.textContent.toLowerCase();
                const status = row.dataset.status;
                const priority = row.dataset.priority;

                const matchesSearch = rowText.includes(searchValue);
                const matchesStatus = !selectedStatus || status === selectedStatus;
                const matchesPriority = !selectedPriority || priority === selectedPriority;

                const visible =
                    matchesSearch &&
                    matchesStatus &&
                    matchesPriority;

                row.hidden = !visible;

                if (visible) {
                    visibleCount++;
                }
            });

            emptyState.hidden = visibleCount !== 0;

            tableFooter.textContent =
                "Showing " + visibleCount +
                (visibleCount === 1 ? " task" : " tasks");
        }

        taskSearch.addEventListener("input", filterTasks);
        statusFilter.addEventListener("change", filterTasks);
        priorityFilter.addEventListener("change", filterTasks);

        resetFilters.addEventListener("click", function () {
            taskSearch.value = "";
            statusFilter.value = "";
            priorityFilter.value = "";
            filterTasks();
        });

        /* SAMPLE ROW DELETION
           This only removes the row from the current page.
           It does not delete a record from the Laravel database. */

        taskTableBody.addEventListener("click", function (event) {
            const deleteButton = event.target.closest(".delete-task");

            if (!deleteButton) return;

            const row = deleteButton.closest("tr");

            if (confirm("Are you sure you want to remove this task from the page?")) {
                row.remove();
                filterTasks();
                updateTaskSummary();
            }
        });

        /* INITIALIZE */

        filterTasks();
        updateTaskSummary();
    </script>

</body>
</html>
