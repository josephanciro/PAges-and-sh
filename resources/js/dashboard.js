document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");

            function openMobileSidebar() {
                sidebar.classList.add("open");
                overlay.classList.add("show");

                hamburger.setAttribute("aria-expanded", "true");
                hamburger.setAttribute("aria-label", "Close sidebar");
                overlay.setAttribute("tabindex", "0");

                document.body.style.overflow = "hidden";
            }

            function closeMobileSidebar() {
                sidebar.classList.remove("open");
                overlay.classList.remove("show");

                hamburger.setAttribute("aria-expanded", "false");
                hamburger.setAttribute("aria-label", "Open sidebar");
                overlay.setAttribute("tabindex", "-1");

                document.body.style.overflow = "";
            }

            function toggleMobileSidebar() {
                if (sidebar.classList.contains("open")) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            }

            /* Mobile hamburger button */
            hamburger.addEventListener("click", function (event) {
                event.preventDefault();
                event.stopPropagation();

                if (mobileQuery.matches) {
                    toggleMobileSidebar();
                }
            });

            /* Close sidebar when overlay is clicked */
            overlay.addEventListener("click", function () {
                closeMobileSidebar();
            });

            /* Desktop sidebar collapse button */
            sidebarToggle.addEventListener("click", function () {
                if (mobileQuery.matches) {
                    closeMobileSidebar();
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

                sidebarToggle.setAttribute(
                    "title",
                    isCollapsed ? "Expand sidebar" : "Collapse sidebar"
                );
            });

            /* Close mobile sidebar after selecting a navigation link */
            sidebar.querySelectorAll(".menu a").forEach(function (link) {
                link.addEventListener("click", function () {
                    if (mobileQuery.matches) {
                        closeMobileSidebar();
                    }
                });
            });

            /* Close sidebar using Escape */
            document.addEventListener("keydown", function (event) {
                if (event.key === "Escape" && mobileQuery.matches) {
                    closeMobileSidebar();
                }
            });

            /* Reset mobile state when returning to desktop */
            function handleViewportChange(event) {
                if (!event.matches) {
                    closeMobileSidebar();
                }
            }

            if (mobileQuery.addEventListener) {
                mobileQuery.addEventListener("change", handleViewportChange);
            } else {
                mobileQuery.addListener(handleViewportChange);
            }
        });