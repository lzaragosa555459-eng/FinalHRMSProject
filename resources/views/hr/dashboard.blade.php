<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        body {
            background-color: #EDF2FA !important;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* FLAT CARDS */
        .card {
            border: none !important;
            box-shadow: none !important;
            border-radius: 12px;
        }


        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
        }

        .small-card { padding: 12px !important; }
        .tight { margin-bottom: 12px !important; }

        .activity-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
    </style>
</head>

<body>
@extends('hr.sidebar')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-3">
<div class="col-lg-11 offset-lg-1">

<!-- NAV -->
<nav class="navbar px-3 tight card-white">
    <div class="d-flex align-items-center">
        <img src="{{ asset('logo.png') }}" style="width:35px;">
        <h5 class="ms-2 mb-0 fw-bold">CoreHR</h5>
    </div>

    <div class="ms-auto d-flex align-items-center">
        <div class="text-end me-2 d-none d-sm-block">
            <h6 class="mb-0">{{ $user->employee->name }}</h6>
            <small class="text-muted">{{ $user->email }}</small>
        </div>

        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold" style="width:38px;height:38px;">
            HR
        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="text-center tight">
    <h5 class="fw-bold">Dashboard Overview</h5>
</div>

<!-- FINANCE (IMPORTANT = BLUE) -->
<div class="row g-2 tight">
    <div class="col-md-4">
        <div class="card card-blue small-card text-center">
            <small>Total Gross</small>
            <h6 class="fw-bold mb-0">₱{{ number_format($totalgross, 2) }}</h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-grey small-card text-center">
            <small>Deductions</small>
            <h6 class="fw-bold text-danger mb-0">₱{{ number_format($totaldeduction, 2) }}</h6>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-blue small-card text-center" style="background-color: #a5d7fa;">
            <small>Total Net</small>
            <h6 class="fw-bold text-success mb-0">₱{{ number_format($totalnet, 2) }}</h6>
        </div>
    </div>
</div>

<!-- MINI STATS -->
<div class="row g-2 tight">
@php
$stats = [
    ['Employees', $totalEmployees, 'primary', 'people-fill'],
    ['Active', $totalActive, 'success', 'person-check-fill'],
    ['New', $newHires, 'info', 'person-plus-fill'],
    ['Resigned', $resignedEmployees, 'danger', 'person-dash-fill'],
    ['Departments', $departments, 'warning', 'building'],
    ['Positions', $positions, 'secondary', 'briefcase-fill']
];
@endphp

@foreach($stats as $index => $s)
<div class="col-6 col-md-4 col-lg-2">
    <div class="card {{ $index < 2 ? 'card-blue' : 'card-grey' }} small-card h-100">
        <div class="stat-icon bg-{{ $s[2] }}-subtle text-{{ $s[2] }}">
            <i class="bi bi-{{ $s[3] }}"></i>
        </div>
        <small style="font-size: 11px;">{{ $s[0] }}</small>
        <h6 class="fw-bold mb-0">{{ $s[1] }}</h6>
    </div>
</div>
@endforeach
</div>

<!-- MAIN -->
<div class="row g-3 tight">

<div class="col-lg-7">
    <div class="card card-white p-3 h-100" style="background-color: #a5d7fa;">
        <h6 class="fw-bold mb-2">Employee Analytics</h6>
        <canvas id="deptChart" style="max-height:250px;"></canvas>
    </div>
</div>

<div class="col-lg-5">
    <div class="card card-grey p-3 h-100">
        <h6 class="fw-bold mb-2">Daily Presence</h6>

        <div class="d-flex justify-content-between small mb-2">
            <span class="text-success">Present</span>
            <span>{{ $totalPresentToday }}</span>
        </div>

        <div class="d-flex justify-content-between small mb-2">
            <span class="text-danger">Absent</span>
            <span>{{ $TotalLeave }}</span>
        </div>

        <div class="d-flex justify-content-between small mb-3">
            <span class="text-warning">Late</span>
            <span>{{ $totalLateToday }}</span>
        </div>

        <hr>

        <div class="row text-center g-1">
            <div class="col">
                <small>Wait</small>
                <div class="fw-bold text-primary">{{ $pendingleaves }}</div>
            </div>
            <div class="col">
                <small>OK</small>
                <div class="fw-bold text-success">{{ $approvedleaves }}</div>
            </div>
            <div class="col">
                <small>No</small>
                <div class="fw-bold text-danger">{{ $disapprovedleaves }}</div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- LOWER -->
