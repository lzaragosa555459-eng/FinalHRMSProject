
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Organization</title>

    <style>
        .card-container {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding: 10px;
        }

        .card-item {
            min-width: 350px;
            width: 350px;        
            flex: 0 0 auto;      
        }

        .card-container::-webkit-scrollbar {
            display: none;
        }

        .card-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .nav-item-link {
            position: relative;
            transition: color 0.3s ease;
        }

        /* Animated underline */
        .nav-item-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0%;
            height: 2px;
            background-color: #0d6efd;
            transition: width 0.3s ease;
        }

        /* Active state */
        .nav-item-link.active {
            color: #0d6efd !important;
            font-weight: 600;
        }

        /* Animate underline on active */
        .nav-item-link.active::after {
            width: 100%;
        }
    </style>
</head>

<body style="background-color: #EDF2FA;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5" style="max-width: 1300px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <!-- Back Button -->
        <a href="{{ route('hr.organization') }}" class="btn btn-outline-secondary rounded mb-3">
            Back
        </a>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchInput" class="form-control"
        placeholder="Search employees or events..."
        onkeyup="globalSearch()"
        style="width:200px;">
        </div>

    </div>
    <!-- Department Title -->
    <h1 class="fw-bold text-dark mb-3">
        Department: 
        <span class="text-primary">
            {{ $employees->first()->position?->department?->name ?? 'N/A' }}
        </span>
    </h1>

    <!-- Summary Cards -->
    <div class="row g-3 mb-5">
        <div class="col-md-4 col-lg-4">
            <div class="card border-0 shadow rounded-4 text-center p-4"
                 style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
                <small class="text-muted fs-6">Total Gross</small>
                <h2 class="fw-bold text-secondary mt-2 mb-0">₱{{ number_format($totalGross, 2)}}</h2>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="card border-0 shadow rounded-4 text-center p-4"
                 style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
                <small class="text-muted fs-6">Deductions</small>
                <h2 class="fw-bold text-danger mt-2 mb-0">₱{{ number_format($totalDeduction, 2) }}</h2>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="card border-0 shadow rounded-4 text-center p-4"
                 style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
                <small class="text-muted fs-6">Total Net</small>
                <h2 class="fw-bold text-success mt-2 mb-0">₱{{ number_format($totalNetDept, 2)}}</h2>
            </div>
        </div>
    </div>

    <!-- TOGGLE BUTTONS -->
    <div class="d-flex justify-content-center align-items-center gap-4 mb-4">

                <a class="nav-link nav-item-link active" href="#" onclick="showContainer('container1', this)">
                    Department
                </a>
            

                <a class="nav-link nav-item-link" href="#" onclick="showContainer('container2', this)">
                    Events
                </a>
 
    </div>
<hr style="border-top: 5px solid-1 black;"> 
    <!-- EMPLOYEES SECTION -->
    <div class="container mt-4"  id="container1" style="display: block;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Employees</h3>
                <p class="text-muted mb-0">{{ $employees->count() }} employees</p>
            </div>
            <div class="input-group" style="max-width: 145px;">

                <a href="{{ route('hr.Crud.add') }}" class="btn btn-primary">
                    + Add Employee
                </a>
            </div>
        </div>

        <div class="card border-0 rounded-4 overflow-hidden">
            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Employee</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Hire Date</th>
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
                                    <div class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                         style="width: 48px; height: 48px;">
                                        {{ strtoupper(substr($emp->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $emp->name }}</div>
                                        <small class="text-muted">{{ $emp->employee_number ?? '—' }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div>{{ $emp->user->email ?? '—' }}</div>
                                <small class="text-muted">{{ $emp->phone_number ?? '—' }}</small>
                            </td>

                            <td>
                                @if($emp->employee_role == 'head')
                                    <span class="badge bg-warning text-dark">Head</span>
                                @else
                                    <span class="badge bg-secondary">Employee</span>
                                @endif
                            </td>

                            <td>
                                {{ $emp->hire_date ? \Carbon\Carbon::parse($emp->hire_date)->format('M d, Y') : '—' }}
                            </td>

                            <td>
                                {{ $emp->payroll ? '₱' . number_format($emp->payroll->net_salary, 2) : '—' }}
                            </td>

                            <td class="text-center">
                                @if($emp->status == 'active' || !isset($emp->status))
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}"
                                   class="btn btn-sm btn-outline-primary me-1">
                                    View
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
      <!-- EVENTS SECTION -->
    <div class="container mt-4"  id="container2"  style="margin-left: 0%; display: none;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Events</h3>
        <a href="{{ route('hr.Crud.addEvent') }}" class="btn btn-primary">
                + Create Event
        </a>
        </div>

        <div class="card-container">
            @foreach($getEvents as $event)
            <div class="card card-item border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary text-white rounded p-2">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <small class="text-muted text-uppercase">
                                {{ str_replace('_', ' ', $event->event_type) }}
                            </small>
                        </div>

                        <div class="position-relative">
                            <span class="badge position-absolute top-0 end-0 m-2
                                @if($event->status == 'published') bg-success
                                @elseif($event->status == 'draft') bg-secondary
                                @else bg-danger
                                @endif">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                    </div>

                    <h5 class="fw-semibold mb-2">{{ $event->title }}</h5>
                    <h6 class="text-muted small mb-3">
                        {{ $event->department->name}} Department
                    </h6>
                    <p class="text-muted small mb-3">
                        {{ $event->description }}
                    </p>

                    <div class="small text-muted mb-3">
                        <div>
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y h:i A') }}
                        </div>
                        <div>
                            <i class="bi bi-geo-alt"></i>
                            {{ $event->location ?? 'N/A' }}
                        </div>
                        <div>
                            <i class="bi bi-people"></i>
                            Max: {{ $event->max_participants ?? 'Unlimited' }}
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-white d-flex justify-content-between">

                    <a href="{{ route('hr.EmployeesDetails.EventAttendances', $event->event_id) }}" class="btn btn-outline-primary btn-sm">
                        View Attendees
                    </a>

                    <div class="d-flex gap-1">
                        <a href="{{ route('hr.Crud.editEvent', $event->event_id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                    <form action="{{ route('hr.Crud.deleteEvent', $event->event_id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
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

/*  GLOBAL SEARCH FOR BOTH EMPLOYEES + EVENTS */
function globalSearch() {
    let input = document.getElementById("searchInput").value.toLowerCase();

    /* ---------------- EMPLOYEES ---------------- */
    let employeeRows = document.querySelectorAll("#container1 tbody tr");

    employeeRows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });

    /* ---------------- EVENTS ---------------- */
    let eventCards = document.querySelectorAll("#container2 .card-item");

    eventCards.forEach(card => {
        let text = card.innerText.toLowerCase();
        card.style.display = text.includes(input) ? "" : "none";
    });
}
</script>

</body>
</html>