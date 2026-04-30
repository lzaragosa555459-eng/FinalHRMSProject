@extends('layouts.apphr')

@section('title', 'Organization')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .nav-item-link {
        position: relative;
        transition: color 0.3s ease;
        color: #6c757d;
        font-weight: 500;
        cursor: pointer;
    }

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

    .nav-item-link.active {
        color: #6f42c1 !important;
        font-weight: 700;
    }

    .nav-item-link.active::after { width: 100%; }

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
    
    .btn-purple:hover { background-color: #5a32a3; color: white; }

    .card-modern {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .header-accent {
        background: linear-gradient(135deg, #6f42c1 0%, #8965d4 100%);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .member-count-badge {
        background: white;
        color: #6f42c1;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 0.85rem;
    }

    .btn-soft {  color: #6f42c1; border: none; }
    .btn-soft:hover { background: #6f42c1; color: white; }
    
    @media (max-width: 768px) {
        .navbar-nav { flex-direction: row !important; justify-content: center; gap: 15px; }
        .custom-search { width: 100% !important; }
        #departmentFilter { max-width: 100% !important; width: 100%; }
    }
/* 📱 iPhone / Mobile Fix */
@media (max-width: 576px) {

    h1 {
        font-size: 1.5rem;
        text-align: center;
    }

    .navbar {
        flex-direction: column !important;
        gap: 10px;
    }

    .navbar-nav {
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .nav-item-link {
        font-size: 0.9rem;
    }

    .custom-search,
    #departmentFilter {
        width: 100% !important;
    }

    .btn-purple {
        width: 100%;
        text-align: center;
    }

    .department-card,
    .card {
        border-radius: 12px;
    }

    .header-accent {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .icon-circle {
        width: 38px;
        height: 38px;
    }

    .member-count-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }

    .col-md-6.col-lg-4 {
        padding-left: 8px;
        padding-right: 8px;
    }

    .card-body {
        padding: 15px !important;
    }

    .p-4 {
        padding: 1rem !important;
    }

    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
}
@media (max-width: 576px) {
    .department-item,
    .event-item {
        width: 100%;
    }
}
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            
            <div class="mb-5 mt-2 text-center text-lg-start">
                <h1 class="fw-bold" style="color: #2d1a4d;">Organization</h1>
                <p class="text-muted mb-0">Manage company hierarchy and upcoming activities</p>
            </div>

            <nav class="navbar navbar-expand-lg mb-4 bg-white rounded-4 shadow-sm px-3 py-3">
                <div class="container-fluid p-0 d-flex justify-content-between align-items-center flex-wrap">
                    <ul class="navbar-nav d-flex flex-row gap-4 mb-3 mb-lg-0">
                        <li class="nav-item">
                            <span class="nav-link nav-item-link active" onclick="showContainer('container1', this)">Departments</span>
                        </li>   
                        <li class="nav-item">
                            <span class="nav-link nav-item-link" onclick="showContainer('container2', this)">Events</span>
                        </li>
                    </ul>

                    <div class="d-flex flex-column flex-lg-row gap-2 align-items-stretch align-items-lg-center w-100 w-lg-auto justify-content-end mt-3">
                        <div class="input-group custom-search shadow-sm rounded-3 overflow-hidden w-100">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-0" placeholder="Search..." onkeyup="globalSearch()">
                        </div>

                        <select class="form-select shadow-sm border-0" id="departmentFilter" style="max-width: 180px;" onchange="filterDepartments()">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ strtolower($dept->name) }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </nav>

            <div id="container1" style="display: block;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Departments</h3>
                    <a href="{{ route('departmentsForm') }}" class="btn-purple text-decoration-none shadow-sm">+ Add Department</a>
                </div>

                <div class="row g-4">
                    @foreach($departments as $dept)
                    <div class="col-md-6 col-lg-4 department-item">
                        <div class="card card-modern shadow-sm rounded-4 h-100">
                            <div class="header-accent">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle rounded-3">
                                        <i class="bi bi-building-fill text-white fs-5"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0 ms-2 text-white">{{ $dept->name }}</h5>      
                                </div>
                                <div class="member-count-badge">
                                    <i class="bi bi-people-fill me-1"></i>{{ $dept->employees_count ?? 0 }}
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <a href="{{ route('hr.EmployeesDetails.employee_by_department', $dept->department_id) }}" class="text-decoration-none">
                                    <p class="text-muted small mb-0" style="min-height: 40px;">
                                        {{ $dept->description ?? 'Strategic unit focused on organizational excellence.' }}
                                    </p>
                                </a>

                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('departmentsForm', $dept->department_id) }}" class="btn btn-sm btn-soft rounded-3 px-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('deleteDepartment', $dept->department_id) }}" method="POST" class="m-0">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-soft btn-soft-danger rounded-3 px-3" onclick="return confirm('Delete department?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @if($dept->employees_count > 0)
                                        <span class="small fw-bold text-purple" style="font-size: 0.7rem;">
                                            <i class="bi bi-check-circle-fill me-1"></i>ACTIVE
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">{{ $departments->links() }}</div>
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
                        <div class="card shadow-sm h-100 rounded-4 border-0 overflow-hidden">
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
                                <p class="text-purple small mb-3 fw-semibold">{{ $event->department->name }}</p>
                                <p class="text-muted small mb-4" style="min-height: 48px;">{{ Str::limit($event->description, 90) }}</p>
                                <div class="p-3 rounded-3 bg-light">
                                    <div class="small text-dark mb-1"><i class="bi bi-calendar3 me-2 text-purple"></i> {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y • h:i A') }}</div>
                                    <div class="small text-dark"><i class="bi bi-geo-alt-fill me-2 text-purple"></i> {{ $event->location ?? 'Headquarters' }}</div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('hr.EmployeesDetails.EventAttendances', $event->event_id) }}" class="text-decoration-none small fw-bold text-purple">View Attendees <i class="bi bi-arrow-right"></i></a>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('hr.Crud.editEvent', $event->event_id) }}" class="text-secondary"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('hr.Crud.deleteEvent', $event->event_id) }}" method="POST" class="d-inline m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0 text-danger" onclick="return confirm('Delete event?');"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">{{ $events->links() }}</div>
            </div>

        </div> </div> </div> <script>
function showContainer(id, el) {
    document.getElementById('container1').style.display = 'none';
    document.getElementById('container2').style.display = 'none';
    document.getElementById(id).style.display = 'block';

    document.querySelectorAll('.nav-item-link').forEach(link => link.classList.remove('active'));
    el.classList.add('active');
    sessionStorage.setItem('activeTab', id);
}

window.onload = function () {
    let activeTab = sessionStorage.getItem('activeTab');
    if (activeTab) {
        let links = document.querySelectorAll('.nav-item-link');
        if (activeTab === 'container2') {
            showContainer('container2', links[1]);
        } else {
            showContainer('container1', links[0]);
        }
    }
};

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
@endsection