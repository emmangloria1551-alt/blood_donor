@extends('admin.layouts.app')

@section('content')

<style>
    /* =========================================================
       COMMUNITY BLOOD DONOR
       BLOOD REQUEST MANAGEMENT
       ========================================================= */

    .blood-request-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
    }

    /* =========================
       PAGE HEADER
       ========================= */

    .br-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .br-title-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .br-title-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #fff0f2;
        color: #c8102e;
        font-size: 25px;
        flex-shrink: 0;
    }

    .br-title-wrap h1 {
        margin: 0;
        color: #172b4d;
        font-size: 30px;
        font-weight: 750;
        letter-spacing: -0.5px;
    }

    .br-title-wrap p {
        margin: 5px 0 0;
        color: #718096;
        font-size: 14px;
    }

    /* =========================
       STATISTICS
       ========================= */

    .br-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .br-stat-card {
        min-height: 112px;
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: #ffffff;
        border: 1px solid #eaecf0;
        border-radius: 16px;
        box-shadow: 0 3px 12px rgba(16, 24, 40, 0.04);
        transition: 0.2s ease;
    }

    .br-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(16, 24, 40, 0.07);
    }

    .br-stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .br-stat-icon.red {
        background: #fff0f2;
        color: #c8102e;
    }

    .br-stat-icon.orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .br-stat-icon.green {
        background: #ecfdf3;
        color: #039855;
    }

    .br-stat-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .br-stat-label {
        color: #667085;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .br-stat-number {
        color: #172b4d;
        font-size: 25px;
        font-weight: 750;
    }

    /* =========================
       MAIN CARD
       ========================= */

    .br-main-card {
        background: #ffffff;
        border: 1px solid #eaecf0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(16, 24, 40, 0.04);
    }

    .br-card-top {
        padding: 24px 26px 0;
    }

    .br-card-title h2 {
        margin: 0;
        color: #172b4d;
        font-size: 20px;
        font-weight: 700;
    }

    .br-card-title p {
        margin: 5px 0 0;
        color: #8a98aa;
        font-size: 13px;
    }

    /* =========================
       FILTER AREA
       ========================= */

    .br-filters {
        display: grid;
        grid-template-columns: minmax(240px, 1fr) 180px 180px;
        gap: 12px;
        margin-top: 22px;
        margin-bottom: 18px;
    }

    .br-search {
        height: 48px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        background: #ffffff;
        border: 1px solid #d9dee8;
        border-radius: 11px;
        transition: 0.2s ease;
    }

    .br-search:focus-within {
        border-color: #c8102e;
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.08);
    }

    .br-search i {
        color: #98a2b3;
        font-size: 17px;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .br-search input {
        width: 100%;
        height: 100%;
        border: none !important;
        outline: none !important;
        background: transparent !important;
        box-shadow: none !important;
        color: #344054;
        font-size: 14px;
    }

    .br-search input::placeholder {
        color: #98a2b3;
    }

    .br-select {
        width: 100%;
        height: 48px;
        padding: 0 14px;
        border: 1px solid #d9dee8;
        border-radius: 11px;
        background: #ffffff;
        color: #344054;
        font-size: 14px;
        outline: none;
        cursor: pointer;
    }

    .br-select:focus {
        border-color: #c8102e;
        box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.08);
    }

    /* =========================
       STATUS TABS
       ========================= */

    .br-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 18px;
    }

    .br-tab {
        height: 40px;
        padding: 0 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid #e4e7ec;
        border-radius: 10px;
        background: #ffffff;
        color: #667085;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: 0.2s ease;
    }

    .br-tab:hover {
        background: #f9fafb;
        border-color: #d0d5dd;
    }

    .br-tab.active {
        background: #fff0f2;
        border-color: #f4a1ad;
        color: #c8102e;
    }

    .br-tab .tab-count {
        min-width: 21px;
        height: 21px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 5px;
        border-radius: 20px;
        background: #f2f4f7;
        color: #667085;
        font-size: 11px;
    }

    .br-tab.active .tab-count {
        background: #c8102e;
        color: #ffffff;
    }

    /* =========================
       TABLE
       ========================= */

    .br-table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-top: 1px solid #eaecf0;
    }

    .br-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .br-table thead {
        background: #f8fafc;
    }

    .br-table th {
        height: 50px;
        padding: 0 22px;
        text-align: left;
        color: #667085;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        white-space: nowrap;
    }

    .br-table td {
        height: 82px;
        padding: 0 22px;
        color: #344054;
        font-size: 14px;
        border-top: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .br-table tbody tr {
        transition: 0.15s ease;
    }

    .br-table tbody tr:hover {
        background: #fcfcfd;
    }

    /* =========================
       PATIENT
       ========================= */

    .br-patient {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .br-avatar {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: #fff0f2;
        color: #c8102e;
        font-size: 12px;
        font-weight: 750;
    }

    .br-patient-name {
        color: #172b4d;
        font-size: 14px;
        font-weight: 700;
    }

    .br-hospital {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 12px;
    }

    /* =========================
       BLOOD TYPE
       ========================= */

    .br-blood {
        min-width: 48px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        background: #fff0f2;
        color: #c8102e;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 750;
    }

    /* =========================
       UNITS
       ========================= */

    .br-units {
        color: #172b4d;
        font-weight: 700;
    }

    .br-units small {
        color: #98a2b3;
        font-weight: 500;
        margin-left: 3px;
    }

    /* =========================
       URGENCY
       ========================= */

    .br-urgency {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        font-weight: 650;
    }

    .br-urgency-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .br-urgency.critical {
        color: #c8102e;
    }

    .br-urgency.critical .br-urgency-dot {
        background: #c8102e;
        box-shadow: 0 0 0 3px #ffe4e8;
    }

    .br-urgency.high {
        color: #d97706;
    }

    .br-urgency.high .br-urgency-dot {
        background: #f59e0b;
    }

    .br-urgency.normal {
        color: #667085;
    }

    .br-urgency.normal .br-urgency-dot {
        background: #98a2b3;
    }

    .br-urgency.moderate {
        color: #2563eb;
    }

    .br-urgency.moderate .br-urgency-dot {
        background: #3b82f6;
    }

    /* =========================
       STATUS
       ========================= */

    .br-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .br-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .br-status.pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .br-status.pending .br-status-dot {
        background: #f59e0b;
    }

    .br-status.approved {
        background: #ecfdf3;
        color: #027a48;
    }

    .br-status.approved .br-status-dot {
        background: #12b76a;
    }

    .br-status.rejected {
        background: #fef3f2;
        color: #b42318;
    }

    .br-status.rejected .br-status-dot {
        background: #f04438;
    }

    /* =========================
       ACTION BUTTONS
       ========================= */

    .br-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .br-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eaecf0;
        border-radius: 9px;
        background: #ffffff;
        color: #667085;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .br-action:hover {
        transform: translateY(-1px);
        background: #f9fafb;
        border-color: #d0d5dd;
    }

    .br-action.view:hover {
        color: #344054;
    }

    .br-action.approve {
        color: #039855;
    }

    .br-action.approve:hover {
        background: #ecfdf3;
        border-color: #a6f4c5;
    }

    .br-action.reject {
        color: #c8102e;
    }

    .br-action.reject:hover {
        background: #fff0f2;
        border-color: #fda4af;
    }

    /* =========================
       DETAILS
       ========================= */

    .br-details {
        padding: 25px 26px;
        border-top: 1px solid #eaecf0;
        background: #ffffff;
    }

    .br-details-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .br-details-heading h3 {
        margin: 0;
        color: #172b4d;
        font-size: 17px;
        font-weight: 700;
    }

    .br-details-heading p {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 12px;
    }

    .br-details-box {
        padding: 20px;
        background: #fcfcfd;
        border: 1px solid #eaecf0;
        border-radius: 13px;
    }

    .br-details-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .br-detail-item span {
        display: block;
        margin-bottom: 6px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 750;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .br-detail-item strong {
        color: #172b4d;
        font-size: 14px;
        font-weight: 650;
    }

    .br-detail-blood {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 30px;
        padding: 0 9px;
        border-radius: 8px;
        background: #fff0f2;
        color: #c8102e !important;
        font-size: 12px !important;
    }

    .br-critical-text {
        color: #c8102e !important;
    }

    .br-details-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 20px;
    }

    .br-btn {
        height: 40px;
        padding: 0 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 650;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .br-btn-reject {
        background: #ffffff;
        border: 1px solid #fda4af;
        color: #c8102e;
    }

    .br-btn-reject:hover {
        background: #fff0f2;
    }

    .br-btn-approve {
        background: #c8102e;
        border: 1px solid #c8102e;
        color: #ffffff;
    }

    .br-btn-approve:hover {
        background: #a50f27;
        border-color: #a50f27;
    }

    /* =========================
       FOOTER
       ========================= */

    .br-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 26px;
        border-top: 1px solid #eaecf0;
    }

    .br-footer-text {
        color: #98a2b3;
        font-size: 12px;
    }

    .br-pagination {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .br-page-btn {
        min-width: 32px;
        height: 32px;
        padding: 0 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eaecf0;
        border-radius: 8px;
        background: #ffffff;
        color: #667085;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
    }

    .br-page-btn:hover {
        background: #f9fafb;
    }

    .br-page-btn.active {
        background: #c8102e;
        border-color: #c8102e;
        color: #ffffff;
    }

    /* =========================
       RESPONSIVE
       ========================= */

    @media (max-width: 1200px) {

        .br-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .br-filters {
            grid-template-columns: 1fr 1fr;
        }

        .br-search {
            grid-column: 1 / -1;
        }

        .br-details-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 800px) {

        .br-page-header {
            align-items: flex-start;
        }

        .br-title-wrap h1 {
            font-size: 25px;
        }

        .br-filters {
            grid-template-columns: 1fr;
        }

        .br-search {
            grid-column: auto;
        }

        .br-details-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {

        .br-stats {
            grid-template-columns: 1fr;
        }

        .br-title-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .br-title-wrap h1 {
            font-size: 22px;
        }

        .br-title-wrap p {
            font-size: 12px;
        }

        .br-card-top {
            padding: 20px 18px 0;
        }

        .br-table th,
        .br-table td {
            padding-left: 15px;
            padding-right: 15px;
        }

        .br-details {
            padding: 20px 18px;
        }

        .br-details-grid {
            grid-template-columns: 1fr;
        }

        .br-details-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .br-details-actions {
            flex-direction: column;
        }

        .br-btn {
            width: 100%;
        }

        .br-footer {
            align-items: flex-start;
            flex-direction: column;
            gap: 12px;
        }
    }
</style>


<div class="blood-request-page">

    {{-- =====================================================
         PAGE HEADER
         ===================================================== --}}
    <div class="br-page-header">

        <div class="br-title-wrap">

            <div class="br-title-icon">
                <i class="bi bi-droplet-fill"></i>
            </div>

            <div>
                <h1>Blood Request Management</h1>

                <p>
                    Review, approve, and manage blood requests.
                </p>
            </div>

        </div>

    </div>


    {{-- =====================================================
         STATISTICS
         ===================================================== --}}
    <div class="br-stats">

        {{-- Total --}}
        <div class="br-stat-card">

            <div class="br-stat-icon red">
                <i class="bi bi-droplet-fill"></i>
            </div>

            <div>
                <div class="br-stat-label">
                    Total Requests
                </div>

                <div class="br-stat-number">
                    24
                </div>
            </div>

        </div>


        {{-- Pending --}}
        <div class="br-stat-card">

            <div class="br-stat-icon orange">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div>
                <div class="br-stat-label">
                    Pending
                </div>

                <div class="br-stat-number">
                    12
                </div>
            </div>

        </div>


        {{-- Approved --}}
        <div class="br-stat-card">

            <div class="br-stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <div class="br-stat-label">
                    Approved
                </div>

                <div class="br-stat-number">
                    9
                </div>
            </div>

        </div>


        {{-- Critical --}}
        <div class="br-stat-card">

            <div class="br-stat-icon blue">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

            <div>
                <div class="br-stat-label">
                    Critical
                </div>

                <div class="br-stat-number">
                    3
                </div>
            </div>

        </div>

    </div>


    {{-- =====================================================
         MAIN CARD
         ===================================================== --}}
    <div class="br-main-card">

        {{-- CARD HEADER --}}
        <div class="br-card-top">

            <div class="br-card-title">

                <h2>Blood Requests</h2>

                <p>
                    View and manage submitted requests from patients and hospitals.
                </p>

            </div>


            {{-- =================================================
                 SEARCH + FILTERS
                 ================================================= --}}
            <div class="br-filters">

                {{-- Search --}}
                <div class="br-search">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search patient or hospital..."
                    >

                </div>


                {{-- Blood Type --}}
                <select
                    name="blood_type"
                    class="br-select"
                >

                    <option value="">
                        All Blood Types
                    </option>

                    <option value="A+">
                        A+
                    </option>

                    <option value="A-">
                        A-
                    </option>

                    <option value="B+">
                        B+
                    </option>

                    <option value="B-">
                        B-
                    </option>

                    <option value="AB+">
                        AB+
                    </option>

                    <option value="AB-">
                        AB-
                    </option>

                    <option value="O+">
                        O+
                    </option>

                    <option value="O-">
                        O-
                    </option>

                </select>


                {{-- Urgency --}}
                <select
                    name="urgency"
                    class="br-select"
                >

                    <option value="">
                        All Urgency
                    </option>

                    <option value="Critical">
                        Critical
                    </option>

                    <option value="High">
                        High
                    </option>

                    <option value="Normal">
                        Normal
                    </option>

                    <option value="Moderate">
                        Moderate
                    </option>

                </select>

            </div>


            {{-- =================================================
                 STATUS TABS
                 ================================================= --}}
            <div class="br-tabs">

                <button type="button" class="br-tab active">

                    All

                    <span class="tab-count">
                        24
                    </span>

                </button>


                <button type="button" class="br-tab">

                    Pending

                    <span class="tab-count">
                        12
                    </span>

                </button>


                <button type="button" class="br-tab">

                    Approved

                    <span class="tab-count">
                        9
                    </span>

                </button>


                <button type="button" class="br-tab">

                    Critical

                    <span class="tab-count">
                        3
                    </span>

                </button>

            </div>

        </div>


        {{-- =====================================================
             REQUEST TABLE
             ===================================================== --}}
        <div class="br-table-wrapper">

            <table class="br-table">

                <thead>

                    <tr>

                        <th>
                            Patient
                        </th>

                        <th>
                            Blood Type
                        </th>

                        <th>
                            Units
                        </th>

                        <th>
                            Urgency
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    {{-- =================================================
                         REQUEST 1
                         ================================================= --}}
                    <tr>

                        <td>

                            <div class="br-patient">

                                <div class="br-avatar">
                                    JH
                                </div>

                                <div>

                                    <div class="br-patient-name">
                                        Jhuniel Huiso
                                    </div>

                                    <div class="br-hospital">
                                        City Hospital
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="br-blood">
                                A+
                            </span>

                        </td>


                        <td>

                            <span class="br-units">
                                2
                            </span>

                            <small>units</small>

                        </td>


                        <td>

                            <span class="br-urgency critical">

                                <span class="br-urgency-dot"></span>

                                Critical

                            </span>

                        </td>


                        <td>

                            <span class="br-status pending">

                                <span class="br-status-dot"></span>

                                Pending

                            </span>

                        </td>


                        <td>

                            <div class="br-actions">

                                <button
                                    type="button"
                                    class="br-action view"
                                    title="View Request"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                                <button
                                    type="button"
                                    class="br-action approve"
                                    title="Approve Request"
                                >
                                    <i class="bi bi-check-lg"></i>
                                </button>

                                <button
                                    type="button"
                                    class="br-action reject"
                                    title="Reject Request"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- =================================================
                         REQUEST 2
                         ================================================= --}}
                    <tr>

                        <td>

                            <div class="br-patient">

                                <div class="br-avatar">
                                    AJ
                                </div>

                                <div>

                                    <div class="br-patient-name">
                                        Anacleto Jotojot
                                    </div>

                                    <div class="br-hospital">
                                        General Hospital
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="br-blood">
                                O-
                            </span>

                        </td>


                        <td>

                            <span class="br-units">
                                1
                            </span>

                            <small>unit</small>

                        </td>


                        <td>

                            <span class="br-urgency high">

                                <span class="br-urgency-dot"></span>

                                High

                            </span>

                        </td>


                        <td>

                            <span class="br-status approved">

                                <span class="br-status-dot"></span>

                                Approved

                            </span>

                        </td>


                        <td>

                            <div class="br-actions">

                                <button
                                    type="button"
                                    class="br-action view"
                                    title="View Request"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- =================================================
                         REQUEST 3
                         ================================================= --}}
                    <tr>

                        <td>

                            <div class="br-patient">

                                <div class="br-avatar">
                                    BP
                                </div>

                                <div>

                                    <div class="br-patient-name">
                                        Bryle Pat
                                    </div>

                                    <div class="br-hospital">
                                        City Medical Center
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="br-blood">
                                B+
                            </span>

                        </td>


                        <td>

                            <span class="br-units">
                                1
                            </span>

                            <small>unit</small>

                        </td>


                        <td>

                            <span class="br-urgency normal">

                                <span class="br-urgency-dot"></span>

                                Normal

                            </span>

                        </td>


                        <td>

                            <span class="br-status pending">

                                <span class="br-status-dot"></span>

                                Pending

                            </span>

                        </td>


                        <td>

                            <div class="br-actions">

                                <button
                                    type="button"
                                    class="br-action view"
                                    title="View Request"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                                <button
                                    type="button"
                                    class="br-action approve"
                                    title="Approve Request"
                                >
                                    <i class="bi bi-check-lg"></i>
                                </button>

                                <button
                                    type="button"
                                    class="br-action reject"
                                    title="Reject Request"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- =================================================
                         REQUEST 4
                         ================================================= --}}
                    <tr>

                        <td>

                            <div class="br-patient">

                                <div class="br-avatar">
                                    JP
                                </div>

                                <div>

                                    <div class="br-patient-name">
                                        Josami Polestico
                                    </div>

                                    <div class="br-hospital">
                                        Iloilo Medical Center
                                    </div>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="br-blood">
                                AB+
                            </span>

                        </td>


                        <td>

                            <span class="br-units">
                                3
                            </span>

                            <small>units</small>

                        </td>


                        <td>

                            <span class="br-urgency moderate">

                                <span class="br-urgency-dot"></span>

                                Moderate

                            </span>

                        </td>


                        <td>

                            <span class="br-status approved">

                                <span class="br-status-dot"></span>

                                Approved

                            </span>

                        </td>


                        <td>

                            <div class="br-actions">

                                <button
                                    type="button"
                                    class="br-action view"
                                    title="View Request"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             REQUEST DETAILS
             ===================================================== --}}
        <div class="br-details">

            <div class="br-details-heading">

                <div>

                    <h3>
                        Request Details
                    </h3>

                    <p>
                        Selected blood request information
                    </p>

                </div>

            </div>


            <div class="br-details-box">

                <div class="br-details-grid">

                    <div class="br-detail-item">

                        <span>
                            Patient
                        </span>

                        <strong>
                            John
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Hospital
                        </span>

                        <strong>
                            City Hospital
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Blood Type
                        </span>

                        <strong class="br-detail-blood">
                            A+
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Units Needed
                        </span>

                        <strong>
                            2 Units
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Urgency
                        </span>

                        <strong class="br-critical-text">
                            ● Critical
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Status
                        </span>

                        <strong>

                            <span class="br-status pending">

                                <span class="br-status-dot"></span>

                                Pending

                            </span>

                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Request Date
                        </span>

                        <strong>
                            September 07, 2026
                        </strong>

                    </div>


                    <div class="br-detail-item">

                        <span>
                            Contact
                        </span>

                        <strong>
                            0912 345 6789
                        </strong>

                    </div>

                </div>


                {{-- ACTIONS --}}
                <div class="br-details-actions">

                    <button
                        type="button"
                        class="br-btn br-btn-reject"
                    >

                        <i class="bi bi-x-lg"></i>

                        Reject Request

                    </button>


                    <button
                        type="button"
                        class="br-btn br-btn-approve"
                    >

                        <i class="bi bi-check-lg"></i>

                        Approve Request

                    </button>

                </div>

            </div>

        </div>


        {{-- =====================================================
             PAGINATION
             ===================================================== --}}
        <div class="br-footer">

            <div class="br-footer-text">
                Showing 1–4 of 24 requests
            </div>


            <div class="br-pagination">

                <button
                    type="button"
                    class="br-page-btn"
                >
                    <i class="bi bi-chevron-left"></i>
                </button>


                <button
                    type="button"
                    class="br-page-btn active"
                >
                    1
                </button>


                <button
                    type="button"
                    class="br-page-btn"
                >
                    2
                </button>


                <button
                    type="button"
                    class="br-page-btn"
                >
                    3
                </button>


                <button
                    type="button"
                    class="br-page-btn"
                >
                    4
                </button>


                <button
                    type="button"
                    class="br-page-btn"
                >
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SMALL JAVASCRIPT
     ========================================================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | STATUS TABS
        |--------------------------------------------------------------------------
        */

        const tabs = document.querySelectorAll('.br-tab');

        tabs.forEach(function (tab) {

            tab.addEventListener('click', function () {

                tabs.forEach(function (item) {
                    item.classList.remove('active');
                });

                this.classList.add('active');

            });

        });


        /*
        |--------------------------------------------------------------------------
        | VIEW BUTTON
        |--------------------------------------------------------------------------
        */

        const viewButtons = document.querySelectorAll('.br-action.view');

        viewButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const row = this.closest('tr');

                if (!row) {
                    return;
                }

                const patient =
                    row.querySelector('.br-patient-name')?.textContent.trim();

                const hospital =
                    row.querySelector('.br-hospital')?.textContent.trim();

                const blood =
                    row.querySelector('.br-blood')?.textContent.trim();

                const units =
                    row.querySelector('.br-units')?.textContent.trim();

                const urgency =
                    row.querySelector('.br-urgency')?.textContent.trim();

                const status =
                    row.querySelector('.br-status')?.textContent.trim();


                /*
                | Update the details panel
                */

                const details =
                    document.querySelector('.br-details-box');

                if (!details) {
                    return;
                }

                const values =
                    details.querySelectorAll('.br-detail-item strong');


                if (values.length >= 6) {

                    values[0].textContent = patient;
                    values[1].textContent = hospital;

                    values[2].textContent = blood;

                    values[3].textContent =
                        units + (units === '1' ? ' Unit' : ' Units');

                    values[4].textContent =
                        '● ' + urgency;

                    values[5].innerHTML =
                        '<span class="br-status ' +
                        (status.toLowerCase().includes('approved')
                            ? 'approved'
                            : 'pending') +
                        '">' +
                        '<span class="br-status-dot"></span>' +
                        status +
                        '</span>';

                }

                /*
                | Scroll smoothly to details
                */

                document.querySelector('.br-details')
                    ?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

            });

        });


        /*
        |--------------------------------------------------------------------------
        | APPROVE BUTTON
        |--------------------------------------------------------------------------
        */

        const approveButtons =
            document.querySelectorAll(
                '.br-action.approve, .br-btn-approve'
            );

        approveButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const confirmed =
                    confirm(
                        'Are you sure you want to approve this blood request?'
                    );

                if (!confirmed) {
                    return;
                }

                alert('Blood request approved successfully.');

            });

        });


        /*
        |--------------------------------------------------------------------------
        | REJECT BUTTON
        |--------------------------------------------------------------------------
        */

        const rejectButtons =
            document.querySelectorAll(
                '.br-action.reject, .br-btn-reject'
            );

        rejectButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const confirmed =
                    confirm(
                        'Are you sure you want to reject this blood request?'
                    );

                if (!confirmed) {
                    return;
                }

                alert('Blood request rejected.');

            });

        });

    });

</script>

@endsection