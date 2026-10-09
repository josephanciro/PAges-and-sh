document.addEventListener("DOMContentLoaded", function () {

            const hamburger = document.getElementById("hamburger");
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            const mobileQuery = window.matchMedia("(max-width: 768px)");

            function openSidebar() {
                sidebar.classList.add("open");
                sidebarOverlay.classList.add("show");

                hamburger.setAttribute("aria-expanded", "true");
                hamburger.setAttribute("aria-label", "Close sidebar");
            }

            function closeSidebar() {
                sidebar.classList.remove("open");
                sidebarOverlay.classList.remove("show");

                hamburger.setAttribute("aria-expanded", "false");
                hamburger.setAttribute("aria-label", "Open sidebar");
            }

            // MOBILE HAMBURGER BUTTON
            hamburger.addEventListener("click", function (event) {
                event.preventDefault();
                event.stopPropagation();

                if (sidebar.classList.contains("open")) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            // CLOSE WHEN OVERLAY IS CLICKED
            sidebarOverlay.addEventListener("click", function () {
                closeSidebar();
            });

            // DESKTOP SIDEBAR COLLAPSE BUTTON
            sidebarToggle.addEventListener("click", function () {

                if (mobileQuery.matches) {
                    closeSidebar();
                    return;
                }

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
            });

            // CLOSE MOBILE MENU AFTER CLICKING A NAVIGATION LINK
            sidebar.querySelectorAll(".menu a").forEach(function (link) {
                link.addEventListener("click", function () {
                    if (mobileQuery.matches) {
                        closeSidebar();
                    }
                });
            });

            // CLOSE SIDEBAR WITH ESCAPE KEY
            document.addEventListener("keydown", function (event) {
                if (event.key === "Escape") {
                    closeSidebar();
                }
            });

            // RESET MOBILE MENU WHEN RESIZING TO DESKTOP
            mobileQuery.addEventListener("change", function (event) {
                if (!event.matches) {
                    closeSidebar();
                }
            });

        });