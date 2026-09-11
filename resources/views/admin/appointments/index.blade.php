@extends('admin.layouts.app')

@section('content')

<style>
    .appointment-page {
        width: 100%;
    }

    /* =========================
       HEADER
    ========================= */

    .appointment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .appointment-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .appointment-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fff0f2;
        color: #c1121f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .appointment-title h1 {
        margin: 0;
        color: #101828;
        font-size: 30px;
        font-weight: 750;
    }

    .appointment-title p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 14px;
    }

    /* =========================
       DATE CARD
    ========================= */

    .date-card {
        background: white;
        border: 1px solid #eaecf0;
        border-radius: 15px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        box-shadow: 0 4px 15px rgba(16, 24, 40, 0.03);
    }

    .calendar-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #fff0f2;
        color: #c1121f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .date-label {
        color: #98a2b3;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .date-value {
        color: #101828;
        font-size: 17px;
        font-weight: 700;
    }

    /* =========================
       STAT CARDS
    ========================= */

    .appointment-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .appointment-stat {
        background: white;
        border: 1px solid #eaecf0;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(16, 24, 40, 0.03);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-icon.red {
        background: #fff0f2;
        color: #c1121f;
    }

    .stat-icon.orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .stat-icon.green {
        background: #ecfdf3;
        color: #039855;
    }

    .stat-icon.gray {
        background: #f2f4f7;
        color: #667085;
    }

    .stat-label {
        color: #667085;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .stat-value {
        color: #101828;
        font-size: 25px;
        font-weight: 750;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .appointments-card {
        background: white;
        border: 1px solid #eaecf0;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(16, 24, 40, 0.04);
        overflow: hidden;
    }

    .appointments-card-header {
        padding: 24px 26px 18px;
    }

    .appointments-card-header h2 {
        margin: 0;
        color: #101828;
        font-size: 20px;
        font-weight: 700;
    }

    .appointments-card-header p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 13px;
    }

    /* =========================
       TABS
    ========================= */

    .appointment-tabs {
        display: flex;
        gap: 8px;
        padding: 0 26px 20px;
        border-bottom: 1px solid #eaecf0;
        overflow-x: auto;
    }

    .appointment-tab {
        border: 1px solid #eaecf0;
        background: #f9fafb;
        color: #667085;
        padding: 9px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .appointment-tab.active {
        background: #fff0f2;
        color: #c1121f;
        border-color: #fda4af;
    }

    /* =========================
       TABLE
    ========================= */

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .appointment-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .appointment-table th {
        background: #f8f9fb;
        color: #667085;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 18px;
        text-align: left;
    }

    .appointment-table td {
        padding: 17px 18px;
        border-top: 1px solid #f0f1f3;
        color: #344054;
        font-size: 13px;
    }

    .appointment-table tbody tr:hover {
        background: #fcfcfd;
    }

    /* =========================
       DONOR
    ========================= */

    .donor-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .donor-avatar {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #fff0f2;
        color: #c1121f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
    }

    .donor-name {
        font-weight: 650;
        color: #101828;
    }

    .donor-email {
        color: #98a2b3;
        font-size: 11px;
        margin-top: 2px;
    }

    /* =========================
       TIME
    ========================= */

    .appointment-time {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 650;
        color: #101828;
    }

    .appointment-time i {
        color: #c1121f;
    }

    /* =========================
       CENTER
    ========================= */

    .center-name {
        font-weight: 600;
        color: #344054;
    }

    .center-location {
        color: #98a2b3;
        font-size: 11px;
        margin-top: 3px;
    }

    /* =========================
       STATUS
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-confirmed {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-completed {
        background: #ecfdf3;
        color: #027a48;
    }

    .status-cancelled {
        background: #fef3f2;
        color: #b42318;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================
       ACTIONS
    ========================= */

    .action-buttons {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: 1px solid #eaecf0;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .action-view {
        color: #475467;
    }

    .action-view:hover {
        background: #f2f4f7;
    }

    .action-confirm {
        color: #039855;
    }

    .action-confirm:hover {
        background: #ecfdf3;
    }

    .action-cancel {
        color: #c1121f;
    }

    .action-cancel:hover {
        background: #fff0f2;
    }

    /* =========================
       DETAILS
    ========================= */

    .details-section {
        padding: 25px 26px;
        border-top: 1px solid #eaecf0;
    }

    .details-title {
        margin-bottom: 15px;
    }

    .details-title h3 {
        margin: 0;
        color: #101828;
        font-size: 18px;
    }

    .details-title p {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 12px;
    }

    .details-box {
        border: 1px solid #eaecf0;
        background: #fcfcfd;
        border-radius: 13px;
        padding: 20px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .detail-item span {
        display: block;
        color: #98a2b3;
        font-size: 11px;
        margin-bottom: 5px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .detail-item strong {
        color: #101828;
        font-size: 14px;
    }

    .details-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-cancel {
        border: 1px solid #fda4af;
        background: white;
        color: #c1121f;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-confirm {
        border: none;
        background: #c1121f;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-confirm:hover {
        background: #a50f1a;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .appointment-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .details-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {

        .appointment-stats {
            grid-template-columns: 1fr;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .appointment-header {
            align-items: flex-start;
        }
    }
</style>


<div class="appointment-page">

    {{-- PAGE HEADER --}}
    <div class="appointment-header">

        <div class="appointment-title">

            <div class="appointment-title-icon">
                <i class="bi bi-calendar-check-fill"></i>
            </div>

            <div>

                <h1>Appointment</h1>

                <p>
                    Manage donor schedules and appointments.
                </p>

            </div>

        </div>

    </div>


    {{-- DATE --}}
    <div class="date-card">

        <div class="calendar-icon">
            <i class="bi bi-calendar3"></i>
        </div>

        <div>

            <div class="date-label">
                Selected Date
            </div>

            <div class="date-value">
                September 2, 2026
            </div>

        </div>

    </div>


    {{-- STATISTICS --}}
    <div class="appointment-stats">

        <div class="appointment-stat">

            <div class="stat-icon red">
                <i class="bi bi-calendar-event-fill"></i>
            </div>

            <div>

                <div class="stat-label">
                    Today's Appointments
                </div>

                <div class="stat-value">
                    12
                </div>

            </div>

        </div>


        <div class="appointment-stat">

            <div class="stat-icon orange">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div>

                <div class="stat-label">
                    Pending
                </div>

                <div class="stat-value">
                    4
                </div>

            </div>

        </div>


        <div class="appointment-stat">

            <div class="stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>

                <div class="stat-label">
                    Completed
                </div>

                <div class="stat-value">
                    6
                </div>

            </div>

        </div>


        <div class="appointment-stat">

            <div class="stat-icon gray">
                <i class="bi bi-x-circle-fill"></i>
            </div>

            <div>

                <div class="stat-label">
                    Cancelled
                </div>

                <div class="stat-value">
                    2
                </div>

            </div>

        </div>

    </div>


    {{-- MAIN APPOINTMENTS CARD --}}
    <div class="appointments-card">

        <div class="appointments-card-header">

            <h2>
                Appointment Schedule
            </h2>

            <p>
                View and manage donor appointments.
            </p>

        </div>


        {{-- FILTER TABS --}}
        <div class="appointment-tabs">

            <button class="appointment-tab active">
                Today
            </button>

            <button class="appointment-tab">
                Upcoming
            </button>

            <button class="appointment-tab">
                Completed
            </button>

            <button class="appointment-tab">
                Cancelled
            </button>

        </div>


        {{-- TABLE --}}
        <div class="table-container">

            <table class="appointment-table">

                <thead>

                    <tr>

                        <th>Donor</th>

                        <th>Time</th>

                        <th>Center</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>


                    {{-- ANACLETO --}}
                    <tr>

                        <td>

                            <div class="donor-info">

                                <div class="donor-avatar">
                                    AJ
                                </div>

                                <div>

                                    <div class="donor-name">
                                        Anacleto Jotojot
                                    </div>

                                    <div class="donor-email">
                                        anacleto@gmail.com
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="appointment-time">

                                <i class="bi bi-clock"></i>

                                9:00 AM

                            </div>

                        </td>


                        <td>

                            <div class="center-name">
                                Center A
                            </div>

                            <div class="center-location">
                                Main Branch
                            </div>

                        </td>


                        <td>

                            <span class="status-badge status-pending">

                                <span class="status-dot"></span>

                                Pending

                            </span>

                        </td>


                        <td>

                            <div class="action-buttons">

                                <button class="action-btn action-view">

                                    <i class="bi bi-eye"></i>

                                </button>

                                <button class="action-btn action-confirm">

                                    <i class="bi bi-check-lg"></i>

                                </button>

                                <button class="action-btn action-cancel">

                                    <i class="bi bi-x-lg"></i>

                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- BRYLE --}}
                    <tr>

                        <td>

                            <div class="donor-info">

                                <div class="donor-avatar">
                                    BP
                                </div>

                                <div>

                                    <div class="donor-name">
                                        Bryle Pat
                                    </div>

                                    <div class="donor-email">
                                        bryle@gmail.com
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="appointment-time">

                                <i class="bi bi-clock"></i>

                                10:00 AM

                            </div>

                        </td>


                        <td>

                            <div class="center-name">
                                Center B
                            </div>

                            <div class="center-location">
                                Downtown Branch
                            </div>

                        </td>


                        <td>

                            <span class="status-badge status-confirmed">

                                <span class="status-dot"></span>

                                Confirmed

                            </span>

                        </td>


                        <td>

                            <div class="action-buttons">

                                <button class="action-btn action-view">

                                    <i class="bi bi-eye"></i>

                                </button>

                                <button class="action-btn action-cancel">

                                    <i class="bi bi-x-lg"></i>

                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- JUNIEL --}}
                    <tr>

                        <td>

                            <div class="donor-info">

                                <div class="donor-avatar">
                                    JH
                                </div>

                                <div>

                                    <div class="donor-name">
                                        Juniel Huiso
                                    </div>

                                    <div class="donor-email">
                                        juniel@gmail.com
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="appointment-time">

                                <i class="bi bi-clock"></i>

                                11:00 AM

                            </div>

                        </td>


                        <td>

                            <div class="center-name">
                                Center A
                            </div>

                            <div class="center-location">
                                Main Branch
                            </div>

                        </td>


                        <td>

                            <span class="status-badge status-completed">

                                <span class="status-dot"></span>

                                Completed

                            </span>

                        </td>


                        <td>

                            <div class="action-buttons">

                                <button class="action-btn action-view">

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                        </td>

                    </tr>


                </tbody>

            </table>

        </div>


        {{-- APPOINTMENT DETAILS --}}
        <div class="details-section">

            <div class="details-title">

                <h3>
                    Appointment Details
                </h3>

                <p>
                    Selected appointment information
                </p>

            </div>


            <div class="details-box">

                <div class="details-grid">


                    <div class="detail-item">

                        <span>
                            Donor
                        </span>

                        <strong>
                            Maria Santos
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Time
                        </span>

                        <strong>
                            9:00 AM
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Donation Center
                        </span>

                        <strong>
                            Center A
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Blood Type
                        </span>

                        <strong>
                            O+
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Date
                        </span>

                        <strong>
                            September 2, 2026
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Status
                        </span>

                        <strong>

                            <span class="status-badge status-pending">

                                <span class="status-dot"></span>

                                Pending

                            </span>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Contact
                        </span>

                        <strong>
                            0912 345 6789
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span>
                            Appointment ID
                        </span>

                        <strong>
                            #APT-001
                        </strong>

                    </div>

                </div>


                <div class="details-actions">

                    <button class="btn-cancel">

                        <i class="bi bi-x-lg"></i>

                        Cancel

                    </button>


                    <button class="btn-confirm">

                        <i class="bi bi-check-lg"></i>

                        Confirm Appointment

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection