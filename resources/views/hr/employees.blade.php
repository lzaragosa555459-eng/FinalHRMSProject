<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Employees</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #EDF2FA;">
@extends('hr.sidebar')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<div class="container mt-4 ">

    <!-- Header -->
    <div class="row mb-4 ">
        <div class="col-12  d-flex justify-content-end align-items-center p-4 " >

          

            <div class="d-flex gap-2 ">

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput"
                        class="form-control"
                        placeholder="Search..."
                        onkeyup="searchEmployees()">
                </div>
                
                
                <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-filter"></i>
                            </span>
                      
                            <select class="form-select" onchange="filterByDepartment()">
                                <option value="">All Departments</option>

                                @foreach($departments as $dept)
                                    <option value="{{ $dept->department_id }}">
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


            </div>

        </div>
    </div>
<hr style="border-top: 5px solid-1 black;"> 
    <div class="row">
        <div class="col-12  d-flex justify-content-between align-items-center p-4 " >
              <h2 class="my-4">Employees</h2>
      
                <a href="{{ route('hr.Crud.add') }}" class="btn btn-primary">
                    +Add Employee
                </a>
        </div>
    </div>
   <!-- Grid -->
<div class="row" id="employeesGrid">
    @foreach($employees as $emp)

   <div class="col-md-4 mb-4 employee-card"
     data-name="{{ strtolower($emp->name) }}"
     data-email="{{ strtolower($emp->email) }}"
     data-position="{{ strtolower($emp->position?->title ?? '') }}"
     data-department="{{ $emp->position->department_id }}">
        <div class="card border-0 shadow-sm h-100 rounded-4 text-center p-4">

            <!-- Big Circle Profile Picture - Centered -->
            <div class="d-flex justify-content-center mb-4">
                <div class="rounded-circle overflow-hidden shadow border border-white"
                     style="width: 110px; height: 110px; border-width: 5px;">
                    
                    @if($emp->profile_image || $emp->avatar)
                        <img src="{{ $emp->profile_photo_path ?? $emp->avatar }}"
                             alt="{{ $emp->name }}"
                             class="w-100 h-100 object-fit-cover">
                    @else
                        <!-- Fallback: Initial -->
                        <div class="w-100 h-100 bg-primary text-white d-flex justify-content-center align-items-center"
                             style="font-size: 42px;">
                            {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                    
                </div>
            </div>

            <!-- Name at the Bottom -->
            <h5 class="fw-semibold mb-1 text-dark">
                {{ $emp->name }}
            </h5>

            <!-- Position -->
            <small class="text-muted d-block mb-3">
                {{ $emp->position?->title ?? 'Staff' }}
            </small>

            <!-- Short Info -->
            <div class="text-muted small text-center mb-4">
                <div class="mb-1">{{ $emp->email }}</div>
                <div>{{ $emp->position->department?->name ?? '—' }}</div>
            </div>

            <!-- Action Button -->
            <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}"
               class="btn btn-primary btn-sm rounded-pill px-4 py-2">
                View Profile
            </a>

        </div>
    </div>

    @endforeach
</div>


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

</body>
</html>
