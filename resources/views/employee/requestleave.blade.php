<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee portal</title>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@extends('layouts.app')

@section('title', 'Leaves')

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-4">Leave Requests</h1>

                <button class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#requestLeaveModal">
                    Request Leave
                </button>
            </div>

            {{-- APPROVED --}}
            <h3>Approved</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Leave ID</th>
                            <th>Employee</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($leaves->where('status', 'approved') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No approved leave requests
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PENDING --}}
            <h3 class="mt-4">In Process</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Leave ID</th>
                            <th>Employee</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($leaves->where('status', 'pending') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                                <td>
                                    <a href="" class="btn btn-outline-danger">
                                        Cancel
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No pending leave requests
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- DISAPPROVED --}}
            <h3 class="mt-4">Disapproved</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Leave ID</th>
                            <th>Employee</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($leaves->where('status', 'disapproved') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-danger">Disapproved</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No disapproved leave requests
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="requestLeaveModal" tabindex="-1" aria-labelledby="requestLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="requestLeaveModalLabel">Request Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('add-request', $user->employee->employee_id) }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason</label>
                        <textarea name="reason" class="form-control" rows="3" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Submit Request
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

</body>
</html>