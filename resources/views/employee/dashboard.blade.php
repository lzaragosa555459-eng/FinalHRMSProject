@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important; /* Soft purple-grey background */
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* FLAT CARDS */
    .card {
        border: none !important;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        border-radius: 16px;
        transition: transform 0.2s;
        background-color: #ffffff;
    }

    /* PURPLE THEME CLASSES */
    .card-purple { background-color: #6f42c1 !important; color: white !important; }
    .card-purple-light { background-color: #e2d9f3 !important; color: #4b208c !important; }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .big-card { padding: 25px !important; }
    .tight { margin-bottom: 20px !important; }

    .navbar-custom {
        background: #ffffff;
        border-radius: 16px;
        padding: 15px 25px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05);
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: white;
        border-radius: 12px;
        padding: 10px 20px;
        border: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: white;
    }

    @media (max-width: 768px) {
        .big-card { padding: 15px !important; }
    }
</style>

<div class="container">
    <div class="col-lg-11 offset-lg-1">
        
        <div class="navbar-custom tight mt-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle text-white d-flex justify-content-center align-items-center fw-bold me-3" style="width:45px;height:45px;">
                    <img src="{{ asset('logo.png') }}" height="35" alt="Logo"> 
                </div>
                <div>
                    <h4 class="mb-0 fw-bold" style="color: #2d1a4d;">Welcome, {{ $user->employee->name }}</h4>
                    <small class="text-muted text-uppercase fw-bold">{{ $user->employee->position->title }}</small>
                </div>
            </div>
            <div class="ms-auto d-none d-md-block">
                <div class="text-end">
                    <h6 class="mb-0 fw-bold" style="color: #6f42c1;">{{ date('l, M d, Y') }}</h6>
                    <small class="text-muted">ID: #{{ $user->employee->employee_number }}</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-4">
                <div class="card big-card text-center shadow-sm h-100">
                    <div class="d-flex justify-content-center align-items-center mb-3">

                        <div class="rounded-circle overflow-hidden"
                            style="width:140px;height:140px;background:#6f42c1;">

                            @php($emp = $user->employee)

                            @if($emp && $emp->profile_image)
                                <img src="{{ asset('uploads/employees/' . $emp->profile_image) }}"
                                    style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center text-white fw-bold fs-2">
                                    {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif

                        </div>

                    </div>
                    <h4 class="fw-bold mb-1">{{ $user->employee->name }}</h4>
                    <p class="text-muted small mb-4">{{ $user->email }}</p>
                    
                    <div class="status-badge bg-purple-light mb-4">
                        {{ $user->employee->position->department->name }}
                    </div>

                    <div class="text-start border-top pt-4">
                        <p class="text-muted small text-uppercase fw-bold mb-2">Quick Actions</p>
                        <a href="{{ route('payroll.downloadSlip', $user->employee->payroll->payroll_id) }}"
                        class="btn btn-purple w-100 mb-2">
                            <i class="bi bi-download me-2"></i> Download Payslip
                        </a>
                        <a href="{{ route('employee.attendance') }}" class="btn btn-light w-100 fw-bold text-muted border">
                            <i class="bi bi-clock-history me-2"></i> Attendance Logs
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card card-purple big-card shadow-sm position-relative overflow-hidden">
                            <div style="position: absolute; right: -10px; top: -10px; opacity: 0.1; font-size: 8rem;">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <p class="text-uppercase small mb-1 opacity-75 fw-bold">Monthly Net Payout</p>
                            <h1 class="display-5 fw-bold mb-0">₱{{ number_format($user->employee->payroll->net_salary ?? 0, 2) }}</h1>
                            <small class="opacity-75">Estimated disbursement at end of month</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card big-card shadow-sm border-start border-4" style="border-color: #6f42c1 !important;">
                            <p class="text-uppercase small mb-1 text-muted fw-bold">Position Base</p>
                            <h3 class="fw-bold mb-0 text-dark">₱{{ number_format($user->employee->position->salary ?? 0, 2) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card big-card shadow-sm">
                            <p class="text-uppercase small mb-1 text-muted fw-bold">Basic Salary</p>
                            <h3 class="fw-bold mb-0 text-dark">₱{{ number_format($user->employee->payroll->basic_salary ?? 0, 2) }}</h3>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-purple-light big-card shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-uppercase small mb-1 fw-bold opacity-75">Total Allowances</p>
                                    <h3 class="fw-bold mb-0">+ ₱{{ number_format($user->employee->payroll->allowances ?? 0, 2) }}</h3>
                                </div>
                                <i class="bi bi-plus-circle fs-3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card big-card shadow-sm border-start border-4" style="border-color: #dc3545 !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-uppercase small mb-1 text-muted fw-bold">Monthly Deductions</p>
                                    <h3 class="fw-bold mb-0 text-danger">- ₱{{ number_format($user->employee->payroll->deduction ?? 0, 2) }}</h3>
                                </div>
                                <i class="bi bi-dash-circle text-danger fs-3"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-2">
                        <div class="p-3 rounded-4 d-flex align-items-center" style="background-color: #efebf7; color: #6f42c1;">
                            <i class="bi bi-info-circle-fill me-3 fs-5"></i>
                            <small class="fw-bold text-uppercase">Payroll data is updated every 15th and 30th. Contact HR for disputes.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection