@extends('admin.layouts.app')

@section('content')

<div class="dashboard-container">

    <!-- PAGE HEADER -->
    <div class="dashboard-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">
                Welcome back, Administrator. Here's what's happening today.
            </p>
        </div>
    </div>


    <!-- STATISTICS -->
    <div class="stats-grid">

        <!-- USERS -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon users">
                    <i class="bi bi-people-fill"></i>
                </div>

                <span class="stat-trend">
                    <i class="bi bi-arrow-up"></i> 8.2%
                </span>
            </div>

            <div class="stat-number">
                {{ number_format($totalUsers) }}
            </div>

            <div class="stat-title">
                Total Users
            </div>

            <div class="stat-footer">
                <span>Registered users</span>
            </div>
        </div>


        <!-- DONORS -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon donors">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>

                <span class="stat-trend">
                    <i class="bi bi-arrow-up"></i> 5.4%
                </span>
            </div>

            <div class="stat-number">
                {{ number_format($totalDonors) }}
            </div>

            <div class="stat-title">
                Total Donors
            </div>

            <div class="stat-footer">
                <span>Active blood donors</span>
            </div>
        </div>


        <!-- REQUESTS -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon requests">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <span class="stat-trend">
                    <i class="bi bi-arrow-up"></i> 3.8%
                </span>
            </div>

            <div class="stat-number">
                24
            </div>

            <div class="stat-title">
                Blood Requests
            </div>

            <div class="stat-footer">
                <span>Current requests</span>
            </div>
        </div>


        <!-- DONATIONS -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon donations">
                    <i class="bi bi-droplet-half"></i>
                </div>

                <span class="stat-trend">
                    <i class="bi bi-arrow-up"></i> 12.5%
                </span>
            </div>

            <div class="stat-number">
                850
            </div>

            <div class="stat-title">
                Total Donations
            </div>

            <div class="stat-footer">
                <span>Successful donations</span>
            </div>
        </div>

    </div>


    <!-- MAIN CONTENT -->
    <div class="dashboard-grid">

        <!-- DONATION STATISTICS -->
        <div class="dashboard-card statistics-card">

            <div class="card-header">
                <div>
                    <h3>Donation Statistics</h3>
                    <p>Monthly blood donation overview</p>
                </div>

                <select class="period-select">
                    <option>Last 6 Months</option>
                    <option>Last 12 Months</option>
                    <option>This Year</option>
                </select>
            </div>


            <!-- CHART -->
            <div class="chart-container">

                <div class="chart-y-axis">
                    <span>200</span>
                    <span>150</span>
                    <span>100</span>
                    <span>50</span>
                    <span>0</span>
                </div>

                <div class="chart-area">

                    <div class="chart-grid-line line-1"></div>
                    <div class="chart-grid-line line-2"></div>
                    <div class="chart-grid-line line-3"></div>
                    <div class="chart-grid-line line-4"></div>
                    <div class="chart-grid-line line-5"></div>

                    <svg
                        class="donation-chart"
                        viewBox="0 0 700 260"
                        preserveAspectRatio="none"
                    >

                        <defs>

                            <linearGradient
                                id="chartGradient"
                                x1="0"
                                y1="0"
                                x2="0"
                                y2="1"
                            >

                                <stop
                                    offset="0%"
                                    stop-color="#c9002b"
                                    stop-opacity="0.25"
                                />

                                <stop
                                    offset="100%"
                                    stop-color="#c9002b"
                                    stop-opacity="0"
                                />

                            </linearGradient>

                        </defs>


                        <!-- AREA -->
                        <path
                            d="
                            M0,190
                            C50,175 70,150 115,165
                            C160,180 175,110 220,125
                            C270,140 285,95 330,110
                            C375,125 395,70 440,90
                            C490,110 510,50 555,75
                            C600,100 630,45 700,60
                            L700,260
                            L0,260
                            Z
                            "
                            fill="url(#chartGradient)"
                        />


                        <!-- LINE -->
                        <path
                            d="
                            M0,190
                            C50,175 70,150 115,165
                            C160,180 175,110 220,125
                            C270,140 285,95 330,110
                            C375,125 395,70 440,90
                            C490,110 510,50 555,75
                            C600,100 630,45 700,60
                            "
                            fill="none"
                            stroke="#c9002b"
                            stroke-width="4"
                            stroke-linecap="round"
                        />


                        <!-- POINTS -->
                        <circle cx="115" cy="165" r="5"/>
                        <circle cx="220" cy="125" r="5"/>
                        <circle cx="330" cy="110" r="5"/>
                        <circle cx="440" cy="90" r="5"/>
                        <circle cx="555" cy="75" r="5"/>
                        <circle cx="700" cy="60" r="5"/>

                    </svg>


                    <!-- MONTHS -->
                    <div class="chart-labels">
                        <span>Apr</span>
                        <span>May</span>
                        <span>Jun</span>
                        <span>Jul</span>
                        <span>Aug</span>
                        <span>Sep</span>
                    </div>

                </div>

            </div>

        </div>


        <!-- RECENT ACTIVITIES -->
        <div class="dashboard-card activity-card">

            <div class="card-header">

                <div>
                    <h3>Recent Activities</h3>
                    <p>Latest system activities</p>
                </div>

                <button class="more-btn">
                    <i class="bi bi-three-dots"></i>
                </button>

            </div>


            <div class="activity-list">

                <!-- ACTIVITY 1 -->
                <div class="activity-item">

                    <div class="activity-icon donor">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>

                    <div class="activity-content">

                        <h4>New donor registered</h4>

                        <p>
                            Pedro Garcia registered as a new donor.
                        </p>

                        <span>
                            <i class="bi bi-clock"></i>
                            10 minutes ago
                        </span>

                    </div>

                </div>


                <!-- ACTIVITY 2 -->
                <div class="activity-item">

                    <div class="activity-icon request">
                        <i class="bi bi-droplet-fill"></i>
                    </div>

                    <div class="activity-content">

                        <h4>Blood request submitted</h4>

                        <p>
                            A new O+ blood request was submitted.
                        </p>

                        <span>
                            <i class="bi bi-clock"></i>
                            35 minutes ago
                        </span>

                    </div>

                </div>


                <!-- ACTIVITY 3 -->
                <div class="activity-item">

                    <div class="activity-icon appointment">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>

                    <div class="activity-content">

                        <h4>Donation completed</h4>

                        <p>
                            Ana Reyes completed a blood donation.
                        </p>

                        <span>
                            <i class="bi bi-clock"></i>
                            1 hour ago
                        </span>

                    </div>

                </div>


                <!-- ACTIVITY 4 -->
                <div class="activity-item">

                    <div class="activity-icon user">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                    <div class="activity-content">

                        <h4>User account verified</h4>

                        <p>
                            A new user account was successfully verified.
                        </p>

                        <span>
                            <i class="bi bi-clock"></i>
                            2 hours ago
                        </span>

                    </div>

                </div>

            </div>


            <button class="view-all-btn">
                View All Activities
                <i class="bi bi-arrow-right"></i>
            </button>

        </div>

    </div>