<div class="row g-3 tight">

<div class="col-lg-4">
    <div class="card card-white p-3 h-100">
        <h6 class="fw-bold mb-2">Gender</h6>
        <canvas id="genderChart"></canvas>
    </div>
</div>

<div class="col-lg-4">
    <div class="card card-grey p-3 h-100">
        <h6 class="fw-bold mb-2">Activity</h6>
        <ul class="list-unstyled small mb-0">
            <li><span class="activity-dot bg-primary"></span>John hired</li>
            <li><span class="activity-dot bg-warning"></span>Leave request</li>
            <li><span class="activity-dot bg-info"></span>Profile updated</li>
        </ul>
    </div>
</div>

<div class="col-lg-4">
    <div class="card card-white p-3 h-100">
        <h6 class="fw-bold mb-2">Daily Chart</h6>
        <canvas id="dailyChart"></canvas>
    </div>
</div>

</div>

<!-- LAST -->
<div class="row">
<div class="col-lg-12">
    <div class="card card-white p-3" style="background-color: #a5d7fa;">
        <h6 class="fw-bold mb-2">Employee Performance</h6>
        <canvas id="employeeChart"></canvas>
    </div>
</div>
</div>

</div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    // ===== BAR CHART =====
    const departments = @json($departmentsAnalytics);
    const labels = departments.map(d => d.department);
    const data = departments.map(d => d.total_positions);

    const deptCtx = document.getElementById('deptChart');
    new Chart(deptCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Employees',
                data: data,
                borderRadius: 10,
                backgroundColor: ['#139dff']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });


    // ===== PIE CHART =====
    const genderCtx = document.getElementById('genderChart');

    const female = @json($female);
    const male = @json($male);
    const other = @json($other);

    new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [{
                data: [male, female, other],
                backgroundColor: [
                    '#139dff',
                    '#ff00bf',
                    '#c014d3'
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});

// Daily Chart Data (from Laravel)
    const dailyDates = @json($dailySummary->pluck('date'));
    const presentData = @json($dailySummary->pluck('present'));
    const lateData = @json($dailySummary->pluck('late'));

    // Daily Bar Chart
    new Chart(document.getElementById('dailyChart'), {
        type: 'bar',
        data: {
            labels: dailyDates,
            datasets: [
                {
                    label: 'Present',
                    data: presentData,
                    backgroundColor: '#139dff',
                    borderColor: '#139dff',
                    borderWidth: 1
                },
                {
                    label: 'Late',
                    data: lateData,
                    backgroundColor: '#395970',
                    borderColor: '#395970',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Daily Attendance Overview' }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Number of Employees' } }
            }
        }
    });

    // Employee Chart Data
    const employeeIds = @json($employeeSummary->pluck('name'));
    const empPresent = @json($employeeSummary->pluck('present'));
    const empLate = @json($employeeSummary->pluck('late'));

    // Employee Horizontal Bar Chart
    new Chart(document.getElementById('employeeChart'), {
        type: 'bar',
        data: {
            labels: employeeIds.map(name =>  name),
            datasets: [
                {
                    label: 'Present',
                    data: empPresent,
                    backgroundColor: '#139dff'
                },
                {
                    label: 'Late',
                    data: empLate,
                    backgroundColor: '#395970'
                }
            ]
        },
        options: {
            indexAxis: 'y',   // Horizontal bars
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Attendance by Employee' }
            },
            scales: {
                x: { beginAtZero: true, title: { display: true, text: 'Number of Days' } }
            }
        }
    });
</script>



</body>
</html>
