@extends('layouts.apphr')

@section('title', 'Employees')

@section('content')
    <style>
        body {
            background-color: #f3f0f7 !important;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* CONTROLS */
        .controls-container {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.08);
            margin-bottom: 30px;
        }

        /* CLICKABLE CARD STYLE */
        .employee-link {
            text-decoration: none !important;
            display: block;
            height: 100%;
        }

        .employee-card .card {
            border: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: #ffffff;
            position: relative;
            cursor: pointer;
        }

        /* Big Box Hover Effect */
        .employee-link:hover .card {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(111, 66, 193, 0.12) !important;
            background-color: #fdfbff; /* Very slight purple tint on hover */
        }

        /* Profile Section */
        .profile-circle {
            width: 130px; /* Bigger box feel */
            height: 130px;
            border: 6px solid #f3f0f7;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin: 0 auto;
            background: #6f42c1;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .initials {
            font-size: 52px;
            font-weight: bold;
            color: white;
        }

        /* Typography */
        .emp-name {
            color: #2d1a4d;
            font-weight: 700;
            margin-top: 15px;
        }

        .emp-position {
            color: #6f42c1;
            background: #efebf7;
            display: inline-block;
            padding: 5px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .info-row {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        /* Add Button */
        .btn-add {
            background-color: #6f42c1;
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #5a32a3;
            color: white;
            transform: scale(1.02);
        }
    </style>


<div class="container py-5">
    <div class="col-lg-11 offset-lg-1">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold mb-0" style="color: #2d1a4d;">Employees</h1>
                <p class="text-muted">Click any card to manage employee details</p>
            </div>
            <a href="{{ route('hr.Crud.add') }}" class="btn-add shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Add New Employee
            </a>
        </div>

        <div class="controls-container">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-purple"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0" 
                               placeholder="Search name or position..." onkeyup="searchEmployees()">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" onchange="filterByDepartment()">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row" id="employeesGrid">
            @foreach($employees as $emp)
            <div class="col-md-6 col-xl-4 mb-4 employee-card"
                 data-name="{{ strtolower($emp->name) }}"
                 data-department="{{ $emp->position->department_id }}">
                
                <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}" class="employee-link">
                    <div class="card shadow-sm h-100 rounded-4 text-center p-4">
                        <div class="profile-container">
                            <div class="profile-circle rounded-circle">
                                @if($emp->profile_image || $emp->avatar)
                                    <img src="{{ $emp->profile_photo_path ?? $emp->avatar }}"
                                         alt="{{ $emp->name }}"
                                         class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="initials">{{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3">
                            <h4 class="emp-name mb-1">{{ $emp->name }}</h4>
                            <div class="emp-position">{{ $emp->position?->title ?? 'Staff Member' }}</div>
                            
                            <div class="info-row">
                                <i class="bi bi-envelope-at me-1"></i> {{ $emp->email }}
                            </div>
                            <div class="info-row">
                                <i class="bi bi-building me-1"></i> {{ $emp->position->department?->name ?? 'Unassigned' }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
<div class="mt-3 d-flex justify-content-center">
    {{ $employees->links() }}
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function searchEmployees() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.employee-card');

    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(searchInput) ? "" : "none";
    });
}

function filterByDepartment() {
    const departmentFilter = document.querySelector('.form-select').value;
    const cards = document.querySelectorAll('.employee-card');

    cards.forEach(card => {
        const department = card.getAttribute('data-department');
        if (departmentFilter === "" || department == departmentFilter) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}
</script>

