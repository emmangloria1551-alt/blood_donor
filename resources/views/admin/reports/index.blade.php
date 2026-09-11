@extends('admin.layouts.app')

@section('content')

<style>
    .reports-page {
        padding: 28px;
        background: #f8fafc;
        min-height: calc(100vh - 70px);
    }

    /* PAGE HEADER */
    .reports-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 24px;
    }

    .reports-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .reports-title-icon {
        width: 48px;
        height: 48px;
        background: #fff1f2;
        color: #dc2626;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .reports-title h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .reports-title p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* DATE FILTER */
    .date-filter {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        align-items: flex-end;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .date-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .date-field label {
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
    }

    .date-field input {
        width: 145px;
        height: 40px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 10px;
        font-size: 13px;
        color: #374151;
        outline: none;
        background: #fff;
    }

    .date-field input:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
    }

    .btn-filter {
        height: 40px;
        padding: 0 18px;
        border: none;
        border-radius: 8px;
        background: #dc2626;
        color: white;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-filter:hover {
        background: #b91c1c;
    }

    /* STAT CARDS */
    .report-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .report-stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
    }

    .stat-info span {
        display: block;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 7px;
    }

    .stat-info h2 {
        margin: 0;
        font-size: 30px;
        color: #111827;
        font-weight: 700;
    }

    .stat-info small {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 8px;
        font-size: 12px;
        color: #16a34a;
        font-weight: 600;
    }

    .report-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .icon-donation {
        background: #fee2e2;
        color: #dc2626;
    }

    .icon-donor {
        background: #fef2f2;
        color: #ef4444;
    }

    .icon-request {
        background: #fff7ed;
        color: #ea580c;
    }

    /* CONTENT GRID */
    .reports-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .report-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .report-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .report-card-header h3 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
    }

    .report-card-header p {
        margin: 4px 0 0;
        color: #9ca3af;
        font-size: 12px;
    }

    .report-card-body {
        padding: 22px;
    }

    /* BLOOD TYPE CHART */
    .blood-row {
        margin-bottom: 20px;
    }

    .blood-row:last-child {
        margin-bottom: 0;
    }

    .blood-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .blood-name {
        display: flex;
        align-items: center;
        gap: 9px;
        font-weight: 600;
        color: #374151;
        font-size: 13px;
    }

    .blood-dot {
        width: 9px;
        height: 9px;
        background: #dc2626;
        border-radius: 50%;
    }

    .blood-value {
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
    }

    .progress-background {
        height: 10px;
        background: #f1f5f9;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #dc2626, #ef4444);
        border-radius: 20px;
    }

    /* SUMMARY */
    .summary-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px;
        background: #f8fafc;
        border-radius: 10px;
    }

    .summary-item-left {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .summary-icon {
        width: 36px;
        height: 36px;
        background: #fff1f2;
        color: #dc2626;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .summary-item strong {
        display: block;
        color: #374151;
        font-size: 13px;
    }

    .summary-item span {
        display: block;
        color: #9ca3af;
        font-size: 11px;
        margin-top: 2px;
    }

    .summary-number {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    /* REPORT INFO */
    .report-info {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .info-box {
        padding: 18px;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        background: #fafafa;
    }

    .info-box span {
        display: block;
        color: #9ca3af;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .info-box strong {
        color: #374151;
        font-size: 14px;
    }

    /* ACTION BUTTONS */
    .report-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 22px;
    }

    .report-btn {
        height: 42px;
        padding: 0 17px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
    }

    .report-btn:hover {
        background: #f9fafb;
    }

    .report-btn.primary {
        background: #dc2626;
        color: white;
        border-color: #dc2626;
    }

    .report-btn.primary:hover {
        background: #b91c1c;
    }

    .report-btn.excel {
        color: #15803d;
        border-color: #bbf7d0;
    }

    .report-btn.pdf {
        color: #dc2626;
        border-color: #fecaca;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .reports-grid {
            grid-template-columns: 1fr;
        }

        .report-info {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 850px) {
        .reports-header {
            flex-direction: column;
            align-items: stretch;
        }

        .date-filter {
            width: 100%;
            flex-wrap: wrap;
        }

        .date-field {
            flex: 1;
        }

        .date-field input {
            width: 100%;
        }

        .report-stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .reports-page {
            padding: 18px;
        }

        .date-filter {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-filter {
            justify-content: center;
        }

        .report-info {
            grid-template-columns: 1fr;
        }

        .report-actions {
            flex-direction: column;
        }

        .report-btn {
            justify-content: center;
        }
    }
</style>

<div class="reports-page">

    <!-- PAGE HEADER -->
    <div class="reports-header">

        <div class="reports-title">
            <div class="reports-title-icon">
                <i class="bi bi-bar-chart-line-fill"></i>
            </div>

            <div>
                <h1>Reports & Statistics</h1>
                <p>Monitor blood donations, donors, and blood requests.</p>
            </div>
        </div>

        <!-- DATE FILTER -->
        <form class="date-filter" method="GET">

            <div class="date-field">
                <label>From</label>
                <input
                    type="date"
                    name="from"
                    value="{{ request('from', '2026-09-01') }}"
                >
            </div>

            <div class="date-field">
                <label>To</label>
                <input
                    type="date"
                    name="to"
                    value="{{ request('to', '2026-09-30') }}"
                >
            </div>

            <button type="submit" class="btn-filter">
                <i class="bi bi-funnel"></i>
                Filter
            </button>

        </form>

    </div>


    <!-- STATISTICS -->
    <div class="report-stats">

        <!-- DONATIONS -->
        <div class="report-stat-card">

            <div class="stat-info">
                <span>Total Donations</span>
                <h2>850</h2>

                <small>
                    <i class="bi bi-arrow-up"></i>
                    12.5% this month
                </small>
            </div>

            <div class="report-stat-icon icon-donation">
                <i class="bi bi-droplet-fill"></i>
            </div>

        </div>


        <!-- DONORS -->
        <div class="report-stat-card">

            <div class="stat-info">
                <span>Registered Donors</span>
                <h2>450</h2>

                <small>
                    <i class="bi bi-arrow-up"></i>
                    8.4% this month
                </small>
            </div>

            <div class="report-stat-icon icon-donor">
                <i class="bi bi-people-fill"></i>
            </div>

        </div>


        <!-- REQUESTS -->
        <div class="report-stat-card">

            <div class="stat-info">
                <span>Blood Requests</span>
                <h2>120</h2>

                <small>
                    <i class="bi bi-arrow-up"></i>
                    5.2% this month
                </small>
            </div>

            <div class="report-stat-icon icon-request">
                <i class="bi bi-clipboard2-pulse-fill"></i>
            </div>

        </div>

    </div>


    <!-- CHART + SUMMARY -->
    <div class="reports-grid">

        <!-- BLOOD TYPE CHART -->
        <div class="report-card">

            <div class="report-card-header">

                <div>
                    <h3>Donations by Blood Type</h3>
                    <p>Distribution of donations for the selected period</p>
                </div>

                <i class="bi bi-droplet-half"
                   style="font-size: 20px; color:#dc2626;"></i>

            </div>

            <div class="report-card-body">

                <!-- A+ -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            A+
                        </div>

                        <span class="blood-value">120 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 80%;"></div>
                    </div>

                </div>


                <!-- O+ -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            O+
                        </div>

                        <span class="blood-value">150 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>

                </div>


                <!-- B+ -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            B+
                        </div>

                        <span class="blood-value">80 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 53%;"></div>
                    </div>

                </div>


                <!-- AB+ -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            AB+
                        </div>

                        <span class="blood-value">40 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 27%;"></div>
                    </div>

                </div>


                <!-- A- -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            A-
                        </div>

                        <span class="blood-value">35 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 23%;"></div>
                    </div>

                </div>


                <!-- O- -->
                <div class="blood-row">

                    <div class="blood-info">
                        <div class="blood-name">
                            <span class="blood-dot"></span>
                            O-
                        </div>

                        <span class="blood-value">25 donations</span>
                    </div>

                    <div class="progress-background">
                        <div class="progress-bar" style="width: 17%;"></div>
                    </div>

                </div>

            </div>

        </div>


        <!-- QUICK SUMMARY -->
        <div class="report-card">

            <div class="report-card-header">

                <div>
                    <h3>Monthly Summary</h3>
                    <p>September 2026</p>
                </div>

                <i class="bi bi-graph-up-arrow"
                   style="font-size: 20px; color:#dc2626;"></i>

            </div>

            <div class="report-card-body">

                <div class="summary-list">

                    <div class="summary-item">

                        <div class="summary-item-left">

                            <div class="summary-icon">
                                <i class="bi bi-droplet-fill"></i>
                            </div>

                            <div>
                                <strong>Successful Donations</strong>
                                <span>Completed donations</span>
                            </div>

                        </div>

                        <div class="summary-number">
                            850
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-item-left">

                            <div class="summary-icon">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>

                            <div>
                                <strong>New Donors</strong>
                                <span>Newly registered</span>
                            </div>

                        </div>

                        <div class="summary-number">
                            75
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-item-left">

                            <div class="summary-icon">
                                <i class="bi bi-clipboard2-pulse-fill"></i>
                            </div>

                            <div>
                                <strong>Blood Requests</strong>
                                <span>Total requests</span>
                            </div>

                        </div>

                        <div class="summary-number">
                            120
                        </div>

                    </div>


                    <div class="summary-item">

                        <div class="summary-item-left">

                            <div class="summary-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>

                            <div>
                                <strong>Completed Requests</strong>
                                <span>Successfully fulfilled</span>
                            </div>

                        </div>

                        <div class="summary-number">
                            96
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- REPORT INFORMATION -->
    <div class="report-card">

        <div class="report-card-header">

            <div>
                <h3>Report Information</h3>
                <p>Details of the currently selected report period</p>
            </div>

        </div>

        <div class="report-card-body">

            <div class="report-info">

                <div class="info-box">
                    <span>Report Period</span>
                    <strong>September 1 – September 30, 2026</strong>
                </div>

                <div class="info-box">
                    <span>Total Donations</span>
                    <strong>850 Donations</strong>
                </div>

                <div class="info-box">
                    <span>Total Donors</span>
                    <strong>450 Donors</strong>
                </div>

                <div class="info-box">
                    <span>Total Requests</span>
                    <strong>120 Requests</strong>
                </div>

            </div>


            <!-- ACTION BUTTONS -->
            <div class="report-actions">

                <button type="button"
                        class="report-btn primary"
                        onclick="window.print()">
                    <i class="bi bi-file-earmark-text"></i>
                    Generate Report
                </button>

                <button type="button"
                        class="report-btn pdf"
                        onclick="window.print()">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Export PDF
                </button>

                <button type="button"
                        class="report-btn excel"
                        onclick="alert('Excel export will be connected to Laravel next.')">
                    <i class="bi bi-file-earmark-excel"></i>
                    Export Excel
                </button>

            </div>

        </div>

    </div>

</div>

@endsection