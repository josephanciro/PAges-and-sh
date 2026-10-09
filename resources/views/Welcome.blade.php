<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ProjectManager Login</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @vite(['resources/css/welcome.css', 'resources/js/welcome.js'])
    
</head>


<body>


    <!-- =====================================================
         FIRST SECTION
         ===================================================== -->

    <section
        class="hero-section active-section"
        id="hero">


        <div class="logo">

            <div class="logo-box"></div>

            Project<span>Manager</span>

        </div>


        <div class="project">
            PROJECT MANAGEMENT WORKSPACE
        </div>


        <div class="intro">

            <div class="small-title">
                BUILT FOR THE LONG VIEW
            </div>


            <h1>
                Good infrastructure<br>
                starts with a
                <span class="green">
                    clear<br>
                    view.
                </span>
            </h1>


            <p class="description">
                Bring projects, teams, and milestones together —
                from the first plan to the final handover.
            </p>


            <div class="hero-buttons">

                <button
                    type="button"
                    class="login-hero-btn"
                    onclick="goToLogin('login')">

                    LOGIN

                </button>


                <button
                    type="button"
                    class="signup-hero-btn"
                    onclick="goToLogin('register')">

                    SIGN UP

                </button>

            </div>

        </div>

    </section>



    <!-- =====================================================
         SECOND SECTION
         ===================================================== -->

    <section
        class="auth-section"
        id="login">


        <div class="form-container">

            <div class="access">
                WORKSPACE ACCESS
            </div>


            <h2 id="formTitle">
                Welcome back
            </h2>


            <p
                class="subtitle"
                id="formSubtitle">

                Sign in to pick up where your team left off.

            </p>


            <div class="tabs">

                <button
                    class="tab active"
                    id="signInTab"
                    onclick="showLogin()">

                    Sign in

                </button>


                <button
                    class="tab"
                    id="registerTab"
                    onclick="showRegister()">

                    Create account

                </button>

            </div>


            <div class="form-switcher">


                <!-- LOGIN -->

                <form
                    action="{{ route('SignInForm') }}"
                    method="POST">

                    @csrf

                    <div
                        id="loginForm"
                        class="form-panel active-form">


                        <label>
                            Work email
                        </label>


                        <div class="input-box">

                            <input
                                type="email"
                                placeholder="you@company.com"
                                name="EEmail"
                            >

                            <span class="icon">
                                ✉
                            </span>

                        </div>


                        <label>
                            Password
                        </label>


                        <div class="input-box">

                            <input
                                type="password"
                                id="loginPassword"
                                placeholder="Enter your password"
                                name="PPassword"
                            >

                            <span
                                class="icon"
                                onclick="togglePassword(
                                    'loginPassword',
                                    this
                                )">

                                👁

                            </span>

                        </div>


                        <div class="workspace">

                            <span>
                                ✓ &nbsp; Your team workspace
                            </span>

                            <span>
                                Secure access
                            </span>

                        </div>


                        <button
                            type="submit"
                            class="login-btn">

                            Sign in to ProjectManager

                            <span class="arrow">
                                →
                            </span>

                        </button>


                        <div class="bottom-text">

                            New to ProjectManager?

                            <a
                                href="#"
                                onclick="
                                    showRegister();
                                    return false;
                                ">

                                Create an account

                            </a>


                            <br>
                            <br>


                            <a href="/Admin.blade.php">

                                TO ADMIN DASH

                            </a>

                        </div>

                    </div>

                </form>



                <!-- REGISTER -->

                <form
                    action=""
                    method="POST">

                    @csrf

                    <div
                        id="registerForm"
                        class="form-panel">


                        <label>
                            Full name
                        </label>


                        <div class="input-box">

                            <input
                                type="text"
                                placeholder="Your name"
                            >

                        </div>


                        <label>
                            Work email
                        </label>


                        <div class="input-box">

                            <input
                                type="email"
                                placeholder="you@company.com"
                            >

                        </div>


                        <label>
                            Password
                        </label>


                        <div class="input-box">

                            <input
                                type="password"
                                id="registerPassword"
                                placeholder="Create a password"
                            >

                            <span
                                class="icon"
                                onclick="togglePassword(
                                    'registerPassword',
                                    this
                                )">

                                👁

                            </span>

                        </div>


                        <button
                            type="submit"
                            class="login-btn">

                            Create ProjectManager account

                            <span class="arrow">
                                →
                            </span>

                        </button>


                        <div class="bottom-text">

                            Already have an account?

                            <a
                                href="#"
                                onclick="
                                    showLogin();
                                    return false;
                                ">

                                Sign in

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </section>



    <!-- =====================================================
         THIRD SECTION
         ===================================================== -->

    <section
        class="video-section"
        id="videoSection">


        <video
            class="background-video"
            autoplay
            muted
            loop
            playsinline
            preload="auto">

            <source
                src="{{ asset('images/background.mp4') }}"
                type="video/mp4">

            Your browser does not support the video tag.

        </video>


        <div class="video-overlay"></div>


        <div class="video-content">

            <div class="video-label">
                PROJECTMANAGER
            </div>


            <h2>
                Plan clearly.<br>
                Build <span>better.</span>
            </h2>


            <p>
                Keep your projects, teams, tasks, and infrastructure
                organized in one workspace.
            </p>

        </div>

    </section>




  <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>