<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee portal</title>
</head>
<body>
@extends('layouts.app')

@section('title', 'Events')

@section('content')

<h1 class="mb-4">Events</h1>

<div class="row g-4">
    @foreach($events as $event)
    <div class="col-md-6 col-lg-4">

<div class="card border-0 shadow-sm h-100 d-flex flex-column">

    <div class="card-body flex-grow-1">

                <!-- Type + Status -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-primary text-white rounded p-2">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                        <small class="text-muted text-uppercase">
                            {{ str_replace('_', ' ', $event->event_type) }}
                        </small>
                    </div>

                    <span class="badge bg-success">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <!-- Title -->
                <h5 class="fw-semibold mb-1">
                    {{ $event->title }}
                </h5>

                <!-- Department -->
                <h6 class="text-muted small mb-3">
                    {{ $event->Department->name }} Department
                </h6>

                <!-- Description -->
                <p class="text-muted small mb-3">
                    {{ $event->description }}
                </p>

                <!-- Info -->
                <div class="small text-muted">
                    <div class="mb-1">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y h:i A') }}
                        -
                        {{ \Carbon\Carbon::parse($event->end_datetime)->format('M d, Y h:i A') }}
                    </div>

                    <div class="mb-1">
                        <i class="bi bi-geo-alt"></i>
                        {{ $event->location }}
                    </div>

                    <div>
                        <i class="bi bi-people"></i>
                        Max: {{ $event->max_participants }}
                    </div>
                </div>

            </div>

            <!-- FIXED BUTTON AREA -->
            <div class="card-footer bg-white border-0 mt-auto">
            @if(!in_array($event->event_id, $attendances))
                <div class="d-flex justify-content-end">
                    <a href="{{ route('attend', [
                        'employee_id' => $user->employee_id,
                        'event_id' => $event->event_id
                    ]) }}"
                    class="btn btn-outline-primary btn-sm" onclick="return confirm('Are you sure you want to register for this event?')">
                        Register
                    </a>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <i class="bi bi-check bg-light text-success">Registered!</i>
                </div>
            @endif

            </div>

        </div>
    </div>
    @endforeach
</div>

@endsection
</body>
</html>