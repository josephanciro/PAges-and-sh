const sidebar = document.getElementById('sidebar');
        const hamburger = document.getElementById('hamburger');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const main = document.getElementById('main');

        hamburger.addEventListener('click', function () {
            sidebar.classList.toggle('mobile-open');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('show');
        });

        // Close mobile menu when a navigation link is selected
        sidebar.querySelectorAll('.menu a').forEach(function (link) {
            link.addEventListener('click', function () {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('show');
            });
        });

        // Date validation
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');

        startDate.addEventListener('change', function () {
            endDate.min = this.value;

            if (endDate.value && endDate.value < this.value) {
                endDate.value = '';
            }
        });

        endDate.addEventListener('change', function () {
            if (startDate.value && this.value < startDate.value) {
                alert('The expected end date cannot be earlier than the start date.');
                this.value = '';
            }
        });

        // Form validation
        document.getElementById('createProjectBtn').addEventListener('click', function () {
            const requiredFields = [
                document.getElementById('projectName'),
                document.getElementById('projectType'),
                document.getElementById('startDate'),
                document.getElementById('endDate'),
                document.getElementById('location')
            ];

            const missingField = requiredFields.find(function (field) {
                return !field.value.trim();
            });

            if (missingField) {
                alert('Please complete all required fields.');
                missingField.focus();
                return;
            }

            if (endDate.value < startDate.value) {
                alert('The expected end date cannot be earlier than the start date.');
                endDate.focus();
                return;
            }

            alert('Validation successful. Database saving has not been connected yet.');
        });