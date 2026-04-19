@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
<style>
    /* Neo-Brutalist Table Aesthetics */
    .attendance-container {
        background: #fff;
        border: 4px solid #000;
        box-shadow: 12px 12px 0px #000;
        border-radius: 0;
        overflow: hidden;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background-color: #000 !important;
        color: #fff !important;
        text-transform: uppercase;
        font-weight: 900;
        font-size: 0.8rem;
        letter-spacing: 2px;
        padding: 20px 15px;
        border: none;
        text-align: center;
    }

    .custom-table tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        font-size: 0.95rem;
        border-bottom: 2px solid #000;
        background: #fff;
        text-align: center;
    }

    .custom-table tbody tr:hover td {
        background-color: #f0f0f0;
    }

    /* Tactile Export Button */
    .btn-brutal-export {
        background: #00ff66; /* Neon green pop */
        color: #000;
        border: 3px solid #000;
        border-radius: 0;
        font-weight: 900;
        text-transform: uppercase;
        box-shadow: 4px 4px 0px #000;
        transition: 0.1s;
    }

    .btn-brutal-export:hover {
        background: #00ff66;
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px #000;
    }

    .btn-brutal-export:active {
        transform: translate(4px, 4px);
        box-shadow: 0px 0px 0px #000;
    }

    /* High-Contrast Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        border: 2px solid #000;
        font-weight: 900;
        font-size: 0.7rem;
        letter-spacing: 1px;
        border-radius: 0;
    }

    .status-present { 
        background: #000; 
        color: #fff; 
    }

    .status-late { 
        background: #ff4d4d; /* Bright red for visibility */
        color: #fff; 
    }

    /* Date column styling */
    .date-cell {
        font-family: 'Courier New', Courier, monospace;
        font-weight: bold;
        color: #555;
    }

    /* Responsive Mobile Cards */
    @media (max-width: 768px) {
        .attendance-container { border-width: 3px; box-shadow: 6px 6px 0px #000; }
        .custom-table tbody td {
            text-align: right;
            padding-left: 50%;
            border-bottom: 1px solid #000;
        }
        .custom-table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.7rem;
        }
    }
@media (max-width: 768px) {

    .attendance-container {
        border-width: 2px;
        box-shadow: 6px 6px 0px #000;
    }

    /* KEEP TABLE HORIZONTAL */
    .custom-table {
        width: 100%;
        font-size: 0.7rem;
    }

    /* HEADER MUST STAY VISIBLE */
    .custom-table thead th {
        font-size: 0.6rem;
        padding: 8px 6px;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    /* CELLS */
    .custom-table tbody td {
        padding: 8px 6px !important;
        font-size: 0.7rem;
        white-space: nowrap;
        text-align: center;
    }

    /* ICONS */
    .custom-table i {
        font-size: 0.75rem;
    }

    /* BADGE */
    .status-badge {
        font-size: 0.55rem;
        padding: 3px 8px;
    }
}
</style>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-end mb-5 border-bottom border-4 border-dark pb-3">
        <div>
            <h1 class="display-4 fw-black m-0 text-uppercase">Logbook</h1>
            <p class="text-muted fw-bold small text-uppercase mb-0">Daily Verification Records</p>
        </div>
        <button class="btn btn-brutal-export px-4 py-2">
            <i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Export CSV
        </button>
    </div>

    <div class="attendance-container">
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
                            <td data-label="" class="date-cell">
                                {{ \Carbon\Carbon::parse($attend->date)->format('Y.m.d') }}
                            </td>
                            <td data-label="">
                                <span class="fw-black text-uppercase">{{ $attend->employee->name }}</span>
                            </td>
                            <td data-label="">
                                <div class="fw-bold">
                                    <i class="bi bi-door-open-fill me-1"></i>
                                    {{ $attend->time_in }}
                                </div>
                            </td>
                            <td data-label="">
                                <div class="fw-bold">
                                    <i class="bi bi-door-closed-fill me-1"></i>
                                    {{ $attend->time_out ?? '--:--' }}
                                </div>
                            </td>
                            <td data-label="">
                                <span class="status-badge {{ $attend->status == 'Present' ? 'status-present' : 'status-late' }}">
                                    {{ strtoupper($attend->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection