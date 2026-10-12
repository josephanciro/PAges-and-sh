<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Calendar</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        :root {
            --primary: #123F3A;
            --hover: #1D4D48;
            --lime: #D7F56B;
            --background: #F5F4EE;
            --white: #FFFFFF;
            --text: #20332F;
            --secondary: #71817E;
            --muted: #8A9693;
            --border: #E0E1DA;
            --light-green: #EEF3DC;
            --sidebar-width: 260px;
            --sidebar-small: 76px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            min-height: 100%;
            overflow-x: clip;
        }

        body {
            min-height: 100vh;
            width: 100%;
            overflow-x: clip;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
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
            background: var(--primary);
            color: var(--white);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-x: hidden;
            overflow-y: auto;
            transition: width 0.25s ease, transform 0.25s ease;
            scrollbar-width: none;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar-header {
            min-height: 78px;
            padding: 18px 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }

        .sidebar-logo {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-logo img {
            width: 37px;
            height: 37px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .logo-fallback {
            width: 37px;
            height: 37px;
            display: none;
            align-items: center;
            justify-content: center;
            background: var(--lime);
            color: var(--primary);
            border-radius: 9px;
            font-size: 19px;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -0.5px;
            white-space: nowrap;
        }

        .logo-text span {
            color: var(--lime);
        }

        .sidebar-toggle {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            background: transparent;
            border: 0;
            border-radius: 7px;
        }

        .sidebar-toggle:hover {
            background: var(--hover);
        }

        .sidebar-content {
            flex: 1;
            padding: 23px 12px 14px;
        }

        .menu-title {
            margin: 0 12px 12px;
            color: #AABCB7;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            white-space: nowrap;
        }

        .menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 28px;
        }

        .menu a {
            min-height: 44px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 0 13px;
            border-radius: 7px;
            color: #E0E9E6;
            font-size: 13px;
            white-space: nowrap;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .menu a:hover {
            background: var(--hover);
            color: var(--white);
        }

        .menu a.active {
            background: var(--lime);
            color: var(--primary);
            font-weight: 700;
        }

        .menu a i {
            width: 20px;
            min-width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .menu a .menu-label {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bottom-menu {
            padding: 14px 12px 18px;
            border-top: 1px solid rgba(255,255,255,0.12);
        }

        /* COLLAPSED SIDEBAR */

        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-small);
        }

        body.sidebar-collapsed .sidebar-header {
            padding: 18px 20px;
            flex-direction: column;
            justify-content: center;
            gap: 12px;
        }

        body.sidebar-collapsed .sidebar-logo {
            width: 37px;
            justify-content: center;
        }

        body.sidebar-collapsed .logo-text,
        body.sidebar-collapsed .menu-title,
        body.sidebar-collapsed .menu-label {
            display: none;
        }

        body.sidebar-collapsed .sidebar-content {
            padding-left: 10px;
            padding-right: 10px;
        }

        body.sidebar-collapsed .menu a {
            justify-content: center;
            padding: 0;
        }

        body.sidebar-collapsed .menu a i {
            font-size: 18px;
        }

        body.sidebar-collapsed .bottom-menu {
            padding-left: 10px;
            padding-right: 10px;
        }

        body.sidebar-collapsed .sidebar-toggle {
            width: 34px;
            height: 28px;
        }

        /* MOBILE SIDEBAR */

        .hamburger {
            display: none;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--primary);
            font-size: 18px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 30, 27, 0.48);
            z-index: 999;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* MAIN LAYOUT */

        .main {
            width: calc(100% - var(--sidebar-width));
            min-width: 0;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: width 0.25s ease, margin-left 0.25s ease;
        }

        body.sidebar-collapsed .main {
            width: calc(100% - var(--sidebar-small));
            margin-left: var(--sidebar-small);
        }

        .topbar {
            min-height: 78px;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .breadcrumb {
            color: var(--secondary);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .topbar-title {
            color: var(--primary);
            font-size: 21px;
            font-weight: 600;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .icon-button {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--primary);
            background: var(--white);
            position: relative;
        }

        .icon-button:hover {
            background: var(--light-green);
        }

        .notification-dot {
            width: 7px;
            height: 7px;
            position: absolute;
            top: 7px;
            right: 7px;
            border-radius: 50%;
            background: #E47D62;
            border: 1px solid white;
        }

        .topbar-profile {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--primary);
            background: var(--light-green);
            border: 1px solid #DCE6C7;
        }

        .page-content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 28px 30px 38px;
            min-width: 0;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            color: var(--primary);
            font-size: 27px;
            font-weight: 600;
            margin-bottom: 8px;
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
            background: var(--primary);
            color: var(--white);
            border: 1px solid var(--primary);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .primary-button:hover {
            background: var(--hover);
        }

        /* CALENDAR SUMMARY */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .summary-card {
            min-width: 0;
            padding: 19px;
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .summary-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--light-green);
            color: var(--primary);
            font-size: 18px;
        }

        .summary-card:nth-child(2) .summary-icon {
            background: #F8EED9;
            color: #97702B;
        }

        .summary-card:nth-child(3) .summary-icon {
            background: #E5EBF7;
            color: #4567A5;
        }

        .summary-label {
            color: var(--secondary);
            font-size: 12px;
            margin-bottom: 7px;
        }

        .summary-value {
            color: var(--primary);
            font-size: 24px;
            font-weight: 700;
        }

        /* CALENDAR PANEL */

        .calendar-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 20px;
            align-items: start;
        }

        .calendar-panel,
        .side-panel {
            min-width: 0;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .calendar-panel {
            padding: 22px;
        }

        .calendar-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        .month-title {
            color: var(--primary);
            font-size: 21px;
            font-weight: 700;
        }

        .calendar-controls {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .calendar-control {
            height: 35px;
            min-width: 35px;
            padding: 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--primary);
            font-size: 12px;
        }

        .calendar-control:hover {
            background: var(--light-green);
        }

        .calendar-weekdays,
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
        }

        .calendar-weekdays {
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .weekday {
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
        }

        .calendar-grid {
            margin-top: 5px;
        }

        .calendar-day {
            min-width: 0;
            min-height: 92px;
            padding: 8px 5px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            border: 1px solid transparent;
            border-radius: 7px;
            background: transparent;
            color: var(--text);
        }

        .calendar-day:hover {
            background: #F6F8F0;
            border-color: var(--border);
        }

        .calendar-day.other-month {
            color: #B9C1BE;
        }

        .calendar-day.today .day-number {
            background: var(--primary);
            color: var(--white);
        }

        .calendar-day.selected {
            background: var(--light-green);
            border-color: #C9D8A8;
        }

        .day-number {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 600;
        }

        .event-markers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 4px;
        }

        .event-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        .event-dot.meeting {
            background: #6C8BC6;
        }

        .event-dot.deadline {
            background: #D87961;
        }

        .event-dot.site {
            background: #78A16A;
        }

        .event-dot.other {
            background: #B49ACD;
        }

        .calendar-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--secondary);
            font-size: 11px;
        }

        /* RIGHT SIDE */

        .side-panel {
            overflow: hidden;
        }

        .side-panel-section {
            padding: 20px;
        }

        .side-panel-section + .side-panel-section {
            border-top: 1px solid var(--border);
        }

        .side-panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
        }

        .side-panel-heading h2 {
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
        }

        .selected-date-label {
            color: var(--secondary);
            font-size: 11px;
            margin-bottom: 14px;
        }

        .event-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .event-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 11px;
            background: #FAFAF7;
            border: 1px solid var(--border);
            border-radius: 8px;
            min-width: 0;
        }

        .event-stripe {
            width: 4px;
            min-height: 42px;
            border-radius: 4px;
            background: #6C8BC6;
            flex-shrink: 0;
        }

        .event-stripe.deadline {
            background: #D87961;
        }

        .event-stripe.site {
            background: #78A16A;
        }

        .event-stripe.other {
            background: #B49ACD;
        }

        .event-details {
            flex: 1;
            min-width: 0;
        }

        .event-title {
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
            margin-bottom: 5px;
        }

        .event-meta {
            color: var(--secondary);
            font-size: 11px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .delete-event {
            flex-shrink: 0;
            padding: 3px;
            color: var(--muted);
            border: 0;
            background: transparent;
        }

        .delete-event:hover {
            color: #B74C3C;
        }

        .empty-state {
            padding: 22px 8px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .empty-state i {
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
            color: #A8B7AD;
        }

        .upcoming-item {
            padding: 11px 0;
            display: flex;
            align-items: flex-start;
            gap: 11px;
            border-bottom: 1px solid #EFF0EA;
        }

        .upcoming-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .upcoming-date {
            width: 43px;
            min-width: 43px;
            padding: 7px 3px;
            text-align: center;
            background: var(--light-green);
            border-radius: 7px;
        }

        .upcoming-date .month {
            display: block;
            color: var(--secondary);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .upcoming-date .day {
            display: block;
            color: var(--primary);
            font-size: 18px;
            font-weight: 700;
            margin-top: 3px;
        }

        .upcoming-info {
            min-width: 0;
        }

        .upcoming-info h3 {
            color: var(--primary);
            font-size: 12px;
            line-height: 1.5;
            overflow-wrap: anywhere;
            margin-bottom: 5px;
        }

        .upcoming-info p {
            color: var(--secondary);
            font-size: 11px;
        }

        /* MODAL */

        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 2000;
            padding: 18px;
            align-items: center;
            justify-content: center;
            background: rgba(14, 35, 31, 0.52);
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 480px;
            max-height: calc(100vh - 36px);
            overflow-y: auto;
            background: var(--white);
            border-radius: 13px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 21px 23px;
            border-bottom: 1px solid var(--border);
        }

        .modal-header h2 {
            color: var(--primary);
            font-size: 18px;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: var(--secondary);
        }

        .modal-close:hover {
            background: var(--background);
        }

        .modal-form {
            padding: 22px 23px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            min-width: 0;
            padding: 11px 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--text);
            font-size: 13px;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(18,63,58,0.08);
        }

        .form-group textarea {
            min-height: 80px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 12px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding-top: 5px;
        }

        .secondary-button {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: var(--white);
            color: var(--secondary);
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .calendar-layout {
                grid-template-columns: minmax(0, 1fr);
            }

            .side-panel {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .side-panel-section + .side-panel-section {
                border-top: 0;
                border-left: 1px solid var(--border);
            }
        }

        @media (max-width: 900px) {
            .page-content {
                padding: 23px 20px 30px;
            }

            .topbar {
                padding: 14px 20px;
            }

            .summary-grid {
                gap: 10px;
            }

            .summary-card {
                padding: 14px;
            }

            .calendar-panel {
                padding: 16px;
            }

            .calendar-day {
                min-height: 75px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            body.sidebar-collapsed .sidebar {
                width: var(--sidebar-width);
            }

            body.sidebar-collapsed .sidebar-header {
                padding: 18px 17px;
                flex-direction: row;
                justify-content: space-between;
            }

            body.sidebar-collapsed .logo-text,
            body.sidebar-collapsed .menu-title,
            body.sidebar-collapsed .menu-label {
                display: initial;
            }

            body.sidebar-collapsed .sidebar-content {
                padding: 23px 12px 14px;
            }

            body.sidebar-collapsed .menu a {
                justify-content: flex-start;
                padding: 0 13px;
            }

            body.sidebar-collapsed .bottom-menu {
                padding: 14px 12px 18px;
            }

            .sidebar-toggle {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .main,
            body.sidebar-collapsed .main {
                width: 100%;
                margin-left: 0;
            }

            .topbar {
                min-height: 70px;
                padding: 12px 16px;
            }

            .topbar-title {
                font-size: 18px;
            }

            .page-content {
                padding: 22px 16px 28px;
            }

            .page-heading h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 560px) {
            .page-heading {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .page-heading .primary-button {
                align-self: flex-start;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                padding: 14px 16px;
            }

            .summary-value {
                font-size: 21px;
            }

            .calendar-panel {
                padding: 12px 8px;
            }

            .calendar-toolbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
                padding: 0 5px;
            }

            .month-title {
                font-size: 19px;
            }

            .calendar-controls {
                width: 100%;
            }

            .calendar-control.today-control {
                flex: 1;
            }

            .weekday {
                font-size: 10px;
            }

            .calendar-day {
                min-height: 53px;
                padding: 4px 1px;
                gap: 4px;
                border-radius: 5px;
            }

            .day-number {
                width: 25px;
                height: 25px;
                font-size: 11px;
            }

            .event-dot {
                width: 5px;
                height: 5px;
            }

            .calendar-legend {
                gap: 10px;
                padding-left: 5px;
                padding-right: 5px;
            }

            .legend-item {
                font-size: 10px;
            }

            .side-panel {
                display: block;
            }

            .side-panel-section + .side-panel-section {
                border-top: 1px solid var(--border);
                border-left: 0;
            }

            .topbar-right {
                gap: 7px;
            }

            .topbar-right .icon-button {
                width: 35px;
                height: 35px;
            }

            .topbar-profile {
                width: 35px;
                height: 35px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 360px) {
            .page-content {
                padding-left: 10px;
                padding-right: 10px;
            }

            .topbar {
                padding-left: 10px;
                padding-right: 10px;
            }

            .breadcrumb {
                font-size: 10px;
            }

            .topbar-title {
                font-size: 16px;
            }

            .calendar-day {
                min-height: 45px;
            }

            .day-number {
                width: 22px;
                height: 22px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ url('/dashboard') }}" class="sidebar-logo">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Project Manager logo"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >
                <span class="logo-fallback">
                    <i class="fa-solid fa-diagram-project"></i>
                </span>

                <span class="logo-text">Project<span>Manager</span></span>
            </a>

            <button class="sidebar-toggle"
                    id="sidebarToggle"
                    type="button"
                    aria-label="Collapse sidebar"
                    title="Collapse sidebar">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>

        <div class="sidebar-content">
            <p class="menu-title">WORKSPACE</p>

            <ul class="menu">
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="menu-label">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/projects') }}">
                        <i class="fa-solid fa-folder-open"></i>
                        <span class="menu-label">Projects</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/tasks') }}">
                        <i class="fa-solid fa-list-check"></i>
                        <span class="menu-label">Tasks</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/calendar') }}" class="active">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="menu-label">Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/personnel') }}">
                        <i class="fa-solid fa-users"></i>
                        <span class="menu-label">Team</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/documents') }}">
                        <i class="fa-solid fa-file-lines"></i>
                        <span class="menu-label">Files</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/reports') }}">
                        <i class="fa-solid fa-chart-column"></i>
                        <span class="menu-label">Reports</span>
                    </a>
                </li>
            </ul>

            <p class="menu-title">ACCOUNT</p>

            <ul class="menu">
                <li>
                    <a href="{{ url('/settings') }}">
                        <i class="fa-solid fa-gear"></i>
                        <span class="menu-label">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="menu-label">Log out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-menu">
            <ul class="menu" style="margin-bottom: 0;">
                <li>
                    <a href="{{ url('/profile') }}">
                        <i class="fa-regular fa-user"></i>
                        <span class="menu-label">My Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="main" id="mainContent">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger"
                        id="hamburger"
                        type="button"
                        aria-label="Open navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div>
                    <div class="breadcrumb">Workspace / Calendar</div>
                    <h2 class="topbar-title">Calendar</h2>
                </div>
            </div>

            <div class="topbar-right">
                <a href="{{ url('/notifications') }}"
                   class="icon-button"
                   aria-label="Notifications"
                   title="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </a>

                <a href="{{ url('/profile') }}"
                   class="topbar-profile"
                   aria-label="My profile"
                   title="My profile">
                    <i class="fa-regular fa-user"></i>
                </a>
            </div>
        </header>

        <section class="page-content">
            <div class="page-heading">
                <div>
                    <h1>Project Calendar</h1>
                    <p>Manage your project meetings, deadlines, and important dates.</p>
                </div>

                <button class="primary-button" id="addEventButton" type="button">
                    <i class="fa-solid fa-plus"></i>
                    Add Event
                </button>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <p class="summary-label">Events This Month</p>
                        <p class="summary-value" id="monthEventCount">0</p>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <p class="summary-label">Upcoming Events</p>
                        <p class="summary-value" id="upcomingEventCount">0</p>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="summary-label">Events Today</p>
                        <p class="summary-value" id="todayEventCount">0</p>
                    </div>
                </div>
            </div>

            <div class="calendar-layout">
                <section class="calendar-panel">
                    <div class="calendar-toolbar">
                        <h2 class="month-title" id="monthTitle">Month Year</h2>

                        <div class="calendar-controls">
                            <button class="calendar-control"
                                    id="previousMonth"
                                    type="button"
                                    aria-label="Previous month">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <button class="calendar-control today-control"
                                    id="todayButton"
                                    type="button">
                                Today
                            </button>

                            <button class="calendar-control"
                                    id="nextMonth"
                                    type="button"
                                    aria-label="Next month">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="calendar-weekdays">
                        <div class="weekday">Sun</div>
                        <div class="weekday">Mon</div>
                        <div class="weekday">Tue</div>
                        <div class="weekday">Wed</div>
                        <div class="weekday">Thu</div>
                        <div class="weekday">Fri</div>
                        <div class="weekday">Sat</div>
                    </div>

                    <div class="calendar-grid" id="calendarGrid"></div>

                    <div class="calendar-legend">
                        <div class="legend-item">
                            <span class="event-dot meeting"></span>
                            Meeting
                        </div>
                        <div class="legend-item">
                            <span class="event-dot deadline"></span>
                            Deadline
                        </div>
                        <div class="legend-item">
                            <span class="event-dot site"></span>
                            Site Visit
                        </div>
                        <div class="legend-item">
                            <span class="event-dot other"></span>
                            Other
                        </div>
                    </div>
                </section>

                <aside class="side-panel">
                    <section class="side-panel-section">
                        <div class="side-panel-heading">
                            <h2>Selected Date</h2>
                        </div>

                        <p class="selected-date-label" id="selectedDateLabel"></p>
                        <div class="event-list" id="selectedDateEvents"></div>
                    </section>

                    <section class="side-panel-section">
                        <div class="side-panel-heading">
                            <h2>Upcoming Events</h2>
                        </div>

                        <div id="upcomingEvents"></div>
                    </section>
                </aside>
            </div>
        </section>
    </main>

    <!-- ADD EVENT MODAL -->
    <div class="modal-backdrop" id="eventModal" role="dialog" aria-modal="true"
         aria-labelledby="modalTitle">
        <div class="modal">
            <div class="modal-header">
                <h2 id="modalTitle">Add Calendar Event</h2>

                <button class="modal-close"
                        id="closeModalButton"
                        type="button"
                        aria-label="Close modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form class="modal-form" id="eventForm">
                <div class="form-group">
                    <label for="eventTitle">Event Title *</label>
                    <input id="eventTitle"
                           name="title"
                           type="text"
                           maxlength="100"
                           placeholder="e.g. Project Meeting"
                           required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="eventDate">Date *</label>
                        <input id="eventDate" name="date" type="date" required>
                    </div>

                    <div class="form-group">
                        <label for="eventTime">Time</label>
                        <input id="eventTime" name="time" type="time">
                    </div>
                </div>

                <div class="form-group">
                    <label for="eventType">Event Type</label>
                    <select id="eventType" name="type">
                        <option value="meeting">Meeting</option>
                        <option value="deadline">Deadline</option>
                        <option value="site">Site Visit</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="eventDescription">Description</label>
                    <textarea id="eventDescription"
                              name="description"
                              maxlength="500"
                              placeholder="Add event details (optional)"></textarea>
                </div>

                <div class="modal-actions">
                    <button class="secondary-button"
                            id="cancelEventButton"
                            type="button">
                        Cancel
                    </button>

                    <button class="primary-button" type="submit">
                        <i class="fa-solid fa-check"></i>
                        Save Event
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* SIDEBAR CONTROLS */
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const hamburger = document.getElementById('hamburger');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const eventModal = document.getElementById('eventModal');

        function isMobile() {
            return window.innerWidth <= 768;
        }

        function closeMobileSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');

            if (!eventModal.classList.contains('show')) {
                document.body.style.overflow = '';
            }
        }

        function openMobileSidebar() {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function updateSidebarMode() {
            if (isMobile()) {
                document.body.classList.remove('sidebar-collapsed');
                closeMobileSidebar();
            } else {
                closeMobileSidebar();
            }
        }

        sidebarToggle.addEventListener('click', function () {
            if (isMobile()) return;

            document.body.classList.toggle('sidebar-collapsed');

            const collapsed = document.body.classList.contains('sidebar-collapsed');
            const icon = sidebarToggle.querySelector('i');

            icon.className = collapsed
                ? 'fa-solid fa-angles-right'
                : 'fa-solid fa-angles-left';

            sidebarToggle.setAttribute(
                'aria-label',
                collapsed ? 'Expand sidebar' : 'Collapse sidebar'
            );

            sidebarToggle.title = collapsed ? 'Expand sidebar' : 'Collapse sidebar';
        });

        hamburger.addEventListener('click', openMobileSidebar);
        sidebarOverlay.addEventListener('click', closeMobileSidebar);

        sidebar.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (isMobile()) closeMobileSidebar();
            });
        });

        window.addEventListener('resize', updateSidebarMode);

        /* CALENDAR DATA
           Events are currently stored in this browser's localStorage.
           They are not saved to the Laravel/MySQL database yet.
        */
        const STORAGE_KEY = 'projectManagerCalendarEvents';

        let events = [];

        try {
            const savedEvents = localStorage.getItem(STORAGE_KEY);
            const parsedEvents = savedEvents ? JSON.parse(savedEvents) : [];

            events = Array.isArray(parsedEvents)
                ? parsedEvents.filter(function (event) {
                    return event &&
                        typeof event.id === 'string' &&
                        typeof event.title === 'string' &&
                        /^\d{4}-\d{2}-\d{2}$/.test(event.date);
                })
                : [];
        } catch (error) {
            events = [];
        }

        const now = new Date();

        let displayedYear = now.getFullYear();
        let displayedMonth = now.getMonth();

        let selectedDate = formatDate(now);

        const monthTitle = document.getElementById('monthTitle');
        const calendarGrid = document.getElementById('calendarGrid');
        const selectedDateLabel = document.getElementById('selectedDateLabel');
        const selectedDateEvents = document.getElementById('selectedDateEvents');
        const upcomingEvents = document.getElementById('upcomingEvents');

        const monthEventCount = document.getElementById('monthEventCount');
        const upcomingEventCount = document.getElementById('upcomingEventCount');
        const todayEventCount = document.getElementById('todayEventCount');

        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');

            return `${year}-${month}-${day}`;
        }

        function parseDate(dateString) {
            const parts = dateString.split('-').map(Number);
            return new Date(parts[0], parts[1] - 1, parts[2]);
        }

        function formatLongDate(dateString) {
            return parseDate(dateString).toLocaleDateString('en-US', {
                weekday: 'long',
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
        }

        function escapeHTML(value) {
            return String(value).replace(/[&<>"']/g, function (character) {
                const replacements = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };

                return replacements[character];
            });
        }

        function saveEvents() {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(events));
            } catch (error) {
                alert('The browser could not save your events. Check your browser storage settings.');
            }
        }

        function getEventsForDate(dateString) {
            return events
                .filter(event => event.date === dateString)
                .sort((a, b) => (a.time || '99:99').localeCompare(b.time || '99:99'));
        }

        function getSortedEvents() {
            return [...events].sort(function (a, b) {
                const first = `${a.date} ${a.time || '99:99'}`;
                const second = `${b.date} ${b.time || '99:99'}`;

                return first.localeCompare(second);
            });
        }

        function formatTime(time) {
            if (!time) return 'Time not set';

            const parts = time.split(':');
            const hour = Number(parts[0]);
            const minute = parts[1];

            const date = new Date();
            date.setHours(hour, Number(minute), 0, 0);

            return date.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit'
            });
        }

        function getTypeLabel(type) {
            const labels = {
                meeting: 'Meeting',
                deadline: 'Deadline',
                site: 'Site Visit',
                other: 'Other'
            };

            return labels[type] || 'Other';
        }

        function renderCalendar() {
            const firstDay = new Date(displayedYear, displayedMonth, 1);
            const lastDay = new Date(displayedYear, displayedMonth + 1, 0);

            monthTitle.textContent = firstDay.toLocaleDateString('en-US', {
                month: 'long',
                year: 'numeric'
            });

            calendarGrid.innerHTML = '';

            const startDay = firstDay.getDay();
            const totalCells = Math.ceil((startDay + lastDay.getDate()) / 7) * 7;

            for (let cell = 0; cell < totalCells; cell++) {
                const dayDate = new Date(
                    displayedYear,
                    displayedMonth,
                    cell - startDay + 1
                );

                const dateString = formatDate(dayDate);
                const dayEvents = getEventsForDate(dateString);

                const dayButton = document.createElement('button');
                dayButton.type = 'button';
                dayButton.className = 'calendar-day';

                if (dayDate.getMonth() !== displayedMonth) {
                    dayButton.classList.add('other-month');
                }

                if (dateString === formatDate(new Date())) {
                    dayButton.classList.add('today');
                }

                if (dateString === selectedDate) {
                    dayButton.classList.add('selected');
                }

                dayButton.setAttribute(
                    'aria-label',
                    `${formatLongDate(dateString)}, ${dayEvents.length} events`
                );

                const dayNumber = document.createElement('span');
                dayNumber.className = 'day-number';
                dayNumber.textContent = dayDate.getDate();

                const markers = document.createElement('span');
                markers.className = 'event-markers';

                dayEvents.slice(0, 4).forEach(function (event) {
                    const dot = document.createElement('span');
                    dot.className = `event-dot ${event.type || 'other'}`;
                    dot.setAttribute('aria-hidden', 'true');
                    markers.appendChild(dot);
                });

                dayButton.appendChild(dayNumber);
                dayButton.appendChild(markers);

                dayButton.addEventListener('click', function () {
                    selectedDate = dateString;
                    displayedYear = dayDate.getFullYear();
                    displayedMonth = dayDate.getMonth();
                    renderAll();
                });

                calendarGrid.appendChild(dayButton);
            }
        }

        function renderSelectedDateEvents() {
            selectedDateLabel.textContent = formatLongDate(selectedDate);

            const dayEvents = getEventsForDate(selectedDate);
            selectedDateEvents.innerHTML = '';

            if (dayEvents.length === 0) {
                selectedDateEvents.innerHTML = `
                    <div class="empty-state">
                        <i class="fa-regular fa-calendar"></i>
                        No events scheduled for this date.
                    </div>
                `;
                return;
            }

            dayEvents.forEach(function (event) {
                const item = document.createElement('div');
                item.className = 'event-item';

                const stripe = document.createElement('span');
                stripe.className = `event-stripe ${event.type || 'other'}`;

                const details = document.createElement('div');
                details.className = 'event-details';

                const title = document.createElement('p');
                title.className = 'event-title';
                title.textContent = event.title;

                const meta = document.createElement('p');
                meta.className = 'event-meta';
                meta.textContent = `${formatTime(event.time)} · ${getTypeLabel(event.type)}`;

                details.appendChild(title);
                details.appendChild(meta);

                if (event.description) {
                    const description = document.createElement('p');
                    description.className = 'event-meta';
                    description.style.marginTop = '5px';
                    description.textContent = event.description;
                    details.appendChild(description);
                }

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'delete-event';
                deleteButton.setAttribute('aria-label', `Delete ${event.title}`);
                deleteButton.title = 'Delete event';
                deleteButton.innerHTML = '<i class="fa-regular fa-trash-can"></i>';

                deleteButton.addEventListener('click', function () {
                    if (!confirm(`Delete "${event.title}"?`)) return;

                    events = events.filter(item => item.id !== event.id);
                    saveEvents();
                    renderAll();
                });

                item.appendChild(stripe);
                item.appendChild(details);
                item.appendChild(deleteButton);

                selectedDateEvents.appendChild(item);
            });
        }

        function renderUpcomingEvents() {
            const today = formatDate(new Date());

            const upcoming = getSortedEvents()
                .filter(event => event.date >= today)
                .slice(0, 5);

            upcomingEvents.innerHTML = '';

            if (upcoming.length === 0) {
                upcomingEvents.innerHTML = `
                    <div class="empty-state">
                        <i class="fa-regular fa-calendar-check"></i>
                        No upcoming events yet.
                    </div>
                `;
                return;
            }

            upcoming.forEach(function (event) {
                const date = parseDate(event.date);

                const item = document.createElement('div');
                item.className = 'upcoming-item';

                const dateBox = document.createElement('div');
                dateBox.className = 'upcoming-date';

                const month = document.createElement('span');
                month.className = 'month';
                month.textContent = date.toLocaleDateString('en-US', {
                    month: 'short'
                });

                const day = document.createElement('span');
                day.className = 'day';
                day.textContent = date.getDate();

                dateBox.appendChild(month);
                dateBox.appendChild(day);

                const info = document.createElement('div');
                info.className = 'upcoming-info';

                const title = document.createElement('h3');
                title.textContent = event.title;

                const time = document.createElement('p');
                time.textContent = event.time
                    ? formatTime(event.time)
                    : getTypeLabel(event.type);

                info.appendChild(title);
                info.appendChild(time);

                item.appendChild(dateBox);
                item.appendChild(info);

                item.addEventListener('click', function () {
                    selectedDate = event.date;
                    const eventDate = parseDate(event.date);
                    displayedYear = eventDate.getFullYear();
                    displayedMonth = eventDate.getMonth();
                    renderAll();
                });

                upcomingEvents.appendChild(item);
            });
        }

        function renderSummary() {
            monthEventCount.textContent = events.filter(function (event) {
                const date = parseDate(event.date);

                return date.getFullYear() === displayedYear &&
                    date.getMonth() === displayedMonth;
            }).length;

            const today = formatDate(new Date());

            upcomingEventCount.textContent = events.filter(function (event) {
                return event.date >= today;
            }).length;

            todayEventCount.textContent = getEventsForDate(today).length;
        }

        function renderAll() {
            renderCalendar();
            renderSelectedDateEvents();
            renderUpcomingEvents();
            renderSummary();
        }

        /* MONTH NAVIGATION */
        document.getElementById('previousMonth').addEventListener('click', function () {
            displayedMonth--;

            if (displayedMonth < 0) {
                displayedMonth = 11;
                displayedYear--;
            }

            renderAll();
        });

        document.getElementById('nextMonth').addEventListener('click', function () {
            displayedMonth++;

            if (displayedMonth > 11) {
                displayedMonth = 0;
                displayedYear++;
            }

            renderAll();
        });

        document.getElementById('todayButton').addEventListener('click', function () {
            const today = new Date();

            displayedYear = today.getFullYear();
            displayedMonth = today.getMonth();
            selectedDate = formatDate(today);

            renderAll();
        });

        /* EVENT MODAL */
        const eventForm = document.getElementById('eventForm');

        function openEventModal() {
            eventModal.classList.add('show');
            document.body.style.overflow = 'hidden';

            document.getElementById('eventDate').value = selectedDate;
            document.getElementById('eventTitle').focus();
        }

        function closeEventModal() {
            eventModal.classList.remove('show');

            if (!sidebar.classList.contains('open')) {
                document.body.style.overflow = '';
            }
        }

        document.getElementById('addEventButton')
            .addEventListener('click', openEventModal);

        document.getElementById('closeModalButton')
            .addEventListener('click', closeEventModal);

        document.getElementById('cancelEventButton')
            .addEventListener('click', closeEventModal);

        eventModal.addEventListener('click', function (event) {
            if (event.target === eventModal) {
                closeEventModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeMobileSidebar();
                closeEventModal();
            }
        });

        eventForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const title = document.getElementById('eventTitle').value.trim();
            const date = document.getElementById('eventDate').value;
            const time = document.getElementById('eventTime').value;
            const type = document.getElementById('eventType').value;
            const description = document.getElementById('eventDescription').value.trim();

            if (!title || !date) {
                alert('Please enter an event title and date.');
                return;
            }

            events.push({
                id: `${Date.now()}-${Math.random().toString(36).slice(2, 9)}`,
                title: title,
                date: date,
                time: time,
                type: type,
                description: description
            });

            saveEvents();

            selectedDate = date;

            const eventDate = parseDate(date);
            displayedYear = eventDate.getFullYear();
            displayedMonth = eventDate.getMonth();

            renderAll();
            eventForm.reset();
            closeEventModal();
        });

        /* INITIALIZE */
        updateSidebarMode();
        renderAll();
    </script>
</body>
</html>
