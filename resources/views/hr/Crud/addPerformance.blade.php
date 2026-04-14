<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container mt-4">
                    <div class="card shadow-sm">
                        <div class="d-flex justify-content-between card-header bg-primary text-white">
                            <h5 class="mb-0">Performance Review</h5>
                            <h5><strong>Employee: </strong>{{ $employeeID->name }}</h5>
                        </div>

                        <div class="row m-4">
                            <form action="{{ isset($performance) 
                                    ? route('UpdateEmployeeRating', [
                                        'employee_id' => $employeeID->employee_id,
                                        'performance_id' => $performance->performance_id
                                    ]) 
                                    : route('AddEmployeeRating', $employeeID->employee_id) }}" 
                                method="POST">

                                @csrf

                                @if(isset($performance))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">

                                    <!-- Reviewer -->
                                    <div class="col-md-6">
                                        <label for="reviewer_id" class="form-label">Reviewer</label>
                                            <select name="reviewer_id" class="form-select">
                                                <option value="">Select Reviewer HR</option>

                                                @foreach($humanresource as $hr)
                                                    <option value="{{ $hr->employee->employee_id }}"
                                                        {{ old('reviewer_id', $performance->reviewer_id ?? '') == $hr->employee->employee_id ? 'selected' : '' }}>
                                                        {{ $hr->employee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <!-- Review Period -->
                                    <div class="col-md-6">
                                        <label for="review_period" class="form-label">Review Period</label>
                                        <input type="text" name="review_period" id="review_period" 
                                            class="form-control" placeholder="e.g. Q1 2026" value="{{ old('review_period', $performance->review_period ?? '')}}">
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-md-6">
                                        <label for="rating" class="form-label">Rating</label>
                                       <input type="number" step="0.01" min="0" max="5" 
                                            name="rating" id="rating" class="form-control" placeholder="0.00 - 5.00" value="{{ old('rating', $performance->rating ?? '')}}">
                                    </div>

                                    <!-- Review Date -->
                                    <div class="col-md-6">
                                       <label for="review_date" class="form-label">Review Date</label>
                                        <input type="date" name="review_date" id="review_date" class="form-control" value="{{ old('review_date', $performance->review_date ?? '') }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
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

                                    <!-- Comments -->
                                    <div class="col-12">
                                        <label for="comments" class="form-label">Comments</label>
                                        <textarea name="comments" id="comments" rows="4" 
                                                class="form-control" placeholder="Write comments here..." >{{ old('comments', $performance->comments ?? '') }}</textarea>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('hr.EmployeesDetails.employee_details', $employeeID->employee_id) }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-save"></i> Save Review
                                        </button>
                                       
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>