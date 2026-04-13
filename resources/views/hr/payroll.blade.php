<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Document</title>
</head>
<body style="background-color: #EDF2FA;">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   @extends('hr.sidebar')
    <div class="container mt-4" style="margin-left: 9%;">
        <h2 class="mb-0">Payroll</h2>
        <div class="row">
         

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <!-- Total Gross -->
        <div class="col-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <small class="text-muted">Overall Total Gross</small>
                <h5 class="fw-bold text-secondary mb-0">₱{{ number_format($totalgross, 2) }}</h5>
            </div>
        </div>

        <!-- Total Deductions -->
        <div class="col-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <small class="text-muted">Overall Deductions</small>
                <h5 class="fw-bold text-danger mb-0">₱{{ number_format($totaldeduction, 2) }}</h5>
            </div>
        </div>
        <!-- Total Net -->
            <div class="col-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                    <small class="text-muted">Overall Total Net</small>
                <h5 class="fw-bold text-success mb-0">₱{{ number_format($totalnet, 2)}}</h5>
            </div>
         </div>        
    </div>
        
        <div class="row">
            <div class="col-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">

                    <h5 class="mb-3 fw-semibold">Add Payroll</h5>
                        <form action="{{ route('hr.AddPayroll') }}" method="POST">
                            @csrf
                                 <!-- Employee -->
                                <div class="mb-3">
                                    <label class="form-label">Employee</label>
                                    <select class="form-select" id="employee_id" name="employee_id">
                                        <option selected disabled>Select Employee</option>
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->employee_id }}">{{ $emp->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <!-- Basic Salary -->
                                <div class="mb-3">
                                    <label class="form-label">Basic Salary</label>
                                    <input type="number" class="form-control" placeholder="Enter basic salary" id="basic_salary" name="basic_salary">
                                </div>

                                <!-- Allowances -->
                                <div class="mb-3">
                                    <label class="form-label">Allowances</label>
                                    <input type="number" class="form-control" placeholder="Enter allowances" id="allowances" name="allowances">
                                </div>

                                <!-- Deductions -->
                                <div class="mb-3">
                                    <label class="form-label">Deductions</label>
                                    <input type="number" class="form-control" placeholder="Enter deductions" id="deduction" name="deduction">
                                </div>

                                <!-- Pay Date -->
                                <div class="mb-3">
                                    <label class="form-label">Pay Date</label>
                                    <input type="date" class="form-control" id="pay_date" name="pay_date">
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex gap-2 mt-3">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-plus-circle me-1"></i> Submit
                                    </button>

                                    <button class="btn btn-light border w-100">
                                        Clear
                                    </button>
                                </div>
                        </form>
                </div>
            </div>
            
            <div class="col-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeyup="searchEmployees()">
                <div class="dropdown ms-4">
                    <select name="" id="departmentFilter" class="form-select w-auto" onchange="searchEmployees()">
                        <option value="">All Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <br>
                <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Employee</th>
                                    <th>Basic Salary</th>
                                    <th>Allowances</th>
                                    <th>Deductions</th>
                                    <th>Net Salary</th>
                                    <th>Pay Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($payrolls as $payroll)
                                <tr data-dept="{{ $payroll->employee->department_id }}">

                                    <td>{{ $payroll->employee->name }}</td>

                                    <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
                                    <td>₱{{ number_format($payroll->allowances, 2) }}</td>
                                    <td>₱{{ number_format($payroll->deduction, 2) }}</td>

                                    <td class="fw-bold text-success">
                                        ₱{{ number_format($payroll->net_salary, 2) }}
                                    </td>

                                    <td>{{ $payroll->pay_date }}</td>

                                    <td class="d-flex">

                                        <!-- FIXED BUTTON -->
                                        <button 
                                            type="button"
                                            class="btn btn-light border btn-sm me-2"
                                            onclick="editEmployee(
                                                '{{ $payroll->employee->employee_id }}',
                                                '{{ $payroll->basic_salary }}',
                                                '{{ $payroll->allowances }}',
                                                '{{ $payroll->deduction }}',
                                                '{{ $payroll->pay_date }}'
                                            )">
                                            <i class="bi bi-pencil"></i>
                                            </button>
                                        <form action="{{ route('delete.payroll', $payroll->payroll_id) }}" method="POST" onsubmit="return confirm('Delete this payroll?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger border btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
            </div>
        </div>
    </div>
<script>
function editEmployee(employee_id, basic_salary, allowances, deduction, paydate){

    document.getElementById('employee_id').value = employee_id;
    document.getElementById('basic_salary').value = basic_salary;
    document.getElementById('allowances').value = allowances;
    document.getElementById('deduction').value = deduction;
    document.getElementById('pay_date').value = paydate;

}
function editEmployee(employee_id, basic_salary, allowances, deduction, paydate){

    document.getElementById('employee_id').value = employee_id;
    document.getElementById('basic_salary').value = basic_salary;
    document.getElementById('allowances').value = allowances;
    document.getElementById('deduction').value = deduction;
    document.getElementById('pay_date').value = paydate;

}

// SEARCH + FILTER FUNCTION
function searchEmployees(){
    let input = document.getElementById("searchInput").value.toLowerCase();
    let filterDept = document.getElementById("departmentFilter").value;

    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        let dept = row.getAttribute("data-dept");

        let matchText = text.includes(input);
        let matchDept = (filterDept === "" || dept === filterDept);

        if(matchText && matchDept){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>
</body>
</html>