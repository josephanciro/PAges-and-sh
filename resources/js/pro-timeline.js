const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");
        const sidebarToggle = document.getElementById("sidebarToggle");
        const mobileMediaQuery = window.matchMedia("(max-width: 768px)");

        function openSidebar() {
            sidebar.classList.add("open");
            sidebarOverlay.classList.add("show");
            hamburger.setAttribute("aria-expanded", "true");
            hamburger.setAttribute("aria-label", "Close navigation menu");
        }

        function closeSidebar() {
            sidebar.classList.remove("open");
            sidebarOverlay.classList.remove("show");
            hamburger.setAttribute("aria-expanded", "false");
            hamburger.setAttribute("aria-label", "Open navigation menu");
        }

        hamburger.addEventListener("click", function () {
            if (sidebar.classList.contains("open")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        sidebarOverlay.addEventListener("click", closeSidebar);

        /* DESKTOP COLLAPSE BUTTON */
        sidebarToggle.addEventListener("click", function () {
            if (mobileMediaQuery.matches) {
                return;
            }

            sidebar.classList.toggle("sidebar-collapsed");

            const isCollapsed =
                sidebar.classList.contains("sidebar-collapsed");

            document.body.classList.toggle(
                "sidebar-is-collapsed",
                isCollapsed
            );

            sidebarToggle.setAttribute(
                "aria-expanded",
                String(!isCollapsed)
            );

            sidebarToggle.setAttribute(
                "aria-label",
                isCollapsed ? "Expand sidebar" : "Collapse sidebar"
            );
        });

        /* CLOSE MOBILE SIDEBAR AFTER SELECTING A LINK */
        document.querySelectorAll(".sidebar .menu a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (mobileMediaQuery.matches) {
                    closeSidebar();
                }
            });
        });

        /* CLOSE SIDEBAR WITH ESCAPE */
        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeSidebar();
            }
        });

        /* RESET MOBILE MENU WHEN RESIZING TO DESKTOP */
        function handleScreenChange() {
            if (!mobileMediaQuery.matches) {
                closeSidebar();
            }
        }

        if (mobileMediaQuery.addEventListener) {
            mobileMediaQuery.addEventListener("change", handleScreenChange);
        } else {
            mobileMediaQuery.addListener(handleScreenChange);
        }