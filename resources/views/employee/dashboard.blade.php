<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>

        <span class="badge bg-primary fs-6 px-3 py-2">
            {{ $user->employee->position->department->name }} Department
        </span>
    </div>

    <!-- Profile Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center py-4">

            <div class="mb-2">
                <span class="text-muted small">Employee No.</span><br>
                <strong>{{ $user->employee->employee_number }}</strong>
            </div>

            <h3 class="mb-1">{{ $user->employee->name }}</h3>

            <p class="text-muted mb-1">
                <i class="bi bi-envelope"></i>
                {{ $user->email }}
            </p>

            <span class="badge bg-dark">
                {{ $user->employee->position->title }}
            </span>

        </div>
    </div>

    <!-- Salary Cards -->
    <div class="row g-3">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        <i class="bi bi-briefcase"></i> Position Salary
                    </h6>
                    <h4 class="fw-bold text-primary">
                        ₱{{ number_format($user->employee->position->salary ?? 0, 2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        <i class="bi bi-cash"></i> Basic Salary
                    </h6>
                    <h4 class="fw-bold">
                        ₱{{ number_format($user->employee->payroll->basic_salary ?? 0, 2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        <i class="bi bi-plus-circle"></i> Allowance
                    </h6>
                    <h4 class="fw-bold text-success">
                        ₱{{ number_format($user->employee->payroll->allowances ?? 0, 2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        <i class="bi bi-dash-circle"></i> Deduction
                    </h6>
                    <h4 class="fw-bold text-danger">
                        ₱{{ number_format($user->employee->payroll->deduction ?? 0, 2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 bg-dark text-white">
                <div class="card-body">
                    <h6 class="text-light">
                        <i class="bi bi-wallet2"></i> Net Salary
                    </h6>
                    <h3 class="fw-bold">
                        ₱{{ number_format($user->employee->payroll->net_salary ?? 0, 2) }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
</body>
</html>