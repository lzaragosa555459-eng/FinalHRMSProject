<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            /* NEW: Dark Purple Sidebar Theme */
            --sidebar-bg: #2d1a4d;      /* Deep, Dark Purple */
            --sidebar-hover-bg: #4b2a89;/* Medium Purple for hover */
            --sidebar-active-bg: #ffc107;/* Bright Gold for active state (High Contrast) */
            --sidebar-text-muted: #d1c4e9;/* Soft Lavender for inactive text */
            --sidebar-text-active: #2d1a4d;/* Dark Purple for active text (High Contrast) */
            
            --main-bg: #f3f0f7;         /* Soft Lavender Main Background */
        }

        body {
            background-color: var(--main-bg);
            font-family: 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 70px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg); /* Dark Purple */
            transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        /* Expanded Sidebar */
        .sidebar:hover,
        .sidebar.active {
            width: 240px;
        }

        .logo-details {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center; /* Center logo in 70px track */
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo-details img {
            min-width: 40px;
            transition: transform 0.3s ease;
        }

        .sidebar:hover .logo-details {
            justify-content: flex-start;
            padding-left: 20px;
        }

        /* Sidebar Links */
        .nav-list {
            padding: 10px;
            margin-top: 15px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            color: var(--sidebar-text-muted); /* Soft Lavender */
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar a i {
            min-width: 50px;
            text-align: center;
            font-size: 1.3rem;
            line-height: 50px;
        }

        .sidebar a span {
            opacity: 0;
            margin-left: 10px;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .sidebar:hover a span {
            opacity: 1;
        }

        /* Hover & Active States */
        .sidebar a:hover {
            background: var(--sidebar-hover-bg); /* Medium Purple */
            color: #fff;
        }

        .sidebar a.active {
            background: var(--sidebar-active-bg); /* Bright Gold */
            color: var(--sidebar-text-active); /* Deep Purple text */
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
            font-weight: 700;
        }

        /* Logout special styling */
        .logout-section {
            margin-top: auto;
            padding: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Main Content Styling */
        .main {
            margin-left: 70px;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 25px;
            min-height: 100vh;
        }

        .sidebar:hover ~ .main {
            margin-left: 240px;
        }

        /* Card refinements for yield content (consistent with Soft UI forms) */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        /* Hamburger Button */
        .hamburger-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: #2d1a4d;
            color: white;
            border: none;
            padding: 8px 10px;
            font-size: 20px;
            display: none;
            border-radius: 6px;
        }

        /* SHOW ON IPAD + PHONE */
        @media (max-width: 1024px) {
            .hamburger-btn {
                display: block;
            }

            /* Hide sidebar by default on tablet/mobile */
            .sidebar {
                left: -240px;
                position: fixed;
                transition: left 0.35s ease;
            }

            .sidebar.active {
                left: 0;
            }

            /* MAIN CONTENT FULL WIDTH */
            .main {
                margin-left: 0 !important;
            }
        }
@media (max-width: 768px) {
    .sidebar {
        width: 190px;
        left: -190px;
    }

    .sidebar.active {
        left: 0;
    }

    .sidebar a {
        height: 42px;
        margin-bottom: 6px;
        border-radius: 10px;
    }

    .sidebar a i {
        min-width: 42px;
        font-size: 1rem;
        line-height: 42px;
    }

    .sidebar a span {
        font-size: 0.85rem;
    }

    .logo-details {
        height: 60px;
    }

    .logo-details img {
        height: 28px;
    }

    .nav-list {
        padding: 8px;
        margin-top: 10px;
    }

    .logout-section {
        padding: 8px;
    }

    .hamburger-btn {
        top: 10px;
        left: 10px;
        padding: 6px 9px;
        font-size: 18px;
    }
    .sidebar:hover a span,
    .sidebar.active a span {
        opacity: 1;
    }

    .sidebar:hover .logo-details,
    .sidebar.active .logo-details {
        justify-content: flex-start;
        padding-left: 20px;
    }
}
    </style>
</head>
<body>
<button class="hamburger-btn">
    <i class="bi bi-list"></i>
</button>
<div id="mySidebar" class="sidebar">
    <div class="logo-details">
        <img src="{{ asset('logo.png') }}" height="35" alt="Logo">
    </div>
    
    <div class="nav-list">
        <a href="{{ route('hr.dashboard') }}" class="{{ Route::is('hr.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('hr.employees') }}" class="{{ Route::is('hr.employees') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Employees</span>
        </a>

        <a href="{{ route('hr.organization') }}" class="{{ Route::is('hr.organization') ? 'active' : '' }}">
            <i class="bi bi-diagram-3-fill"></i>
            <span>Organization</span>
        </a>

        <a href="{{ route('hr.attendance') }}" class="{{ Route::is('hr.attendance') ? 'active' : '' }}">
            <i class="bi bi-calendar2-check-fill"></i>
            <span>Attendance</span>
        </a>

        <a href="{{ route('hr.payroll') }}" class="{{ Route::is('hr.payroll') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i>
            <span>Payroll</span>
        </a>
    </div>

    <div class="logout-section">
        <a href="{{ route('login') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

 <!--@yield('content')-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.querySelector('#mySidebar');
    const btn = document.querySelector('.hamburger-btn');

    btn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>
</body>
</html>