@extends('layouts.apphr')

@section('title', 'create event')

@section('content')

    <style>
        body {
            background-color: #f3f0f7;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #4b2a89;
            --light-purple: #efebf7;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.1);
            background-color: white;
            overflow: hidden;
        }

        .header-gradient {
            background: linear-gradient(135deg, #6f42c1 0%, #4b2a89 100%);
            color: white;
            padding: 2.5rem 2rem;
        }

        .employee-badge {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: inline-block;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.15);
        }

        .btn-purple {
            background-color: var(--primary-purple);
            color: white;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
        }

        .btn-purple:hover {
            background-color: var(--dark-purple);
            color: white;
        }

        .rating-note {
            font-size: 0.8rem;
            color: var(--primary-purple);
            background-color: var(--light-purple);
            padding: 10px;
            border-radius: 8px;
            margin-top: 5px;
        }
    </style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card card-custom">
                <div class="header-gradient d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h3 class="mb-1 fw-bold">Performance Review</h3>
                        <p class="mb-0 opacity-75">Evaluate and document employee growth</p>
                    </div>
                    <div class="employee-badge">
                        <span class="small opacity-75 d-block">Employee Name</span>
                        <span class="fw-bold fs-5 text-white">{{ $employeeID->name }}</span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ isset($performance) 
                            ? route('UpdateEmployeeRating', ['employee_id' => $employeeID->employee_id, 'performance_id' => $performance->performance_id]) 
                            : route('AddEmployeeRating', $employeeID->employee_id) }}" 
                        method="POST">

                        @csrf
                        @if(isset($performance))
                            @method('PUT')
                        @endif

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="reviewer_id" class="form-label">Assigned Reviewer (HR)</label>
                                <select name="reviewer_id" class="form-select">
                                    <option value="">Select Reviewer</option>
                                    @foreach($humanresource as $hr)
                                        <option value="{{ $hr->employee->employee_id }}"
                                            {{ old('reviewer_id', $performance->reviewer_id ?? '') == $hr->employee->employee_id ? 'selected' : '' }}>
                                            {{ $hr->employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="review_period" class="form-label">Review Period</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-calendar3"></i></span>
                                    <input type="text" name="review_period" id="review_period" 
                                        class="form-control border-start-0" placeholder="e.g. Q1 2026" 
                                        value="{{ old('review_period', $performance->review_period ?? '')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="rating" class="form-label">Numerical Rating (0 - 5)</label>
                                <input type="number" step="0.01" min="0" max="5" 
                                    name="rating" id="rating" class="form-control" placeholder="0.00" 
                                    value="{{ old('rating', $performance->rating ?? '')}}">
                                <div class="rating-note">
                                    <i class="bi bi-info-circle me-1"></i> Standard: <strong>1.00</strong> (Needs Improvement) to <strong>5.00</strong> (Excellent)
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="review_date" class="form-label">Review Date</label>
                                <input type="date" name="review_date" id="review_date" class="form-control" 
                                    value="{{ old('review_date', $performance->review_date ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Evaluation Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Select Status</option>
                                    @foreach($status as $stat)
                                        <option value="{{ $stat }}"
                                            {{ old('status', $performance->status ?? '') == $stat ? 'selected' : '' }}>
                                            {{ $stat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="comments" class="form-label">Detailed Comments & Feedback</label>
                                <textarea name="comments" id="comments" rows="4" 
                                    class="form-control" placeholder="Describe strengths, weaknesses, and areas for development..." >{{ old('comments', $performance->comments ?? '') }}</textarea>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="d-flex justify-content-end gap-2 border-top pt-4">
                                    <a href="{{ route('hr.EmployeesDetails.employee_details', $employeeID->employee_id) }}" 
                                       class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                                    <button type="submit" class="btn btn-purple rounded-pill px-4 shadow-sm" style="background-color: #4b2a89;">
                                        <i class="bi bi-check-circle me-2"></i> {{ isset($performance) ? 'Update' : 'Save' }} Review
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
