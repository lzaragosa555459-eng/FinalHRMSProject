<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Organization</title>
</head>
<body style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @extends('hr.sidebar')

    <div class="container mt-4" style="margin-left: 9%;">
    <h2>Organization</h2>
    <h4 class="text-secondary">Company Structure & Activities</h4>
    <!-- Filters / Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
       <div class="input-group" style="max-width: 320px;">
             <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input 
                    type="text" 
                    id="searchInput" 
                    class="form-control" 
                    placeholder="Search..." 
                    onkeyup="searchEmployees()">
            </div>

        <div class="d-flex gap-2">
            <select class="form-select">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>

            <select class="form-select">
                <option>All Heads</option>
                {{-- loop heads if available --}}
            </select>

            <select class="form-select">
                <option>Name (A-Z)</option>
                <option>Name (Z-A)</option>
            </select>
        </div>
    </div>

   <div class="row g-4">
    @foreach($departments as $dept)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0">
            
            <!-- Card Header -->
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">{{ $dept->name }}</h4>
                <span class="badge bg-primary">{{ $dept->department_number }}</span>
            </div>

            <div class="card-body">

                <!-- Description -->
                <p class="card-text text-muted">
                    {{ $dept->description ?? 'No description available.' }}
                </p>

                <!-- Head of Department -->
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Head of Department</small>
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:40px; height:40px; font-weight:600;">
                            {{ $dept->head 
                                ? strtoupper(substr($dept->head->name, 0, 2)) 
                                : 'NA' 
                            }}
                        </div>
                        <div>
                            <strong>{{ $dept->head->name ?? 'No Head Assigned' }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Employees Count -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Total Employees</small>
                        <h4 class="mb-0">{{ $dept->employees_count ?? 0 }}</h4>
                    </div>

                    <!-- Status -->
                    @if($dept->employees_count > 0)
                        <span class="badge bg-success px-3 py-2">Active</span>
                    @else
                        <span class="badge bg-danger px-3 py-2">Inactive</span>
                    @endif
                </div>

            </div>

            <!-- Card Footer with Actions -->
            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between gap-2">
                    <a href="{{ route('hr.EmployeesDetails.employee_by_department', $dept->department_id) }}" 
                       class="btn btn-outline-primary flex-grow-1">
                        <i class="bi bi-eye"></i> View Employees
                    </a>

                    <button class="btn btn-outline-warning">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
</div>
</body>
</html>