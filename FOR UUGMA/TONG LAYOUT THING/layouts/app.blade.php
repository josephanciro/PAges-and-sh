<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Project Manager')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/sidebar.css', 'resources/css/NEWTOPBar.css', 'resources/js/sidebar.js'])
    <style>
        
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.sidebar')

    <main class="main">

        <!-- SHARED TOPBAR -->

        <div class="topbar">

            <div class="page-title">PROJECT WORKSPACE</div>

            <div class="user-area">

                <button
                    class="notification"
                    type="button"
                    aria-label="Notifications"
                >
                    <i class="fa-regular fa-bell" aria-hidden="true"></i>
                </button>

                <div class="user">
                    <div class="avatar">J</div>
                    <span>Jay</span>
                </div>

            </div>

        </div>
    

    @stack('scripts')
</body>
</html>
