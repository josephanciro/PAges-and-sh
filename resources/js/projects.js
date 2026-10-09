document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarToggle = document.getElementById("sidebarToggle");
            const hamburger = document.getElementById("hamburger");
            const overlay = document.getElementById("sidebarOverlay");
            const mobileQuery = window.matchMedia("(max-width: 768px)");
            const filterButtons = document.querySelectorAll(".project-filters button");
            const projectCards = Array.from(document.querySelectorAll(".project-card"));
            const progressBars = document.querySelectorAll(".progress");
            const reduceMotion = window.matchMedia(
                "(prefers-reduced-motion: reduce)"
            ).matches;

            let filterRun = 0;
            let resizeFrame = null;

            /* SIDEBAR ANIMATIONS */

            function openMobileSidebar() {
                if (!mobileQuery.matches) return;

                sidebar.classList.add("open");
                overlay.classList.add("show");
                hamburger.setAttribute("aria-expanded", "true");
                hamburger.setAttribute("aria-label", "Close sidebar");
                document.body.style.overflow = "hidden";
            }

            function closeMobileSidebar() {
                sidebar.classList.remove("open");
                overlay.classList.remove("show");
                hamburger.setAttribute("aria-expanded", "false");
                hamburger.setAttribute("aria-label", "Open sidebar");
                document.body.style.overflow = "";
            }

            hamburger.addEventListener("click", function () {
                if (sidebar.classList.contains("open")) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            });

            overlay.addEventListener("click", closeMobileSidebar);

            sidebarToggle.addEventListener("click", function () {
                if (mobileQuery.matches) {
                    closeMobileSidebar();
                    return;
                }

                const isCollapsed = sidebar.classList.toggle("sidebar-collapsed");

                sidebarToggle.setAttribute(
                    "aria-expanded",
                    String(!isCollapsed)
                );

                sidebarToggle.setAttribute(
                    "aria-label",
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
                if (event.key === "Escape" && sidebar.classList.contains("open")) {
                    closeMobileSidebar();
                    hamburger.focus();
                }
            });

            mobileQuery.addEventListener("change", function (event) {
                closeMobileSidebar();

                if (event.matches) {
                    sidebar.classList.remove("sidebar-collapsed");
                    sidebarToggle.setAttribute("aria-expanded", "true");
                    sidebarToggle.setAttribute("aria-label", "Collapse sidebar");
                }
            });

            /* ANIMATED PROGRESS BARS */

            function animateProgressBars() {
                progressBars.forEach(function (bar, index) {
                    if (reduceMotion) {
                        bar.classList.add("animate-progress");
                        return;
                    }

                    window.setTimeout(function () {
                        bar.classList.add("animate-progress");
                    }, 350 + index * 100);
                });
            }

            animateProgressBars();

            /* PROJECT FILTER ANIMATIONS */

            function showCard(card) {
                card.classList.remove("filter-hidden", "filter-exit");
                card.classList.add("filter-enter");

                if (reduceMotion) {
                    card.classList.add("filter-visible");
                    return;
                }

                /* Force the browser to register the initial state. */
                void card.offsetWidth;

                requestAnimationFrame(function () {
                    card.classList.add("filter-visible");
                });
            }

            function hideCard(card, currentRun) {
                card.classList.remove("filter-enter", "filter-visible");

                if (reduceMotion) {
                    card.classList.add("filter-hidden");
                    card.classList.remove("filter-exit");
                    return;
                }

                card.classList.add("filter-exit");

                window.setTimeout(function () {
                    if (currentRun !== filterRun) return;

                    card.classList.add("filter-hidden");
                    card.classList.remove("filter-exit");
                }, 230);
            }

            filterButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const selectedFilter = button.dataset.filter;
                    const currentRun = ++filterRun;

                    filterButtons.forEach(function (item) {
                        item.classList.remove("active");
                        item.setAttribute("aria-pressed", "false");
                    });

                    button.classList.add("active");
                    button.setAttribute("aria-pressed", "true");

                    projectCards.forEach(function (card) {
                        const matches =
                            selectedFilter === "all" ||
                            selectedFilter === card.dataset.status;

                        if (matches) {
                            if (card.classList.contains("filter-hidden")) {
                                showCard(card);
                            } else if (
                                card.classList.contains("filter-exit")
                            ) {
                                card.classList.remove("filter-exit");
                                showCard(card);
                            }
                        } else if (
                            !card.classList.contains("filter-hidden")
                        ) {
                            hideCard(card, currentRun);
                        }
                    });
                });
            });

            /* SCROLL REVEAL ANIMATIONS */

            if ("IntersectionObserver" in window && !reduceMotion) {
                const revealTargets = document.querySelectorAll(
                    ".project-details, .project-description"
                );

                revealTargets.forEach(function (element) {
                    element.classList.add("reveal-on-scroll");
                });

                const revealObserver = new IntersectionObserver(
                    function (entries, observer) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add("revealed");
                                observer.unobserve(entry.target);
                            }
                        });
                    },
                    {
                        threshold: 0.12,
                        rootMargin: "0px 0px -25px 0px"
                    }
                );

                revealTargets.forEach(function (element) {
                    revealObserver.observe(element);
                });
            }

            /* SMOOTH PRESS FEEDBACK */

            document.querySelectorAll(".create-btn, .view-project").forEach(
                function (link) {
                    link.addEventListener("pointerdown", function () {
                        link.style.transition = "transform .12s ease";
                    });

                    function restoreTransition() {
                        link.style.transition = "";
                    }

                    link.addEventListener("pointerup", restoreTransition);
                    link.addEventListener("pointercancel", restoreTransition);
                    link.addEventListener("blur", restoreTransition);
                }
            );

            /* CLEAN UP MOBILE STATE WHEN RESIZING */

            window.addEventListener("resize", function () {
                if (resizeFrame !== null) {
                    cancelAnimationFrame(resizeFrame);
                }

                resizeFrame = requestAnimationFrame(function () {
                    if (!mobileQuery.matches) {
                        closeMobileSidebar();
                    }

                    resizeFrame = null;
                });
            });
        });