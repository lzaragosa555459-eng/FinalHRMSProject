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
    @extends('hr.sidebar')
   
    <div class="container mt-4 p-4" style="margin-left: 9%;">
     <div class="container">
        <a href="{{ route('hr.employees') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
        Back
    </a>
     </div>
    <div class="row align-items-center ">

        <!-- Profile Image -->
        <div class="col-md-4 text-center">
            <img src="{{ asset('LIZPIC.jpg') }}"
                 class="rounded-circle mt-3"
                 width="250"
                 height="250"
                 alt="Profile">
        </div>

        <!-- Employee Info -->
        <div class="col-md-6">

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

</div>

</body>
</html>