<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>Create Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f0f7; /* Soft purple background */
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

        .header-accent {
            background: linear-gradient(135deg, #6f42c1 0%, #4b2a89 100%);
            color: white;
            padding: 30px;
            text-align: center;
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
            padding: 12px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background-color: var(--dark-purple);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-purple {
            border-color: var(--primary-purple);
            color: var(--primary-purple);
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="text-decoration-none text-purple fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Back to Department
                </a>
            </div>

            <div class="card card-custom">
                <div class="header-accent">
                    <i class="bi bi-calendar-plus fs-1 mb-2"></i>
                    <h3 class="mb-0 fw-bold">Schedule New Event</h3>
                    <p class="mb-0 opacity-75">Organize meetings, trainings, or social gatherings</p>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('hr.Crud.addEvent') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Q3 Strategy Planning" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Start Date & Time</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-calendar-event"></i></span>
                                    <input type="datetime-local" name="start_datetime" class="form-control border-start-0" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Date & Time</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-calendar-check"></i></span>
                                    <input type="datetime-local" name="end_datetime" class="form-control border-start-0" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Venue / Location</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" name="location" class="form-control border-start-0" placeholder="Room 101, Main Office, or Google Meet link" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Host Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}">
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Event Category</label>
                                <select name="event_type" class="form-select" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="meeting">Meeting</option>
                                    <option value="training">Training</option>
                                    <option value="team_building">Team Building</option>
                                    <option value="social">Social</option>
                                    <option value="workshop">Workshop</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Max Capacity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-people"></i></span>
                                    <input type="number" name="max_participants" class="form-control border-start-0" min="1" placeholder="Unlimited" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Event Brief / Agenda</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Mention the goals or required preparations..." required></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Publication Status</label>
                            <div class="d-flex gap-3">
                                <div class="form-check border rounded-3 p-2 px-4 flex-grow-1">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="draft" checked>
                                    <label class="form-check-label text-muted" for="status1">Draft Only</label>
                                </div>
                                <div class="form-check border rounded-3 p-2 px-4 flex-grow-1">
                                    <input class="form-check-input" type="radio" name="status" id="status2" value="published">
                                    <label class="form-check-label text-success fw-bold" for="status2">Publish Now</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-purple btn-lg shadow">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i> Create Event
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