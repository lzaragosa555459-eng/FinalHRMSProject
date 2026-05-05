@extends('layouts.apphr')

@section('title', 'Edit Employee')

@section('content')

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
        padding: 40px;
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

    .section-title {
        color: var(--dark-purple);
        font-weight: 800;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
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

    .required-dot {
        color: #dc3545;
        margin-left: 3px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card-custom">

                <h2 class="section-title">
                    <i class="bi bi-pencil-square"></i> Edit Employee
                </h2>

                <form action="{{ route('hr.Crud.update', $employee->employee_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        {{-- BASIC INFO --}}
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
                            <input type="text" name="phone_number" class="form-control"
                                value="{{ old('phone_number', $employee->phone_number) }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
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
                                <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Role Type</label>
                            <select name="role" class="form-select">
                                <option value="employee" {{ $employee->role == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="head" {{ $employee->role == 'head' ? 'selected' : '' }}>Department Head</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Position</label>
                            <select name="position_id" class="form-select">
                                <option value="">Select position</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->position_id }}"
                                        {{ $employee->position_id == $pos->position_id ? 'selected' : '' }}>
                                        {{ $pos->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Applicant (Optional)</label>
                            <select name="applicant_id" class="form-select">
                                <option value="">None</option>
                                @foreach($applicants as $app)
                                    <option value="{{ $app->applicant_id }}"
                                        {{ $employee->applicant_id == $app->applicant_id ? 'selected' : '' }}>
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
                            <label class="form-label">Manager</label>
                            <select name="manager_id" class="form-select">
                                <option value="">None</option>
                                @foreach($managers as $man)
                                    <option value="{{ $man->employee_id }}"
                                        {{ $employee->manager_id == $man->employee_id ? 'selected' : '' }}>
                                        {{ $man->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">User Account</label>
                            <select name="user_id" class="form-select">
                                <option value="">None</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}"
                                        {{ $employee->user_id == $user->user_id ? 'selected' : '' }}>
                                        {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="resigned" {{ $employee->status == 'resigned' ? 'selected' : '' }}>Resigned</option>
                            </select>
                        </div>

                    </div>
                        {{-- USER ACCOUNT --}}
                        <div class="col-12 mt-5">
                            <h5 class="fw-bold text-dark">
                                <i class="bi bi-person-badge me-2"></i> User Account
                            </h5>
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                value="{{ old('username', $employee->user->username ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $employee->user->email ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password</label>

                            <div class="input-group">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Leave blank to keep current password">

                                <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </span>
                            </div>
                            <small class="text-muted">Only fill if you want to change password</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">System Role</label>
                            <select name="system_role" class="form-select">
                                <option value="employee" {{ optional($employee->user)->system_role == 'employee' ? 'selected' : '' }}>
                                    Employee
                                </option>
                                <option value="hr" {{ optional($employee->user)->system_role == 'hr' ? 'selected' : '' }}>
                                    HR
                                </option>
                            </select>
                        </div>
                    {{-- BUTTONS --}}
                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <a href="{{ route('hr.EmployeesDetails.employee_details', $employee->employee_id) }}"
                           class="btn btn-outline-secondary rounded-pill px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-purple rounded-pill px-4">
                            <i class="bi bi-check-lg me-1"></i> Update Employee
                        </button>
                    </div>
                    
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection