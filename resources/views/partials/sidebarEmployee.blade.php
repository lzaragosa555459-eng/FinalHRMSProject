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
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;

    width: 70px;   /* collapsed */
    background-color: #212529;
    padding: 20px 10px;

    overflow-x: hidden;
    transition: 0.3s ease;
    z-index: 1000;
}

/* expand on hover */
.sidebar:hover {
    width: 250px;
}

.sidebar h3 {
    color: white;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;

    opacity: 0;
    transition: 0.2s;
    white-space: nowrap;
}

.sidebar:hover h3 {
    opacity: 1;
}

.sidebar .nav-link {
    color: #dcdcdc;
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 12px;
    border-radius: 10px;
    margin-bottom: 8px;

    white-space: nowrap;
}

.sidebar .nav-link i {
    font-size: 18px;
    min-width: 30px;
    text-align: center;
}

/* hide text by default */
.sidebar .text {
    opacity: 0;
    transition: 0.2s;
}

/* show text on hover */
.sidebar:hover .text {
    opacity: 1;
}

/* hover effect */
.sidebar .nav-link:hover {
    background-color: #343a40;
    color: white;
}

/* active */
.sidebar .nav-link.active {
    background-color: #0d6efd;
    color: white;
}

</style>

<div class="sidebar">

    <h3>Menu</h3>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('employee.dashboard') }}" class="nav-link">
                <i class="bi bi-speedometer2"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.attendance') }}" class="nav-link">
                <i class="bi bi-calendar-check"></i>
                <span class="text">Attendance</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.attendEvent') }}" class="nav-link">
                <i class="bi bi-calendar-event"></i>
                <span class="text">Events</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.requestleave') }}" class="nav-link">
                <i class="bi bi-envelope-paper"></i>
                <span class="text">Leave</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('employee.performance') }}" class="nav-link">
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

</body>
</html>