@extends('layouts.app')

@section('title', 'Leave Management')

@section('content')

<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Modern Flat Card */
    .portal-card {
        background: #ffffff;
        border: none !important;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        border-radius: 16px;
        overflow: hidden;
    }

    /* Refined Custom Tabs */
    .nav-tabs-custom {
        border-bottom: 1px solid #efebf7;
        background: #f8f7fa;
        padding: 0 10px;
    }

    .nav-tabs-custom .nav-link {
        color: #6c757d;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        transition: 0.3s;
        border-bottom: 3px solid transparent;
    }

    .nav-tabs-custom .nav-link:hover {
        color: #6f42c1;
    }

    .nav-tabs-custom .nav-link.active {
        background: transparent;
        color: #6f42c1 !important;
        border-bottom-color: #6f42c1;
    }

    /* Table Styling */
    .table thead th {
        background: #fff;
        color: #6f42c1;
        border-bottom: 2px solid #efebf7;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
        color: #4b208c;
        border-bottom: 1px solid #f8f7fa;
    }

    /* CoreHR Purple Button */
    .btn-portal {
        background: #6f42c1;
        color: #fff;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.6rem 1.2rem;
        border: none;
        font-size: 0.8rem;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(111, 66, 193, 0.2);
    }

    .btn-portal:hover {
        background: #5a32a3;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Soft Status Badges */
    .status-badge {
        border-radius: 8px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        padding: 0.4rem 0.8rem;
    }

    .bg-soft-warning { background: #fff4e5; color: #b0721a; }
    .bg-soft-success { background: #e2f9ed; color: #1e7e34; }
    .bg-soft-danger { background: #ffe5e5; color: #dc3545; }

    .header-section {
        margin-top: 40px;
        margin-bottom: 30px;
    }

    @media (max-width: 576px) {
        .nav-tabs-custom .nav-link {
            padding: 0.8rem 0.6rem !important;
            font-size: 0.6rem !important;
        }
        .display-5 { font-size: 1.8rem; }
    }
</style>

<div class="container">
    <div class="col-lg-11 offset-lg-1">
        
        <div class="d-flex justify-content-between align-items-end header-section border-bottom border-2 pb-3" style="border-color: #e2d9f3 !important;">
            <div>
                <h1 class="display-5 fw-bold m-0" style="color: #2d1a4d;">Leave Tracker</h1>
                <p class="text-muted text-uppercase small fw-bold mb-0">Manage and monitor absence requests</p>
            </div>

            <button class="btn btn-portal" data-bs-toggle="modal" data-bs-target="#requestLeaveModal">
                <i class="bi bi-plus-lg me-1"></i> New Request
            </button>
        </div>

        <div class="portal-card mb-5">
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">In Process</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approved">Approved</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#disapproved">History</button>
                </li>
            </ul>

            <div class="tab-content">
                {{-- PENDING --}}
                <div class="tab-pane fade show active" id="pending">
                    <div class="table-responsive portal-table">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Duration</th>
                                    <th>Reason</th>
                                    <th>Requested</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pending as $leave)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">
                                            {{ \Carbon\Carbon::parse($leave->start_date)->format('d M') }} — {{ \Carbon\Carbon::parse($leave->end_date)->format('d M, Y') }}
                                        </div>
                                        <span class="badge bg-soft-warning status-badge">Processing</span>
                                    </td>
                                    <td class="text-muted small">{{ Str::limit($leave->reason, 50) }}</td>
                                    <td class="small">{{ $leave->created_at->format('M d, Y') }}</td>
                                    <td class="text-end pe-4">
                                        <form action="{{ route('cancel-leave', $leave->leave_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger border-0 fw-bold" onclick="return confirm('Cancel request?')">
                                                <i class="bi bi-x-circle me-1"></i> Cancel
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-5 text-muted">No pending requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3">{{ $pending->links() }}</div>
                </div>

                {{-- APPROVED --}}
                <div class="tab-pane fade" id="approved">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee</th>
                                    <th>Period</th>
                                    <th>Reason</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($approved as $leave)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ $leave->employee->name }}</td>
                                    <td class="small">{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                                    <td class="text-muted small">{{ $leave->reason }}</td>
                                    <td class="text-end pe-4">
                                        <span class="badge bg-soft-success status-badge">Approved</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-5 text-muted">No approved requests.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3">{{ $approved->links() }}</div>
                </div>

                {{-- DISAPPROVED --}}
                <div class="tab-pane fade" id="disapproved">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Period</th>
                                    <th>Reason</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($disapproved as $leave)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ $leave->start_date }} - {{ $leave->end_date }}</td>
                                    <td class="text-muted small">{{ $leave->reason }}</td>
                                    <td class="text-end pe-4">
                                        <span class="badge bg-soft-danger status-badge">Rejected</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-5 text-muted">No record history.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3">{{ $disapproved->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="requestLeaveModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="fw-bold text-uppercase mt-2" style="color: #6f42c1;">Request Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('add-request', $user->employee->employee_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="small fw-bold text-muted text-uppercase mb-1">Start Date</label>
                    <input type="date" name="start_date" class="form-control mb-3 p-2" style="border-radius: 8px;" required>
                    
                    <label class="small fw-bold text-muted text-uppercase mb-1">End Date</label>
                    <input type="date" name="end_date" class="form-control mb-3 p-2" style="border-radius: 8px;" required>
                    
                    <label class="small fw-bold text-muted text-uppercase mb-1">Reason for Absence</label>
                    <textarea name="reason" class="form-control p-2" rows="4" style="border-radius: 8px;" placeholder="Briefly explain the reason for your leave..." required></textarea>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn text-muted fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-portal px-4">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection