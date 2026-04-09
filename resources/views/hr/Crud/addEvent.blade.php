<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Event Manager</a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card -->
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4">
                    <h4 class="mb-0 text-center">Create Event</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('hr.Crud.addEvent') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <!-- Dates -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Start Date & Time</label>
                                <input type="datetime-local" name="start_datetime" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_datetime" class="form-control" required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g. Room 101 or Online" required>
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}">
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type + Participants -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Event Type</label>
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
                                <label class="form-label">Max Participants</label>
                                <input type="number" name="max_participants" class="form-control" min="1" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Save Event
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>