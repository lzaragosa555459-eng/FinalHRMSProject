<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | {{ $event->title }}</title>

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
            border-radius: 12px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.15);
        }

        .btn-purple {
            background-color: var(--primary-purple);
            color: white;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background-color: var(--dark-purple);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
        }

        .btn-cancel {
            border-radius: 12px;
            padding: 12px 30px;
            color: #6c757d;
            background: #f8f9fa;
            border: 1px solid #ddd;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background: #e9ecef;
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card card-custom">
                <div class="header-gradient">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="status-badge">
                            <i class="bi bi-circle-fill me-1" style="font-size: 0.6rem;"></i> {{ $event->status }}
                        </div>
                        <i class="bi bi-calendar-event fs-1 opacity-50"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Update Event</h3>
                    <p class="mb-0 opacity-75">Modify scheduling, location, and participation details</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('hr.Crud.updateEvent', $event->event_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label">Event Title</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-pencil-square"></i></span>
                                    <input type="text" name="title" class="form-control border-start-0"
                                           value="{{ old('title', $event->title) }}" required placeholder="Enter event name">
                                </div>
                            </div>

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

                            <div class="col-12">
                                <label class="form-label">Location / Venue</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" name="location" class="form-control border-start-0"
                                           value="{{ old('location', $event->location) }}" required placeholder="Physical room or Meeting Link">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Assigned Department</label>
                                <select name="department_id" class="form-select">
                                    <option value="">-- All Departments --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_id }}"
                                            {{ $event->department_id == $department->department_id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Event Category</label>
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
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-people"></i></span>
                                    <input type="number" name="max_participants" class="form-control border-start-0"
                                           value="{{ old('max_participants', $event->max_participants) }}" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Publishing Status</label>
                                <select name="status" class="form-select">
                                    <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                    <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Published (Active)</option>
                                    <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Event Description & Agenda</label>
                                <textarea name="description" class="form-control" rows="4" required placeholder="Outline the purpose of this event...">{{ old('description', $event->description) }}</textarea>
                            </div>

                            <div class="col-12 pt-4 border-top mt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ url()->previous() }}" class="btn btn-cancel">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-purple shadow-sm">
                                        <i class="bi bi-check2-circle me-1"></i> Update Event Details
                                    </button>
                                </div>
                            </div>
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