</div>


<style>

/* ================================
   DASHBOARD
================================ */

.dashboard-container {
    width: 100%;
}


/* HEADER */

.dashboard-header {
    margin-bottom: 28px;
}

.page-title {
    margin: 0;
    font-size: 30px;
    font-weight: 800;
    color: #202124;
    letter-spacing: -0.5px;
}

.page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}


/* ================================
   STATISTICS
================================ */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.stat-card {
    background: #ffffff;
    border: 1px solid #eeeeee;
    border-radius: 18px;
    padding: 22px;
    transition: 0.25s;
    box-shadow: 0 5px 20px rgba(0,0,0,0.03);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.stat-icon.users {
    background: #fff0f3;
    color: #c9002b;
}

.stat-icon.donors {
    background: #fff4f4;
    color: #d62839;
}

.stat-icon.requests {
    background: #fff0f0;
    color: #b00020;
}

.stat-icon.donations {
    background: #fff6f7;
    color: #e63950;
}

.stat-trend {
    font-size: 12px;
    font-weight: 700;
    color: #1b9a59;
    background: #edfff5;
    padding: 5px 8px;
    border-radius: 20px;
}

.stat-number {
    margin-top: 18px;
    font-size: 31px;
    font-weight: 800;
    color: #202124;
}

.stat-title {
    margin-top: 4px;
    font-size: 14px;
    font-weight: 600;
    color: #555;
}

.stat-footer {
    margin-top: 14px;
    font-size: 12px;
    color: #999;
}


/* ================================
   MAIN GRID
================================ */

.dashboard-grid {
    display: grid;
    grid-template-columns: 1.65fr 1fr;
    gap: 24px;
}


/* ================================
   CARDS
================================ */

.dashboard-card {
    background: white;
    border: 1px solid #eeeeee;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.03);
    overflow: hidden;
}

.card-header {
    padding: 22px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #f0f0f0;
}

.card-header h3 {
    margin: 0;
    font-size: 17px;
    font-weight: 750;
    color: #222;
}

.card-header p {
    margin: 5px 0 0;
    color: #999;
    font-size: 12px;
}


/* ================================
   SELECT
================================ */

.period-select {
    border: 1px solid #e5e5e5;
    background: white;
    border-radius: 9px;
    padding: 8px 12px;
    font-size: 12px;
    color: #555;
    outline: none;
}


/* ================================
   CHART
================================ */

.chart-container {
    display: flex;
    padding: 25px 25px 20px;
    height: 330px;
}

.chart-y-axis {
    width: 35px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-bottom: 30px;
    color: #aaa;
    font-size: 11px;
}

.chart-area {
    flex: 1;
    position: relative;
    padding-bottom: 30px;
}

.chart-grid-line {
    position: absolute;
    left: 0;
    right: 0;
    border-top: 1px dashed #eeeeee;
}

.line-1 {
    top: 0;
}

.line-2 {
    top: 25%;
}

.line-3 {
    top: 50%;
}

.line-4 {
    top: 75%;
}

.line-5 {
    top: 100%;
}

.donation-chart {
    width: 100%;
    height: calc(100% - 30px);
    position: relative;
    z-index: 2;
    overflow: visible;
}

.donation-chart circle {
    fill: #c9002b;
    stroke: white;
    stroke-width: 3;
}

.chart-labels {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-between;
    color: #999;
    font-size: 11px;
}


/* ================================
   ACTIVITIES
================================ */

.activity-list {
    padding: 8px 22px;
}

.activity-item {
    display: flex;
    gap: 14px;
    padding: 17px 0;
    border-bottom: 1px solid #f1f1f1;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.activity-icon.donor {
    background: #fff0f3;
    color: #c9002b;
}

.activity-icon.request {
    background: #fff4f4;
    color: #d62839;
}

.activity-icon.appointment {
    background: #fff7ed;
    color: #e67e22;
}

.activity-icon.user {
    background: #f1f4ff;
    color: #536dfe;
}

.activity-content {
    min-width: 0;
}

.activity-content h4 {
    margin: 0;
    font-size: 13px;
    font-weight: 700;
    color: #333;
}

.activity-content p {
    margin: 4px 0;
    font-size: 12px;
    color: #888;
    line-height: 1.5;
}

.activity-content span {
    font-size: 10px;
    color: #aaa;
}

.more-btn {
    border: none;
    background: transparent;
    color: #999;
    font-size: 18px;
    cursor: pointer;
}

.view-all-btn {
    width: calc(100% - 44px);
    margin: 5px 22px 20px;
    height: 40px;
    border: 1px solid #eee;
    background: white;
    color: #c9002b;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.view-all-btn:hover {
    background: #fff4f6;
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 1200px) {

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 700px) {

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .page-title {
        font-size: 24px;
    }

    .chart-container {
        height: 280px;
        padding: 20px 15px;
    }

    .card-header {
        padding: 18px;
    }

    .period-select {
        display: none;
    }

}

</style>

@endsection