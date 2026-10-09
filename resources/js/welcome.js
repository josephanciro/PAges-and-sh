

  
        /* =====================================================
           SECTION FADE / ACTIVE SECTION
           ===================================================== */

        const sections = document.querySelectorAll(
            ".hero-section, .auth-section, .video-section"
        );


        const sectionObserver =
            new IntersectionObserver(
                (entries) => {

                    entries.forEach((entry) => {

                        if (entry.isIntersecting) {

                            sections.forEach((section) => {

                                section.classList.remove(
                                    "active-section"
                                );

                            });


                            entry.target.classList.add(
                                "active-section"
                            );

                        }

                    });

                },
                {
                    threshold: 0.55
                }
            );


        sections.forEach((section) => {

            sectionObserver.observe(section);

        });



        /* =====================================================
           GO TO LOGIN / REGISTER
           ===================================================== */

        function goToLogin(type) {

            const section =
                document.getElementById("login");


            section.scrollIntoView({
                behavior: "smooth"
            });


            setTimeout(() => {

                if (type === "register") {

                    showRegister();

                } else {

                    showLogin();

                }

            }, 500);

        }



        /* =====================================================
           SHOW LOGIN
           ===================================================== */

        function showLogin() {

            const title =
                document.getElementById("formTitle");

            const subtitle =
                document.getElementById("formSubtitle");


            title.classList.add("text-switch");

            subtitle.classList.add("text-switch");


            setTimeout(() => {

                document
                    .getElementById("loginForm")
                    .classList
                    .add("active-form");


                document
                    .getElementById("registerForm")
                    .classList
                    .remove("active-form");


                document
                    .getElementById("signInTab")
                    .classList
                    .add("active");


                document
                    .getElementById("registerTab")
                    .classList
                    .remove("active");


                title.innerText =
                    "Welcome back";


                subtitle.innerText =
                    "Sign in to pick up where your team left off.";


                title.classList.remove("text-switch");

                subtitle.classList.remove("text-switch");

            }, 200);

        }



        /* =====================================================
           SHOW REGISTER
           ===================================================== */

        function showRegister() {

            const title =
                document.getElementById("formTitle");

            const subtitle =
                document.getElementById("formSubtitle");


            title.classList.add("text-switch");

            subtitle.classList.add("text-switch");


            setTimeout(() => {

                document
                    .getElementById("loginForm")
                    .classList
                    .remove("active-form");


                document
                    .getElementById("registerForm")
                    .classList
                    .add("active-form");


                document
                    .getElementById("signInTab")
                    .classList
                    .remove("active");


                document
                    .getElementById("registerTab")
                    .classList
                    .add("active");


                title.innerText =
                    "Create account";


                subtitle.innerText =
                    "Create your ProjectManager workspace account.";


                title.classList.remove("text-switch");

                subtitle.classList.remove("text-switch");

            }, 200);

        }



        /* =====================================================
           PASSWORD VISIBILITY
           ===================================================== */

        function togglePassword(inputId, icon) {

            const input =
                document.getElementById(inputId);


            if (input.type === "password") {

                input.type = "text";

                icon.innerText = "◉";

            } else {

                input.type = "password";

                icon.innerText = "👁";

            }

        }



        /* =====================================================
           FORM FADE-IN
           ===================================================== */

        const authSection =
            document.querySelector(".auth-section");

        const formContainer =
            document.querySelector(".form-container");


        const formObserver =
            new IntersectionObserver(
                (entries) => {

                    entries.forEach((entry) => {

                        if (entry.isIntersecting) {

                            formContainer.classList.add(
                                "show-form"
                            );

                        }

                    });

                },
                {
                    threshold: 0.25
                }
            );


        formObserver.observe(authSection);
