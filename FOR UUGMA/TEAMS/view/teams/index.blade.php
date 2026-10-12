
@extends('layouts.app')

@section('title', 'Project Manager - Teams')

@push('styles')
    @vite(['resources/css/teams/index.css'])
@endpush

@push('scripts')
    @vite(['resources/js/teams/index.js'])
@endpush

@section('content')
    @auth
        <div class="teams-page">
            <div class="teams-header">
                <div>
                    <h1>Teams</h1>
                    <p>Manage your team members and view their roles.</p>
                </div>

                <button class="teams-primary-button" type="button" id="inviteMemberButton">
                    <i class="fa-solid fa-user-plus"></i>
                    Invite Member
                </button>
            </div>

            <div class="teams-summary">
                <article class="teams-summary-card">
                    <div class="teams-summary-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <p>Total Members</p>
                        <h2 id="totalMembers">6</h2>
                    </div>
                </article>

                <article class="teams-summary-card">
                    <div class="teams-summary-icon teams-icon-admin">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <p>Administrators</p>
                        <h2 id="totalAdmins">2</h2>
                    </div>
                </article>

                <article class="teams-summary-card">
                    <div class="teams-summary-icon teams-icon-member">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <p>Team Members</p>
                        <h2 id="totalRegularMembers">4</h2>
                    </div>
                </article>
            </div>

            <section class="teams-panel">
                <div class="teams-panel-header">
                    <div>
                        <h2>Team Members</h2>
                        <p>View the people in your workspace.</p>
                    </div>

                    <div class="teams-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input
                            type="search"
                            id="teamSearch"
                            placeholder="Search members..."
                            aria-label="Search team members"
                        >
                    </div>
                </div>

                <div class="teams-filters" role="group" aria-label="Filter team members">
                    <button class="active" type="button" data-filter="all" aria-pressed="true">
                        All Members
                    </button>
                    <button type="button" data-filter="admin" aria-pressed="false">
                        Administrators
                    </button>
                    <button type="button" data-filter="member" aria-pressed="false">
                        Members
                    </button>
                </div>

                <div class="teams-table-wrapper">
                    <table class="teams-table">
                        <thead>
                            <tr>
                                <th scope="col">Member</th>
                                <th scope="col">Role</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="teamMembersTable">
                            <tr data-role="admin">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-green">JD</div>
                                        <div>
                                            <strong>John Davis</strong>
                                            <span>Workspace administrator</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-admin">Administrator</span></td>
                                <td>john.davis@example.com</td>
                                <td><span class="teams-status status-active"><span></span>Active</span></td>
                            </tr>

                            <tr data-role="member">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-yellow">SM</div>
                                        <div>
                                            <strong>Sarah Miller</strong>
                                            <span>Project coordinator</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-member">Member</span></td>
                                <td>sarah.miller@example.com</td>
                                <td><span class="teams-status status-active"><span></span>Active</span></td>
                            </tr>

                            <tr data-role="member">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-blue">MR</div>
                                        <div>
                                            <strong>Michael Reyes</strong>
                                            <span>Site supervisor</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-member">Member</span></td>
                                <td>michael.reyes@example.com</td>
                                <td><span class="teams-status status-active"><span></span>Active</span></td>
                            </tr>

                            <tr data-role="admin">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-purple">AC</div>
                                        <div>
                                            <strong>Anna Cruz</strong>
                                            <span>Project administrator</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-admin">Administrator</span></td>
                                <td>anna.cruz@example.com</td>
                                <td><span class="teams-status status-active"><span></span>Active</span></td>
                            </tr>

                            <tr data-role="member">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-orange">DL</div>
                                        <div>
                                            <strong>Daniel Lopez</strong>
                                            <span>Field engineer</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-member">Member</span></td>
                                <td>daniel.lopez@example.com</td>
                                <td><span class="teams-status status-pending"><span></span>Pending</span></td>
                            </tr>

                            <tr data-role="member">
                                <td>
                                    <div class="teams-member">
                                        <div class="teams-avatar avatar-pink">RT</div>
                                        <div>
                                            <strong>Rachel Torres</strong>
                                            <span>Documentation assistant</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="teams-role role-member">Member</span></td>
                                <td>rachel.torres@example.com</td>
                                <td><span class="teams-status status-active"><span></span>Active</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="teams-empty-state" id="teamsEmptyState" hidden>
                        <i class="fa-solid fa-users"></i>
                        <p>No team members found.</p>
                    </div>
                </div>

                <div class="teams-table-footer">
                    <span id="teamResultsCount">Showing 6 members</span>
                </div>
            </section>
        </div>
    @else
        @include('components.not_logged_in')
    @endauth
@endsection
