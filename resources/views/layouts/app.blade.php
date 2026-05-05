<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreHR - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --core-purple: #6f42c1;
            --dark-purple: #2d1a4d;
            --sidebar-width: 70px;
            --sidebar-expanded: 260px;
        }

        body {
            background-color: #f3f0f7;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--dark-purple);
            padding: 20px 10px;
            overflow-x: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), left 0.3s ease;
            z-index: 1050;
        }

        @media (min-width: 1025px) {
            .sidebar:hover { width: var(--sidebar-expanded); }
        }

        /* --- Content Wrapper --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            padding: 40px; /* Generous padding for a clean look */
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 1024px) {
            .sidebar { left: -100px; width: var(--sidebar-expanded); }
            .sidebar.mobile-active { left: 0; box-shadow: 10px 0 50px rgba(0,0,0,0.5); }
            .main-wrapper { margin-left: 0; padding: 80px 20px 20px 20px; padding-top: 10px !important;}
            .sidebar-overlay {
                display: none; position: fixed; top: 0; left: 0;
                width: 100%; height: 100%; background: rgba(0,0,0,0.4); z-index: 1040;
            }
            .sidebar.mobile-active + .sidebar-overlay { display: block; }
        }

        .mobile-toggle {
            display: none; position: fixed; top: 15px; left: 15px; z-index: 1060;
            background: var(--core-purple); color: white; border: none;
            border-radius: 8px; width: 45px; height: 45px; font-size: 24px;
        }
        @media (max-width: 1024px) { .mobile-toggle { display: flex; align-items: center; justify-content: center; } }
        
        /* Sidebar Text Visibility */
        .sidebar .text { opacity: 0; margin-left: 15px; font-weight: 600; transition: opacity 0.2s; white-space: nowrap; }
        .sidebar:hover .text, .sidebar.mobile-active .text { opacity: 1; }
        .sidebar .nav-link { color: #b8a6d9; display: flex; align-items: center; padding: 12px; border-radius: 10px; margin-bottom: 8px; text-decoration: none; }
        .sidebar .nav-link.active { background: var(--core-purple); color: white; }
    </style>
    @yield('styles')
</head>
<body>


    @include('partials.sidebarEmployee')

    <div class="sidebar-overlay" id="overlay"></div>

    <main class="main-wrapper" style="margin-left: 10px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('overlay');

        if(toggle) {
            toggle.addEventListener('click', () => sidebar.classList.toggle('mobile-active'));
            overlay.addEventListener('click', () => sidebar.classList.remove('mobile-active'));
        }
    </script>
    @yield('scripts')
</body>
</html>