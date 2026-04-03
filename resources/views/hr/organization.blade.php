<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Organization</title>
</head>
<style>
.nav-item-link {
    position: relative;
    transition: color 0.3s ease;
}

/* Animated underline */
.nav-item-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0%;
    height: 2px;
    background-color: #0d6efd;
    transition: width 0.3s ease;
}

/* Active state */
.nav-item-link.active {
    color: #0d6efd !important;
    font-weight: 600;
}

/* Animate underline on active */
.nav-item-link.active::after {
    width: 100%;
}
</style>
<body style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @extends('hr.sidebar')
    
    <div class="container mt-4" style="margin-left: 9%;">
    
<nav class="navbar navbar-expand-lg navbar-light hadow-sm" style="background-color: #a2aab6;">
    <div class="container">

   

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                <a class="nav-link nav-item-link active" href="#" onclick="showContainer('container1', this)">
                    Department
                </a>
            </li>

            <li class="nav-item me-5">
                <a class="nav-link nav-item-link" href="#" onclick="showContainer('container2', this)">
                    Events
                </a>
            </li>
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
       
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-filter"></i>
            </span>

            <select class="form-select">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
        </div>
    </div>
            </ul>
        </div>

    </div>
</nav>
<div class="container" style="background-color: #c5ccd6;">
     <h2>Organization</h2>
    <h4 class="text-secondary mb-0">Company Structure & Activities</h4><br><br>
</div>
   
<!-- Departments -->
<div class="container mt-4" id="container1"  display: block;">
    <h3 class="mb-4">Departments</h3>
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
                <p class="card-text text-muted mb-4">
                    {{ $dept->description ?? 'No description available.' }}
                </p>

                <!-- Head of Department 
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
                </div>-->

                <!-- Employees Count -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <small class="text-muted">Total Employees:</small>
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
 <!-- Events -->
<div class="container mt-4" id="container2" style="margin-left: 0%; display: none;">
    <h3 class="mb-4">Events</h3>

    <div class="row g-4">
        @foreach($events as $event)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">

                <!-- Header (Document Style) -->
                <div class="card-body">

                    <!-- Icon + Type -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary text-white rounded p-2">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <small class="text-muted text-uppercase">
                                {{ str_replace('_', ' ', $event->event_type) }}
                            </small>
                        </div>

                        <!-- Status -->
                        <span class="badge 
                            @if($event->status == 'published') bg-success
                            @elseif($event->status == 'draft') bg-secondary
                            @else bg-danger
                            @endif">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h5 class="fw-semibold mb-2">
                        {{ $event->title }}
                    </h5>

                    <!-- Description -->
                    <p class="text-muted small mb-3">
                        {{ $event->description }}
                    </p>

                    <!-- Info -->
                    <div class="small text-muted mb-3">
                        <div><i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y h:i A') }}
                        </div>

                        <div><i class="bi bi-geo-alt"></i>
                            {{ $event->location ?? 'N/A' }}
                        </div>

                        <div><i class="bi bi-people"></i>
                            Max: {{ $event->max_participants ?? 'Unlimited' }}
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer bg-white border-top d-flex justify-content-between">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye"></i> View
                    </button>

                    <div class="d-flex gap-1">
                        <button class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
function showContainer(id, el) {
    // Hide all containers
    document.getElementById('container1').style.display = 'none';
    document.getElementById('container2').style.display = 'none';

    // Show selected container
    document.getElementById(id).style.display = 'block';

    // Remove active class from all nav links
    document.querySelectorAll('.nav-item-link').forEach(link => {
        link.classList.remove('active');
    });

    // Add active to clicked link
    el.classList.add('active');
}
</script>
</body>
</html>