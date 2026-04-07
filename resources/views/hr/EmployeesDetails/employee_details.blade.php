@extends('hr.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Employees</title>
</head>
<body style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
   
    <div class="container mt-4 p-4" style="margin-left: 9%;">
     <div class="container">
        <a href="{{ route('hr.employees') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
        Back
    </a>
     </div>
    <div class="row align-items-center ">

        <!-- Container (Rectangle) -->
        <div class="bg-light text-center position-relative" style="height: 180px;">

            <!-- Circle Profile -->
            <div class="rounded-circle overflow-hidden shadow border border-white position-absolute start-50 translate-middle-x"
                style="width: 250px; height: 250px; border-width: 5px; bottom: -125px;">
                
                @if($emp->profile_image || $emp->avatar)
                    <img src="{{ $emp->profile_photo_path ?? $emp->avatar }}"
                        alt="{{ $emp->name }}"
                        class="w-100 h-100 object-fit-cover">
                @else
                    <!-- Fallback -->
                    <div class="w-100 h-100 bg-primary text-white d-flex justify-content-center align-items-center"
                        style="font-size: 42px;">
                        {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                    </div>
                @endif
                
            </div>

        </div>
        <!-- Add spacing below so content doesn't overlap -->
        <div style="height: 200px;"></div>
          <nav>
                <a href="{{ route('hr.EmployeesDetails.employee_by_department', $emp->department_id) }}">View Department</a>
                <a href="{{ route('hr.Crud.edit', $emp->employee_id) }}" class="ms-4">Edit employee</a>
            </nav>
        <!-- Employee Info -->
        <div class="col-md-6 bg-light p-4">
          
            <h2 class="mb-1">{{ $emp->name }}</h2>
            <h5>{{ $emp->position?->title ?? '—' }}</h5>
            <h6 class="text-secondary">
                @if($emp->role === 'head')
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-star-fill"></i> Head
                    </span>
                @else
                    <span class="badge bg-secondary">
                        Employee
                    </span>
                @endif
            </h6>
           

            <hr>

            <div class="mb-2">
                <strong>Employee Number:</strong>
                {{ $emp->employee_number ?? '—' }}
            </div>

            <div class="mb-2">
                <strong>Phone:</strong>
                {{ $emp->phone_number ?? '—' }}
            </div>

            <div class="mb-2">
                <strong>Department:</strong>
                {{ $emp->department?->name ?? '—' }}
            </div>

            <div class="mb-2">
                <strong>Email:</strong>
                 {{ $emp->email }}
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col">
            <input type="submit" value="Delete employee" class="btn btn-outline-danger">
        </div>
    </div>

</div>

</body>
</html>