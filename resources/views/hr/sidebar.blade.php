<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Dashboard</title>

    <style>
        body {
            overflow-x: hidden;
        }

        /* Sidebar default (collapsed) */
        .sidebar {
            width: 60px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
            color: #fff;
            transition: 0.3s;
            padding-top: 20px;
        }

        /* Expanded on hover */
        .sidebar:hover {
            width: 200px;
        }

        /* Links */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: 0.2s;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: #343a40;
            color: #fff;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: #fff;
            border-radius: 5px;
        }

        /* Hide text when collapsed */
        .sidebar a span {
            opacity: 0;
            margin-left: 10px;
            transition: 0.2s;
        }

        /* Show text when hovered */
        .sidebar:hover a span {
            opacity: 1;
        }

        /* Main content shift */
        .main {
            margin-left: 70px;
            transition: 0.3s;
            padding: 20px;
        }

        .sidebar:hover ~ .main {
            margin-left: 250px;
        }

        /* Logo center when collapsed */
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .sidebar:hover .logo {
            justify-content: flex-start;
            padding-left: 15px;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    
    <img src="{{ asset('logo.png') }}" height="25" style="margin: 15px;">
    
    <a href="{{ route('hr.dashboard') }}" 
       class="{{ Route::is('hr.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('hr.employees') }}" 
       class="{{ Route::is('hr.employees') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i>
        <span>Employees</span>
    </a>

    <a  href="{{ route('hr.organization') }}" 
       class="{{ Route::is('hr.organization') ? 'active' : '' }}">
        <i class="bi bi-diagram-3-fill"></i>
        <span>Organization</span>
    </a>

    <a href="{{ route('hr.attendance') }}" 
       class="{{ Route::is('hr.attendance') ? 'active' : '' }}">
        <i class="bi bi-calendar-check-fill"></i>
        <span>Attendance</span>
    </a>

    <a href="{{ route('hr.payroll') }}" 
       class="{{ Route::is('hr.payroll') ? 'active' : '' }}">
        <i class="bi bi-cash-stack"></i>
        <span>Payroll</span>
    </a>

    <hr class="text-light">

    <a href="{{ route('login') }}" 
      class="{{ Route::is('login') ? 'active' : '' }}">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
    </a>

</div>



<!-- Main Content -->
<div id="mainContent" class="main">


    <div class="container-fluid">
        @yield('content')
    </div>

</div>

<script>
    const sidebar = document.getElementById("mySidebar");
    const mainContent = document.getElementById("mainContent");

    window.addEventListener("DOMContentLoaded", () => {
        const isOpen = localStorage.getItem("sidebarOpen");
        if (isOpen === "true") {
            sidebar.classList.add("open");
            mainContent.classList.add("shift");
        }
    });

    function openSidebar() {
        sidebar.classList.add("open");
        mainContent.classList.add("shift");
        localStorage.setItem("sidebarOpen", "true");
    }

    function closeSidebar() {
        sidebar.classList.remove("open");
        mainContent.classList.remove("shift");
        localStorage.setItem("sidebarOpen", "false");
    }
</script>

</body>
</html>