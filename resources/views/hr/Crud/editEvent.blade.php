<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Edit Event</span>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-0 text-center pt-4">
                    <h4 class="mb-0">Update Event</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('hr.Crud.updateEvent', $event->event_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $event->title }}" required>
                        </div>

                        <!-- Dates -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Start Date & Time</label>
                                <input type="datetime-local" name="start_datetime" class="form-control"
                                       value="{{ \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i') }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_datetime" class="form-control"
                                       value="{{ \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i') }}"
                                       required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control"
                                   value="{{ $event->location }}" required>
                        </div>

                        <!-- Department -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department_id" class="form-select">
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}"
                                        {{ $event->department_id == $department->department_id ? 'selected' : '' }}>
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
                                    <option value="meeting" {{ $event->event_type == 'meeting' ? 'selected' : '' }}>Meeting</option>
                                    <option value="training" {{ $event->event_type == 'training' ? 'selected' : '' }}>Training</option>
                                    <option value="team_building" {{ $event->event_type == 'team_building' ? 'selected' : '' }}>Team Building</option>
                                    <option value="social" {{ $event->event_type == 'social' ? 'selected' : '' }}>Social</option>
                                    <option value="workshop" {{ $event->event_type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Max Participants</label>
                                <input type="number" name="max_participants" class="form-control"
                                       value="{{ $event->max_participants }}" min="1" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update Event
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