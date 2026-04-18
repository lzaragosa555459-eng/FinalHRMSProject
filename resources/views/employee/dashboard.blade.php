@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Neo-Brutalist Dashboard Core */
    .brutal-card {
        background: #fff;
        border: 3px solid #000;
        box-shadow: 8px 8px 0px #000;
        border-radius: 0;
        transition: all 0.2s;
    }

    .brutal-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 10px 10px 0px #000;
    }

    .profile-sidebar {
        background: #fff;
        border: 4px solid #000;
        box-shadow: 12px 12px 0px #000;
    }

    .stat-box {
        padding: 1.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .label-accent {
        font-size: 0.7rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #000;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Color Variants */
    .bg-brutal-green { background: #00ff66; border-color: #000; }
    .bg-brutal-red { background: #ff4d4d; color: #fff; }
    .bg-brutal-dark { background: #000; color: #fff; }

    .btn-brutal {
        border: 3px solid #000;
        border-radius: 0;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 0.75rem 1.5rem;
        background: #fff;
        color: #000;
        box-shadow: 4px 4px 0px #000;
        transition: 0.1s;
    }

    .btn-brutal:hover {
        background: #000;
        color: #fff;
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px #000;
    }

    .btn-brutal:active {
        transform: translate(4px, 4px);
        box-shadow: 0px 0px 0px #000;
    }

    .avatar-frame {
        border: 4px solid #000;
        background: #fff;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 6px 6px 0px #000;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 border-bottom border-4 border-dark pb-4">
        <div>
            <h1 class="display-4 fw-black m-0 text-uppercase">DASHBOARD</h1>
            <p class="text-muted fw-bold small text-uppercase mb-0">
                <span class="text-dark">{{ $user->employee->position->department->name }}</span> // ACCESS LEVEL: EMPLOYEE
            </p>
        </div>
        <div class="mt-3 mt-md-0">
            <div class="p-2 bg-dark text-white fw-bold text-uppercase" style="letter-spacing: 2px; font-size: 0.8rem;">
                {{ date('l, M d, Y') }}
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-12 col-lg-4">
            <div class="profile-sidebar p-4 text-center">
                <div class="avatar-frame mb-4">
                    <i class="bi bi-person-fill fs-1"></i>
                </div>
                
                <span class="label-accent">Employee Serial</span>
                <h4 class="fw-black text-uppercase border-bottom border-2 border-dark d-inline-block pb-1 mb-4">
                    #{{ $user->employee->employee_number }}
                </h4>

                <h2 class="fw-black text-uppercase mb-1">{{ $user->employee->name }}</h2>
                <p class="fw-bold text-muted small mb-4 text-lowercase">{{ $user->email }}</p>
                
                <div class="p-3 bg-brutal-green fw-black text-uppercase border border-3 border-dark mb-4">
                    {{ $user->employee->position->title }}
                </div>

                <div class="text-start mt-5">
                    <button class="btn-brutal w-100 mb-3">Download Payslip <i class="bi bi-download ms-2"></i></button>
                    <button class="btn-brutal w-100 bg-light">View History <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="brutal-card stat-box">
                        <span class="label-accent">Position Base</span>
                        <h3 class="fw-black mb-0">₱{{ number_format($user->employee->position->salary ?? 0, 2) }}</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="brutal-card stat-box">
                        <span class="label-accent">Contractual Basic</span>
                        <h3 class="fw-black mb-0">₱{{ number_format($user->employee->payroll->basic_salary ?? 0, 2) }}</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="brutal-card stat-box border-success" style="background: #e6fffa;">
                        <span class="label-accent text-success">Total Allowances</span>
                        <h3 class="fw-black text-success mb-0">+ ₱{{ number_format($user->employee->payroll->allowances ?? 0, 2) }}</h3>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="brutal-card stat-box bg-brutal-red">
                        <span class="label-accent text-white">Monthly Deductions</span>
                        <h2 class="fw-black mb-0">- ₱{{ number_format($user->employee->payroll->deduction ?? 0, 2) }}</h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="brutal-card bg-brutal-dark p-5 position-relative overflow-hidden">
                        <div class="position-absolute opacity-25" style="right: -20px; bottom: -20px;">
                            <i class="bi bi-wallet2 display-1" style="font-size: 10rem;"></i>
                        </div>
                        
                        <div class="position-relative">
                            <span class="label-accent text-white-50">Monthly Net Payout</span>
                            <h1 class="display-3 fw-black mb-0 text-white">₱{{ number_format($user->employee->payroll->net_salary ?? 0, 2) }}</h1>
                            <p class="text-white-50 small fw-bold mt-2 text-uppercase">Estimated disbursement: End of Month</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="p-4 border border-3 border-dark bg-white d-flex align-items-center">
                        <i class="bi bi-info-square-fill fs-4 me-3"></i>
                        <p class="mb-0 fw-bold small text-uppercase">Payroll data is updated every 15th and 30th. Contact HR for disputes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection