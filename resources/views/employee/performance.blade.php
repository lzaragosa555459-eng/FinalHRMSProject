<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

@extends('layouts.app')

@section('title', 'Performance')

@section('content')

<h1 class="mb-4">My Performance Records</h1>

<div class="container">
    <div class="row">
        <div class="col-7">
             <!-- Chart -->
            <div style="height:400px;">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="bg-light p-4 rounded h-100 d-flex flex-column">

                <h4 class="mb-3">Performance</h4>

   

                <!-- List -->
                <div class="d-flex flex-column gap-4 mt-3"
                    style="max-height: 600px; overflow-y: auto; padding-right: 10px;">

                    @forelse($performances as $perf)
                        <div>
                            <h6>
                                Reviewer: <strong>{{ $perf->reviewer->name ?? 'N/A' }}</strong>
                            </h6>

                            <h6 class="mb-1">
                                Review Period:
                                <strong>{{ $perf->review_period }}</strong>
                            </h6>

                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span class="badge 
                                    @if($perf->status == 'Reviewed') bg-success 
                                    @elseif($perf->status == 'Completed') bg-primary 
                                    @else bg-secondary 
                                    @endif">
                                    {{ $perf->status }}
                                </span>
                            </p>

                            <p class="mb-1">
                                <strong>Rating:</strong> {{ $perf->rating }}
                            </p>

                            <p class="mb-1">
                                <strong>Review Date:</strong> {{ $perf->review_date }}
                            </p>

                            <p class="mb-0">
                                <strong>Comments:</strong><br>
                                <span class="text-muted">{{ $perf->comments }}</span>
                            </p>
                        </div>
                        <hr>
                    @empty
                        <p class="text-muted text-center">No performance records found.</p>
                    @endforelse

                </div>

            </div>
        </div>
    </div>
</div>

<!-- IMPORTANT: Scripts HERE -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const labels = @json($performances->pluck('review_period'));
    const ratings = @json($performances->pluck('rating'));

    const ctx = document.getElementById('performanceChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Rating',
                data: ratings,
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });

});
</script>

@endsection
</body>
</html>