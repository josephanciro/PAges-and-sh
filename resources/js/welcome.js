
/* =====================================================
   SECTION OBSERVER
===================================================== */

const sections = document.querySelectorAll(
    ".hero-section, .auth-section, .video-section"
);

if (sections.length > 0) {
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sections.forEach((section) => {
                        section.classList.remove("active-section");
                    });

                    entry.target.classList.add("active-section");
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
}


/* =====================================================
   GO TO LOGIN / REGISTER
===================================================== */

function goToLogin(type) {
    const section = document.getElementById("login");

    if (!section) {
        console.error('Login section with id="login" was not found.');
        return;
    }

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
    const title = document.getElementById("formTitle");
    const subtitle = document.getElementById("formSubtitle");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const signInTab = document.getElementById("signInTab");
    const registerTab = document.getElementById("registerTab");

    if (!title || !subtitle || !loginForm || !registerForm ||
        !signInTab || !registerTab) {
        console.error("Some login/register elements were not found.");
        return;
    }

    title.classList.add("text-switch");
    subtitle.classList.add("text-switch");

    setTimeout(() => {
        loginForm.classList.add("active-form");
        registerForm.classList.remove("active-form");

        signInTab.classList.add("active");
        registerTab.classList.remove("active");

        title.innerText = "Welcome back";
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
    const title = document.getElementById("formTitle");
    const subtitle = document.getElementById("formSubtitle");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const signInTab = document.getElementById("signInTab");
    const registerTab = document.getElementById("registerTab");

    if (!title || !subtitle || !loginForm || !registerForm ||
        !signInTab || !registerTab) {
        console.error("Some login/register elements were not found.");
        return;
    }

    title.classList.add("text-switch");
    subtitle.classList.add("text-switch");

    setTimeout(() => {
        loginForm.classList.remove("active-form");
        registerForm.classList.add("active-form");

        signInTab.classList.remove("active");
        registerTab.classList.add("active");

        title.innerText = "Create account";
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
    const input = document.getElementById(inputId);

    if (!input || !icon) {
        console.error("Password input or visibility icon was not found.");
        return;
    }

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

const authSection = document.querySelector(".auth-section");
const formContainer = document.querySelector(".form-container");

if (authSection && formContainer) {
    const formObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    formContainer.classList.add("show-form");
                }
            });
        },
        {
            threshold: 0.25
        }
    );

    formObserver.observe(authSection);
}


/* =====================================================
   MAKE FUNCTIONS ACCESSIBLE TO BLADE HTML
===================================================== */

window.goToLogin = goToLogin;
window.showLogin = showLogin;
window.showRegister = showRegister;
window.togglePassword = togglePassword;


/* =====================================================
   DEBUG MESSAGE
===================================================== */

console.log("Login page JavaScript loaded successfully.");
