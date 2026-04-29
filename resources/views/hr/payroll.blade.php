@extends('layouts.apphr')

@section('title', 'Payroll')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .text-purple { color: #6f42c1 !important; }
    .bg-purple { background-color: #6f42c1 !important; }
    
    .btn-purple {
        background-color: #6f42c1;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: white;
        transform: translateY(-1px);
    }
    .btn {
        font-size: 12px !important;
        padding: 6px 10px !important;
    }
    .card-summary {
        padding: 10px !important;
        border-radius: 10px !important;
    }

    .card-summary h4 {
        font-size: 30px;
        margin: 0;
    }

    .card-summary small {
        font-size: 11px;
    }
    .card-summary:hover {
        transform: scale(1.02);
    }

    .form-control:focus, .form-select:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
    }
    .form-control,
    .form-select {
        font-size: 13px !important;
        padding: 6px 10px !important;
    }

    label {
        font-size: 11px !important;
    }

    .table thead {
        background-color: #efebf7;
        color: #6f42c1;
    }

    .input-group-text {
        background-color: #efebf7;
        color: #6f42c1;
        border: none;
    }

    /* Customizing Summary Colors */
    .border-gross { border-left-color: #6c757d; }
    .border-deduction { border-left-color: #dc3545; }
    .border-net { border-left-color: #198754; }

    .table-sm td,
    .table-sm th {
        padding: 5px 8px !important;
        font-size: 12px;
    }

    .table thead th {
        font-size: 11px;
        font-weight: 600;
    }

    td small {
        font-size: 10px;
    }

    .badge {
        font-size: 10px;
        padding: 3px 6px;
    }

    td small {
        font-size: 11px;
    }
    h2 {
    font-size: 20px;
    }

    h5 {
        font-size: 14px;
    }
    .row {
        margin-bottom: 10px !important;
    }

    .mb-3 {
        margin-bottom: 8px !important;
    }

    .mb-4 {
        margin-bottom: 12px !important;
    }
</style>
    
    <div class="container">
        <div class="col-lg-11 offset-lg-1 mb-5 mt-4 text-center text-lg-start">
            <h2 class="fw-bold mb-4" style="color: #2d1a4d;">Payroll Management</h2>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 card-summary border-gross">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="bg-light p-3 rounded-3 me-3">
                                <i class="bi bi-wallet2 text-secondary fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Overall Total Gross</small>
                                <h4 class="fw-bold text-dark mb-0">₱{{ number_format($totalgross, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 card-summary border-deduction ">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="bg-danger-subtle p-3 rounded-3 me-3">
                                <i class="bi bi-graph-down-arrow text-danger fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Overall Deductions</small>
                                <h4 class="fw-bold text-danger mb-0">₱{{ number_format($totaldeduction, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 card-summary border-net">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="bg-success-subtle p-3 rounded-3 me-3">
                                <i class="bi bi-cash-stack text-success fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Overall Total Net</small>
                                <h4 class="fw-bold text-success mb-0">₱{{ number_format($totalnet, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <h5 class="mb-4 fw-bold text-purple"><i class="bi bi-plus-circle-fill me-2"></i>Add Payroll</h5>
                        <form action="{{ route('hr.AddPayroll') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Employee</label>
                                <select class="form-select rounded-3" id="employee_id" name="employee_id">
                                    <option selected disabled>Select Employee</option>
                                    @foreach($employees as $emp)
                                        <option value="{{ $emp->employee_id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Basic Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">₱</span>
                                    <input type="number" class="form-control border-start-0" placeholder="0.00" id="basic_salary" name="basic_salary">
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-3">  
                                    <label class="form-label small fw-bold text-muted">Period Start</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0" placeholder="period start" id="period_start" name="period_start">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Period End</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0" placeholder="period end" id="period_end" name="period_end">
                                    </div>
                                </div> 
                            </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">Allowances</label>
                                    <input type="number" class="form-control" placeholder="0.00" id="allowances" name="allowances">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Pay Date</label>
                                <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar"></i>
                                </span>
                                <input type="text" class="form-control" id="pay_date" name="pay_date" placeholder="Enter pay date">
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-purple py-2 fw-bold text-white" style="background-color: #2d1a4d;">
                                    <i class="bi bi-check-lg me-1"></i> Submit Payroll
                                </button>
                                <button type="reset" class="btn btn-light border py-2">
                                    Clear Fields
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="d-flex gap-3 mb-3">
                        <div class="input-group custom-search">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>    
                            </span>
                        
                            <input type="text" id="searchInput" class="form-control border-0" placeholder="Search employee..." onkeyup="searchEmployees()">
                        </div>
                        
                        <select id="departmentFilter" class="form-select w-auto shadow-sm border-0 rounded-3" style="min-width: 220px;" onchange="searchEmployees()">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="table-responsive" style="max-height: 540px;">
                            <table class="table table-hover table-sm align-middle mb-0 small">
                                <thead class="position-sticky top-0">
                                    <tr>
                                        <th>Department</th>
                                        <th class="ps-4">Employee</th>
                                        <th>Period</th>
                                        <th>Basic (Computed)</th>
                                        <th>Allowances</th>
                                        <th>Gross salary</th>
                                        <th>Deductions</th>
                                        <th>Net Salary</th>
                                        <th>Pay date</th>
                                        <th class="pe-4">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @foreach($payrolls as $payroll)
                                    <tr data-dept="{{ $payroll->employee->department_id }}">
                                        <td>
                                            <div class="fw-bold text-secondary">{{ $payroll->employee->position->department->name }}</div>
                                        </td>   
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $payroll->employee->name }}</div>
                                        </td>

                                        <td>
                                            <small class="text-muted">
                                                {{ $payroll->period_start }} <br>
                                                → {{ $payroll->period_end }}
                                            </small>
                                        </td>

                                        <td>
                                            ₱{{ number_format($payroll->basic_salary, 2) }}
                                        </td>

                                        <td class="text-primary">
                                            +₱{{ number_format($payroll->allowances, 2) }}
                                        </td>

                                        <td class="text-primary">
                                            +₱{{ number_format($payroll->gross_salary, 2) }}
                                        </td>


                                        <td class="text-danger">
                                            -₱{{ number_format($payroll->deduction, 2) }}
                                        </td>

                                        <td>
                                            <span class="badge-subtle text-success fs-6 rounded-pill px-3">
                                                ₱{{ number_format($payroll->net_salary, 2) }}
                                            </span>
                                        </td>
                                        <td>{{ $payroll->pay_date}}</td>
                                        <td class="pe-4 align-middle">
                                            <div class="d-flex flex-row gap-2 justify-content-center align-items-center" style="min-height: 34px;">

                                                <button type="button"
                                                    class="btn btn-sm btn-light border d-flex align-items-center justify-content-center p-0"
                                                    style="width: 34px; height: 34px; flex-shrink: 0;"
                                                    onclick="editEmployee(
                                                        '{{ $payroll->employee->employee_id }}',
                                                        '{{ $payroll->basic_salary }}',
                                                        '{{ $payroll->period_start }}',
                                                        '{{ $payroll->period_end }}',
                                                        '{{ $payroll->allowances }}',
                                                        '{{ $payroll->pay_date }}'
                                                    )">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <form action="{{ route('delete.payroll', $payroll->payroll_id) }}"
                                                    method="POST"
                                                    class="m-0 d-flex align-items-center">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-sm btn-light border text-danger d-flex align-items-center justify-content-center p-0"
                                                        style="width: 34px; height: 34px; flex-shrink: 0;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <tfoot>        
                                    <tr>
                                        <td class="colspan=6 mt-4">
                                            <div class="mt-3 d-flex justify-content-end me-4">
                                                {{ $payrolls->links() }}
                                            </div>
                                        </td>
                                    </tr>
                            </tfoot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
function editEmployee(employee_id, basic_salary, period_start, period_end, allowances, paydate){
    document.getElementById('employee_id').value = employee_id;
    document.getElementById('basic_salary').value = basic_salary;
    document.getElementById('period_start').value = period_start;
    document.getElementById('period_end').value = period_end;
    document.getElementById('allowances').value = allowances;
    document.getElementById('pay_date').value = paydate;
}

function searchEmployees(){
    let input = document.getElementById("searchInput").value.toLowerCase();
    let filterDept = document.getElementById("departmentFilter").value;
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        let dept = row.getAttribute("data-dept");
        let matchText = text.includes(input);
        let matchDept = (filterDept === "" || dept === filterDept);
        row.style.display = (matchText && matchDept) ? "" : "none";
    });
}
document.getElementById('employee_id').addEventListener('change', function () {
    let employeeId = this.value;

    if (employeeId) {
        fetch('/employee/' + employeeId)
            .then(response => response.json())
            .then(data => {
                console.log(data); 

                document.getElementById('basic_salary').value = data.basic_salary;
            });
    }
});
</script>
