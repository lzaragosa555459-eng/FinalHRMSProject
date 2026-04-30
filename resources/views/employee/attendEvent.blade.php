@extends('layouts.app')

@section('title', 'Events')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Modern Flat Event Card */
    .event-card {
        border: none !important;
        border-radius: 16px;
        transition: all 0.3s ease;
        background: #fff;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        overflow: hidden;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(111, 66, 193, 0.1) !important;
    }

    /* Header area of the card */
    .event-header {
        background-color: #f8f7fa;
        padding: 20px;
        border-bottom: 1px solid #efebf7;
    }

    .event-type-tag {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #6f42c1; /* Core Purple */
        color: #fff;
        padding: 5px 10px;
        border-radius: 8px;
    }

    .status-badge-soft {
        font-size: 0.65rem;
        color: #4b208c;
        padding: 5px 12px;
        font-weight: 700;
        border-radius: 50px;
        text-transform: uppercase;
    }

    .event-title {
        color: #2d1a4d;
        font-weight: 700;
        line-height: 1.3;
        margin-top: 10px;
    }

    .info-grid {
        padding: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.85rem;
        margin-bottom: 8px;
        color: #6c757d;
    }

    .info-item i {
        color: #6f42c1;
        font-size: 1rem;
    }

    /* CoreHR Purple Button */
    .btn-register {
        background: #6f42c1;
        color: #fff;
        font-weight: 700;
        border-radius: 20px;
        padding: 8px 20px;
        border: none;
        transition: 0.3s;
        font-size: 0.85rem;
    }

    .btn-register:hover {
        background: #5a32a3;
        color: #fff;
        box-shadow: 0 4px 10px rgba(111, 66, 193, 0.2);
    }

    .registered-label {
        background: #efebf7;
        color: #6f42c1;
        padding: 8px 15px;
        font-size: 0.8rem;
        font-weight: 700;
        border-radius: 12px;
        display: flex;
        align-items: center;
    }

    .header-section {
        margin-top: 40px;
        margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="col-lg-11 offset-lg-1">
        <div class="header-section border-bottom border-2 pb-3" style="border-color: #e2d9f3 !important;">
            <h1 class="display-5 fw-bold m-0" style="color: #2d1a4d;">Upcoming Events</h1>
            <p class="text-muted fw-bold small text-uppercase mb-0">Stay connected with your department</p>
        </div>

        <div class="row g-4 mb-5">
            @foreach($events as $event)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card event-card h-100">
                    <div class="event-header">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="event-type-tag">
                                {{ str_replace('_', ' ', $event->event_type) }}
                            </span>
                            <span class="status-badge-soft">
                                {{ $event->status }}
                            </span>
                        </div>
                        <h4 class="event-title text-uppercase">
                            {{ $event->title }}
                        </h4>
                        <small class="text-muted fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                            <i class="bi bi-building me-1"></i> {{ $event->Department->name }}
                        </small>
                    </div>

                    <div class="card-body d-flex flex-column p-0">
                        <div class="info-grid flex-grow-1">
                            <p class="text-secondary small mb-4">
                                {{ Str::limit($event->description, 100) }}
                            </p>
                            
                            <div class="info-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y') }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ \Carbon\Carbon::parse($event->start_datetime)->format('h:i A') }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                        </div>

                        <div class="p-3 border-top bg-light" style="border-color: #efebf7 !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="fw-bold text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-people-fill me-1 text-primary"></i>{{ $event->max_participants }} SLOTS
                                </small>

                                @if(!in_array($event->event_id, $attendances))
                                    <a href="{{ route('attend', ['employee_id' => $user->employee_id, 'event_id' => $event->event_id]) }}"
                                       class="btn btn-register btn-sm" 
                                       onclick="return confirm('Register for this event?')">
                                        JOIN EVENT <i class="bi bi-chevron-right ms-1"></i>
                                    </a>
                                @else
                                    <span class="registered-label">
                                        <i class="bi bi-check2-circle me-2"></i> REGISTERED
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection