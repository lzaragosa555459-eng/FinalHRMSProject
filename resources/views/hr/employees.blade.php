@extends('hr.sidebar')
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<div class="container mt-4" style="margin-left: 9%;">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center p-4 rounded-4" style="background-color: #a2aab6;">

            <h2 class="mb-0">Employees</h2>

            <div class="d-flex gap-2 ">

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeyup="searchEmployees()">
                </div>
                
                
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Select Option
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Option 2</a></li>
                        <li><a class="dropdown-item" href="#">Option 3</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary" onclick="showAddModal()">
                    +Add_Employee
                </button>

            </div>

        </div>
    </div>

    <!-- Grid -->
   <div class="row" id="employeesGrid">
    @foreach($employees as $emp)

    <div class="col-md-4 mb-4 employee-card" data-id="{{ $emp->id }}">
        <div class="card border-0 shadow-sm h-100 rounded-4 text-center p-4 position-relative">

            <!-- Avatar (Top Center) -->
            <div class="d-flex justify-content-center">
                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center shadow"
                     style="width:80px; height:80px; font-size:28px; margin-top:-50px; border:4px solid #fff;">
                    {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                </div>
            </div>

            <!-- Name -->
            <h5 class="mt-3 mb-1 fw-semibold">
                {{ $emp->name }}
            </h5>

            <!-- Position -->
            <small class="text-muted d-block mb-3">
                {{ $emp->position?->title ?? 'Staff' }}
            </small>

            <!-- Info -->
            <div class="text-muted small text-start px-2">
                <div class="mb-1"><strong>Email:</strong> {{ $emp->email }}</div>
                <div class="mb-1"><strong>Phone:</strong> {{ $emp->phone_number ?? '—' }}</div>
                <div class="mb-1"><strong>Department:</strong> {{ $emp->department?->name ?? '—' }}</div>
            </div>

            <!-- Action -->
            <div class="mt-3">
                <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}"
                   class="btn btn-primary btn-sm rounded-pill px-4">
                    View Profile
                </a>
            </div>

        </div>
    </div>

    @endforeach
</div>

<!-- Modal -->
<div id="employeeModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">Add / Edit Employee</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>

            <div class="modal-body">

                <form id="employeeForm">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" id="first_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="last_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" id="phone" class="form-control">
                        </div>

                    </div>
                </form>

            </div>

            <div class="modal-footer border-0">
                <button class="btn btn-light rounded-pill px-4" onclick="closeModal()">Cancel</button>
                <button class="btn btn-primary rounded-pill px-4" onclick="saveEmployee()">Save</button>
            </div>

        </div>
    </div>
</div>

<script>


function searchEmployees() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.employee-card');

    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(input) ? '' : 'none';
    });
}



</script>

</body>
</html>
