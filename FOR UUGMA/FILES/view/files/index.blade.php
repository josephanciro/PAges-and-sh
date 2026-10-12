
@extends('layouts.app')

@section('title', 'Project Manager - Files')

@push('styles')
    @vite(['resources/css/files/index.css'])
@endpush

@push('scripts')
    @vite(['resources/js/files/index.js'])
@endpush

@section('content')
<div class="files-page">
    <div class="files-header">
        <div>
            <h1>Files</h1>
            <p>Manage and organize your project documents.</p>
        </div>

        <label class="files-upload-button" for="fileUpload">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            Upload Files
        </label>
        <input type="file" id="fileUpload" multiple hidden>
    </div>

    <div class="files-summary">
        <article class="files-summary-card">
            <div class="files-summary-icon">
                <i class="fa-solid fa-folder"></i>
            </div>
            <div>
                <p>Total Files</p>
                <h2 id="totalFiles">5</h2>
            </div>
        </article>

        <article class="files-summary-card">
            <div class="files-summary-icon files-icon-pdf">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div>
                <p>PDF Documents</p>
                <h2 id="totalPdfs">2</h2>
            </div>
        </article>

        <article class="files-summary-card">
            <div class="files-summary-icon files-icon-image">
                <i class="fa-solid fa-file-image"></i>
            </div>
            <div>
                <p>Images</p>
                <h2 id="totalImages">1</h2>
            </div>
        </article>

        <article class="files-summary-card">
            <div class="files-summary-icon files-icon-document">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div>
                <p>Other Files</p>
                <h2 id="totalOther">2</h2>
            </div>
        </article>
    </div>

    <section class="files-panel">
        <div class="files-panel-header">
            <div>
                <h2>Project Documents</h2>
                <p>Browse and search your available files.</p>
            </div>

            <div class="files-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="fileSearch"
                    placeholder="Search files..."
                    aria-label="Search files"
                >
            </div>
        </div>

        <div class="files-toolbar">
            <div class="files-filters" role="group" aria-label="Filter files by type">
                <button type="button" class="active" data-filter="all" aria-pressed="true">
                    All Files
                </button>
                <button type="button" data-filter="pdf" aria-pressed="false">
                    PDF
                </button>
                <button type="button" data-filter="image" aria-pressed="false">
                    Images
                </button>
                <button type="button" data-filter="document" aria-pressed="false">
                    Documents
                </button>
                <button type="button" data-filter="other" aria-pressed="false">
                    Other
                </button>
            </div>
        </div>

        <div class="files-table-wrapper">
            <table class="files-table">
                <thead>
                    <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">Project</th>
                        <th scope="col">File Size</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody id="filesTableBody">
                    <tr data-type="pdf">
                        <td>
                            <div class="files-name">
                                <span class="files-file-icon file-icon-pdf">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </span>
                                <strong>Project Proposal.pdf</strong>
                            </div>
                        </td>
                        <td>Bridge Construction</td>
                        <td>2.4 MB</td>
                        <td>Oct 02, 2026</td>
                        <td><span class="files-type">PDF</span></td>
                        <td>
                            <button type="button" class="files-action" disabled
                                aria-label="Download Project Proposal.pdf"
                                title="Sample file has no stored content">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </td>
                    </tr>

                    <tr data-type="document">
                        <td>
                            <div class="files-name">
                                <span class="files-file-icon file-icon-document">
                                    <i class="fa-solid fa-file-word"></i>
                                </span>
                                <strong>Project Requirements.docx</strong>
                            </div>
                        </td>
                        <td>Road Improvement</td>
                        <td>856 KB</td>
                        <td>Oct 04, 2026</td>
                        <td><span class="files-type">Document</span></td>
                        <td>
                            <button type="button" class="files-action" disabled
                                aria-label="Download Project Requirements.docx"
                                title="Sample file has no stored content">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </td>
                    </tr>

                    <tr data-type="image">
                        <td>
                            <div class="files-name">
                                <span class="files-file-icon file-icon-image">
                                    <i class="fa-solid fa-file-image"></i>
                                </span>
                                <strong>Site Inspection.jpg</strong>
                            </div>
                        </td>
                        <td>Building Renovation</td>
                        <td>4.1 MB</td>
                        <td>Oct 06, 2026</td>
                        <td><span class="files-type">Image</span></td>
                        <td>
                            <button type="button" class="files-action" disabled
                                aria-label="Download Site Inspection.jpg"
                                title="Sample file has no stored content">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </td>
                    </tr>

                    <tr data-type="pdf">
                        <td>
                            <div class="files-name">
                                <span class="files-file-icon file-icon-pdf">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </span>
                                <strong>Safety Guidelines.pdf</strong>
                            </div>
                        </td>
                        <td>Bridge Construction</td>
                        <td>1.2 MB</td>
                        <td>Oct 08, 2026</td>
                        <td><span class="files-type">PDF</span></td>
                        <td>
                            <button type="button" class="files-action" disabled
                                aria-label="Download Safety Guidelines.pdf"
                                title="Sample file has no stored content">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </td>
                    </tr>

                    <tr data-type="other">
                        <td>
                            <div class="files-name">
                                <span class="files-file-icon file-icon-other">
                                    <i class="fa-solid fa-file-zipper"></i>
                                </span>
                                <strong>Project Resources.zip</strong>
                            </div>
                        </td>
                        <td>Road Improvement</td>
                        <td>8.7 MB</td>
                        <td>Oct 10, 2026</td>
                        <td><span class="files-type">Archive</span></td>
                        <td>
                            <button type="button" class="files-action" disabled
                                aria-label="Download Project Resources.zip"
                                title="Sample file has no stored content">
                                <i class="fa-solid fa-download"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="files-empty" id="filesEmpty" hidden>
                <i class="fa-solid fa-folder-open"></i>
                <p>No files found.</p>
            </div>
        </div>

        <div class="files-footer">
            <span id="filesCount">Showing 5 files</span>
        </div>
    </section>
</div>
@endsection
