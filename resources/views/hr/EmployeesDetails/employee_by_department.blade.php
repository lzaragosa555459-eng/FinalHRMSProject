@extends('hr.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization</title>
</head>
<body style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container mt-5" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
        <a href="{{ route('hr.organization')}}" class="btn btn-outline-secondary rounded ">
        Back
    </a>
    </div>
    <div class="container mt-5" style="max-width: 1200px; margin-left: auto; margin-right: auto;">

    <!-- Department Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                Department: 
                <span class="text-primary">
                    {{ $employees->first()?->department?->name ?? 'N/A' }}
                </span>
            </h4>
            <p class="text-muted mb-0">{{ $employees->count() }} employees</p>
        </div>
        
        <!-- Optional: Add Employee Button -->
        <button class="btn btn-primary rounded-3 px-4 py-2 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Add Employee
        </button>
    </div>

    <!-- Modern Card -->
    <div class="card border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-bottom">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold text-muted">Employee</th>
                            <th class="py-3 fw-semibold text-muted">Contact</th>
                            <th class="py-3 fw-semibold text-muted">Role</th>
                            <th class="py-3 fw-semibold text-muted">Hire Date</th>
                            <th class="py-3 fw-semibold text-muted">Salary</th>
                            <th class="py-3 fw-semibold text-muted text-center">Status</th>
                            <th class="pe-4 py-3 text-end fw-semibold text-muted">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="border-top">
                        @foreach($employees as $emp)
                        <tr class="border-bottom">
                            <!-- Employee -->
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar bg-gradient text-white fw-bold rounded-3 d-flex justify-content-center align-items-center shadow-sm bg-secondary"
                                         style="width: 48px; height: 48px; font-size: 1.1rem;">
                                        {{ strtoupper(substr($emp->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold fs-6 text-dark">{{ $emp->name }}</div>
                                        <small class="text-muted">{{ $emp->employee_number ?? '—' }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="py-3">
                                <div class="text-dark">{{ $emp->email ?? '—' }}</div>
                                <small class="text-muted">{{ $emp->phone_number ?? '—' }}</small>
                            </td>

                            <!-- Role -->
                            <td class="py-3">
                                @if($emp->role == 'head')
                                    <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                        <i class="bi bi-star-fill me-1"></i>Head
                                    </span>
                                @else
                                    <span class="badge bg-secondary  px-3 py-2 fs-6">
                                        Employee
                                    </span>
                                @endif
                            </td>

                            <!-- Hire Date -->
                            <td class="py-3">
                                <span class="text-muted">
                                    {{ $emp->hire_date ? \Carbon\Carbon::parse($emp->hire_date)->format('M d, Y') : '—' }}
                                </span>
                            </td>

                            <!-- Salary -->
                            <td class="py-3">
                                <span class="fw-semibold">
                                    {{ $emp->salary ? '$' . number_format($emp->salary, 0) : '—' }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="py-3 text-center">
                                @if($emp->status == 'active' || !isset($emp->status))
                                    <span class="badge bg-success  px-3 py-1">
                                        <i class="bi bi-check-circle me-1"></i>Active
                                    </span>
                                @else
                                    <span class="badge bg-danger  px-3 py-1">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="pe-4 py-3 text-end">
                                <div class="btn-group">
                                     <a href="{{ route('hr.EmployeesDetails.employee_details', $emp->employee_id) }}" class="btn btn-sm btn-outline-primary rounded-3 me-1">
                                        View
                                    </a>
                                    <button class="btn btn-sm btn-outline-primary rounded-3">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

  
</div>
  
</body>
</html>