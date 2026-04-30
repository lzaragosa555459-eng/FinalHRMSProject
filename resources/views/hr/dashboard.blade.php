@extends('layouts.apphr')

@section('title', 'Dashboard')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .card {
        border: none !important;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        border-radius: 16px;
        transition: transform 0.2s;
    }

    .card-purple { background-color: #6f42c1 !important; color: white !important; }
    .card-purple-light { background-color: #e2d9f3 !important; color: #4b208c !important; }
    .card-white { background-color: #ffffff !important; }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .big-card { padding: 25px !important; }
    .small-card { padding: 20px !important; }
    .tight { margin-bottom: 20px !important; }

    .navbar {
        background: #ffffff;
        border-radius: 16px;
        padding: 15px 25px;
    }

    @media (max-width: 768px) {
        .col-6.col-md-4.col-lg-2 { width: 50% !important; }
        .tight h3 { text-align: center; }
    }
    .stat-icon i {
        font-size: 10px;
    }
@media (max-width: 768px) {
    .container.py-4 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .col-lg-11.offset-lg-1 {
        margin-left: 0 !important;
        width: 100% !important;
    }



    .big-card {
        padding: 15px !important;
    }

    .small-card {
        padding: 12px !important;
    }

    .card h3,
    .card h4,
    .card h5 {
        font-size: 1rem;
    }

    .card p,
    .card small,
    .card span,
    .card li {
        font-size: 0.75rem;
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .tight h3 {
        font-size: 1.2rem;
        text-align: center;
    }

    canvas {
        max-height: 220px !important;
    }

    #employeeChart {
        min-height: 250px !important;
    }

    .row.g-4,
    .row.g-3 {
        --bs-gutter-y: 0.8rem;
    }

    .col-6.col-md-4.col-lg-2 {
        width: 50%;
    }
}
@media (max-width: 768px) {
    #employeeChart {
        min-height: 180px !important;
        max-height: 180px !important;
    }

    .card h5 {
        font-size: 0.9rem;
    }

    .card.card-white.p-4.shadow-sm {
        padding: 15px !important;
    }
}
@media (max-width: 576px) {
    .small-card {
        padding: 10px !important;
    }

    .stat-icon {
        width: 24px !important;
        height: 24px !important;
    }

    h6, h5, h4 {
        font-size: 14px !important;
    }
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <nav class="navbar shadow-sm tight mt-2">
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('logo.png') }}" style="width:40px;">
                    <h4 class="ms-2 mb-0 fw-bold" style="color: #6f42c1;">CoreHR</h4>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <div class="text-end me-3 d-none d-sm-block">
                        <h6 class="mb-0 fw-bold">{{ $user->employee->name }}</h6>
                        <small class="text-muted">{{ $user->email }}</small>
                    </div>
                    <div class="rounded-circle text-white d-flex justify-content-center align-items-center fw-bold me-4" style="width:45px;height:45px; background: #6f42c1;">
                        HR
                    </div>
                </div>
            </nav>

            <div class="tight mt-4">
                <h3 class="fw-bold" style="color: #2d1a4d;">Dashboard Overview</h3>
            </div>

            <div class="row g-3 tight">
                <div class="col-md-4">
                    <div class="card card-purple big-card text-end shadow-sm">
                        <p class="text-uppercase small mb-1 opacity-75 text-start">Total Gross</p>
                        <h3 class="fw-bold mb-0">₱{{ number_format($totalgross, 2) }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white big-card text-end shadow-sm">
                        <p class="text-uppercase small mb-1 text-muted text-start">Deductions</p>
                        <h3 class="fw-bold text-danger mb-0">₱{{ number_format($totaldeduction, 2) }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-purple-light big-card text-end shadow-sm">
                        <p class="text-uppercase small mb-1 text-start">Total Net</p>
                        <h3 class="fw-bold text-success mb-0">₱{{ number_format($totalnet, 2) }}</h3>
                    </div>
                </div>
            </div>

            <div class="row g-3 tight">
                @php
                $stats = [
                    ['Employees', $totalEmployees, '6f42c1', 'people-fill'],
                    ['Active', $totalActive, '198754', 'person-check-fill'],
                    ['New', $newHires, '0dcaf0', 'person-plus-fill'],
                    ['Resigned', $resignedEmployees, 'dc3545', 'person-dash-fill'],
                    ['Departments', $departments, 'fd7e14', 'building'],
                    ['Positions', $positions, '6c757d', 'briefcase-fill']
                ];
                @endphp

                @foreach($stats as $s)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card card-white small-card h-100 shadow-sm border-bottom border-4 p-2 d-flex flex-column"
                            style="border-color: #{{ $s[2] }} !important; min-height: 100px;">
                            
                            <div class="d-flex align-items-center mb-2">
                                <div class="stat-icon d-flex align-items-center justify-content-center me-2"
                                    style="background-color: #{{ $s[2] }}20; color: #{{ $s[2] }}; width: 24px; height: 24px; border-radius: 6px;">
                                    <i class="bi bi-{{ $s[3] }}" style="font-size: 17px;"></i>
                                </div>
                                <small class="text-muted fw-bold" style="font-size: 17px; line-height: 1; margin-bottom: 10px;">{{ $s[0] }}</small>
                            </div>

                            <div class="mt-auto text-end">
                                <h4 class="fw-bold mb-0" style="color: #2d1a4d;">{{ $s[1] }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-4 tight">
                <div class="col-lg-7">
                    <div class="card card-white p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-4">Employee Analytics</h5>
                        <canvas id="deptChart" style="max-height:300px;"></canvas>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-white p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-4">Daily Presence</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 bg-light">
                            <span class="text-success fw-bold"><i class="bi bi-circle-fill me-2"></i>Present</span>
                            <h5 class="mb-0 fw-bold">{{ $totalPresentToday }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3 bg-light">
                            <span class="text-danger fw-bold"><i class="bi bi-circle-fill me-2"></i>Absent</span>
                            <h5 class="mb-0 fw-bold">{{ $TotalLeave }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded-3 bg-light">
                            <span class="text-warning fw-bold"><i class="bi bi-circle-fill me-2"></i>Late</span>
                            <h5 class="mb-0 fw-bold">{{ $totalLateToday }}</h5>
                        </div>
                        <hr>
                        <div class="row g-0"> 
                            <div class="col d-flex justify-content-between align-items-center px-2">
                                <small class="text-muted fw-bold" style="font-size: 0.75rem;">Wait</small>
                                <h4 class="fw-bold text-primary mb-0">{{ $pendingleaves }}</h4>
                            </div>

                            <div class="col border-start border-end d-flex justify-content-between align-items-center px-2">
                                <small class="text-muted fw-bold" style="font-size: 0.75rem;">Approved</small>
                                <h4 class="fw-bold text-success mb-0">{{ $approvedleaves }}</h4>
                            </div>

                            <div class="col d-flex justify-content-between align-items-center px-2">
                                <small class="text-muted fw-bold" style="font-size: 0.75rem;">Declined</small>
                                <h4 class="fw-bold text-danger mb-0">{{ $disapprovedleaves }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 tight">
                <div class="col-lg-4">
                    <div class="card card-white p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-3">Gender Distribution</h5>
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-white p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-3">Missing Time Out Today</h5>
                        @forelse($missingTimeouts as $attendance)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>{{ $attendance->employee->name }}</span>
                                <span class="text-danger small">No Time Out</span>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No missing records.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-white p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-3">Attendance Trends</h5>
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-white p-4 shadow-sm">
                        <h5 class="fw-bold mb-3">Employee Performance Analysis</h5>
                        <canvas id="employeeChart" style="min-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

        </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    Chart.defaults.color = '#4b208c';
    Chart.defaults.font.family = "'Segoe UI', sans-serif";

    const departments = @json($departmentsAnalytics);
    new Chart(document.getElementById('deptChart'), {
        type: 'bar',
        data: {
            labels: departments.map(d => d.department),
            datasets: [{
                data: departments.map(d => d.total_positions),
                borderRadius: 8,
                backgroundColor: '#6f42c1'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [{
                data: [@json($male), @json($female), @json($other)],
                backgroundColor: ['#6f42c1', '#e83e8c', '#fd7e14'],
                borderWidth: 0
            }]
        },
        options: { plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('dailyChart'), {
        type: 'line',
        data: {
            labels: @json($dailySummary->pluck('date')),
            datasets: [{
                label: 'Present',
                data: @json($dailySummary->pluck('present')),
                borderColor: '#6f42c1',
                tension: 0.3,
                fill: false
            }]
        }
    });

    new Chart(document.getElementById('employeeChart'), {
        type: 'bar',
        data: {
            labels: @json($employeeSummary->pluck('name')),
            datasets: [
                { label: 'Present Days', data: @json($employeeSummary->pluck('present')), backgroundColor: '#6f42c1' },
                { label: 'Late Days', data: @json($employeeSummary->pluck('late')), backgroundColor: '#e2d9f3' }
            ]
        },
        options: { indexAxis: 'y', responsive: true, plugins: { legend: { position: 'top' } } }
    });
});
</script>
@endsection