@extends('layouts.app')

@section('title', 'Events')

@section('content')
<style>
    .event-card {
        border: 2px solid #000 !important;
        border-radius: 0; /* Sharp corners for a modern look */
        transition: all 0.3s ease;
        background: #fff;
    }

    .event-card:hover {
        box-shadow: 8px 8px 0px #000; /* Neo-brutalism shadow */
        transform: translate(-4px, -4px);
    }

    .event-type-tag {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #000;
        color: #fff;
        padding: 4px 8px;
    }

    .status-badge-mono {
        font-size: 0.7rem;
        border: 1px solid #000;
        padding: 3px 10px;
        font-weight: 600;
        border-radius: 50px;
    }

    .event-title {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        line-height: 1.2;
    }

    .info-grid {
        border-top: 1px solid #eee;
        padding-top: 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    /* Button Styling */
    .btn-register {
        border: 2px solid #000;
        background: transparent;
        color: #000;
        font-weight: 800;
        border-radius: 0;
        transition: 0.2s;
    }

    .btn-register:hover {
        background: #000;
        color: #fff;
    }

    .registered-label {
        background: #f0f0f0;
        color: #000;
        padding: 8px 15px;
        font-size: 0.8rem;
        font-weight: 700;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="border-bottom border-3 border-dark mb-5 pb-2">
        <h1 class="display-5 fw-black m-0">UPCOMING EVENTS</h1>
        <p class="text-muted">Stay connected with your department</p>
    </div>

    <div class="row g-4">
        @foreach($events as $event)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card event-card h-100">
                <div class="card-body d-flex flex-column">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="event-type-tag">
                            {{ str_replace('_', ' ', $event->event_type) }}
                        </span>
                        <span class="status-badge-mono">
                            {{ strtoupper($event->status) }}
                        </span>
                    </div>

                    <h4 class="event-title mb-1 text-uppercase">
                        {{ $event->title }}
                    </h4>
                    <p class="text-muted small fw-bold mb-3">
                        {{ strtoupper($event->Department->name) }} DEPARTMENT
                    </p>

                    <p class="text-secondary small flex-grow-1">
                        {{ Str::limit($event->description, 120) }}
                    </p>

                    <div class="info-grid mt-3">
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
                </div>

                <div class="card-footer bg-white border-0 pb-4 pt-0">
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="fw-bold text-muted">
                            <i class="bi bi-people-fill me-1"></i>{{ $event->max_participants }} SLOTS
                        </small>

                        @if(!in_array($event->event_id, $attendances))
                            <a href="{{ route('attend', ['employee_id' => $user->employee_id, 'event_id' => $event->event_id]) }}"
                               class="btn btn-register btn-sm px-4" 
                               onclick="return confirm('Register for this event?')">
                                REGISTER →
                            </a>
                        @else
                            <span class="registered-label">
                                <i class="bi bi-check2-circle me-1"></i> REGISTERED
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection