@extends('layouts.app')

@section('title', 'Leave Management')

@section('content')

<style>
    .portal-card {
        background: #ffffff;
        border: 2px solid #000000;
        box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
        border-radius: 0;
    }
    .nav-tabs-custom {
        border-bottom: 2px solid #000;
        background: #f8f9fa;
    }
    .nav-tabs-custom .nav-link {
        color: #666;
        border: none;
        border-right: 1px solid #ddd;
        border-radius: 0;
        padding: 1rem 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    .nav-tabs-custom .nav-link.active {
        background: #000;
        color: #fff !important;
    }
    .table thead th {
        background: #fff;
        color: #000;
        border-bottom: 2px solid #000;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
    }
    .btn-portal {
        background: #000;
        color: #fff;
        border-radius: 0;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.6rem 1.2rem;
    }
    .btn-portal:hover {
        background: #333;
        color: #fff;
    }
    .status-badge {
        border-radius: 0;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        padding: 0.4rem 0.8rem;
    }
</style>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="display-5 fw-black m-0">LEAVE TRACKER</h1>
            <p class="text-muted text-uppercase small fw-bold">Manage and monitor absence requests</p>
        </div>

        <button class="btn btn-portal" data-bs-toggle="modal" data-bs-target="#requestLeaveModal">
            Create New Request
        </button>
    </div>

    <div class="portal-card">

        <ul class="nav nav-tabs nav-tabs-custom">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">
                    In Process
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approved">
                    Approved
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#disapproved">
                    Disapproved
                </button>
            </li>
        </ul>

        <div class="tab-content">

            {{-- PENDING --}}
            <div class="tab-pane fade show active" id="pending">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Duration</th>
                            <th>Reason</th>
                            <th>Requested</th>
                            <th class="text-end pe-4">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pending as $leave)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">
                                    {{ \Carbon\Carbon::parse($leave->start_date)->format('d M') }}
                                    —
                                    {{ \Carbon\Carbon::parse($leave->end_date)->format('d M, Y') }}
                                </div>
                                <span class="badge bg-warning text-dark status-badge">Processing</span>
                            </td>
                            <td class="text-muted small">{{ $leave->reason }}</td>
                            <td>{{ $leave->created_at->format('Y-m-d') }}</td>
                            <td class="text-end pe-4">
                                <form action="{{ route('cancel-leave', $leave->leave_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Cancel?')">
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4">No pending requests</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-3">
                    {{ $pending->links() }}
                </div>
            </div>

            {{-- APPROVED --}}
            <div class="tab-pane fade" id="approved">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Period</th>
                            <th>Reason</th>
                            <th class="text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($approved as $leave)
                        <tr>
                            <td class="fw-bold">{{ $leave->employee->name }}</td>
                            <td>{{ $leave->start_date }} - {{ $leave->end_date }}</td>
                            <td class="text-muted">{{ $leave->reason }}</td>
                            <td class="text-end">
                                <span class="badge bg-dark status-badge">Approved</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4">No approved requests</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-3">
                    {{ $approved->links() }}
                </div>
            </div>

            {{-- DISAPPROVED --}}
            <div class="tab-pane fade" id="disapproved">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Period</th>
                            <th>Reason</th>
                            <th class="text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disapproved as $leave)
                        <tr>
                            <td>{{ $leave->start_date }} - {{ $leave->end_date }}</td>
                            <td class="text-muted">{{ $leave->reason }}</td>
                            <td class="text-end">
                                <span class="badge bg-danger status-badge">Rejected</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4">No disapproved requests</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-3">
                    {{ $disapproved->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="requestLeaveModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="fw-bold text-uppercase">Request Leave</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('add-request', $user->employee->employee_id) }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="date" name="start_date" class="form-control mb-2" required>
                    <input type="date" name="end_date" class="form-control mb-2" required>
                    <textarea name="reason" class="form-control" placeholder="Reason" required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection