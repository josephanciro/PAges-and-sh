
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager - Project Details</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite('resources/css/pro-details.css', 'resources/js/pro-details.js')
    <style>
        
    </style>
</head>

<body>

    @include('layouts.app')

    <!-- MAIN CONTENT -->

    

        <!-- PROJECT DETAILS PAGE CONTENT -->

        <div class="project-details-page">

            <a href="projects.blade.php" class="back-link">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                Back to Projects
            </a>

            <!-- PROJECT HEADER -->

            <div class="project-header">

                <div>
                    <h1>Riverside Bridge</h1>
                    <p>Bridge Construction</p>
                </div>

                <span class="status">IN PROGRESS</span>

            </div>

            <!-- DETAILS GRID -->

            <div class="details-grid">

                <!-- LEFT COLUMN -->

                <div class="details-column">

                    <!-- PROJECT DESCRIPTION -->

                    <section class="card">

                        <div class="card-header">
                            <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                            <h2>Project Description</h2>
                        </div>

                        <p class="project-description">
                            Construction and improvement of the Riverside
                            Bridge to improve transportation and public access.
                            The project includes structural improvements,
                            road connections, and safety improvements around
                            the bridge area.
                        </p>

                    </section>

                    <!-- PROJECT PROGRESS -->

                    <section class="card">

                        <div class="card-header">
                            <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                            <h2>Project Progress</h2>
                        </div>

                        <div class="progress-info">
                            <span>Overall Progress</span>
                            <strong>72%</strong>
                        </div>

                        <div
                            class="progress-bar"
                            role="progressbar"
                            aria-valuenow="72"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            aria-label="Overall project progress"
                        >
                            <div class="progress"></div>
                        </div>

                    </section>

                    <!-- PROJECT ACTION BUTTONS -->
                    <!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION --><!-- EDIT TO CHANGE LOCATION -->
                    <div class="action-buttons">

                        <a href="/pro-edit.blade.php" class="primary-btn">
                            <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            Edit Project
                        </a>

                        <a href="pro-timeline.blade.php" class="secondary-btn">
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                            View Timeline
                        </a>

                        <a href="pro-delete.blade.php" class="secondary-btn">
                            <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                            Delete Project
                        </a>

                    </div>

                </div>

                <!-- RIGHT COLUMN: PROJECT INFORMATION -->

                <section class="card">

                    <div class="card-header">
                        <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                        <h2>Project Information</h2>
                    </div>

                    <div class="info-list">

                        <div class="info-item">
                            <span class="info-label">Project Type</span>
                            <span class="info-value">Bridge Construction</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="info-value">In Progress</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Start Date</span>
                            <span class="info-value">Sep 01, 2026</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Expected End</span>
                            <span class="info-value">Oct 24, 2026</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Location</span>
                            <span class="info-value">Riverside Area</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Project Manager</span>
                            <span class="info-value">Jay</span>
                        </div>

                    </div>

                </section>

            </div>

        </div>

    </main>

    <!-- SHARED SIDEBAR JAVASCRIPT -->

    

</body>
</html>
