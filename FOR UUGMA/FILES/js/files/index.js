
document.addEventListener('DOMContentLoaded', () => {
    const page = document.querySelector('.files-page');

    if (!page) {
        return;
    }

    const searchInput = document.getElementById('fileSearch');
    const uploadInput = document.getElementById('fileUpload');
    const tableBody = document.getElementById('filesTableBody');
    const filterButtons = document.querySelectorAll('.files-filters button');
    const emptyState = document.getElementById('filesEmpty');
    const filesCount = document.getElementById('filesCount');

    let activeFilter = 'all';

    function getFileCategory(fileName, mimeType = '') {
        const extension = fileName.split('.').pop().toLowerCase();

        if (extension === 'pdf' || mimeType === 'application/pdf') {
            return 'pdf';
        }

        if (
            mimeType.startsWith('image/') ||
            ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(extension)
        ) {
            return 'image';
        }

        if (
            [
                'doc', 'docx', 'txt', 'rtf', 'odt',
                'xls', 'xlsx', 'csv', 'ppt', 'pptx'
            ].includes(extension)
        ) {
            return 'document';
        }

        return 'other';
    }

    function formatFileSize(bytes) {
        if (bytes < 1024) {
            return `${bytes} B`;
        }

        if (bytes < 1024 * 1024) {
            return `${(bytes / 1024).toFixed(1)} KB`;
        }

        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    }

    function formatDate(date) {
        return date.toLocaleDateString('en-US', {
            month: 'short',
            day: '2-digit',
            year: 'numeric'
        });
    }

    function getFileIcon(category, fileName) {
        const extension = fileName.split('.').pop().toLowerCase();

        if (category === 'pdf') {
            return ['fa-solid', 'fa-file-pdf', 'file-icon-pdf'];
        }

        if (category === 'image') {
            return ['fa-solid', 'fa-file-image', 'file-icon-image'];
        }

        if (category === 'document') {
            if (['doc', 'docx'].includes(extension)) {
                return ['fa-solid', 'fa-file-word', 'file-icon-document'];
            }

            if (['xls', 'xlsx', 'csv'].includes(extension)) {
                return ['fa-solid', 'fa-file-excel', 'file-icon-document'];
            }

            if (['ppt', 'pptx'].includes(extension)) {
                return ['fa-solid', 'fa-file-powerpoint', 'file-icon-document'];
            }

            return ['fa-solid', 'fa-file-lines', 'file-icon-document'];
        }

        return ['fa-solid', 'fa-file-zipper', 'file-icon-other'];
    }

    function updateSummary() {
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        const pdfs = rows.filter(row => row.dataset.type === 'pdf').length;
        const images = rows.filter(row => row.dataset.type === 'image').length;

        document.getElementById('totalFiles').textContent = rows.length;
        document.getElementById('totalPdfs').textContent = pdfs;
        document.getElementById('totalImages').textContent = images;
        document.getElementById('totalOther').textContent =
            rows.length - pdfs - images;
    }

    function filterFiles() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        let visibleCount = 0;

        rows.forEach(row => {
            const matchesSearch = row.textContent.toLowerCase().includes(searchTerm);
            const matchesType =
                activeFilter === 'all' || row.dataset.type === activeFilter;
            const visible = matchesSearch && matchesType;

            row.hidden = !visible;

            if (visible) {
                visibleCount++;
            }
        });

        emptyState.hidden = visibleCount !== 0;

        filesCount.textContent =
            `Showing ${visibleCount} ${visibleCount === 1 ? 'file' : 'files'}`;
    }

    function createFileRow(file) {
        const category = getFileCategory(file.name, file.type);
        const [iconPrefix, iconName, iconClass] =
            getFileIcon(category, file.name);

        const row = document.createElement('tr');
        row.dataset.type = category;
        row.dataset.downloadUrl = URL.createObjectURL(file);
        row.dataset.uploadedFile = 'true';

        const nameCell = document.createElement('td');
        const nameWrapper = document.createElement('div');
        nameWrapper.className = 'files-name';

        const iconWrapper = document.createElement('span');
        iconWrapper.className = `files-file-icon ${iconClass}`;

        const icon = document.createElement('i');
        icon.classList.add(iconPrefix, iconName);
        iconWrapper.appendChild(icon);

        const name = document.createElement('strong');
        name.textContent = file.name;

        nameWrapper.append(iconWrapper, name);
        nameCell.appendChild(nameWrapper);

        const projectCell = document.createElement('td');
        projectCell.textContent = 'Local upload';

        const sizeCell = document.createElement('td');
        sizeCell.textContent = formatFileSize(file.size);

        const dateCell = document.createElement('td');
        dateCell.textContent = formatDate(new Date());

        const typeCell = document.createElement('td');
        const typeLabel = document.createElement('span');
        typeLabel.className = 'files-type';

        const typeNames = {
            pdf: 'PDF',
            image: 'Image',
            document: 'Document',
            other: 'Other'
        };

        typeLabel.textContent = typeNames[category];
        typeCell.appendChild(typeLabel);

        const actionCell = document.createElement('td');
        const downloadButton = document.createElement('button');
        downloadButton.type = 'button';
        downloadButton.className = 'files-action';
        downloadButton.setAttribute('aria-label', `Download ${file.name}`);
        downloadButton.title = 'Download file';

        const downloadIcon = document.createElement('i');
        downloadIcon.className = 'fa-solid fa-download';

        downloadButton.appendChild(downloadIcon);
        actionCell.appendChild(downloadButton);

        row.append(
            nameCell,
            projectCell,
            sizeCell,
            dateCell,
            typeCell,
            actionCell
        );

        return row;
    }

    searchInput.addEventListener('input', filterFiles);

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            activeFilter = button.dataset.filter;

            filterButtons.forEach(filterButton => {
                const active = filterButton === button;

                filterButton.classList.toggle('active', active);
                filterButton.setAttribute('aria-pressed', String(active));
            });

            filterFiles();
        });
    });

    uploadInput.addEventListener('change', () => {
        const selectedFiles = Array.from(uploadInput.files || []);

        selectedFiles.forEach(file => {
            tableBody.prepend(createFileRow(file));
        });

        uploadInput.value = '';

        updateSummary();
        filterFiles();
    });

    tableBody.addEventListener('click', event => {
        const button = event.target.closest('.files-action');

        if (!button || button.disabled) {
            return;
        }

        const row = button.closest('tr');
        const downloadUrl = row.dataset.downloadUrl;

        if (!downloadUrl) {
            return;
        }

        const link = document.createElement('a');
        link.href = downloadUrl;
        link.download = row.querySelector('.files-name strong').textContent;

        document.body.appendChild(link);
        link.click();
        link.remove();
    });

    updateSummary();
    filterFiles();
});
