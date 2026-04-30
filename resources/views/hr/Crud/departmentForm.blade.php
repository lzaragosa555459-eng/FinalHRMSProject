@extends('layouts.apphr')

@section('title', isset($department) ? 'Edit' : 'Create' )

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
            padding: 2rem;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.15);
        }

        .btn-purple {
            background-color: var(--primary-purple);
            color: white;
            border-radius: 12px;
            padding: 10px 30px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background-color: var(--dark-purple);
            color: white;
            transform: translateY(-2px);
        }

        .btn-cancel {
            border-radius: 12px;
            padding: 10px 30px;
            color: #6c757d;
            background: #f8f9fa;
            border: 1px solid #ddd;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background: #e9ecef;
            color: #333;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(5px);
        }
/* 📱 iPhone / Mobile Fix */
@media (max-width: 576px) {

    .header-gradient {
        padding: 1.5rem 1rem;
    }

    .header-gradient h3 {
        font-size: 1.3rem;
    }

    .header-gradient p {
        font-size: 0.85rem;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }

    .form-label {
        font-size: 0.8rem;
    }

    .form-control {
        font-size: 0.9rem;
        padding: 10px;
    }

    .btn-purple,
    .btn-outline-secondary {
        width: 100%;
        display: block;
        text-align: center;
    }

    .d-flex.justify-content-end {
        flex-direction: column;
        gap: 10px !important;
    }

    .card-custom {
        border-radius: 14px;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .input-group-text {
        font-size: 0.85rem;
    }
}
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <div class="card card-custom">
                    <div class="header-gradient">
                        <div class="icon-box">
                            <i class="bi bi-diagram-3 fs-2 text-white"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">
                            {{ isset($department) ? 'Edit Department' : 'New Department' }}
                        </h3>
                        <p class="mb-0 opacity-75 small">Define organizational structure and goals</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ isset($department)
                            ? route('UpdateDepartment', $department->department_id)
                            : route('AddNewDepartment') }}"
                            method="POST">
                            @csrf
                            
                            @if(isset($department))
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="department_number" class="form-label">Department ID / Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="text" class="form-control border-start-0" id="department_number" name="department_number" 
                                        placeholder="e.g. DEP-101" 
                                        value="{{ old('department_number', $department->department_number ?? '' ) }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="name" class="form-label">Department Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-building"></i></span>
                                    <input type="text" class="form-control border-start-0" id="name" name="name" 
                                        placeholder="e.g. Human Resources" 
                                        value="{{ old('name', $department->name ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Purpose & Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" 
                                    placeholder="Briefly describe the department's responsibilities...">{{ old('description', $department->description ?? '') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                <a href="{{ route('hr.organization') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-purple shadow-sm text-white" style="background-color: #4b2a89;">
                                    <i class="bi bi-check-lg me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
