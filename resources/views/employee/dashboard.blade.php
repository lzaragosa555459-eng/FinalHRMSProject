<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                    <h2>Dashboard</h2>
                    <h1>{{ $user->employee->department->name}} Department</h1>
                    <div class="p-4 bg-light text-center">
                        {{ $user->employee->employee_number }}
                        <h3> {{ $user->employee->name }}</h3>
                         <p>{{ $user->email}}</p>
                         {{ $user->employee->position->title }}
                    </div>
            </div>
        </div>
        <div class="row justify-content-center">
             <div class="col-5 mt-4 p-4 bg-light me-2">
                <h6>Position Salary</h6>
               ₱{{ number_format($user->employee->position->salary, 2)}}
            </div>
             <div class="col-5 mt-4 p-4 bg-light">
                <h6>Basic Salary</h6>
               ₱{{ number_format($user->employee->payroll->basic_salary, 2)}}
            </div>
             <div class="col-5 mt-4 p-4 bg-secondary me-2">
                <h6>Allowance</h6>
               ₱{{ number_format($user->employee->payroll->allowances, 2)}}
            </div>
            <div class="col-5 mt-4 p-4 bg-danger">
                <h6>Deduction</h6>
               ₱{{ number_format($user->employee->payroll->deduction, 2)}}   
            </div>
             <div class="col-5 mt-4 p-4 bg-primary">
                <h6>Net Salary</h6>
               ₱{{ number_format($user->employee->payroll->net_salary, 2)}}
            </div>
        </div>
    </div>
</body>
</html>