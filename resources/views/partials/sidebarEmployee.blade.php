<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            background-color: #f5f6fa;
        }

        /* SIDEBAR BASE */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 300vh;
            width: 70px; /* Collapsed width */
            background-color: #212529;
            padding: 20px 10px;
            overflow-x: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        /* HOVER & CLICKED STATE */
        /* This keeps the sidebar expanded if hovered OR if it has the .expanded class */
        .sidebar:hover, 
        .sidebar.expanded {
            width: 250px;
        }

        /* HEADER (MENU TEXT) */
        .sidebar h3 {
            color: white;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.2rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease;
        }

        .sidebar:hover h3,
        .sidebar.expanded h3 {
            opacity: 1;
            visibility: visible;
        }

        /* LINKS */
        .sidebar .nav-link {
            color: #dcdcdc;
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 8px;
            white-space: nowrap;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar .nav-link i {
            font-size: 18px;
            min-width: 30px; /* Essential for centering icon when collapsed */
            text-align: center;
        }

        /* TEXT LABELS */
        .sidebar .text {
            opacity: 0;
            visibility: hidden;
            margin-left: 12px;
            transition: opacity 0.2s ease;
        }

        .sidebar:hover .text,
        .sidebar.expanded .text {
            opacity: 1;
            visibility: visible;
        }

        /* HOVER & ACTIVE STATES */
        .sidebar .nav-link:hover {
            background-color: #343a40;
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        /* LOGOUT SPECIAL STYLE */
        .sidebar .logout {
            margin-top: 20px;
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .sidebar .logout:hover {
            background-color: #dc3545;
            color: white;
        }
        /* HAMBURGER BUTTON */
        .hamburger-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: #212529;
            color: white;
            border: none;
            padding: 8px 10px;
            font-size: 20px;
        }

        /* MOBILE ONLY BEHAVIOR */
        @media (max-width: 1024px) {
            .sidebar {
                left: -250px; /* hide sidebar */
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0; /* OVERLAP OPEN */
            }
        }
    </style>
</head>
<body>
<button class="hamburger-btn">
    <i class="bi bi-list"></i>
</button>
<div class="sidebar">
    <h3>Menu</h3>

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

<script>
    const sidebar = document.querySelector('.sidebar');
    const btn = document.querySelector('.hamburger-btn');

    btn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>
</body>
</html>