<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('title', 'Events')

@section('content')

<h1 class="mb-4">Events</h1>

<div class="row g-4">
    @foreach($events as $event)
    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

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

                    <span class="badge
                        @if($event->status == 'published') bg-success
                        @else bg-secondary
                        @endif">
                        {{ ucfirst($event->status) }}
                    </span>

                </div>

                <!-- Title -->
                <h5 class="fw-semibold mb-1">
                    {{ $event->title }}
                </h5>

                <!-- Department -->
                <h6 class="text-muted small mb-3">
                    Department ID: {{ $event->department_id }}
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

        </div>

    </div>
    @endforeach
</div>

@endsection
</body>
</html>