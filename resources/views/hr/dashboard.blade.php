@extends('hr.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
        .navbar { border-radius: 1rem; margin-bottom: 2rem; }
        .activity-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 10px; }
    </style>
</head>
<body style="background-color: #EDF2FA;">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<div class="container py-4" style="margin-left:5%;">
    <div class="row">
        <div class="col-lg-11 offset-lg-1">
            
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">    
                        <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('logo.png') }}" style="width: 40px;" alt="Logo">
                                <h4 class="ms-3 mb-0 fw-bold">CoreHR</h4>
                            </div>
                            <div class="ms-auto d-flex align-items-center">
                                <div class="text-end me-3 d-none d-sm-block">
                                    <h6 class="mb-0">hruser</h6>
                                    <small class="text-muted">hr@gmail.com</small>
                                </div>
                                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold" style="width:45px;height:45px;">
                                    HR
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1 class="fw-bold display-6">Dashboard Overview</h1>
                        <p class="text-muted">Real-time HR analytics and employee management</p>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-people-fill fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Total Employees</small>
                            <h3 class="fw-bold mb-0">{{ $totalEmployees }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-person-check-fill fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Total Active</small>
                            <h3 class="fw-bold mb-0">{{ $totalActive }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-info-subtle text-info"><i class="bi bi-person-plus-fill fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">New Hires</small>
                            <h3 class="fw-bold mb-0">{{ $newHires }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-danger-subtle text-danger"><i class="bi bi-person-dash-fill fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Resigned</small>
                            <h3 class="fw-bold mb-0">{{ $resignedEmployees }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-building fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Departments</small>
                            <h3 class="fw-bold mb-0">{{ $departments }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="card bg-white shadow-sm p-3 h-100">
                            <div class="stat-icon bg-secondary-subtle text-secondary"><i class="bi bi-briefcase-fill fs-4"></i></div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Positions</small>
                            <h3 class="fw-bold mb-0">{{ $positions }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card bg-white shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-4">Employee Analytics</h5>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2 bg-light rounded text-center mb-3 small fw-bold">Employees by Department</div>
                                    <canvas id="deptChart" style="max-height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card bg-white shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-4">Daily Presence</h5>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 d-flex justify-content-between align-items-center px-0">
                                    <span><i class="bi bi-check-circle-fill text-success me-2"></i> Present Today</span>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">{{ $totalPresentToday }}</span>
                                </div>
                                <div class="list-group-item border-0 d-flex justify-content-between align-items-center px-0">
                                    <span><i class="bi bi-x-circle-fill text-danger me-2"></i> Absent / Leave</span>
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">{{ $TotalLeave }}</span>
                                </div>
                                <div class="list-group-item border-0 d-flex justify-content-between align-items-center px-0 mb-3">
                                    <span><i class="bi bi-clock-fill text-warning me-2"></i> Late Arrivals</span>
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">{{ $totalLateToday }}</span>
                                </div>
                            </div>
                            <hr>
                            <h6 class="fw-bold mb-3 small text-muted text-uppercase">Leave Requests</h6>
                            <div class="row g-2 text-center">
                                <div class="col-4">
                                    <div class="p-2 border rounded">
                                        <small class="d-block text-muted">Wait</small>
                                        <strong class="text-primary">{{ $pendingleaves }}</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 border rounded">
                                        <small class="d-block text-muted">OK</small>
                                        <strong class="text-success">{{ $approvedleaves }}</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 border rounded">
                                        <small class="d-block text-muted">No</small>
                                        <strong class="text-danger">{{ $disapprovedleaves }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                       <div class="card bg-white shadow-sm p-4 h-100">
                        <h5 class="fw-bold mb-4">Gender Stats</h5>

                        <div class="bg-light rounded p-3 border-dashed">
                            <canvas id="genderChart" height="200"></canvas>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-white shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-4">Recent Activity</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="activity-dot bg-primary"></span>
                                    <span class="fw-medium">John Doe</span> was hired
                                    <small class="text-muted d-block ms-4">2 hours ago</small>
                                </li>
                                <li class="mb-3">
                                    <span class="activity-dot bg-warning"></span>
                                    <span class="fw-medium">Jane Smith</span> filed a leave request
                                    <small class="text-muted d-block ms-4">5 hours ago</small>
                                </li>
                                <li>
                                    <span class="activity-dot bg-info"></span>
                                    <span class="fw-medium">Mark</span> updated employee profile
                                    <small class="text-muted d-block ms-4">Yesterday</small>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-3xl font-bold mb-8">Attendance History Graph ({{ now()->format('F Y') }})</h1>

                        <!-- Daily Attendance Chart -->
                        <div class="bg-white p-6 rounded-lg shadow mb-10">
                            <h2 class="text-xl font-semibold mb-4">Daily Present vs Late</h2>
                            <canvas id="dailyChart" height="100"></canvas>
                        </div>

                        <!-- Employee Performance Chart -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-xl font-semibold mb-4">Employee Attendance Performance</h2>
                            <canvas id="employeeChart" height="120"></canvas>
                        </div>
                    </div>
                </div>

            </div> </div>
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
                backgroundColor: ['#b5c8ff']
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
                    '#0d6efd',
                    '#dc3545',
                    '#fffb00'
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
                    backgroundColor: '#22c55e',
                    borderColor: '#16a34a',
                    borderWidth: 1
                },
                {
                    label: 'Late',
                    data: lateData,
                    backgroundColor: '#eab308',
                    borderColor: '#ca8a04',
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
                    backgroundColor: '#22c55e'
                },
                {
                    label: 'Late',
                    data: empLate,
                    backgroundColor: '#eab308'
                }
            ]
        },
        options: {
            indexAxis: 'y',   // Horizontal bars
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Attendance by Employee (3 Days)' }
            },
            scales: {
                x: { beginAtZero: true, title: { display: true, text: 'Number of Days' } }
            }
        }
    });
</script>

</body>
</html>