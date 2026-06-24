@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="row mb-6">
            <div class="col-12">
                <div class="welcome-section">
                    <h1 class="welcome-title">Good {{ now()->format('A') === 'AM' ? 'morning' : (now()->format('H') < 18 ? 'afternoon' : 'evening') }}, {{ Auth::user()->name }}! 👋</h1>
                    <p class="welcome-subtitle">Here's what's happening with your tasks today.</p>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/dashboard/style.css') }}">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing charts...');

    // Productivity Chart
    const chartCanvas = document.getElementById('productivityChart');

    if (!chartCanvas) {
        console.error('Productivity chart canvas element not found');
        return;
    } else {
        console.log('Productivity chart canvas found');
    }

    const ctx = chartCanvas.getContext('2d');

    // Fetch productivity data
    fetch('{{ route("dashboard.productivity-data") }}')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Productivity chart data received:', data);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Tasks Completed',
                        data: data.data,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            console.log('Productivity chart initialized successfully');
        })
        .catch(error => {
            console.error('Error loading productivity data:', error);
        });

    // Task Status Distribution Chart
    const statusChartCanvas = document.getElementById('taskStatusChart');

    if (statusChartCanvas) {
        console.log('Status chart canvas found');

        const statusCtx = statusChartCanvas.getContext('2d');

    
        console.log('Status chart data:', statusData);

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['To Do', 'In Progress', 'Completed'],
                datasets: [{
                    data: [statusData.to_do, statusData.in_progress, statusData.completed],
                    backgroundColor: [
                        '#6366f1',  // Primary color
                        '#f59e0b',  // Warning color
                        '#10b981'   // Success color
                    ],
                    borderWidth: 0,
                    cutout: '65%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        console.log('Status chart initialized successfully');
    } else {
        console.error('Status chart canvas element not found');
    }
});
</script>
@endpush
