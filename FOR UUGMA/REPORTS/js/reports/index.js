
document.addEventListener('DOMContentLoaded', () => {
    const page = document.querySelector('.reports-page');

    if (!page) {
        return;
    }

    const searchInput = document.getElementById('reportSearch');
    const typeFilter = document.getElementById('reportType');
    const statusFilter = document.getElementById('reportStatus');
    const resetButton = document.getElementById('resetFilters');
    const exportButton = document.getElementById('exportReport');
    const tableBody = document.getElementById('reportsTableBody');
    const emptyState = document.getElementById('reportsEmpty');
    const reportsCount = document.getElementById('reportsCount');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    function filterReports() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const selectedType = typeFilter.value;
        const selectedStatus = statusFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const matchesSearch = row.textContent.toLowerCase().includes(searchTerm);
            const matchesType =
                selectedType === 'all' || row.dataset.type === selectedType;
            const matchesStatus =
                selectedStatus === 'all' || row.dataset.status === selectedStatus;

            const visible = matchesSearch && matchesType && matchesStatus;

            row.hidden = !visible;

            if (visible) {
                visibleCount++;
            }
        });

        emptyState.hidden = visibleCount !== 0;

        reportsCount.textContent =
            `Showing ${visibleCount} ${visibleCount === 1 ? 'report' : 'reports'}`;
    }

    searchInput.addEventListener('input', filterReports);
    typeFilter.addEventListener('change', filterReports);
    statusFilter.addEventListener('change', filterReports);

    resetButton.addEventListener('click', () => {
        searchInput.value = '';
        typeFilter.value = 'all';
        statusFilter.value = 'all';

        filterReports();
    });

    exportButton.addEventListener('click', () => {
        const visibleRows = rows.filter(row => !row.hidden);

        if (visibleRows.length === 0) {
            return;
        }

        const headers = Array.from(
            page.querySelectorAll('.reports-table thead th')
        ).map(header => header.textContent.trim());

        const csvRows = [
            headers,
            ...visibleRows.map(row =>
                Array.from(row.querySelectorAll('td')).map(cell =>
                    cell.textContent.trim().replace(/\s+/g, ' ')
                )
            )
        ];

        const escapeCsvValue = value =>
            `"${String(value).replace(/"/g, '""')}"`;

        const csvContent = csvRows
            .map(row => row.map(escapeCsvValue).join(','))
            .join('\r\n');

        const blob = new Blob(
            ['\uFEFF' + csvContent],
            { type: 'text/csv;charset=utf-8;' }
        );

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = url;
        link.download = 'civika-reports.csv';

        document.body.appendChild(link);
        link.click();
        link.remove();

        URL.revokeObjectURL(url);
    });

    filterReports();
});
