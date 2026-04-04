<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Attendance</title>
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
<body  style="background-color: #EDF2FA;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @extends('hr.sidebar')
   <div class="container mt-4" style="margin-left: 9%;">

  
    <div class="row">
        <div class="col-12">

            <!-- Header -->
            <div class="d-flex justify-content-end align-items-center mb-3">
                <a class="nav-link nav-item-link active me-4" href="#" 
                    onclick="showContainer('container1', this)">
                    Attendance
                    </a>

                    <a class="nav-link nav-item-link me-4" href="#" 
                    onclick="showContainer('container2', this)">
                    Leave Request
                    @if($countleaves > 0)
                     <span class="badge bg-danger ms-2">{{ $countleaves }}</span>
                     @endif
                    </a>
                    
                <select class="form-select w-auto shadow-sm ms-4">
                    <option>All</option>
                    <option>Present</option>
                    <option>Late</option>
                    <option>Absent</option>
                </select>
            </div>
         <div class="innercontaner" id="container1" style="display: block;">
            <!-- Card -->
              <h4 class="fw-semibold mb-2">Attendance</h4>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">

                    <!-- Scrollable Table -->
                    <div style="max-height: 350px; overflow-y: auto;">

                        <table class="table table-hover align-middle mb-0">
 
                            <!-- Sticky Header -->
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <!-- Data -->
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->attendance_id }}</td>
                                    <td class="fw-medium">
                                        {{ $attendance->employee->name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->time_in }}</td>
                                    <td>{{ $attendance->time_out }}</td>

                                    <td>
                                        @if($attendance->status == 'Present')
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Present</span>
                                        @elseif($attendance->status == 'Late')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Late</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Absent</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
            <br>
            <h4>Leave</h4>
            <!--LEAVE SECTION-->   
             <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">

                    <!-- Scrollable Table -->
                    <div style="max-height: 350px; overflow-y: auto;">

                        <table class="table table-hover align-middle mb-0">

                            <!-- Sticky Header -->
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <!-- Data -->
                            <tbody>
                                @foreach($approvedleaves as $leave)
                                <tr>
                                    <td>{{ $leave->leave_id }}</td>
                                    <td class="fw-medium">
                                        {{ $leave->employee->name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>{{ $leave->reason }}</td>

                                    <td>
                                        @if($leave->status == 'approved')
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Approved</span>
                                        @elseif($attendance->status == 'pending')
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Pending</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Disapproved</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>


          </div>
          <div class="innercontainer"  id="container2" style="margin-left: 0%; display: none;">
                <!--Request leaves-->
                  
                    <h4>Leave Request</h4>


                     <div style="max-height: 400px; overflow-y: auto;">

                        <table class="table table-hover align-middle mb-0">

                            <!-- Sticky Header -->
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <!-- Data -->
                            <tbody>
                                @foreach($pendingleaves as $leave)
                                <tr>
                                    <td>{{ $leave->leave_id }}</td>
                                    <td class="fw-medium">
                                        {{ $leave->employee->name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>{{ $leave->reason }}</td>

                                    <td>
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">pending</span>
                                    </td>
                                      <td>
                                        <!-- Action buttons (placeholder) -->
                                        <button class="btn btn-sm btn-success">Approve</button>
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>

                        </table>

                    </div>
          </div>
        </div>
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