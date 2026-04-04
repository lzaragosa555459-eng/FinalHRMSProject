@extends('hr.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Organization</title>
</head>
<style>
.card-container {
    display: flex;
    gap: 16px;
    overflow-x: auto;   /* enables horizontal scroll */
    padding: 10px;
}

.card-item {
    min-width: 250px;   /* important so cards stay side-by-side */
    height: 150px;
    background: #f8f9fa;
    border-radius: 12px;
    flex-shrink: 0;
}
.card-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-item:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.card-container::-webkit-scrollbar {
    display: none;
}

.card-container {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
<body style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container mt-5" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
        <a href="{{ route('hr.organization')}}" class="btn btn-outline-secondary rounded ">
             Back
        </a>
         <h1 class="fw-bold text-dark mb-1">
                Department: 
                <span class="text-primary">
                    {{ $employees->first()?->department?->name ?? 'N/A' }}
                </span>
        </h1>
        <div  class="d-flex align-items-center justify-content-between mb-1 mt-4">
        <h3>Events</h3>
        <input type="submit" value="+Add event" class="btn btn-primary">
        </div>
   
    
    <!--CAROUSEL SLIDERS CONTAINER-->
    <div class="card-container">
     @foreach($getEvents as $event)
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
    <div class="container mt-5" style="max-width: 1200px; margin-left: auto; margin-right: auto;">

    <!-- Department Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
           <h3>Employees</h3>
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
<script>
    let index = 0;

function showPanel(i) {
    const track = document.getElementById('track');
    index = i;
    track.style.transform = `translateX(-${index * 100}%)`;
}
</script>
</body>
</html>