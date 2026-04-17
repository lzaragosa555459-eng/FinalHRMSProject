<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee portal</title>
</head>

<body>

@extends('layouts.app')

@section('title', 'Leaves')

@section('content')

<div class="container mt-4">

    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-4">Leave Requests</h1>

                <button class="btn btn-primary btn-sm">
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
                        @foreach($leaves->where('status', 'approved') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
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
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($leaves->where('status', 'pending') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
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
                        @foreach($leaves->where('status', 'disapproved') as $leave)
                            <tr>
                                <td>{{ $leave->leave_id }}</td>
                                <td>{{ $leave->employee->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td><span class="badge bg-danger">Disapproved</span></td>
                                <td>{{ $leave->created_at ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection

</body>
</html>