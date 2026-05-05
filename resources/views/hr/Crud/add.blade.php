@extends('layouts.apphr')

@section('title', 'Add Employee')

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
                    <i class="bi bi-person-plus-fill"></i> Add New Employee
                </h2>

                <p class="text-muted mb-4">
                    Please fill in the required information to register a new employee in the system.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('hr.Crud.add') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        {{-- BASIC INFO --}}
                        <div class="col-md-6">
                            <label class="form-label">Employee Number<span class="required-dot">*</span></label>
                            <input type="text" name="employee_number" class="form-control" placeholder="EMP-2024-001">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Full Name<span class="required-dot">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number<span class="required-dot">*</span></label>
                            <input type="text" name="phone_number" class="form-control" placeholder="+63 900 000 0000">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address<span class="required-dot">*</span></label>
                            <textarea name="address" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth<span class="required-dot">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender<span class="required-dot">*</span></label>
                            <select name="gender" class="form-select">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Role Type<span class="required-dot">*</span></label>
                            <select name="employee_role" class="form-select">
                                <option value="employee">Employee</option>
                                <option value="head">Department Head</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Position<span class="required-dot">*</span></label>
                            <select name="position_id" class="form-select">
                                <option value="">Select position</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->position_id }}">{{ $pos->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Applicant (Optional)</label>
                            <select name="applicant_id" class="form-select">
                                <option value="">None</option>
                                @foreach($applicants as $app)
                                    <option value="{{ $app->applicant_id }}">{{ $app->first_name }} {{ $app->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hire Date</label>
                            <input type="date" name="hire_date" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Manager</label>
                            <select name="manager_id" class="form-select">
                                <option value="">None</option>
                                @foreach($managers as $man)
                                    <option value="{{ $man->employee_id }}">{{ $man->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">User Account</label>
                            <select name="user_id" class="form-select">
                                 <option value="">None</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="resigned">Resigned</option>
                            </select>
                        </div>

                        {{-- USER ACCOUNT SECTION --}}
                        <div class="col-12 mt-3">
                            <h5 class="fw-bold text-dark">Create User Account</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username<span class="required-dot">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Enter username">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email<span class="required-dot">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password<span class="required-dot">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">System Role<span class="required-dot">*</span></label>
                            <select name="system_role" class="form-select">
                                <option value="employee">Employee</option>
                                <option value="hr">HR</option>
                            </select>
                        </div>

                    </div>

                    {{-- BUTTONS --}}
                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-purple rounded-pill px-4">
                            <i class="bi bi-check-lg me-1"></i> Save Employee
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection