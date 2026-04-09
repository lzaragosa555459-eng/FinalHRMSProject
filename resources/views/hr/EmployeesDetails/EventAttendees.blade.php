<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendees</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0 rounded-4">
                
                <!-- Header -->
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Event Attendees</h5>

                    @if($attendees->isNotEmpty())
                        @php $att = $attendees->first(); @endphp
                        <a href="{{ route('hr.EmployeesDetails.employee_by_department', $att->employee->department_id) }}" 
                           class="btn btn-outline-primary btn-sm">
                            ← Back
                        </a>
                    @endif
                </div>

                <!-- Table -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Check-in Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($attendees as $att)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $att->employee->name }}
                                        </td>

                                        <td>
                                            <span class="badge 
                                                {{ $att->status == 'attended' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($att->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $att->check_in_time ?? '—' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No attendees found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>