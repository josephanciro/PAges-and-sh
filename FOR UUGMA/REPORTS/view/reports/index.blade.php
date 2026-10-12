
@extends('layouts.app')

@section('title', 'Reports | Civika')
@section('main-class', 'reports-main')

@push('styles')
    @vite(['resources/css/reports/index.css'])
@endpush

@section('content')
<div class="reports-page">
    <header class="reports-heading">
        <div>
            <p class="reports-eyebrow">WORKSPACE</p>
            <h1>Reports</h1>
            <p class="reports-subtitle">Review project progress, task completion, and workspace activity.</p>
        </div>

        <button type="button" class="reports-button reports-button-primary" id="exportReport">
            <i class="fa-solid fa-download"></i>
            Export CSV
        </button>
    </header>

    <section class="reports-overview" aria-label="Report overview">
        <article class="reports-stat-card">
            <div class="reports-stat-icon">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <p>Total Projects</p>
                <h2 id="totalProjects">4</h2>
                <span>Across all project statuses</span>
            </div>
        </article>

        <article class="reports-stat-card">
            <div class="reports-stat-icon reports-stat-icon-lime">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div>
                <p>Completed Tasks</p>
                <h2 id="completedTasks">18</h2>
                <span>Tasks marked completed</span>
            </div>
        </article>

        <article class="reports-stat-card">
            <div class="reports-stat-icon reports-stat-icon-blue">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <p>In Progress</p>
                <h2 id="activeProjects">2</h2>
                <span>Projects currently underway</span>
            </div>
        </article>

        <article class="reports-stat-card">
            <div class="reports-stat-icon reports-stat-icon-orange">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <p>Pending Tasks</p>
                <h2 id="pendingTasks">7</h2>
                <span>Tasks awaiting completion</span>
            </div>
        </article>
    </section>

    <section class="reports-panel">
        <div class="reports-panel-heading">
            <div>
                <h2>Project Reports</h2>
                <p>View and filter the available project reports.</p>
            </div>

            <div class="reports-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="reportSearch"
                    placeholder="Search reports..."
                    aria-label="Search reports"
                >
            </div>
        </div>

        <div class="reports-filters">
            <div class="reports-filter-group">
                <label for="reportType">Report type</label>
                <select id="reportType">
                    <option value="all">All types</option>
                    <option value="project">Project</option>
                    <option value="task">Task</option>
                    <option value="team">Team</option>
                </select>
            </div>

            <div class="reports-filter-group">
                <label for="reportStatus">Status</label>
                <select id="reportStatus">
                    <option value="all">All statuses</option>
                    <option value="completed">Completed</option>
                    <option value="in-progress">In Progress</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <button type="button" class="reports-button reports-button-secondary" id="resetFilters">
                <i class="fa-solid fa-rotate-left"></i>
                Reset filters
            </button>
        </div>

        <div class="reports-table-wrapper">
            <table class="reports-table">
                <thead>
                    <tr>
                        <th scope="col">Report name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date created</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>

                <tbody id="reportsTableBody">
                    <tr data-type="project" data-status="in-progress">
                        <td>
                            <div class="reports-name">
                                <span class="reports-file-icon">
                                    <i class="fa-solid fa-chart-line"></i>
                                </span>
                                <strong>Project Progress Report</strong>
                            </div>
                        </td>
                        <td><span class="reports-type">Project</span></td>
                        <td>2026-10-01</td>
                        <td><span class="reports-status status-in-progress">In Progress</span></td>
                        <td>Overview of ongoing project progress.</td>
                    </tr>

                    <tr data-type="task" data-status="completed">
                        <td>
                            <div class="reports-name">
                                <span class="reports-file-icon">
                                    <i class="fa-solid fa-list-check"></i>
                                </span>
                                <strong>Task Completion Report</strong>
                            </div>
                        </td>
                        <td><span class="reports-type">Task</span></td>
                        <td>2026-10-03</td>
                        <td><span class="reports-status status-completed">Completed</span></td>
                        <td>Summary of completed tasks.</td>
                    </tr>

                    <tr data-type="team" data-status="completed">
                        <td>
                            <div class="reports-name">
                                <span class="reports-file-icon">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <strong>Team Activity Report</strong>
                            </div>
                        </td>
                        <td><span class="reports-type">Team</span></td>
                        <td>2026-10-05</td>
                        <td><span class="reports-status status-completed">Completed</span></td>
                        <td>Overview of team participation.</td>
                    </tr>

                    <tr data-type="project" data-status="pending">
                        <td>
                            <div class="reports-name">
                                <span class="reports-file-icon">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </span>
                                <strong>Project Schedule Report</strong>
                            </div>
                        </td>
                        <td><span class="reports-type">Project</span></td>
                        <td>2026-10-08</td>
                        <td><span class="reports-status status-pending">Pending</span></td>
                        <td>Summary of project schedules and deadlines.</td>
                    </tr>

                    <tr data-type="task" data-status="in-progress">
                        <td>
                            <div class="reports-name">
                                <span class="reports-file-icon">
                                    <i class="fa-solid fa-bars-progress"></i>
                                </span>
                                <strong>Task Status Report</strong>
                            </div>
                        </td>
                        <td><span class="reports-type">Task</span></td>
                        <td>2026-10-10</td>
                        <td><span class="reports-status status-in-progress">In Progress</span></td>
                        <td>Overview of current task statuses.</td>
                    </tr>
                </tbody>
            </table>

            <div class="reports-empty" id="reportsEmpty" hidden>
                <i class="fa-solid fa-file-circle-xmark"></i>
                <p>No reports match your filters.</p>
            </div>
        </div>

        <footer class="reports-table-footer">
            <span id="reportsCount">Showing 5 reports</span>
        </footer>
    </section>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/reports/index.js'])
@endpush
