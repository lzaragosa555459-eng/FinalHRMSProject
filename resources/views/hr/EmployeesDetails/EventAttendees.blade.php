@extends('layouts.apphr')

@section('title', 'Event Attendance')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f0f7; /* Soft purple background */
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #4b2a89;
            --light-purple: #efebf7;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            background-color: white;
            overflow: hidden;
        }

        .header-gradient {
            background: linear-gradient(135deg, #6f42c1 0%, #4b2a89 100%);
            color: white;
            padding: 2rem;
        }

        .btn-back {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: white;
            color: var(--primary-purple);
        }

        .table-custom thead {
            background-color: var(--light-purple);
        }

        .table-custom th {
            color: var(--dark-purple);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1.25rem 1rem;
        }

        .table-custom td {
            padding: 1rem;
            color: #4a4a4a;
        }

        /* Status Badges */
        .badge-attended {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .badge-pending {
            background-color: #efebf7;
            color: #6f42c1;
        }

        .avatar-placeholder {
            width: 35px;
            height: 35px;
            background-color: var(--light-purple);
            color: var(--primary-purple);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: bold;
            font-size: 0.9rem;
        }
    </style>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card card-custom">
                
                <div class="header-gradient d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1 fw-bold">Event Attendance</h3>
                        <p class="mb-0 opacity-75 small">
                            <i class="bi bi-people-fill me-1"></i> Total: {{ $attendees->count() }} registered
                        </p>
                    </div>

                    <a href="{{ url()->previous() }}" class="btn btn-back rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle table-custom">
                            <thead>
                                <tr>
                                    <th class="ps-4">Employee Name</th>
                                    <th>Status</th>
                                    <th>Check-in Details</th>
                                    <th class="text-end pe-4">Identity</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($attendees as $att)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-placeholder">
                                                    {{ strtoupper(substr($att->employee->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-bold text-dark">{{ $att->employee->name }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            @if($att->status == 'attended')
                                                <span class="badge badge-attended rounded-pill px-3 py-2">
                                                    <i class="bi bi-check-circle-fill me-1"></i>Attended
                                                </span>
                                            @else
                                                <span class="badge badge-pending rounded-pill px-3 py-2">
                                                    <i class="bi bi-clock-history me-1"></i>{{ ucfirst($att->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($att->check_in_time)
                                                <div class="small fw-semibold text-dark">
                                                    <i class="bi bi-clock text-purple me-1"></i> {{ $att->check_in_time }}
                                                </div>
                                            @else
                                                <span class="text-muted small italic">Not checked in</span>
                                            @endif
                                        </td>

                                        <td class="text-end pe-4">
                                            <small class="text-muted fw-mono">#{{ $att->employee->employee_number ?? 'N/A' }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="py-3">
                                                <i class="bi bi-person-x fs-1 text-muted opacity-25"></i>
                                                <p class="text-muted mt-2 mb-0">No attendees have registered for this event yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light border-0 py-3 ps-4">
                    <small class="text-muted">
                        Attendance data is automatically updated via check-in system.
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection