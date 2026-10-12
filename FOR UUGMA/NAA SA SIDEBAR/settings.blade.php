
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Settings</title>

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

        button, a, input, select {
            -webkit-tap-highlight-color: transparent;
        }

        button:focus-visible, a:focus-visible,
        input:focus-visible, select:focus-visible {
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

        /* SETTINGS PAGE CONTENT */

        .settings-page { padding: 30px 0; }

        .settings-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            animation: fadeDown .65s .2s ease both;
        }

        .settings-header h1 {
            font-size: 36px;
            font-weight: 500;
            letter-spacing: -1px;
        }

        .settings-header p {
            margin-top: 6px;
            color: #64748B;
            font-size: 14px;
            line-height: 1.6;
        }

        .settings-layout {
            display: grid;
            grid-template-columns: 220px minmax(0, 1fr);
            align-items: start;
            gap: 24px;
        }

        .settings-navigation {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            animation: cardEntrance .6s .25s var(--motion) both;
        }

        .settings-navigation button {
            display: flex;
            width: 100%;
            min-height: 43px;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            border: none;
            border-radius: 7px;
            color: var(--secondary);
            background: transparent;
            font-size: 12px;
            text-align: left;
            cursor: pointer;
            transition:
                color .25s ease,
                background .25s ease,
                transform .25s var(--motion);
        }

        .settings-navigation button:hover {
            color: var(--primary);
            background: var(--light-green);
            transform: translateX(2px);
        }

        .settings-navigation button.active {
            color: var(--primary);
            background: var(--accent);
            font-weight: bold;
        }

        .settings-navigation button i {
            width: 17px;
            text-align: center;
            font-size: 14px;
        }

        .settings-content {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .settings-section {
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: white;
            animation: cardEntrance .65s var(--motion) both;
            scroll-margin-top: 20px;
        }

        .settings-section:nth-child(1) { animation-delay: .25s; }
        .settings-section:nth-child(2) { animation-delay: .35s; }
        .settings-section:nth-child(3) { animation-delay: .45s; }
        .settings-section:nth-child(4) { animation-delay: .55s; }

        .settings-section h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .section-description {
            margin-top: 7px;
            color: var(--secondary);
            font-size: 12px;
            line-height: 1.6;
        }

        .section-divider {
            height: 1px;
            margin: 22px 0;
            border: 0;
            background: var(--border);
        }

        .profile-preview {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 22px;
        }

        .profile-avatar {
            display: grid;
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            place-items: center;
            border: 3px solid var(--light-green);
            border-radius: 50%;
            color: var(--accent);
            background: var(--primary);
            font-size: 24px;
            font-weight: bold;
        }

        .profile-info h3 {
            font-size: 15px;
            font-weight: 600;
        }

        .profile-info p {
            margin-top: 5px;
            color: var(--secondary);
            font-size: 12px;
        }

        .profile-role {
            display: inline-block;
            margin-top: 8px;
            padding: 5px 9px;
            border-radius: 20px;
            color: var(--primary);
            background: var(--light-green);
            font-size: 10px;
            font-weight: bold;
        }

        .settings-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .form-group {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            min-width: 0;
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

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(18, 63, 58, .08);
        }

        .form-group input::placeholder { color: #A0AAA6; }

        .form-help {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .settings-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 16px 0;
            border-bottom: 1px solid #EEF0E9;
        }

        .settings-option:first-of-type { margin-top: 12px; }

        .settings-option:last-child {
            padding-bottom: 0;
            border-bottom: none;
        }

        .option-info {
            min-width: 0;
        }

        .option-info h3 {
            font-size: 13px;
            font-weight: 600;
        }

        .option-info p {
            margin-top: 5px;
            color: var(--secondary);
            font-size: 11px;
            line-height: 1.6;
        }

        .switch {
            position: relative;
            display: inline-flex;
            width: 42px;
            height: 24px;
            flex-shrink: 0;
        }

        .switch input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .switch-track {
            position: absolute;
            inset: 0;
            border-radius: 30px;
            background: #D5DAD5;
            cursor: pointer;
            transition: background .25s ease;
        }

        .switch-track::before {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            content: "";
            box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
            transition: transform .25s var(--motion);
        }

        .switch input:checked + .switch-track {
            background: var(--primary);
        }

        .switch input:checked + .switch-track::before {
            transform: translateX(18px);
        }

        .switch input:focus-visible + .switch-track {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        .settings-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .settings-btn {
            display: inline-flex;
            min-height: 40px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 16px;
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--primary);
            background: white;
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

        .settings-btn:hover {
            background: var(--light-green);
            border-color: #C8D5BC;
            transform: translateY(-2px);
        }

        .settings-btn:active { transform: scale(.97); }

        .settings-btn.primary-btn {
            color: white;
            border-color: var(--primary);
            background: var(--primary);
        }

        .settings-btn.primary-btn:hover {
            border-color: var(--primary-hover);
            background: var(--primary-hover);
        }

        .settings-message {
            display: none;
            margin-top: 18px;
            padding: 12px 14px;
            border: 1px solid #C8DCC1;
            border-radius: 7px;
            color: var(--primary);
            background: var(--light-green);
            font-size: 12px;
            line-height: 1.5;
        }

        .settings-message.show { display: block; }

        .danger-zone {
            border-color: #F0D8D5;
        }

        .danger-zone h2 { color: #A33B32; }

        .danger-zone .section-description { color: #7D6663; }

        .danger-btn {
            color: #A33B32;
            border-color: #E6C4C0;
        }

        .danger-btn:hover {
            color: #8C2821;
            border-color: #DDAAA4;
            background: #FFF3F1;
        }

        /* TABLET */

        @media (max-width: 1050px) {
            .main { padding: 30px; }

            .settings-layout {
                grid-template-columns: 190px minmax(0, 1fr);
                gap: 18px;
            }

            .settings-section { padding: 22px; }
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

            .settings-page { padding: 20px 0; }

            .settings-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .settings-header h1 { font-size: 30px; }

            .settings-layout {
                grid-template-columns: 1fr;
            }

            .settings-navigation {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 6px;
            }

            .settings-navigation button {
                justify-content: flex-start;
                padding: 11px 9px;
                font-size: 11px;
            }

            .settings-section { padding: 20px; }
        }

        @media (max-width: 500px) {
            .main { padding: 16px; }

            .user-area { gap: 10px; }

            .page-title {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .settings-header h1 { font-size: 28px; }

            .settings-navigation {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                padding: 8px;
            }

            .settings-navigation button {
                gap: 7px;
                padding: 10px 7px;
                font-size: 10px;
            }

            .settings-navigation button i { font-size: 12px; }

            .settings-section { padding: 18px; }

            .form-grid { grid-template-columns: 1fr; }

            .profile-preview { gap: 12px; }

            .profile-avatar {
                width: 54px;
                height: 54px;
                font-size: 20px;
            }

            .settings-option { gap: 12px; }

            .settings-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .settings-actions .settings-btn { width: 100%; }
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
                <i class="menu-icon fa-solid fa-map" aria-hidden="true"></i>
            <span class="sidebar-label">Project Map</span>
            </a>

            <a href="#">
                <i class="menu-icon fa-solid fa-chart-column" aria-hidden="true"></i>
                <span class="sidebar-label">Reports</span>
            </a>

            <div class="menu-title">ACCOUNT</div>

            <nav class="menu" aria-label="Account navigation">
                <a href="/settings.blade.php"  aria-current="page">
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

        <!-- SETTINGS PAGE CONTENT -->
        <div class="settings-page">
            <div class="settings-header">
                <div>
                    <h1>Settings</h1>
                    <p>Manage your account, preferences, notifications, and security.</p>
                </div>
            </div>

            <div class="settings-layout">

                <!-- SETTINGS NAVIGATION -->
                <nav class="settings-navigation" aria-label="Settings sections">
                    <button type="button" class="active" data-section="profileSettings">
                        <i class="fa-regular fa-user" aria-hidden="true"></i>
                        Profile
                    </button>

                    <button type="button" data-section="accountSettings">
                        <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                        Preferences
                    </button>

                    <button type="button" data-section="notificationSettings">
                        <i class="fa-regular fa-bell" aria-hidden="true"></i>
                        Notifications
                    </button>

                    <button type="button" data-section="securitySettings">
                        <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                        Security
                    </button>
                </nav>

                <!-- SETTINGS CONTENT -->
                <div class="settings-content">

                    <!-- PROFILE SETTINGS -->
                    <section class="settings-section" id="profileSettings">
                        <h2>Profile Settings</h2>
                        <p class="section-description">
                            Update the personal information associated with your account.
                        </p>

                        <div class="profile-preview">
                            <div class="profile-avatar">J</div>

                            <div class="profile-info">
                                <h3>Jay</h3>
                                <p>Project Manager account</p>
                                <span class="profile-role">Administrator</span>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <form class="settings-form" id="profileForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input
                                        type="text"
                                        id="fullName"
                                        name="fullName"
                                        value="Jay"
                                        placeholder="Enter your full name"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="displayName">Display Name</label>
                                    <input
                                        type="text"
                                        id="displayName"
                                        name="displayName"
                                        value="Jay"
                                        placeholder="Enter your display name"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        placeholder="Enter your email address"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        placeholder="Enter your phone number"
                                    >
                                </div>
                            </div>

                            <div class="settings-actions">
                                <button class="settings-btn" type="reset">
                                    Reset
                                </button>

                                <button class="settings-btn primary-btn" type="submit">
                                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                                    Save Changes
                                </button>
                            </div>

                            <div class="settings-message" id="profileMessage" role="status"></div>
                        </form>
                    </section>

                    <!-- ACCOUNT PREFERENCES -->
                    <section class="settings-section" id="accountSettings">
                        <h2>Account Preferences</h2>
                        <p class="section-description">
                            Customize how information is displayed on your workspace.
                        </p>

                        <form class="settings-form" id="preferencesForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="language">Language</label>
                                    <select id="language" name="language">
                                        <option value="en">English</option>
                                        <option value="fil">Filipino</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="timezone">Time Zone</label>
                                    <select id="timezone" name="timezone">
                                        <option value="Asia/Manila">Philippine Time (UTC+08:00)</option>
                                        <option value="UTC">Coordinated Universal Time (UTC)</option>
                                        <option value="Asia/Singapore">Singapore Time (UTC+08:00)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="dateFormat">Date Format</label>
                                    <select id="dateFormat" name="dateFormat">
                                        <option value="d-m-Y">DD-MM-YYYY</option>
                                        <option value="m-d-Y">MM-DD-YYYY</option>
                                        <option value="Y-m-d">YYYY-MM-DD</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="itemsPerPage">Items Per Page</label>
                                    <select id="itemsPerPage" name="itemsPerPage">
                                        <option value="10">10 items</option>
                                        <option value="20">20 items</option>
                                        <option value="50">50 items</option>
                                    </select>
                                </div>
                            </div>

                            <div class="settings-actions">
                                <button class="settings-btn" type="reset">Reset</button>

                                <button class="settings-btn primary-btn" type="submit">
                                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                                    Save Preferences
                                </button>
                            </div>

                            <div class="settings-message" id="preferencesMessage" role="status"></div>
                        </form>
                    </section>

                    <!-- NOTIFICATION SETTINGS -->
                    <section class="settings-section" id="notificationSettings">
                        <h2>Notification Settings</h2>
                        <p class="section-description">
                            Choose which updates you want to receive from Project Manager.
                        </p>

                        <form id="notificationsForm">
                            <div class="settings-option">
                                <div class="option-info">
                                    <h3>Email Notifications</h3>
                                    <p>Receive important project updates through email.</p>
                                </div>

                                <label class="switch">
                                    <input type="checkbox" name="emailNotifications" checked>
                                    <span class="switch-track"></span>
                                </label>
                            </div>

                            <div class="settings-option">
                                <div class="option-info">
                                    <h3>Project Updates</h3>
                                    <p>Get notified when project details or status change.</p>
                                </div>

                                <label class="switch">
                                    <input type="checkbox" name="projectUpdates" checked>
                                    <span class="switch-track"></span>
                                </label>
                            </div>

                            <div class="settings-option">
                                <div class="option-info">
                                    <h3>Task Reminders</h3>
                                    <p>Receive reminders about upcoming tasks and deadlines.</p>
                                </div>

                                <label class="switch">
                                    <input type="checkbox" name="taskReminders" checked>
                                    <span class="switch-track"></span>
                                </label>
                            </div>

                            <div class="settings-option">
                                <div class="option-info">
                                    <h3>Team Activity</h3>
                                    <p>Get updates when team members make changes.</p>
                                </div>

                                <label class="switch">
                                    <input type="checkbox" name="teamActivity">
                                    <span class="switch-track"></span>
                                </label>
                            </div>

                            <div class="settings-actions">
                                <button class="settings-btn" type="reset">Reset</button>

                                <button class="settings-btn primary-btn" type="submit">
                                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                                    Save Notifications
                                </button>
                            </div>

                            <div class="settings-message" id="notificationsMessage" role="status"></div>
                        </form>
                    </section>

                    <!-- SECURITY SETTINGS -->
                    <section class="settings-section" id="securitySettings">
                        <h2>Security</h2>
                        <p class="section-description">
                            Manage your password and help keep your account secure.
                        </p>

                        <form class="settings-form" id="securityForm">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input
                                    type="password"
                                    id="currentPassword"
                                    name="currentPassword"
                                    placeholder="Enter your current password"
                                    autocomplete="current-password"
                                    required
                                >
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input
                                        type="password"
                                        id="newPassword"
                                        name="newPassword"
                                        placeholder="Enter your new password"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >
                                    <span class="form-help">Use at least 8 characters.</span>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm New Password</label>
                                    <input
                                        type="password"
                                        id="confirmPassword"
                                        name="confirmPassword"
                                        placeholder="Confirm your new password"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="settings-actions">
                                <button class="settings-btn" type="reset">Clear</button>

                                <button class="settings-btn primary-btn" type="submit">
                                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                    Update Password
                                </button>
                            </div>

                            <div class="settings-message" id="securityMessage" role="status"></div>
                        </form>
                    </section>

                    <!-- DANGER ZONE -->
                    <section class="settings-section danger-zone">
                        <h2>Account Actions</h2>
                        <p class="section-description">
                            Sign out when you have finished working on your account.
                        </p>

                        <div class="settings-option">
                            <div class="option-info">
                                <h3>Log Out</h3>
                                <p>End your current session on this device.</p>
                            </div>

                            <a href="/logout" class="settings-btn danger-btn">
                                <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                                Log Out
                            </a>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </main>

    <!-- SHARED SIDEBAR JAVASCRIPT + SETTINGS INTERACTIONS -->
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

            /* SETTINGS SECTION NAVIGATION */

            const settingsNavButtons = document.querySelectorAll(
                ".settings-navigation button"
            );

            settingsNavButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const sectionId = button.dataset.section;
                    const targetSection = document.getElementById(sectionId);

                    if (!targetSection) return;

                    settingsNavButtons.forEach(function (item) {
                        item.classList.remove("active");
                    });

                    button.classList.add("active");

                    targetSection.scrollIntoView({
                        behavior: reduceMotion ? "auto" : "smooth",
                        block: "start"
                    });
                });
            });

            /* PROFILE PREVIEW */

            const fullNameInput = document.getElementById("fullName");
            const displayNameInput = document.getElementById("displayName");
            const profileName = document.querySelector(".profile-info h3");
            const profileAvatar = document.querySelector(".profile-avatar");
            const topbarAvatar = document.querySelector(".avatar");
            const topbarName = document.querySelector(".user > span");

            function updateProfilePreview() {
                const name = displayNameInput.value.trim() || "Jay";
                const initial = name.charAt(0).toUpperCase();

                profileName.textContent = name;
                profileAvatar.textContent = initial;
                topbarAvatar.textContent = initial;
                topbarName.textContent = name;
            }

            displayNameInput.addEventListener("input", updateProfilePreview);

            /* FORM MESSAGES */

            function showMessage(elementId, message) {
                const messageElement = document.getElementById(elementId);

                messageElement.textContent = message;
                messageElement.classList.add("show");
            }

            function clearMessage(form) {
                const message = form.querySelector(".settings-message");

                if (message) {
                    message.textContent = "";
                    message.classList.remove("show");
                }
            }

            document.querySelectorAll(".settings-form, #notificationsForm")
                .forEach(function (form) {
                    form.addEventListener("input", function () {
                        clearMessage(form);
                    });

                    form.addEventListener("reset", function () {
                        window.setTimeout(function () {
                            clearMessage(form);

                            if (form.id === "profileForm") {
                                updateProfilePreview();
                            }
                        }, 0);
                    });
                });

            /* PROFILE FORM */

            document.getElementById("profileForm").addEventListener(
                "submit",
                function (event) {
                    event.preventDefault();

                    if (!this.reportValidity()) return;

                    updateProfilePreview();

                    showMessage(
                        "profileMessage",
                        "Your profile changes are ready. Connect this form to your Laravel backend to save them permanently."
                    );
                }
            );

            /* PREFERENCES FORM */

            document.getElementById("preferencesForm").addEventListener(
                "submit",
                function (event) {
                    event.preventDefault();

                    showMessage(
                        "preferencesMessage",
                        "Your preferences are selected. Connect this form to your Laravel backend to save them permanently."
                    );
                }
            );

            /* NOTIFICATION FORM */

            document.getElementById("notificationsForm").addEventListener(
                "submit",
                function (event) {
                    event.preventDefault();

                    showMessage(
                        "notificationsMessage",
                        "Your notification choices are selected. Connect this form to your Laravel backend to save them permanently."
                    );
                }
            );

            /* SECURITY FORM */

            document.getElementById("securityForm").addEventListener(
                "submit",
                function (event) {
                    event.preventDefault();

                    if (!this.reportValidity()) return;

                    const newPassword = document.getElementById("newPassword");
                    const confirmPassword = document.getElementById("confirmPassword");

                    if (newPassword.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity(
                            "The passwords do not match."
                        );

                        confirmPassword.reportValidity();
                        confirmPassword.setCustomValidity("");
                        return;
                    }

                    showMessage(
                        "securityMessage",
                        "The passwords match. Connect this form to Laravel's password update functionality to change your password securely."
                    );

                    this.reset();
                }
            );
        });
    </script>
</body>
</html>
