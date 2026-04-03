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

    <!-- Filters / Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" class="form-control w-25" placeholder="Search departments...">

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

    <!-- Table -->
    <div class="table-responsive bg-white p-3">

        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Head of Department</th>
                    <th>Employees</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($departments as $dept)
                <tr>
                    <!-- ID -->
                    <td>{{ $dept->department_number }}</td>

                    <!-- Name -->
                    <td>{{ $dept->name }}</td>

                    <!-- Description -->
                    <td>{{ $dept->description }}</td>

                    <!-- Head (example relation) -->
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                                style="width:35px;height:35px;">

                                {{ $dept->head 
                                    ? strtoupper(substr($dept->head->name, 0, 2))
                                    : 'NA' 
                                }}

                            </div>

                            <span>
                                {{ $dept->head->name ?? 'No Head' }}
                            </span>
                        </div>
                    </td>

                    <!-- Employees Count -->
                    <td>
                        {{ $dept->employees_count ?? 0 }}
                    </td>

                    <!-- Status -->
                    <td>
                        @if($dept->employees_count > 0)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                           <a href="{{ route('hr.EmployeesDetails.employee_by_department', $dept->department_id) }}" 
                           class="btn btn-sm btn-outline-primary px-3">
                               View
                            </a>

                            <button class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                          

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    

    </div>
</div>
</body>
</html>