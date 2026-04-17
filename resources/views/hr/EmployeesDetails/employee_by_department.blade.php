<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Organization</title>

    <style>
        body {
            background-color: #f3f0f7; /* Soft purple-tinted background */
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Purple Theme Overrides */
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #4b2a89;
            --light-purple: #efebf7;
        }

        .text-purple { color: var(--primary-purple) !important; }
        .bg-purple { background-color: var(--primary-purple) !important; }
        .btn-purple { 
            background-color: var(--primary-purple); 
            color: white; 
            border: none;
        }
        .btn-purple:hover { 
            background-color: var(--dark-purple); 
            color: white; 
        }
        
        .btn-outline-purple {
            border-color: var(--primary-purple);
            color: var(--primary-purple);
        }
        .btn-outline-purple:hover {
            background-color: var(--primary-purple);
            color: white;
        }

        /* Card Horizontal Scroll */
        .card-container {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding: 10px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .card-container::-webkit-scrollbar { display: none; }

        .card-item {
            min-width: 350px;
            width: 350px;        
            flex: 0 0 auto;
            border-radius: 15px;      
        }

        /* Animated Tabs */
        .nav-item-link {
            position: relative;
            transition: color 0.3s ease;
            color: #6c757d;
            font-weight: 500;
        }
        .nav-item-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0%;
            height: 3px;
            background-color: var(--primary-purple);
            transition: width 0.3s ease;
            border-radius: 10px;
        }
        .nav-item-link.active {
            color: var(--primary-purple) !important;
            font-weight: 700;
        }
        .nav-item-link.active::after { width: 100%; }

        /* Table Styling */
        .table-custom thead {
            background-color: var(--light-purple);
            color: var(--dark-purple);
        }
        .avatar-circle {
            width: 45px;
            height: 45px;
            background-color: var(--primary-purple);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5" style="max-width: 1300px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('hr.organization') }}" class="btn btn-white shadow-sm rounded-pill px-3">
           <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        
        <div class="input-group shadow-sm" style="width: 300px;">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control border-start-0"
                   placeholder="Search department..." onkeyup="globalSearch()">
        </div>
    </div>

    <div class="mb-5 text-center text-md-start">
        <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px;">Department Overview</h6>
        <h1 class="fw-bold text-dark">
            <span class="text-purple">{{ $employees->first()->position?->department?->name ?? 'N/A' }}</span>
        </h1>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-purple border-5" style="border-left: 5px solid var(--primary-purple) !important;">
                <small class="text-muted fw-bold">TOTAL GROSS</small>
                <h2 class="fw-bold text-dark mt-2 mb-0">₱{{ number_format($totalGross, 2)}}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <small class="text-muted fw-bold">DEDUCTIONS</small>
                <h2 class="fw-bold text-danger mt-2 mb-0">₱{{ number_format($totalDeduction, 2) }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-purple text-white">
                <small class="text-white-50 fw-bold">TOTAL NET</small>
                <h2 class="fw-bold mt-2 mb-0">₱{{ number_format($totalNetDept, 2)}}</h2>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-5 mb-2">
        <a class="nav-link nav-item-link active fs-5" href="#" onclick="showContainer('container1', this)">
            <i class="bi bi-people-fill me-2"></i>Employees
        </a>
        <a class="nav-link nav-item-link fs-5" href="#" onclick="showContainer('container2', this)">
            <i class="bi bi-calendar-event-fill me-2"></i>Events
        </a>
    </div>
    <hr class="mb-5 opacity-10">

    <div class="container-fluid px-0" id="container1" style="display: block;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-0">Staff List</h3>
                <p class="text-muted">{{ $employees->count() }} team members assigned</p>
            </div>
            <a href="{{ route('hr.Crud.add') }}" class="btn btn-purple rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Add Employee
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0 table-custom">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3">Employee</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Salary</th>
                            <th class="text-center">Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $emp)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($emp->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $emp->name }}</div>
                                        <small class="text-muted">{{ $emp->employee_number ?? '—' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small fw-semibold">{{ $emp->user->email ?? '—' }}</div>
                                <small class="text-muted">{{ $emp->phone_number ?? '—' }}</small>
                            </td>
                            <td>
                                @if($emp->employee_role == 'head')
                                    <span class="badge rounded-pill bg-warning text-dark px-3">Head</span>
                                @else
                                    <span class="badge rounded-pill bg-light text-muted px-3 border">Employee</span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">
                                {{ $emp->payroll ? '₱' . number_format($emp->payroll->net_salary, 2) : '—' }}
                            </td>
                            <td class="text-center">
                                @if($emp->status == 'active' || !isset($emp->status))
                                    <span class="text-success fw-bold small"><i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Active</span>
                                @else
                                    <span class="text-danger fw-bold small"><i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}"
                                   class="btn btn-sm btn-outline-purple rounded-pill px-3">
                                    View Profile
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0" id="container2" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Department Events</h3>
            <a href="{{ route('hr.Crud.addEvent') }}" class="btn btn-purple rounded-pill px-4">
                <i class="bi bi-calendar-plus me-2"></i>Create Event
            </a>
        </div>

        <div class="card-container pb-4">
            @foreach($getEvents as $event)
            <div class="card card-item border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="badge bg-purple-subtle text-purple text-uppercase small px-2 py-1">
                            {{ str_replace('_', ' ', $event->event_type) }}
                        </span>
                        <span class="badge rounded-pill 
                            @if($event->status == 'published') bg-success 
                            @elseif($event->status == 'draft') bg-secondary 
                            @else bg-danger @endif">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>

                    <h5 class="fw-bold mb-1">{{ $event->title }}</h5>
                    <p class="text-muted small text-truncate-2 mb-3" style="min-height: 40px;">
                        {{ $event->description }}
                    </p>

                    <div class="bg-light rounded-3 p-3 mb-3 small">
                        <div class="mb-1"><i class="bi bi-calendar3 me-2 text-purple"></i>{{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y h:i A') }}</div>
                        <div class="mb-1"><i class="bi bi-geo-alt me-2 text-purple"></i>{{ $event->location ?? 'Virtual' }}</div>
                        <div><i class="bi bi-people me-2 text-purple"></i>Limit: {{ $event->max_participants ?? 'No Limit' }}</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <a href="{{ route('hr.EmployeesDetails.EventAttendances', $event->event_id) }}" class="text-purple fw-bold small text-decoration-none">
                            View Attendees <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <div class="d-flex gap-1">
                            <a href="{{ route('hr.Crud.editEvent', $event->event_id) }}" class="btn btn-light btn-sm rounded-circle text-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('hr.Crud.deleteEvent', $event->event_id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger" onclick="return confirm('Delete event?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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

    function globalSearch() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        
        // Employee search
        document.querySelectorAll("#container1 tbody tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
        });

        // Event search
        document.querySelectorAll("#container2 .card-item").forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(input) ? "" : "none";
        });
    }
</script>

</body>
</html>