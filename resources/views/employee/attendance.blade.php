@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important; /* Soft purple-grey background */
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Modern Flat Container */
    .attendance-container {
        background: #fff;
        border: none;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        border-radius: 16px;
        overflow: hidden;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background-color: #f8f7fa !important; /* Very light purple/grey */
        color: #6f42c1 !important; /* Core Purple */
        text-transform: uppercase;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 18px 15px;
        border-bottom: 2px solid #efebf7;
        text-align: center;
    }

    .custom-table tbody td {
        padding: 15px 15px;
        vertical-align: middle;
        font-size: 0.9rem;
        border-bottom: 1px solid #efebf7;
        background: #fff;
        text-align: center;
        color: #4b208c;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr:hover td {
        background-color: #fcfaff;
    }

    /* CoreHR Purple Button */
    .btn-purple-export {
        background: #6f42c1;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 10px 20px;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(111, 66, 193, 0.2);
    }

    .btn-purple-export:hover {
        background: #5a32a3;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(111, 66, 193, 0.3);
    }

    /* Refined Status Badges */
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        font-weight: 700;
        font-size: 0.7rem;
        border-radius: 8px;
        text-transform: uppercase;
    }

    .status-present { 
        background: #e2d9f3; 
        color: #6f42c1; 
    }

    .status-late { 
        background: #ffe5e5; 
        color: #dc3545; 
    }

    /* Date column styling */
    .date-cell {
        font-weight: 600;
        color: #6f42c1;
    }

    .header-section {
        margin-top: 40px;
        margin-bottom: 30px;
    }

    /* Desktop/Mobile specific tweaks */
    @media (max-width: 768px) {
        .custom-table thead th, 
        .custom-table tbody td {
            font-size: 0.7rem;
            padding: 10px 5px !important;
        }
        
        .display-4 {
            font-size: 2rem;
        }
    }
</style>

<div class="container">
    <div class="col-lg-11 offset-lg-1">
        <div class="d-flex justify-content-between align-items-end header-section border-bottom border-2 pb-3" style="border-color: #e2d9f3 !important;">
            <div>
                <h1 class="display-5 fw-bold m-0" style="color: #2d1a4d;">Logbook</h1>
                <p class="text-muted fw-bold small text-uppercase mb-0">Daily Verification Records</p>
            </div>
            <button class="btn btn-purple-export">
                <i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Export CSV
            </button>
        </div>

        <div class="attendance-container mb-5">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee Reference</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendance as $attend)
                            <tr>
                                <td class="date-cell">
                                    {{ \Carbon\Carbon::parse($attend->date)->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $attend->employee->name }}</span>
                                </td>
                                <td>
                                    <div class="text-muted">
                                        <i class="bi bi-box-arrow-in-right me-1 text-primary"></i>
                                        {{ $attend->time_in }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted">
                                        <i class="bi bi-box-arrow-right me-1 text-secondary"></i>
                                        {{ $attend->time_out ?? '--:--' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $attend->status == 'Present' ? 'status-present' : 'status-late' }}">
                                        {{ $attend->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection