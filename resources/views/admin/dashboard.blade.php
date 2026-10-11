 @extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Safely prepare recent activity dates
    |--------------------------------------------------------------------------
    | Activity dates may arrive as strings, Carbon objects, or null values.
    | Convert valid dates to Carbon and safely handle missing/invalid dates.
    */
    $safeRecentActivities = collect($recentActivities ?? [])->map(function ($activity) {
        $activity = (array) $activity;

        try {
            $date = $activity['date'] ?? null;

            $activity['parsed_date'] = filled($date)
                ? \Illuminate\Support\Carbon::parse($date)
                : null;
        } catch (\Throwable $exception) {
            $activity['parsed_date'] = null;
        }

        return $activity;
    });
@endphp

<div class="dashboard-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Dashboard</h1>

            <p class="dashboard-subtitle">
                Welcome back, Administrator. Here's what's happening today.
            </p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="stats-grid">

        {{-- USERS --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon users-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="stat-badge">
                    <i class="bi bi-database"></i>
                    Live
                </div>
            </div>

            <div class="stat-number">
                {{ number_format($totalUsers ?? 0) }}
            </div>

            <div class="stat-label">Total Users</div>
            <div class="stat-description">Registered users</div>
        </div>

        {{-- DONORS --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon donors-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>

                <div class="stat-badge">
                    <i class="bi bi-database"></i>
                    Live
                </div>
            </div>

            <div class="stat-number">
                {{ number_format($totalDonors ?? 0) }}
            </div>

            <div class="stat-label">Total Donors</div>
            <div class="stat-description">Registered blood donors</div>
        </div>

        {{-- BLOOD REQUESTS --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon requests-icon">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <div class="stat-badge">
                    <i class="bi bi-database"></i>
                    Live
                </div>
            </div>

            <div class="stat-number">
                {{ number_format($totalBloodRequests ?? 0) }}
            </div>

            <div class="stat-label">Blood Requests</div>
            <div class="stat-description">Current blood requests</div>
        </div>

        {{-- DONATIONS --}}
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon donations-icon">
                    <i class="bi bi-droplet-half"></i>
                </div>

                <div class="stat-badge">
                    <i class="bi bi-database"></i>
                    Live
                </div>
            </div>

            <div class="stat-number">
                {{ number_format($totalDonations ?? 0) }}
            </div>

            <div class="stat-label">Total Donations</div>
            <div class="stat-description">Recorded donations</div>
        </div>

    </div>

    {{-- LOWER DASHBOARD --}}
    <div class="dashboard-grid">

        {{-- DONATION CHART --}}
        <div class="dashboard-card chart-card">

            <div class="card-header">
                <div>
                    <h2>Donation Statistics</h2>
                    <p>Monthly blood donation overview</p>
                </div>

                <div class="chart-period">Last 6 Months</div>
            </div>

            <div class="chart-container">
                <canvas id="donationChart"></canvas>
            </div>

        </div>

        {{-- RECENT ACTIVITIES --}}
        <div class="dashboard-card activities-card">

            <div class="card-header">
                <div>
                    <h2>Recent Activities</h2>
                    <p>Latest system activities</p>
                </div>

                <i class="bi bi-three-dots more-icon"></i>
            </div>

            <div class="activities-list">

                @forelse($safeRecentActivities as $activity)

                    <div class="activity-item">

                        <div class="activity-icon {{ $activity['class'] ?? 'activity-user' }}">
                            <i class="bi {{ $activity['icon'] ?? 'bi-activity' }}"></i>
                        </div>

                        <div class="activity-content">

                            <div class="activity-title">
                                {{ $activity['title'] ?? 'System Activity' }}
                            </div>

                            <div class="activity-description">
                                {{ $activity['description'] ?? 'A system activity occurred.' }}
                            </div>

                            <div class="activity-time">
                                <i class="bi bi-clock"></i>

                                @if (!empty($activity['parsed_date']))
                                    {{ $activity['parsed_date']->diffForHumans() }}
                                @else
                                    <span>Date unavailable</span>
                                @endif
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-activities">
                        <div class="empty-icon">
                            <i class="bi bi-inbox"></i>
                        </div>

                        <h3>No recent activities</h3>

                        <p>
                            New system activities will appear here.
                        </p>
                    </div>

                @endforelse

            </div>

            @if (\Illuminate\Support\Facades\Route::has('admin.notifications'))
                <a href="{{ route('admin.notifications') }}" class="view-activities">
                    View All Activities
                    <i class="bi bi-arrow-right"></i>
                </a>
            @endif

        </div>

    </div>

</div>

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('donationChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const labels = @json($chartLabels ?? []);
    const data = @json($chartData ?? []);

    // Prevent creating duplicate charts on the same canvas.
    const existingChart = Chart.getChart(canvas);

    if (existingChart) {
        existingChart.destroy();
    }

    new Chart(canvas, {
        type: 'line',

        data: {
            labels: labels,

            datasets: [{
                label: 'Donations',
                data: data,
                borderColor: '#c8102e',
                backgroundColor: 'rgba(200, 16, 46, 0.12)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#c8102e',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    backgroundColor: '#222',
                    padding: 12,
                    displayColors: false,

                    callbacks: {
                        label: function (context) {
                            return ' Donations: ' + (context.parsed.y ?? 0);
                        }
                    }
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },

                    ticks: {
                        color: '#888'
                    }
                },

                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0,
                        color: '#888'
                    },

                    grid: {
                        color: '#eeeeee',
                        borderDash: [4, 4]
                    }
                }
            }
        }
    });

});
</script>

<style>
/* =========================================================
   DASHBOARD
========================================================= */

.dashboard-page {
    width: 100%;
    min-width: 0;
}

.dashboard-header {
    margin-bottom: 28px;
}

.dashboard-title {
    margin: 0;
    font-size: 32px;
    line-height: 1.2;
    font-weight: 700;
    color: #171717;
}

.dashboard-subtitle {
    margin: 8px 0 0;
    font-size: 16px;
    color: #777;
}

/* =========================================================
   STATISTICS
========================================================= */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    min-width: 0;
    min-height: 220px;
    padding: 28px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
    transition: transform .2s ease, box-shadow .2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(0, 0, 0, .07);
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.stat-icon {
    width: 58px;
    height: 58px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    font-size: 25px;
}

.users-icon,
.donors-icon,
.requests-icon,
.donations-icon {
    background: #fff0f3;
    color: #c8102e;
}

.stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 10px;
    border-radius: 20px;
    background: #eafaf1;
    color: #16834b;
    font-size: 12px;
    font-weight: 700;
}

.stat-number {
    margin-top: 28px;
    font-size: 36px;
    line-height: 1.1;
    font-weight: 750;
    color: #151515;
    overflow-wrap: anywhere;
}

.stat-label {
    margin-top: 14px;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.stat-description {
    margin-top: 9px;
    font-size: 13px;
    color: #999;
}

/* =========================================================
   LOWER GRID
========================================================= */

.dashboard-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.65fr) minmax(0, .9fr);
    gap: 28px;
    align-items: stretch;
}

.dashboard-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
    overflow: hidden;
}

.chart-card,
.activities-card {
    min-height: 520px;
}

/* =========================================================
   CARD HEADER
========================================================= */

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 30px 30px 22px;
    border-bottom: 1px solid #eee;
}

.card-header h2 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
    color: #181818;
}

.card-header p {
    margin: 7px 0 0;
    font-size: 13px;
    color: #999;
}

.chart-period {
    padding: 10px 15px;
    border: 1px solid #dedede;
    border-radius: 9px;
    background: #fff;
    color: #555;
    font-size: 13px;
    white-space: nowrap;
}

.more-icon {
    font-size: 20px;
    color: #999;
}

/* =========================================================
   CHART
========================================================= */

.chart-container {
    position: relative;
    height: 390px;
    padding: 25px 30px 30px;
}

/* =========================================================
   RECENT ACTIVITIES
========================================================= */

.activities-list {
    padding: 10px 28px 0;
}

.activity-item {
    display: flex;
    gap: 15px;
    padding: 21px 0;
    border-bottom: 1px solid #eee;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    flex: 0 0 48px;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    font-size: 19px;
}

.activity-user,
.activity-request {
    background: #fff0f3;
    color: #c8102e;
}

.activity-appointment {
    background: #fff5e8;
    color: #e68a00;
}

.activity-donation {
    background: #eef2ff;
    color: #5267d8;
}

.activity-content {
    min-width: 0;
    overflow-wrap: anywhere;
}

.activity-title {
    font-size: 14px;
    font-weight: 700;
    color: #222;
}

.activity-description {
    margin-top: 5px;
    font-size: 13px;
    line-height: 1.5;
    color: #888;
}

.activity-time {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 7px;
    font-size: 11px;
    color: #999;
}

.view-activities {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin: 15px 28px 28px;
    padding: 14px;
    border: 1px solid #eee;
    border-radius: 10px;
    color: #c8102e;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    transition: background .2s ease, color .2s ease;
}

.view-activities:hover {
    background: #fff5f6;
    color: #a70d26;
}

/* =========================================================
   EMPTY STATE
========================================================= */

.empty-activities {
    padding: 55px 20px;
    text-align: center;
}

.empty-icon {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #f5f5f5;
    color: #999;
    font-size: 22px;
}

.empty-activities h3 {
    margin: 0;
    font-size: 15px;
    color: #444;
}

.empty-activities p {
    margin: 7px 0 0;
    font-size: 13px;
    color: #999;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1400px) {
    .stats-grid {
        gap: 16px;
    }

    .stat-card {
        padding: 22px;
    }

    .dashboard-grid {
        grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
        gap: 20px;
    }

    .card-header {
        padding: 24px 22px 20px;
    }

    .activities-list {
        padding-right: 22px;
        padding-left: 22px;
    }
}

@media (max-width: 1100px) {
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 700px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-title {
        font-size: 26px;
    }

    .dashboard-subtitle {
        font-size: 14px;
    }

    .stat-card {
        min-height: auto;
    }

    .chart-card,
    .activities-card {
        min-height: auto;
    }

    .card-header {
        padding: 22px 20px;
        gap: 12px;
    }

    .card-header h2 {
        font-size: 18px;
    }

    .chart-period {
        padding: 8px 10px;
        font-size: 11px;
    }

    .chart-container {
        height: 320px;
        padding: 20px;
    }

    .activities-list {
        padding: 5px 20px 0;
    }

    .activity-item {
        gap: 12px;
    }

    .activity-icon {
        flex-basis: 42px;
        width: 42px;
        height: 42px;
    }

    .view-activities {
        margin: 15px 20px 20px;
    }
}
</style>

@endsection