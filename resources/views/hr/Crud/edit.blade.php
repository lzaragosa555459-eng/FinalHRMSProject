<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee | {{ $employee->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
            transition: 0.3s;
        }

        .btn-purple:hover {
            background-color: var(--dark-purple);
            transform: translateY(-1px);
        }

        .employee-id-tag {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card card-custom">
                <div class="header-gradient d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Employee Profile</h3>
                        <p class="mb-0 opacity-75">Update personal details and organizational status</p>
                    </div>
                    <div class="text-end d-none d-md-block">
                        <span class="employee-id-tag">ID: {{ $employee->employee_number }}</span>
                        <h4 class="mt-2 mb-0 fw-bold">{{ $employee->name }}</h4>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('hr.Crud.update', $employee->employee_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label class="form-label">Employee Number</label>
                                <input type="text" name="employee_number" class="form-control"
                                       value="{{ old('employee_number', $employee->employee_number) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $employee->name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="phone_number" class="form-control border-start-0"
                                           value="{{ old('phone_number', $employee->phone_number) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0"
                                           value="{{ old('email', $employee->email) }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Residential Address</label>
                                <textarea name="address" class="form-control" rows="2">{{ old('address', $employee->address) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control"
                                       value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Update Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                                <small class="text-muted mt-1 d-block italic">Leave blank to keep current image</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Role Type</label>
                                <select name="role" class="form-select">
                                    <option value="employee" {{ $employee->role == 'employee' ? 'selected' : '' }}>Regular Employee</option>
                                    <option value="head" {{ $employee->role == 'head' ? 'selected' : '' }}>Department Head</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Position</label>
                                <select name="position_id" class="form-select" id="position_id">
                                    <option value="">Select position</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->position_id }}"
                                        {{ old('position_id', $employee->position_id) == $pos->position_id ? 'selected' : ''}}>
                                        {{ $pos->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Original Applicant Record</label>
                                <select name="applicant_id" class="form-select">
                                    <option value="">No linked applicant</option>
                                    @foreach($applicants as $app)
                                        <option value="{{ $app->applicant_id }}"
                                            {{ old('applicant_id', $employee->applicant_id) == $app->applicant_id ? 'selected' : '' }}>
                                            {{ $app->first_name }} {{ $app->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hire Date</label>
                                <input type="date" name="hire_date" class="form-control"
                                       value="{{ old('hire_date', $employee->hire_date) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Reporting Manager</label>
                                <select name="manager_id" class="form-select">
                                    <option value="">Select manager</option>
                                    @foreach($managers as $man)
                                        <option value="{{ $man->employee_id }}"
                                            {{ old('manager_id', $employee->manager_id) == $man->employee_id ? 'selected' : '' }}>
                                            {{ $man->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Linked System User</label>
                                <select name="user_id" class="form-select">
                                    <option value="">Select user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->user_id }}"
                                            {{ old('user_id', $employee->user_id) == $user->user_id ? 'selected' : '' }}>
                                            {{ $user->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Employment Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="resigned" {{ $employee->status == 'resigned' ? 'selected' : '' }}>Resigned</option>
                                    <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-5 d-flex justify-content-end gap-2 border-top pt-4">
                            <a href="{{ route('hr.EmployeesDetails.employee_details', $employee->employee_id) }}" 
                               class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-purple rounded-pill px-4 shadow-sm">
                                <i class="bi bi-save me-1"></i> Update Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>