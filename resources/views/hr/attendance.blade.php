<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Attendance</title>
</head>
<style>
    body {
        background-color: #f3f0f7 !important; /* Consistent Lavender Background */
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .nav-item-link {
        position: relative;
        transition: color 0.3s ease;
        color: #6c757d;
        font-weight: 500;
        text-decoration: none;
    }

    /* Purple Animated underline */
    .nav-item-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0%;
        height: 3px;
        background-color: #6f42c1;
        transition: width 0.3s ease;
    }

    /* Active state Purple */
    .nav-item-link.active {
        color: #6f42c1 !important;
        font-weight: 700;
    }

    .nav-item-link.active::after {
        width: 100%;
    }

    /* Table Styling */
    .table thead {
        background-color: #efebf7 !important;
        color: #6f42c1;
    }

    .table-hover tbody tr:hover {
        background-color: #fdfbff;
    }

    .badge-purple {
        background-color: #efebf7;
        color: #6f42c1;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: white;
    }

    /* Custom Scrollbar for the tables */
    .table-responsive-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .table-responsive-scroll::-webkit-scrollbar-thumb {
        background: #d1c4e9;
        border-radius: 10px;
    }

    .form-select:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
    }
</style>
<body>
@extends('hr.sidebar')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <div class="container py-5">
        <div class="col-lg-11 offset-lg-1">

            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="fw-bold mb-0" style="color: #2d1a4d;">Attendance & Leaves</h1>
                    <p class="text-muted">Monitor daily presence and manage time-off requests</p>
                </div>
                
                <div class="d-flex align-items-center bg-white p-2 rounded-4 shadow-sm px-4">
                    <a class="nav-link nav-item-link active me-4" href="#" onclick="showContainer('container1', this)">
                        Attendance
                    </a>

                    <a class="nav-link nav-item-link me-4" href="#" onclick="showContainer('container2', this)">
                        Leave Requests
                        @if($countleaves > 0)
                            <span class="badge rounded-pill bg-danger ms-1">{{ $countleaves }}</span>
                        @endif
                    </a>
                    
                    <div class="vr me-4 my-2"></div>

                    <select class="form-select border-0 bg-light shadow-none w-auto" onchange="filterStatus(this)">
                        <option value="">All Status</option>
                        <option value="present">Present</option>
                        <option value="late">Late</option>
                        <option value="absent">Absent</option>
                    </select>
                </div>
            </div>

            <div class="innercontaner" id="container1" style="display: block;">
                <h4 class="fw-bold mb-3" style="color: #2d1a4d;"><i class="bi bi-calendar-check me-2 text-purple"></i>Daily Attendance</h4>
                
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <div class="table-responsive table-responsive-scroll" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0" id="table">
                            <thead class="position-sticky top-0 z-1">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th class="pe-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td class="ps-4 text-muted small">#{{ $attendance->attendance_id }}</td>
                                    <td class="fw-bold text-dark">
                                        {{ $attendance->employee->name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $attendance->date }}</td>
                                    <td><span class="text-success fw-medium">{{ $attendance->time_in }}</span></td>
                                    <td><span class="text-muted">{{ $attendance->time_out ?? '--:--' }}</span></td>
                                    <td class="pe-4 text-center">
                                        @if($attendance->status == 'Present')
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Present</span>
                                        @elseif($attendance->status == 'Late')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Late</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Absent</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <h4 class="fw-bold mb-3" style="color: #2d1a4d;"><i class="bi bi-person-walking me-2 text-purple"></i>Employees On Leave</h4>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive table-responsive-scroll" style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="position-sticky top-0 z-1">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Employee</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th class="pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedleaves as $leave)
                                <tr>
                                    <td class="ps-4 text-muted">#{{ $leave->leave_id }}</td>
                                    <td class="fw-bold">{{ $leave->employee->name ?? 'N/A' }}</td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td class="small text-muted text-truncate" style="max-width: 200px;">{{ $leave->reason }}</td>
                                    <td class="pe-4">
                                        <span class="badge bg-purple-subtle text-purple px-3 py-2 rounded-pill">Approved</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="innercontainer" id="container2" style="display: none;">
                <h4 class="fw-bold mb-3" style="color: #2d1a4d;"><i class="bi bi-envelope-paper me-2 text-purple"></i>Pending Leave Requests</h4>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive table-responsive-scroll" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="position-sticky top-0 z-1">
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Employee</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingleaves as $leave)
                                <tr>
                                    <td class="ps-4 text-muted">#{{ $leave->leave_id }}</td>
                                    <td class="fw-bold">{{ $leave->employee->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="small fw-medium">{{ $leave->start_date }}</div>
                                        <div class="text-muted small">to {{ $leave->end_date }}</div>
                                    </td>
                                    <td class="small text-muted">{{ $leave->reason }}</td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Pending</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                            <form action="{{ route('approved', $leave->leave_id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-success border-0 px-3">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('reject', $leave->leave_id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-danger border-0 px-3">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
    function showContainer(id, el) {
        document.getElementById('container1').style.display = 'none';
        document.getElementById('container2').style.display = 'none';
        document.getElementById(id).style.display = 'block';

        document.querySelectorAll('.nav-item-link').forEach(link => {
            link.classList.remove('active');
        });
        el.classList.add('active');
    }

    function filterStatus(select) {
        let value = select.value.toLowerCase();
        let rows = document.querySelectorAll("#table tbody tr");

        rows.forEach(row => {
            let statusText = row.cells[5].innerText.toLowerCase();
            row.style.display = (value === "" || statusText.includes(value)) ? "" : "none";
        });
    }
</script>
</body>
</html>