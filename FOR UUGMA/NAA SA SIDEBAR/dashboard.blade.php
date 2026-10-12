
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Dashboard</title>

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

        button, a { -webkit-tap-highlight-color: transparent; }

        button:focus-visible, a:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 3px;
        }

        button { font: inherit; }

        @keyframes pageFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes contentFadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes overlayFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes progressFadeIn {
            from { opacity: 0; transform: scaleX(.7); }
            to { opacity: 1; transform: scaleX(1); }
        }

        
        /* DASHBOARD WELCOME */

        .welcome {
            margin-bottom: 30px;
            animation: contentFadeIn .65s ease-out .1s both;
        }

        .welcome h1 {
            margin-bottom: 8px;
            font-size: 38px;
            font-weight: 400;
            letter-spacing: -1.5px;
        }

        .welcome p {
            color: var(--secondary);
            font-size: 13px;
        }

        /* STATISTICS */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            animation: contentFadeIn .6s ease-out both;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .stat-card:nth-child(1) { animation-delay: .15s; }
        .stat-card:nth-child(2) { animation-delay: .25s; }
        .stat-card:nth-child(3) { animation-delay: .35s; }

        .stat-card:hover {
            box-shadow: 0 5px 15px rgba(18, 63, 58, .07);
            transform: translateY(-3px);
        }

        .stat-label {
            margin-bottom: 12px;
            color: var(--secondary);
            font-size: 11px;
        }

        .stat-number {
            color: var(--primary);
            font-size: 32px;
            font-weight: 400;
        }

        .stat-small {
            margin-top: 5px;
            color: var(--secondary);
            font-size: 10px;
        }

        /* DASHBOARD CONTENT GRID */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 20px;
        }

        .card {
            min-width: 0;
            padding: 24px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            transition: box-shadow .25s ease, border-color .25s ease;
            animation: contentFadeIn .65s ease-out .3s both;
        }

        .content-grid > div:last-child > .card:first-child {
            animation-delay: .4s;
        }

        .content-grid > div:last-child > .card:last-child {
            animation-delay: .5s;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        .card-header h2 {
            font-size: 16px;
            font-weight: 500;
        }

        .view-all {
            flex-shrink: 0;
            color: #66813C;
            font-size: 10px;
            font-weight: bold;
            text-decoration: none;
        }

        .view-all:hover { color: var(--primary); }

        /* ACTIVE PROJECTS */

        .project {
            padding: 17px 0;
            border-top: 1px solid #ECECE6;
        }

        .project:first-of-type {
            padding-top: 0;
            border-top: none;
        }

        .project-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 7px;
        }

        .project-name {
            font-size: 13px;
            font-weight: bold;
        }

        .status {
            padding: 5px 8px;
            border-radius: 5px;
            color: #66813C;
            background: var(--light-green);
            font-size: 9px;
            font-weight: bold;
            white-space: nowrap;
        }

        .project-type {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            overflow: hidden;
            border-radius: 10px;
            background: #E8E9E2;
        }

        .progress {
            height: 100%;
            border-radius: 10px;
            background: var(--primary);
            animation: progressFadeIn 1s ease-out both;
            transform-origin: left;
        }

        .project-bottom {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 8px;
            color: var(--muted);
            font-size: 9px;
        }

        /* UPCOMING TASKS */

        .task {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-top: 1px solid #ECECE6;
        }

        .task:first-of-type {
            padding-top: 0;
            border-top: none;
        }

        .task-icon {
            display: flex;
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: #66813C;
            background: var(--light-green);
            font-size: 12px;
        }

        .task-info { min-width: 0; flex: 1; }

        .task-name {
            margin-bottom: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .task-date {
            color: var(--muted);
            font-size: 9px;
        }

        /* RECENT ACTIVITY */

        .activity { margin-top: 20px; }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 13px 0;
            border-top: 1px solid #ECECE6;
        }

        .activity-dot {
            width: 7px;
            height: 7px;
            margin-top: 4px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--accent);
        }

        .activity-text {
            color: #536865;
            font-size: 10px;
            line-height: 1.5;
        }

        .activity-time {
            margin-top: 3px;
            color: #9AA39F;
            font-size: 8px;
        }

        /* TABLET */

        @media (max-width: 1000px) {
            .main { padding: 30px; }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* MOBILE */

        @media (max-width: 768px) {
            body { display: block; }

            

            .main {
                width: 100%;
                margin-left: 0;
                padding: 25px 20px;
            }

            

            .stats { grid-template-columns: 1fr; }
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 500px) {
            .welcome h1 { font-size: 30px; }
            .user-area { gap: 10px; }
            .user { gap: 7px; }

            .project-top, .project-bottom { gap: 10px; }
            .project-name { line-height: 1.5; }
            .card { padding: 19px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-delay: 0ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
    @include('layouts.app')

    <!-- MAIN CONTENT -->
    <main class="main">


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

        <!-- DASHBOARD CONTENT -->
        <section class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h2>Active Projects</h2>
                    <a href="/projects" class="view-all">View all →</a>
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

            <div>
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
                            <div class="task-date">Oct 14, 2026</div>
                        </div>
                    </div>
                </div>

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

 
</body>
</html>
