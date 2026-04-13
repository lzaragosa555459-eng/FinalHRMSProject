
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
<div class="container mt-4" >

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('hr.employees') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
            Back
        </a>
    </div>

    <!-- PROFILE HEADER -->
    <div class="bg-light rounded p-4 text-center position-relative mb-4">

        <!-- Profile Image -->
        <div class="rounded-circle overflow-hidden shadow border border-white mx-auto"
             style="width: 150px; height: 150px;">

            @if($emp->profile_image || $emp->avatar)
                <img src="{{ $emp->profile_photo_path ?? $emp->avatar }}"
                     alt="{{ $emp->name }}"
                     class="w-100 h-100 object-fit-cover">
            @else
                <div class="w-100 h-100 bg-primary text-white d-flex justify-content-center align-items-center"
                     style="font-size: 40px;">
                    {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                </div>
            @endif
        </div>

        <!-- Name -->
        <h2 class="mt-3 mb-1">{{ $emp->name }}</h2>
        <h5 class="text-muted">{{ $emp->position?->title ?? '—' }}</h5>

        <!-- Role Badge -->
        @if($emp->role === 'head')
            <span class="badge bg-warning text-dark mt-2">
                <i class="bi bi-star-fill"></i> Head
            </span>
        @else
            <span class="badge bg-secondary mt-2">Employee</span>
        @endif

        <!-- Actions -->
        <div class="mt-3">
            <a href="{{ route('hr.EmployeesDetails.employee_by_department', $emp->position->department_id) }}" class="btn btn-sm btn-outline-primary">
                View Department
            </a>
            <a href="{{ route('hr.Crud.edit', $emp->employee_id) }}" class="btn btn-sm btn-outline-dark ms-2">
                Edit Employee
            </a>
        </div>

    </div>

    <!-- MAIN CONTENT -->
    <div class="row g-4">

        <!-- Employee Info -->
        <div class="col-md-6">
            <div class="bg-light p-4 rounded h-100">

                <h4 class="mb-3">Employee Details</h4>
                <hr>

                <p><strong>Employee Number:</strong> {{ $emp->employee_number ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $emp->phone_number ?? '—' }}</p>
                <p><strong>Department:</strong> {{ $emp->position->department->name ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $emp->email }}</p>

            </div>
        </div>

        <!-- Performance Chart -->
    <div class="col-md-6">
        <div class="bg-light p-4 rounded h-100">

            <h4 class="mb-3">Performance</h4>

            <!-- Chart -->
            <div style="height:250px;">
                <canvas id="performanceChart"></canvas>
            </div>

            <hr>

            <!-- Document Style Content -->
            <div class="d-flex flex-column gap-4">

                @forelse($performances as $perf)
                    <div>

                        <h6 class="mb-1">
                            Review Period: <strong>{{ $perf->review_period }}</strong>
                        </h6>

                        <p class="mb-1">
                            <strong>Status:</strong> 
                            <span class="badge 
                                @if($perf->status == 'Reviewed') bg-success 
                                @elseif($perf->status == 'Completed') bg-primary 
                                @else bg-secondary 
                                @endif">
                                {{ $perf->status }}
                            </span>
                        </p>

                        <p class="mb-1">
                            <strong>Rating:</strong> {{ $perf->rating }}
                        </p>

                        <p class="mb-1">
                            <strong>Review Date:</strong> {{ $perf->review_date }}
                        </p>

                        <p class="mb-0">
                            <strong>Comments:</strong><br>
                            <span class="text-muted">{{ $perf->comments }}</span>
                        </p>

                    </div>

                    <hr>

                @empty
                    <p class="text-muted text-center">No added performance record.</p>
                @endforelse

            </div>

        </div>

    </div>
    <div class="row">
        <div class="col">
            <h2 class="text-center mt-4">Attendance History</h2>
                <canvas id="attendanceChart" height="120"></canvas>
        </div>
    </div>

    </div>

    <!-- DELETE BUTTON -->
    <div class="mt-4">
        <form action="{{ route('hr.Crud.delete', $emp->employee_id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this employee?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Delete Employee
            </button>
        </form>
    </div>

</div>
<script>
    const ctx = document.getElementById('performanceChart').getContext('2d');

    const performanceChart = new Chart(ctx, {
        type: 'bar', // you can change to 'line', 'pie', etc.
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Employee Ratings',
                data: @json($ratings),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });

    const dates = @json($dates);
    const present = @json($present);
    const late = @json($late);


    new Chart(document.getElementById('attendanceChart'), {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [
                {
                    label: 'Present',
                    data: present,
                    backgroundColor: '#22c55e'
                },
                {
                    label: 'Late',
                    data: late,
                    backgroundColor: '#eab308'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { 
                    display: true, 
                    text: 'Attendance per Day' 
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Date' }
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Count' }
                }
            }
        }
    });
</script>
</body>
</html>