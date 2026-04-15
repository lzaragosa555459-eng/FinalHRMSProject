<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container mt-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="mb-0">Department Form</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('AddNewDepartment') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="department_number" class="form-label">Department Number</label>
                                    <input type="text" class="form-control" id="department_number" name="department_number" placeholder="Enter department number e.g DEP001">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Department Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter department name">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Save Department
                                </button>
                                <a href="{{ route('hr.organization') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>