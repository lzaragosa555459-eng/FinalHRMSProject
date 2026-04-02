<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #EDF2FA;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@extends('hr.sidebar')

<div class="container mt-4">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">

            <h2 class="mb-0">Employees</h2>

            <div class="d-flex gap-2">

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeyup="searchEmployees()">
                </div>

                <button class="btn btn-primary rounded-pill" onclick="showAddModal()">
                    + Add Employee
                </button>

            </div>

        </div>
    </div>

    <!-- Grid -->
    <div class="row" id="employeesGrid">

        @foreach($employees as $emp)

        <div class="col-md-4 mb-4 employee-card" data-id="{{ $emp->id }}">

            <div class="card border-0 bg-white h-100 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-3">

                            <div class="rounded-circle d-flex justify-content-center align-items-center bg-secondary text-white"
                                 style="width:45px;height:45px;">
                                {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                            </div>

                            <div>
                                <h6 class="mb-0 fw-semibold">
                                    {{ $emp->name }} 
                                </h6>
                                <small class="text-muted">
                                    {{ $emp->position_id->title}}
                                </small>
                            </div>

                        </div>

                        <small class="text-muted">#{{ $emp->id }}</small>
                    </div>

                    <div class="text-muted small">
                        <div><strong>Email:</strong> {{ $emp->email }}</div>
                        <div><strong>Phone:</strong> {{ $emp->phone ?? '—' }}</div>
                        <div><strong>Dept:</strong> {{ $emp->department?->name ?? '—' }}</div>
                    </div>

                  <div class="d-flex justify-content-end gap-2 mt-3">
                        <!--  <button class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                onclick="editEmployee('{{ $emp->id }}')">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                onclick="deleteEmployee('{{ $emp->id }}')">
                            Delete
                        </button>-->
                         <button class="btn btn-sm btn-outline-primary rounded-pill px-3 ">
                            View
                    </button>
                    </div>

                   

                </div>
            </div>

        </div>

        @endforeach

    </div>
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
let modalInstance = new bootstrap.Modal(document.getElementById('employeeModal'));

function showAddModal() {
    modalInstance.show();
}

function closeModal() {
    modalInstance.hide();
}

function searchEmployees() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.employee-card');

    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(input) ? '' : 'none';
    });
}

function editEmployee(id) {
    alert("Edit employee: " + id);
    modalInstance.show();
}

function deleteEmployee(id) {
    if (confirm("Are you sure you want to delete employee " + id + "?")) {
        alert("Deleted (frontend only)");
    }
}

function saveEmployee() {
    alert("Save clicked (connect to backend later)");
    modalInstance.hide();
}
</script>

</body>
</html>
