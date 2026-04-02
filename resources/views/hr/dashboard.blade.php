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
     @extends('hr.sidebar')
<div class="container mt-4">
   <h2 class="mb-0">Dashboard</h2>

    <div class="row">
        <div class="col-12">
            <div class="row g-3">

                <div class="col-md-3">
                    <div class="card p-3 text-center">
                        <h5>Total Employees</h5>
                        <p>{{ $totalEmployees }}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 text-center">
                        <h5>Total Active</h5>
                        <p>{{ $totalActive }}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 text-center">
                        <h5>New Hires</h5>
                        <p>{{ $newHires }}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 text-center">
                        <h5>Resigned Employees</h5>
                        <p>{{  $resignedEmployees }}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card p-3 text-center">
                        <h5>Departments</h5>
                        <p>{{ $departments }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FIXED: Employee Analytics + Attendance (horizontal) -->
    <div class="row mt-3">
        <div class="col-8">
            <div class="card">
                <h5>Employee Analytics</h5>
                <p>0</p>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <h5>Attendance and leaves</h5>
                <p>0</p>
            </div>
        </div>
    </div>

    <!-- FIXED: Gender Stats + Recent Activity (horizontal) -->
    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                <h5>Gender stats</h5>
                <p>0</p>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <h5>Recent Activity</h5>
                <p>0</p>
            </div>
        </div>
    </div>

</div>
</body>
</html>