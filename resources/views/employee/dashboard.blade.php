<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1a1a1a;
        }
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            transition: transform 0.2s ease;
        }
        .card-mono {
            background-color: #ffffff;
            border: 2px solid #000000;
        }
        .card-dark {
            background-color: #000000;
            color: #ffffff;
        }
        .text-subtle {
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stat-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #444;
        }
        /* Responsiveness Tweaks */
        @media (max-width: 768px) {
            .display-6 { font-size: 1.5rem; }
            .container { padding-left: 20px; padding-right: 20px; }
        }
    </style>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-4 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 border-bottom pb-3">
        <div>
            <h1 class="fw-black mb-0">Dashboard</h1>
            <p class="text-muted mb-0">
                <i class="bi bi-building me-1"></i>
                {{ $user->employee->position->department->name }} Department
            </p>
        </div>
        <div class="mt-2 mt-md-0">
            <span class="badge bg-light text-dark border">
                System Date: {{ date('M d, Y') }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card h-100 shadow-sm border-0 bg-white">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-fill fs-1"></i>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="text-subtle">Employee ID</div>
                        <div class="fw-bold fs-5 text-uppercase">{{ $user->employee->employee_number }}</div>
                    </div>

                    <h2 class="fw-bold mb-1">{{ $user->employee->name }}</h2>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <div class="d-inline-block px-3 py-2 bg-dark text-white rounded-pill small fw-bold">
                        {{ $user->employee->position->title }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card p-3 h-100">
                        <div class="stat-label mb-2">Position Salary</div>
                        <h4 class="fw-bold mb-0">₱{{ number_format($user->employee->position->salary ?? 0, 2) }}</h4>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card p-3 h-100 border-dark">
                        <div class="stat-label mb-2">Basic Salary</div>
                        <h4 class="fw-bold mb-0">₱{{ number_format($user->employee->payroll->basic_salary ?? 0, 2) }}</h4>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card p-3 h-100 border-success border-opacity-25">
                        <div class="stat-label mb-2 text-success">Total Allowance</div>
                        <h4 class="fw-bold mb-0 text-success">+ ₱{{ number_format($user->employee->payroll->allowances ?? 0, 2) }}</h4>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card p-4 h-100 border-danger border-opacity-25">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stat-label mb-1 text-danger">Deductions</div>
                                <h3 class="fw-bold text-danger">- ₱{{ number_format($user->employee->payroll->deduction ?? 0, 2) }}</h3>
                            </div>
                            <i class="bi bi-graph-down-arrow text-danger fs-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-dark p-4 h-100 shadow">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-subtle text-dark-50 mb-1">Net Monthly Salary</div>
                                <h2 class="fw-bold mb-0">₱{{ number_format($user->employee->payroll->net_salary ?? 0, 2) }}</h2>
                            </div>
                            <i class="bi bi-wallet2 text-white-50 fs-2"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="p-3 bg-white border rounded d-flex flex-wrap gap-2">
                        <button class="btn btn-dark btn-sm rounded-pill px-4">Download Payslip</button>
                        <button class="btn btn-outline-dark btn-sm rounded-pill px-4">View History</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

</body>
</html>