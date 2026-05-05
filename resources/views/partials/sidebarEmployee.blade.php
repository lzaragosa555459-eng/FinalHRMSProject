<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreHR Sidebar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --core-purple: #6f42c1;
            --dark-purple: #2d1a4d;
            --soft-purple: #f3f0f7;
            --sidebar-width: 70px;
            --sidebar-expanded: 260px;
        }

        body {
            margin: 0;
            background-color: var(--soft-purple);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* SIDEBAR BASE */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--dark-purple);
            padding: 20px 10px;
            overflow-x: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        /* HOVER & EXPANDED STATE */
        .sidebar:hover, 
        .sidebar.expanded {
            width: var(--sidebar-expanded);
        }

        /* LOGO / HEADER */
        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding-left: 5px;
        }

        .sidebar-header i {
            font-size: 2rem;
            color: #fff;
            min-width: 45px;
        }

        .sidebar-header h3 {
            color: white;
            font-weight: 800;
            margin: 0 0 0 15px;
            font-size: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .sidebar:hover h3, .sidebar.expanded h3 {
            opacity: 1;
        }

        /* NAV LINKS */
        .sidebar .nav-link {
            color: #b8a6d9;
            display: flex;
            align-items: center;
            padding: 14px 12px;
            border-radius: 12px;
            margin-bottom: 8px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            min-width: 35px;
            text-align: center;
        }

        .sidebar .text {
            opacity: 0;
            margin-left: 15px;
            font-weight: 600;
            transition: opacity 0.2s ease;
        }

        .sidebar:hover .text, .sidebar.expanded .text {
            opacity: 1;
        }

        /* ACTIVE & HOVER EFFECTS */
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: var(--core-purple);
            color: white;
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.4);
        }

        /* LOGOUT */
        .sidebar .logout {
            margin-top: auto;
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }

        .sidebar .logout:hover {
            background-color: #ff6b6b;
            color: white;
        }

        /* MAIN CONTENT PADDING */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            transition: margin-left 0.3s ease;
        }

        /* MOBILE STYLES */
        @media (max-width: 1024px) {
            .sidebar {
                left: -100px;
            }
            .sidebar.active {
                left: 0;
                width: var(--sidebar-expanded);
            }
            .sidebar.active .text, .sidebar.active h3 {
                opacity: 1;
            }
            .main-content {
                margin-left: 0;
            }
        }

        .hamburger-btn {
            position: fixed;
            top: 15px;
            right: 15px; /* Moved to right for easier thumb access on mobile */
            z-index: 1100;
            background: var(--dark-purple);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            display: none;
        }

        @media (max-width: 1024px) {
            .hamburger-btn { display: block; }
        }

    </style>
</head>
<body>

<button class="hamburger-btn">
    <i class="bi bi-list"></i>
</button>

<div class="sidebar d-flex flex-column">
    <div class="sidebar-header">
        <i class="bi bi-cpu-fill"></i> <h3>CoreHR</h3>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('employee.dashboard') }}" class="nav-link {{ Route::is('employee.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.attendance') }}" class="nav-link {{ Route::is('employee.attendance') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i>
                <span class="text">Attendance</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.attendEvent') }}" class="nav-link {{ Route::is('employee.attendEvent') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                <span class="text">Events</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.requestleave') }}" class="nav-link {{ Route::is('employee.requestleave') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper"></i>
                <span class="text">Leave</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.performance') }}" class="nav-link {{ Route::is('employee.performance') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                <span class="text">Performance</span>
            </a>
        </li>

        <li class="nav-item mt-4">
            <a href="{{ route('hr.logout') }}" class="nav-link logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>

</div>

<div class="main-content">
    </div>

<script>
    const sidebar = document.querySelector('.sidebar');
    const btn = document.querySelector('.hamburger-btn');

    btn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>

</body>
</html>