@extends('layouts.apphr')

@section('title', 'Employee profile')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    /* Purple Theme Overrides */
    .bg-purple-gradient {
        background: linear-gradient(135deg, #6f42c1 0%, #4b2a89 100%);
        color: white;
    }

    .btn-outline-purple {
        border-color: #6f42c1;
        color: #6f42c1;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }

    .text-purple { color: #6f42c1 !important; }

    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background-color: white;
    }

    /* Status Badges */
    .badge-head { background-color: #ffc107; color: #000; }
    .badge-emp { background-color: #efebf7; color: #6f42c1; }

    /* Custom Scrollbar */
    .scroll-container::-webkit-scrollbar {
        width: 5px;
    }
    .scroll-container::-webkit-scrollbar-thumb {
        background: #d1c4e9;
        border-radius: 10px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container py-4">
        <div class="col-lg-11 offset-lg-1" style="margin-left: 2%;">
            
            <div class="mb-3 text-end">
                <a href="{{ route('hr.employees') }}" class="btn btn-white shadow-sm rounded-pill px-4">
                   <i class="bi bi-arrow-left me-2"></i> Back to List
                </a>
            </div>

            <div class="card-custom bg-purple-gradient p-5 text-center mb-4">
                <div class="rounded-circle overflow-hidden shadow-lg border border-4 border-white mx-auto mb-3"
                     style="width: 160px; height: 160px;">
                    @if($emp->profile_image || $emp->avatar)
                        <img src="{{ $emp->profile_photo_path ?? $emp->avatar }}"
                             alt="{{ $emp->name }}"
                             class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="w-100 h-100 bg-white text-purple d-flex justify-content-center align-items-center"
                             style="font-size: 50px; font-weight: bold;">
                            {{ strtoupper(substr($emp->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h2 class="fw-bold mb-1">{{ $emp->name }}</h2>
                <p class="opacity-75 fs-5 mb-2">{{ $emp->position?->title ?? 'Position Not Set' }}</p>

                @if($emp->employee_role === 'head')
                    <span class="badge rounded-pill badge-head px-3 py-2">
                        <i class="bi bi-star-fill me-1"></i> Department Head
                    </span>
                @else
                    <span class="badge rounded-pill bg-white text-dark px-3 py-2">Staff Member</span>
                @endif

                <div class="mt-4 d-flex justify-content-center gap-2">
                    <a href="{{ route('hr.EmployeesDetails.employee_by_department', $emp->position->department_id) }}" class="btn btn-sm btn-light rounded-pill px-3">
                        <i class="bi bi-building me-1"></i> Department
                    </a>
                    <a href="{{ route('hr.Crud.edit', $emp->employee_id) }}" class="btn btn-sm btn-light border-0 opacity-75 rounded-pill px-3">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    <a href="{{ route('gotoperfomanceform', $emp->employee_id) }}" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i> Add Performance
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-5">
                    <div class="card-custom p-4 h-100">
                        <h5 class="fw-bold text-purple mb-4"><i class="bi bi-info-circle me-2"></i>Employee Details</h5>
                        
                        <div class="mb-3">
                            <label class="text-muted small d-block">Employee Number</label>
                            <span class="fw-bold">{{ $emp->employee_number ?? '—' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Phone Number</label>
                            <span class="fw-bold">{{ $emp->phone_number ?? '—' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Department</label>
                            <span class="fw-bold text-purple">{{ $emp->position->department->name ?? '—' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Work Email</label>
                            <span class="fw-bold">{{ $emp->user->email ?? 'N/A' }}</span>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <label class="text-muted small d-block">Net Monthly Salary</label>
                            <h4 class="text-success fw-bold mb-0">
                                ₱{{ $emp->payroll && $emp->payroll->net_salary !== null ? number_format($emp->payroll->net_salary, 2) : '0.00' }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card-custom p-4 h-100">
                        <h5 class="fw-bold text-purple mb-3"><i class="bi bi-trophy me-2"></i>Performance Reviews</h5>
                        
                        <div style="height:200px;" class="mb-4">
                            <canvas id="performanceChart"></canvas>
                        </div>

                        <div class="scroll-container" style="max-height: 300px; overflow-y: auto;">
                            @forelse($performances as $perf)
                                <div class="p-3 border rounded-3 mb-3 bg-white hover-shadow">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $perf->review_period }}</h6>
                                            <small class="text-muted">By {{ $perf->reviewer->name }}</small>
                                        </div>
                                        <span class="badge rounded-pill 
                                            @if($perf->status == 'Reviewed')  text-success 
                                            @elseif($perf->status == 'Completed')  text-primary 
                                            @else  text-secondary @endif">
                                            {{ $perf->status }}
                                        </span>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="text-warning me-2">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="bi bi-star{{ $i <= $perf->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="fw-bold">{{ $perf->rating }}/5</span>
                                    </div>

                                    <p class="small text-muted mb-3 italic">"{{ $perf->comments }}"</p>

                                    @if(auth()->user()->employee_id == $perf->reviewer_id)
                                        <div class="d-flex justify-content-end gap-2 border-top pt-2">
                                            <a href="{{ route('gotoperfomanceform', [$emp->employee_id, $perf->performance_id]) }}" 
                                            class="btn btn-sm " title="Edit Review">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm" title="Delete Review">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-clipboard-x fs-2 text-muted"></i>
                                    <p class="text-muted mt-2">No performance records found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card-custom p-4">
                        <h5 class="fw-bold text-purple mb-4"><i class="bi bi-calendar-week me-2"></i>Attendance History</h5>
                        <canvas id="attendanceChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="mt-5 mb-5 p-4 bg-white rounded-4 border border-danger-subtle d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="text-danger fw-bold mb-1">Danger Zone</h5>
                    <p class="text-muted mb-0 small">Deleting an employee record is permanent and cannot be undone.</p>
                </div>
                <form action="{{ route('hr.Crud.delete', $emp->employee_id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 rounded-pill fw-bold">
                        <i class="bi bi-trash me-2"></i> Delete Employee
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
    const ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Rating Score',
                data: @json($ratings),
                borderColor: '#6f42c1',
                backgroundColor: 'rgba(111, 66, 193, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, max: 5 } }
        }
    });

    new Chart(document.getElementById('attendanceChart'), {
        type: 'bar',
        data: {
            labels: @json($dates),
            datasets: [
                {
                    label: 'Present',
                    data: @json($present),
                    backgroundColor: '#6f42c1',
                    borderRadius: 5
                },
                {
                    label: 'Late',
                    data: @json($late),
                    backgroundColor: '#ffc107',
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
@endsection