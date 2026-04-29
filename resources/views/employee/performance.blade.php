@extends('layouts.app')

@section('title', 'Performance')

@section('content')
<style>
    body {
        background-color: #f3f0f7 !important;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Modern Flat Stats */
    .stat-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(100, 50, 150, 0.05) !important;
        padding: 1.5rem;
    }
    
    .perf-record-card {
        background: #fff;
        border: 1px solid #efebf7;
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .perf-record-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(111, 66, 193, 0.1);
    }

    .perf-header {
        background: #f8f7fa;
        color: #6f42c1;
        padding: 0.6rem 1rem;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
        border-bottom: 1px solid #efebf7;
    }

    .rating-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        color: #2d1a4d;
    }

    /* Custom Scrollbar for CoreHR */
    .scroll-container::-webkit-scrollbar {
        width: 6px;
    }
    .scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .scroll-container::-webkit-scrollbar-thumb {
        background: #e2d9f3;
        border-radius: 10px;
    }
    .scroll-container::-webkit-scrollbar-thumb:hover {
        background: #6f42c1;
    }

    .badge-status {
        border-radius: 6px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.65rem;
        padding: 4px 10px;
    }

    .bg-soft-purple { background: #e2d9f3; color: #6f42c1; }
    .bg-soft-dark { background: #2d1a4d; color: #fff; }

    .comment-box {
        background-color: #fcfaff;
        border-left: 4px solid #6f42c1;
        padding: 10px;
        font-style: italic;
        color: #555;
    }

    .header-section {
        margin-top: 40px;
        margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="col-lg-11 offset-lg-1">
        <div class="header-section border-bottom border-2 pb-3" style="border-color: #e2d9f3 !important;">
            <h1 class="display-5 fw-bold m-0" style="color: #2d1a4d;">Performance Analytics</h1>
            <p class="text-muted small fw-bold text-uppercase mb-0">Historical data and reviewer feedback</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="stat-card h-100">
                    <h5 class="fw-bold text-uppercase mb-4" style="color: #6f42c1; font-size: 0.9rem; letter-spacing: 1px;">Rating Progress</h5>
                    <div style="height:350px;">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <h5 class="fw-bold text-uppercase mb-3" style="color: #6f42c1; font-size: 0.9rem; letter-spacing: 1px;">Review History</h5>
                <div class="scroll-container" style="max-height: 600px; overflow-y: auto; padding-right: 10px;">
                    @forelse($performances as $perf)
                        <div class="perf-record-card">
                            <div class="perf-header d-flex justify-content-between align-items-center">
                                <span>Period: {{ $perf->review_period }}</span>
                                <span>{{ \Carbon\Carbon::parse($perf->review_date)->format('M d, Y') }}</span>
                            </div>
                            
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-uppercase text-muted">Reviewer</h6>
                                        <span class="fw-bold" style="color: #4b208c;">{{ $perf->reviewer->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="text-end">
                                        <div class="rating-number">{{ $perf->rating }}</div>
                                        <span class="small fw-bold text-uppercase text-muted" style="font-size: 0.6rem;">Out of 5</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <span class="badge badge-status 
                                        @if($perf->status == 'Reviewed') bg-soft-purple 
                                        @elseif($perf->status == 'Completed') bg-soft-dark 
                                        @else bg-light text-muted @endif">
                                        {{ $perf->status }}
                                    </span>
                                </div>

                                <div class="comment-box">
                                    <p class="small mb-0">"{{ $perf->comments }}"</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="stat-card text-center py-5">
                            <i class="bi bi-bar-chart text-muted display-1 mb-3"></i>
                            <p class="text-muted mb-0">No performance records found yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const labels = @json($performances->pluck('review_period'));
    const ratings = @json($performances->pluck('rating'));
    const ctx = document.getElementById('performanceChart').getContext('2d');

    // Create Gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(111, 66, 193, 0.4)');
    gradient.addColorStop(1, 'rgba(111, 66, 193, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Rating Score',
                data: ratings,
                borderColor: '#6f42c1',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6f42c1',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    grid: { color: '#efebf7' },
                    ticks: { 
                        stepSize: 1,
                        font: { weight: 'bold', family: 'Segoe UI' },
                        color: '#6f42c1'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        font: { weight: 'bold', family: 'Segoe UI' },
                        color: '#6f42c1'
                    }
                }
            }
        }
    });
});
</script>
@endsection