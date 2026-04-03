<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body style="background-color: #EDF2FA;">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@extends('hr.sidebar')
 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #EDF2FA;">
        <div class="container-fluid">

            <div class="ms-auto d-flex align-items-center">

                <div class="rounded-circle d-flex justify-content-center align-items-center bg-secondary text-white"
                    style="width:45px;height:45px;">
                    HR
                </div>

                <div class="ms-2 d-flex flex-column">
                    <h6 class="mb-0">hruser</h6>
                    <small class="text-muted">hr@gmail.com</small>
            </div>

        </div>

    </div>
</nav>
<div class="container mt-4" style="margin-left: 9%;">
    
    <!-- Header -->
    <div class="text-center mb-4">
        <h3 class="fw-semibold">DASHBOARD</h3>
    </div>

    <!-- Top Stats -->
    <div class="row g-3 mb-4">

                <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
                <i class="bi bi-people-fill fs-3 mb-2 text-primary"></i>
                <h6 class="text-muted">Total Employees</h6>
                <h4 class="fw-semibold">{{ $totalEmployees }}</h4>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
                <i class="bi bi-person-check-fill fs-3 mb-2 text-success"></i>
                <h6 class="text-muted">Total Active</h6>
                <h4 class="fw-semibold">{{ $totalActive }}</h4>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
                <i class="bi bi-person-plus-fill fs-3 mb-2 text-info"></i>
                <h6 class="text-muted">New Hires</h6>
                <h4 class="fw-semibold">{{ $newHires }}</h4>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
                <i class="bi bi-person-dash-fill fs-3 mb-2 text-danger"></i>
                <h6 class="text-muted">Resigned</h6>
                <h4 class="fw-semibold">{{ $resignedEmployees }}</h4>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
                <i class="bi bi-building fs-3 mb-2 text-warning"></i>
                <h6 class="text-muted">Departments</h6>
                <h4 class="fw-semibold">{{ $departments }}</h4>
            </div>
        </div>
         <div class="col-md-2">
            <div class="card border-0 bg-white rounded-4 p-3 text-center h-100">
               <i class="bi bi-briefcase-fill fs-3 mb-2 text-primary"></i>
                <h6 class="text-muted">Positions</h6>
                <h4 class="fw-semibold">{{ $positions }}</h4>
            </div>
        </div>

    </div>

    <!-- Main Content Row -->
    <div class="row g-3">

        <!-- Employee Analytics -->
        <div class="col-md-8">
            <div class="card border-0 bg-white rounded-4 p-3 h-100">
                <h6 class="fw-semibold mb-3">Employee Analytics</h6>

                <div class="row text-center g-3">
                    <div class="col-md-4">
                        <div class="p-3 rounded bg-white border">Employees by Department</div>
                        <canvas id="deptChart"></canvas>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded bg-white border">Age Metric</div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded bg-white border">Employment Stats</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance -->
        <div class="col-md-4">
            <div class="card border-0 bg-white rounded-4 p-3 h-100">
                <h6 class="fw-semibold mb-3">Attendance and Leaves</h6>

                <div class="mb-2">✔ Present: {{ $totalPresentToday }}</div>
                <div class="mb-2">❌ Absent: {{  $TotalLeave  }}</div>
                <div class="mb-3">⏰ Late: {{ $totalLateToday}} </div>

                <hr>

                <h6 class="fw-semibold">Leave Requests</h6>
                <div>⏳ Pending: 0</div>
                <div>✅ Approved: 0</div>
                <div>❌ Rejected: 0</div>
            </div>
        </div>

    </div>

    <!-- Bottom Row -->
    <div class="row g-3 mt-2">

        <!-- Gender Stats -->
        <div class="col-md-6">
            <div class="card border-0 bg-white rounded-4 p-3 h-100">
                <h6 class="fw-semibold mb-3">Gender Stats</h6>
                <div class="bg-white border rounded p-5 text-center">Pie Chart</div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-md-6">
            <div class="card border-0 bg-white rounded-4 p-3 h-100">
                <h6 class="fw-semibold mb-3">Recent Activity</h6>

                <ul class="list-unstyled mb-0">
                    <li class="mb-2">✔ John Doe was hired</li>
                    <li class="mb-2">✔ Jane Smith filed a leave request</li>
                    <li>✔ Mark updated employee profile</li>
                </ul>
            </div>
        </div>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const departments = @json($departmentsAnalytics);

    const labels = departments.map(d => d.department);
    const data = departments.map(d => d.total_positions);

    const ctx = document.getElementById('deptChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Employees',
                data: data,
                borderWidth: 1,
                backgroundColor: ['#0d6efd', '#198754', '#ffc107']
            }]
        },
        options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // 🔥 force 1,2,3
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            }
    });

});


</script>

</body>
</html>
