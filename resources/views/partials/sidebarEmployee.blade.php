<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            background-color: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            padding: 20px;
        }

        .sidebar h3 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: #dcdcdc;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #343a40;
            color: white;
            padding-left: 20px;
        }

        /* ACTIVE STATE (FIXED) */
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        .sidebar .logout {
            margin-top: 30px;
            background-color: #dc3545;
            color: white !important;
        }

        .sidebar .logout:hover {
            background-color: #bb2d3b;
        }

        .sidebar .nav-link {
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h3>Menu</h3>

    <ul class="nav flex-column">

        <!-- DASHBOARD -->
        <li class="nav-item">
            <a href="{{ route('employee.dashboard') }}"
               class="nav-link {{ Route::is('employee.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item mt-3">
            <span class="text-uppercase text-secondary small fw-bold px-2">
                Actions
            </span>
        </li>

        <!-- ATTENDANCE -->
        <li class="nav-item mt-2">
            <a href="{{ route('employee.attendance') }}"
               class="nav-link {{ Route::is('employee.attendance') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i>
                Attendance
            </a>
        </li>

        <!-- ATTEND EVENT -->
        <li class="nav-item">
            <a href="{{ route('employee.attendEvent') }}"
               class="nav-link {{ Route::is('employee.attendEvent') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                Attend Event
            </a>
        </li>

        <!-- REQUEST LEAVE -->
        <li class="nav-item">
            <a href="{{ route('employee.requestleave') }}"
               class="nav-link {{ Route::is('employee.requestleave') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper"></i>
                Request Leave
            </a>
        </li>

        <!-- PERFORMANCE -->
        <li class="nav-item">
            <a href="{{ route('employee.performance') }}"
               class="nav-link {{ Route::is('employee.performance') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                Performance
            </a>
        </li>

        <!-- LOGOUT -->
        <li class="nav-item mt-4">
            <a href="{{ route('hr.logout') }}"
               class="nav-link logout">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </li>

    </ul>
</div>

</body>
</html>