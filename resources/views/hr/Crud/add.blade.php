
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #EDF2FA;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
<div class="container mt-4">
    <div class="row">
        
        <div class="col-8" style="margin-left: 20%;">
<form method="POST" action="{{ route('hr.Crud.add') }}" enctype="multipart/form-data">
    @csrf
    <h2>Add Employee</h2>
    <div class="row">

        <div class="col-md-6">
            <label class="form-label">Employee Number<span class="text-danger">*</span></label>
            <input type="text" name="employee_number" class="form-control" id="employee_number">
        </div>

        <div class="col-md-6">
            <label class="form-label">Name<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <div class="col-md-6">
            <label class="form-label">Phone Number<span class="text-danger">*</span></label>
            <input type="text" name="phone_number" class="form-control" id="phone_number">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" id="email">
        </div>

        <div class="col-12">
            <label class="form-label">Address<span class="text-danger">*</span></label>
            <textarea name="address" class="form-control" id="address"></textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth">
        </div>

        <div class="col-md-6">
            <label class="form-label">Gender<span class="text-danger">*</span></label>
            <select name="gender" class="form-control" id="gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Profile Image</label>
            <input type="file" name="profile_image" class="form-control" id="profile_image">
        </div>

        <div class="col-md-6">
            <label class="form-label">Role<span class="text-danger">*</span></label>
            <select name="role" class="form-control" id="role">
                <option value="employee">Employee</option>
                <option value="head">Head</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Department name<span class="text-danger">*</span></label>
         
               <select name="department_id" class="form-control" id="department_id">
                <option value="">Select department</option>
            @foreach($departments as $dept)
                <option  value="{{ $dept->department_id }}">{{ $dept->name }}</option>
            @endforeach
               </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Position<span class="text-danger">*</span></label>
         
            <select name="position_id" class="form-control" id="position_id">
                <option value="">Select position</option>
                @foreach($positions as $pos)
                    <option  value="{{ $pos->position_id }}">{{ $pos->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Applicant ID</label>
            <select name="applicant_id" class="form-control" id="applicant_id">
                <option value="">Select Applicant</option>
                @foreach($applicants as $app)
                    <option value="{{ $app->applicant_id }}">{{ $app->first_name }} {{ $app->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Hire Date</label>
            <input type="date" name="hire_date" class="form-control" id="hire_date">
        </div>

        <div class="col-md-6">
            <label class="form-label">Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" id="salary">
        </div>

        <div class="col-md-6">
            <label class="form-label">Manager name</label>
            <select name="manager_id" class="form-control" id="manager_id">
                <option value="">Select manager</option>
                @foreach($managers as $man)
                    <option value="{{ $man->employee_id }}">{{ $man->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">User name</label>
            <select name="user_id" class="form-control" id="user_id">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="resigned">Resigned</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

    </div>
   
     <div class="mt-4 text-end">
         <a href="{{ route('hr.employees') }}" class="btn btn-secondary">
        Back
    </a>
     </div>
    <div class="mt-4 text-end">
        <button class="btn btn-success">Save Employee</button>
    </div>
</form>
        </div>
    </div>
</div>

<script>
    function saveEmployee() {
    const formData = {
        employee_number: document.getElementById('employee_number').value,
        name: document.getElementById('name').value,
        phone_number: document.getElementById('phone_number').value,
        email: document.getElementById('email').value,
        address: document.getElementById('address').value,
        date_of_birth: document.getElementById('date_of_birth').value,
        gender: document.getElementById('gender').value,
        profile_image: document.getElementById('profile_image').value,
        role: document.getElementById('role').value,
        department_id: document.getElementById('department_id').value,
        position_id: document.getElementById('position_id').value,
        applicant_id: document.getElementById('applicant_id').value,
        hire_date: document.getElementById('hire_date').value,
        salary: document.getElementById('salary').value,
        manager_id: document.getElementById('manager_id').value,
        user_id: document.getElementById('user_id').value,
        status: document.getElementById('status').value,
    };
}
</script>

</body>
</html>