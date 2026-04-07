
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #EDF2FA;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
<div class="container mt-4">
    <div class="row">
        
        <div class="col-8" style="margin-left: 20%;">
<form action="{{ route('hr.Crud.update', $employee->employee_id) }}" method="POST">
    @csrf
    @method('PUT')
  

    <h2>Edit Employee</h2>

    <div class="row">

        <div class="col-md-6">
            <label class="form-label">Employee Number</label>
            <input type="text" name="employee_number" class="form-control"
                   value="{{ old('employee_number', $employee->employee_number) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $employee->name) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control"
                   value="{{ old('phone_number', $employee->phone_number) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $employee->email) }}">
        </div>

        <div class="col-12">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address', $employee->address) }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control"
                   value="{{ old('date_of_birth', $employee->date_of_birth) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control">
                <option value="">Select Gender</option>
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
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="employee" {{ $employee->role == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="head" {{ $employee->role == 'head' ? 'selected' : '' }}>Head</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">
                Department name<span class="text-danger">*</span>
            </label>

            <select name="department_id" class="form-control" id="department_id">
                <option value="">Select department</option>

                @foreach($departments as $dept)
                    <option value="{{ $dept->department_id }}"
                        {{ old('department_id', $employee->department_id) == $dept->department_id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Position ID</label>
             <select name="position_id" class="form-control" id="position_id">
                <option value="">Select position</option>

                @foreach($positions as $pos)
                    <option  value="{{ $pos->position_id }}"
                    {{ old('position_id', $employee->position_id) == $pos->position_id ? 'selected' : ''}}>
                    {{ $pos->title }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Applicant</label>
            <select name="applicant_id" class="form-control">
                <option value="">Select Applicant</option>

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
            <label class="form-label">Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control"
                   value="{{ old('salary', $employee->salary) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Manager</label>
            <select name="manager_id" class="form-control">
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
            <label class="form-label">User</label>
            <select name="user_id" class="form-control">
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
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="">Select Status</option>
                <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="resigned" {{ $employee->status == 'resigned' ? 'selected' : '' }}>Resigned</option>
                <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('hr.EmployeesDetails.employee_details', $employee->employee_id) }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-success">Update Employee</button>
    </div>
</form>
        </div>
    </div>
</div>

</body>
</html>