<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Organization</title>

    <style>
        body {
            background-color: #f3f0f7 !important; /* Soft Lavender Background */
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .nav-item-link {
            position: relative;
            transition: color 0.3s ease;
            color: #6c757d;
            font-weight: 500;
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

        /* Active state in Purple */
        .nav-item-link.active {
            color: #6f42c1 !important;
            font-weight: 700;
        }

        .nav-item-link.active::after {
            width: 100%;
        }

        /* Big Box Department Card */
        .department-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: none !important;
            background: white;
        }

        .department-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(111, 66, 193, 0.12) !important;
        }

        .text-purple { color: #6f42c1 !important; }
        .bg-purple-subtle { background-color: #efebf7 !important; color: #6f42c1 !important; }
        
        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .btn-purple:hover {
            background-color: #5a32a3;
            color: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
        }
    </style>
</head>

<body>
@extends('hr.sidebar')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-4">
    <div class="col-lg-11 offset-lg-1">
        
        <nav class="navbar navbar-expand-lg mb-4 bg-white rounded-4 shadow-sm px-4">
            <div class="container-fluid p-0">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4">
                        <a class="nav-link nav-item-link active" href="#" onclick="showContainer('container1', this)">
                            Departments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-item-link" href="#" onclick="showContainer('container2', this)">
                            Events
                        </a>
                    </li>
                </ul>

                <div class="d-flex gap-3 align-items-center">
                    <div class="input-group" style="max-width: 250px;">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-purple"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search..." onkeyup="globalSearch()">
                    </div>
                    
                    <select class="form-select" id="departmentFilter" onchange="filterDepartments()" style="max-width: 200px;">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ strtolower($dept->name) }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </nav>

        <div class="mb-5 mt-4">
            <h1 class="fw-bold" style="color: #2d1a4d;">Organization</h1>
            <p class="text-muted">Manage company hierarchy and upcoming activities</p>
        </div>

        <div id="container1" style="display: block;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Departments</h3>
                <a href="{{ route('departmentsForm') }}" class="btn-purple text-decoration-none">+ Add Department</a>
            </div>

            <div class="row g-4">
                @foreach($departments as $dept)
                <div class="col-md-6 col-lg-4 department-item">
                    <div class="card department-card shadow-sm h-100 rounded-4 p-4">
                        <a href="{{ route('hr.EmployeesDetails.employee_by_department', $dept->department_id) }}" class="text-decoration-none">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-purple-subtle rounded-3 p-3">
                                        <i class="bi bi-building-fill fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold text-dark">{{ $dept->name }}</h5>
                                        <small class="text-muted">ID: #{{ $dept->department_number }}</small>
                                    </div>
                                </div>
                                @if($dept->employees_count > 0)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">Operational</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">Empty</span>
                                @endif
                            </div>

                            <p class="text-muted small mb-4" style="min-height: 40px;">
                                {{ $dept->description ?? 'Strategic unit handling organizational objectives.' }}
                            </p>

                            <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <small class="text-muted d-block">Team Size</small>
                                    <h4 class="mb-0 fw-bold text-purple">{{ $dept->employees_count ?? 0 }}</h4>
                                </div>
                                <i class="bi bi-people-fill text-purple opacity-50 fs-3"></i>
                            </div>
                        </a>

                        <div class="d-flex gap-2 pt-2 border-top">
                            <a href="{{ route('departmentsForm', $dept->department_id) }}" class="btn btn-outline-warning border-0 btn-sm">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('deleteDepartment', $dept->department_id) }}" method="POST" class="ms-auto">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger border-0 btn-sm" onclick="return confirm('Delete department?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

<div id="container2" style="display: none;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Upcoming Events</h3>
        <a href="{{ route('hr.Crud.addEvent') }}" class="btn-purple text-decoration-none shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Create Event
        </a>
    </div>

    <div class="row g-4">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4 event-item">
            <a href="{{ route('hr.EmployeesDetails.EventAttendances', $event->event_id) }}" class="text-decoration-none">
                <div class="card department-card shadow-sm h-100 rounded-4 overflow-hidden border-0">
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="bg-purple-subtle px-3 py-1 rounded-pill small fw-bold">
                                {{ str_replace('_', ' ', $event->event_type) }}
                            </div>
                            <span class="badge @if($event->status == 'published') bg-success @else bg-secondary @endif">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>

                        <h5 class="fw-bold text-dark mb-1">{{ $event->title }}</h5>
                        <p class="text-purple small mb-3 fw-semibold">{{ $event->department->name }} Department</p>
                        
                        <p class="text-muted small mb-4" style="min-height: 48px;">
                            {{ Str::limit($event->description, 90) }}
                        </p>

                        <div class="p-3 rounded-3 bg-light mb-0">
                            <div class="small text-dark mb-2">
                                <i class="bi bi-calendar3 me-2 text-purple"></i> 
                                {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y • h:i A') }}
                            </div>
                            <div class="small text-dark">
                                <i class="bi bi-geo-alt-fill me-2 text-purple"></i> 
                                {{ $event->location ?? 'Headquarters' }}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                        <span class="text-purple small fw-bold">Click to view attendees <i class="bi bi-arrow-right ms-1"></i></span>
                        
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-light border" 
                                    onclick="event.preventDefault(); window.location.href='{{ route('hr.Crud.editEvent', $event->event_id) }}';">
                                <i class="bi bi-pencil"></i>
                            </button>
                            
                            <form action="{{ route('hr.Crud.deleteEvent', $event->event_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" 
                                        onclick="event.stopPropagation(); return confirm('Delete event?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

    </div>
</div>

<script>
function showContainer(id, el) {
    document.getElementById('container1').style.display = 'none';
    document.getElementById('container2').style.display = 'none';
    document.getElementById(id).style.display = 'block';

    document.querySelectorAll('.nav-item-link').forEach(link => link.classList.remove('active'));
    el.classList.add('active');
}

function globalSearch() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    document.querySelectorAll(".department-item, .event-item").forEach(card => {
        card.style.display = card.innerText.toLowerCase().includes(input) ? "" : "none";
    });
}

function filterDepartments() {
    let value = document.getElementById("departmentFilter").value.toLowerCase();
    document.querySelectorAll(".department-item, .event-item").forEach(card => {
        card.style.display = (value === "" || card.innerText.toLowerCase().includes(value)) ? "" : "none";
    });
}
</script>
</body>
</html>