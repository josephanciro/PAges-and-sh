 
 
 
 
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

            <a href="{{ url('/dashboard') }}" class="sidebar-logo">
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

            <a href="{{ url('/dashboard.blade.php') }}">
                <i class="menu-icon fa-solid fa-gauge-high" aria-hidden="true"></i>
                <span class="sidebar-label">Dashboard</span>
            </a>

            <a href="{{ url('/projects.blade.php') }}" aria-current="page">
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

            

                <a href="/settings.blade.php">
                    <i class="menu-icon fa-solid fa-gear" aria-hidden="true"></i>
                    <span class="sidebar-label">Settings</span>
                </a>

                <a href="/">
                    <i class="menu-icon fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    <span class="sidebar-label">Log out</span>
                </a>

            

            

        </nav>

        

    </aside>