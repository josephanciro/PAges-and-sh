document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const hamburger = document.getElementById("hamburger");
        const overlay = document.getElementById("sidebarOverlay");
        const mobileQuery = window.matchMedia("(max-width: 768px)");

        function closeMobileSidebar() {
            sidebar.classList.remove("open");
            overlay.classList.remove("show");
            hamburger.classList.remove("menu-open");

            hamburger.setAttribute("aria-expanded", "false");
            hamburger.setAttribute("aria-label", "Open sidebar");
            overlay.setAttribute("tabindex", "-1");

            document.body.style.overflow = "";
        }

        function openMobileSidebar() {
            if (!mobileQuery.matches) return;

            sidebar.classList.add("open");
            overlay.classList.add("show");
             hamburger.classList.add("menu-open");

            hamburger.setAttribute("aria-expanded", "true");
            hamburger.setAttribute("aria-label", "Close sidebar");
            overlay.setAttribute("tabindex", "0");

            document.body.style.overflow = "hidden";
        }

        function setDesktopState() {
            sidebar.classList.remove("open");
            sidebar.classList.add("sidebar-collapsed");

            sidebarToggle.setAttribute("aria-expanded", "false");
            sidebarToggle.setAttribute("aria-label", "Expand sidebar");
            sidebarToggle.setAttribute("title", "Expand sidebar");
        }

        function updateViewport() {
            closeMobileSidebar();

            if (mobileQuery.matches) {
                // Mobile: sidebar starts closed and opens using the hamburger.
                sidebar.classList.remove("sidebar-collapsed");
            } else {
                // Desktop: sidebar starts collapsed, as requested.
                setDesktopState();
            }
        }

        // Set the correct initial sidebar state.
        updateViewport();

        hamburger.addEventListener("click", function () {
            if (!mobileQuery.matches) return;

            if (sidebar.classList.contains("open")) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }
        });

        overlay.addEventListener("click", closeMobileSidebar);

        sidebarToggle.addEventListener("click", function () {
            if (mobileQuery.matches) return;

            const isCollapsed =
                sidebar.classList.toggle("sidebar-collapsed");

            sidebarToggle.setAttribute(
                "aria-expanded",
                String(!isCollapsed)
            );

            sidebarToggle.setAttribute(
                "aria-label",
                isCollapsed ? "Expand sidebar" : "Collapse sidebar"
            );

            sidebarToggle.setAttribute(
                "title",
                isCollapsed ? "Expand sidebar" : "Collapse sidebar"
            );
        });

        sidebar.querySelectorAll(".menu a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (mobileQuery.matches) {
                    closeMobileSidebar();
                }
            });
        });

        document.addEventListener("keydown", function (event) {
            if (
                event.key === "Escape" &&
                mobileQuery.matches &&
                sidebar.classList.contains("open")
            ) {
                closeMobileSidebar();
                hamburger.focus();
            }
        });

        if (mobileQuery.addEventListener) {
            mobileQuery.addEventListener("change", updateViewport);
        } else {
            mobileQuery.addListener(updateViewport);
        }
    });