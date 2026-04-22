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

    .card-summary {
        transition: transform 0.2s ease;
        border-left: 4px solid #6f42c1;
    }

    .card-summary:hover {
        transform: scale(1.02);
    }

    .form-control:focus, .form-select:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
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
</style>
    
    <div class="container p-4">
        <div class="col-lg-11 offset-lg-1 mb-5 mt-4 text-center text-lg-start">
            <h2 class="fw-bold mb-4" style="color: #2d1a4d;">Payroll Management</h2>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 card-summary border-gross">
                        <div class="d-flex align-items-center">
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
                    <div class="card border-0 shadow-sm rounded-4 p-3 card-summary border-deduction">
                        <div class="d-flex align-items-center">
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
                        <div class="d-flex align-items-center">
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
                                    <label class="form-label small fw-bold text-muted">Allowances</label>
                                    <input type="number" class="form-control" placeholder="0.00" id="allowances" name="allowances">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted">Deductions</label>
                                    <input type="number" class="form-control" placeholder="0.00" id="deduction" name="deduction">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Pay Date</label>
                                <input type="date" class="form-control" id="pay_date" name="pay_date">
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
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <span class="input-group-text border-0"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchInput" class="form-control border-0" placeholder="Search employee..." onkeyup="searchEmployees()">
                        </div>
                        
                        <select id="departmentFilter" class="form-select w-auto shadow-sm border-0 rounded-3" onchange="searchEmployees()">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="table-responsive" style="max-height: 540px;">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="position-sticky top-0">
                                    <tr>
                                        <th class="ps-4">Employee</th>
                                        <th>Basic</th>
                                        <th>Allowances</th>
                                        <th>Deductions</th>
                                        <th>Net Salary</th>
                                        <th class="pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payrolls as $payroll)
                                    <tr data-dept="{{ $payroll->employee->department_id }}">
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $payroll->employee->name }}</div>
                                            <small class="text-muted">{{ $payroll->pay_date }}</small>
                                        </td>
                                        <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
                                        <td class="text-primary">+₱{{ number_format($payroll->allowances, 2) }}</td>
                                        <td class="text-danger">-₱{{ number_format($payroll->deduction, 2) }}</td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success fs-6 rounded-pill px-3">
                                                ₱{{ number_format($payroll->net_salary, 2) }}
                                            </span>
                                        </td>
                                        <td class="pe-4">
                                            <div class="d-flex gap-2 justify-content-center align-items-center">

                                                <button type="button"
                                                    class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center"
                                                    style="width: 34px; height: 34px;"
                                                    onclick="editEmployee('{{ $payroll->employee->employee_id }}','{{ $payroll->basic_salary }}','{{ $payroll->allowances }}','{{ $payroll->deduction }}','{{ $payroll->pay_date }}')">
                                                    <i class="bi bi-pencil fs-6"></i>
                                                </button>

                                                <form action="{{ route('delete.payroll', $payroll->payroll_id) }}" method="POST"
                                                    class="m-0">
                                                    @csrf @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center text-danger"
                                                        style="width: 34px; height: 34px;">
                                                        <i class="bi bi-trash fs-6"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
</script>
