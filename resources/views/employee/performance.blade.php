@extends('layouts.app')

@section('title', 'Performance')

@section('content')
<style>
    /* Neo-brutalist Performance Aesthetics */
    .stat-card {
        background: #fff;
        border: 3px solid #000;
        box-shadow: 6px 6px 0px #000;
        padding: 1.5rem;
        transition: 0.2s;
    }
    
    .perf-record-card {
        background: #fff;
        border: 2px solid #000;
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .perf-record-card:hover {
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px #000;
    }

    .perf-header {
        background: #000;
        color: #fff;
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .rating-number {
        font-size: 2.5rem;
        font-weight: 900;
        line-height: 1;
        color: #000;
    }

    .scroll-container::-webkit-scrollbar {
        width: 8px;
    }
    .scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .scroll-container::-webkit-scrollbar-thumb {
        background: #000;
    }

    .badge-status {
        border-radius: 0;
        border: 2px solid #000;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.7rem;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="mb-5">
        <h1 class="display-6 fw-black mb-0 text-uppercase">Performance Analytics</h1>
        <p class="text-muted small fw-bold uppercase">Historical data and reviewer feedback</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="stat-card h-100">
                <h5 class="fw-black text-uppercase mb-4">Rating Progress</h5>
                <div style="height:350px;">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <h5 class="fw-black text-uppercase mb-3">Review History</h5>
            <div class="scroll-container" style="max-height: 600px; overflow-y: auto; padding-right: 15px;">
                @forelse($performances as $perf)
                    <div class="perf-record-card">
                        <div class="perf-header d-flex justify-content-between align-items-center">
                            <span>Period: {{ $perf->review_period }}</span>
                            <span>{{ $perf->review_date }}</span>
                        </div>
                        
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="mb-0 fw-bold">Reviewer</h6>
                                    <span class="text-muted small">{{ $perf->reviewer->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-end">
                                    <div class="rating-number">{{ $perf->rating }}</div>
                                    <span class="small fw-bold text-uppercase">Score</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="badge badge-status 
                                    @if($perf->status == 'Reviewed') bg-white text-dark 
                                    @elseif($perf->status == 'Completed') bg-dark text-white 
                                    @else bg-light text-muted @endif">
                                    {{ $perf->status }}
                                </span>
                            </div>

                            <div class="bg-light p-2 border-start border-3 border-dark">
                                <p class="small mb-0 italic">"{{ $perf->comments }}"</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="stat-card text-center py-5">
                        <p class="text-muted mb-0">No performance records found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const labels = @json($performances->pluck('review_period'));
    const ratings = @json($performances->pluck('rating'));

    const ctx = document.getElementById('performanceChart');

    new Chart(ctx, {
        type: 'line', // Changed to line for a more 'progress' feel
        data: {
            labels: labels,
            datasets: [{
                label: 'Rating Score',
                data: ratings,
                borderColor: '#000',
                backgroundColor: 'rgba(0,0,0,0.05)',
                borderWidth: 4,
                pointBackgroundColor: '#000',
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.3 // Smooth curves
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
                    grid: { color: '#eee' },
                    ticks: { font: { weight: 'bold' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { weight: 'bold' } }
                }
            }
        }
    });
});
</script>
@endsection