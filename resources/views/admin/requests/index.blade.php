@extends('admin.layouts.app')

@section('title', 'Blood Request Management')

@section('content')

<style>
    .request-page {
        padding: 28px;
        background: #f6f7fb;
        min-height: calc(100vh - 70px);
    }

    .request-page * {
        box-sizing: border-box;
    }

    /* HEADER */
    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .request-title-area {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .request-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fff0f1;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .request-title {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .request-subtitle {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* STAT CARDS */
    .request-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .request-stat {
        background: #ffffff;
        border: 1px solid #eceef2;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.035);
        transition: .2s ease;
    }

    .request-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .request-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .icon-red {
        background: #fff0f1;
        color: #dc3545;
    }

    .icon-yellow {
        background: #fff8df;
        color: #d39e00;
    }

    .icon-green {
        background: #eaf8f0;
        color: #198754;
    }

    .icon-blue {
        background: #edf4ff;
        color: #0d6efd;
    }

    .request-stat-label {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 3px;
    }

    .request-stat-value {
        font-size: 25px;
        line-height: 1;
        font-weight: 700;
        color: #1f2937;
    }

    /* MAIN CARD */
    .request-card {
        background: #ffffff;
        border: 1px solid #e8eaf0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.035);
    }

    /* TOOLBAR */
    .request-toolbar {
        padding: 18px 20px;
        border-bottom: 1px solid #eceef2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .request-search-form {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        flex-wrap: wrap;
    }

    .request-search {
        position: relative;
        flex: 1;
        min-width: 260px;
    }

    .request-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .request-search input {
        width: 100%;
        height: 43px;
        border: 1px solid #dfe2e8;
        border-radius: 9px;
        padding: 0 15px 0 40px;
        font-size: 14px;
        outline: none;
        color: #374151;
        background: #fff;
        transition: .2s;
    }

    .request-search input:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, .08);
    }

    .request-filter {
        height: 43px;
        min-width: 150px;
        border: 1px solid #dfe2e8;
        border-radius: 9px;
        padding: 0 13px;
        background: #fff;
        color: #374151;
        font-size: 14px;
        outline: none;
        cursor: pointer;
    }

    .request-filter:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, .08);
    }

    .request-search-btn {
        height: 43px;
        padding: 0 18px;
        border: none;
        border-radius: 9px;
        background: #dc3545;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        cursor: pointer;
        transition: .2s;
    }

    .request-search-btn:hover {
        background: #c82333;
    }

    .request-reset-btn {
        height: 43px;
        padding: 0 15px;
        border: 1px solid #dfe2e8;
        border-radius: 9px;
        background: #fff;
        color: #6b7280;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 14px;
        transition: .2s;
    }

    .request-reset-btn:hover {
        background: #f8f9fa;
        color: #374151;
    }

    /* TABS */
    .request-tabs {
        padding: 0 20px;
        border-bottom: 1px solid #eceef2;
        display: flex;
        gap: 5px;
        overflow-x: auto;
    }

    .request-tab {
        position: relative;
        padding: 15px 14px;
        color: #6b7280;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .request-tab:hover {
        color: #dc3545;
    }

    .request-tab.active {
        color: #dc3545;
    }

    .request-tab.active::after {
        content: "";
        position: absolute;
        left: 10px;
        right: 10px;
        bottom: -1px;
        height: 2px;
        background: #dc3545;
        border-radius: 5px 5px 0 0;
    }

    /* TABLE */
    .request-table-wrapper {
        overflow-x: auto;
    }

    .request-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .request-table th {
        background: #fafbfc;
        color: #6b7280;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid #eceef2;
    }

    .request-table td {
        padding: 17px 20px;
        border-bottom: 1px solid #f0f1f4;
        color: #374151;
        font-size: 14px;
        vertical-align: middle;
    }

    .request-table tbody tr {
        transition: .15s;
    }

    .request-table tbody tr:hover {
        background: #fffafb;
    }

    /* PATIENT */
    .patient-info {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .patient-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff0f1;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .patient-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 2px;
    }

    .patient-email {
        font-size: 12px;
        color: #9ca3af;
    }

    /* BLOOD TYPE */
    .blood-type {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        height: 31px;
        padding: 0 9px;
        border-radius: 8px;
        background: #fff0f1;
        color: #dc3545;
        font-weight: 700;
        font-size: 13px;
    }

    /* UNITS */
    .units-value {
        font-weight: 600;
        color: #374151;
    }

    /* HOSPITAL */
    .hospital-name {
        color: #374151;
        font-weight: 500;
    }

    .hospital-notes {
        color: #9ca3af;
        font-size: 12px;
        max-width: 190px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 3px;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fff7df;
        color: #a87500;
    }

    .status-approved {
        background: #eaf8f0;
        color: #198754;
    }

    .status-rejected {
        background: #fff0f1;
        color: #dc3545;
    }

    .status-default {
        background: #f1f3f5;
        color: #6b7280;
    }

    /* DATE */
    .request-date {
        color: #374151;
        font-weight: 500;
        white-space: nowrap;
    }

    .request-time {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 2px;
    }

    /* ACTION */
    .request-view-btn {
        width: 35px;
        height: 35px;
        border: 1px solid #e1e4e9;
        border-radius: 8px;
        background: #fff;
        color: #6b7280;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
    }

    .request-view-btn:hover {
        color: #dc3545;
        border-color: #dc3545;
        background: #fff5f5;
    }

    /* EMPTY */
    .request-empty {
        padding: 70px 20px;
        text-align: center;
    }

    .request-empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #f3f4f6;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .request-empty-title {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    .request-empty-text {
        font-size: 13px;
        color: #9ca3af;
    }

    /* FOOTER */
    .request-footer {
        padding: 16px 20px;
        border-top: 1px solid #eceef2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .request-count {
        color: #6b7280;
        font-size: 13px;
    }

    .request-pagination .pagination {
        margin: 0;
    }

    .request-pagination .page-link {
        color: #dc3545;
        border-color: #e5e7eb;
    }

    .request-pagination .page-item.active .page-link {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    /* MODAL */
    .request-modal-header {
        border-bottom: 1px solid #eee;
    }

    .request-modal-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #fff0f1;
        color: #dc3545;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .detail-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 13px;
        height: 100%;
    }

    .detail-label {
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 4px;
    }

    .detail-value {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
    }

    .notes-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .request-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .request-page {
            padding: 18px;
        }

        .request-header {
            align-items: flex-start;
        }

        .request-title {
            font-size: 22px;
        }

        .request-search {
            min-width: 100%;
        }

        .request-filter {
            flex: 1;
        }

        .request-search-btn,
        .request-reset-btn {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .request-stats {
            grid-template-columns: 1fr;
        }

        .request-title-icon {
            width: 45px;
            height: 45px;
        }

        .request-toolbar {
            padding: 15px;
        }

        .request-tabs {
            padding: 0 15px;
        }
    }
</style>


<div class="request-page">

    {{-- HEADER --}}
    <div class="request-header">

        <div class="request-title-area">

            <div class="request-title-icon">
                <i class="bi bi-droplet-half"></i>
            </div>

            <div>
                <h1 class="request-title">
                    Blood Request Management
                </h1>

                <p class="request-subtitle">
                    Review and manage blood requests from your database.
                </p>
            </div>

        </div>

    </div>


    {{-- STATISTICS --}}
    <div class="request-stats">

        <div class="request-stat">

            <div class="request-stat-icon icon-red">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>

            <div>
                <div class="request-stat-label">
                    Total Requests
                </div>

                <div class="request-stat-value">
                    {{ number_format($totalRequests) }}
                </div>
            </div>

        </div>


        <div class="request-stat">

            <div class="request-stat-icon icon-yellow">
                <i class="bi bi-clock-history"></i>
            </div>

            <div>
                <div class="request-stat-label">
                    Pending
                </div>

                <div class="request-stat-value">
                    {{ number_format($pendingRequests) }}
                </div>
            </div>

        </div>


        <div class="request-stat">

            <div class="request-stat-icon icon-green">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <div class="request-stat-label">
                    Approved
                </div>

                <div class="request-stat-value">
                    {{ number_format($approvedRequests) }}
                </div>
            </div>

        </div>


        <div class="request-stat">

            <div class="request-stat-icon icon-blue">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>
                <div class="request-stat-label">
                    Blood Units
                </div>

                <div class="request-stat-value">
                    {{ number_format($totalUnits) }}
                </div>
            </div>

        </div>

    </div>


    {{-- MAIN CARD --}}
    <div class="request-card">

        {{-- SEARCH --}}
        <div class="request-toolbar">

            <form
                action="{{ route('admin.requests') }}"
                method="GET"
                class="request-search-form"
            >

                <div class="request-search">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search patient or hospital..."
                    >

                </div>


                <select
                    name="blood_type"
                    class="request-filter"
                >
                    <option value="">
                        All Blood Types
                    </option>

                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)

                        <option
                            value="{{ $type }}"
                            {{ request('blood_type') === $type ? 'selected' : '' }}
                        >
                            {{ $type }}
                        </option>

                    @endforeach

                </select>


                <select
                    name="status"
                    class="request-filter"
                >
                    <option value="">
                        All Statuses
                    </option>

                    @php
                        $statuses = \App\Models\BloodRequest::query()
                            ->select('status')
                            ->whereNotNull('status')
                            ->distinct()
                            ->orderBy('status')
                            ->pluck('status');
                    @endphp

                    @foreach($statuses as $status)

                        <option
                            value="{{ $status }}"
                            {{ request('status') === $status ? 'selected' : '' }}
                        >
                            {{ ucfirst($status) }}
                        </option>

                    @endforeach

                </select>


                <button
                    type="submit"
                    class="request-search-btn"
                >
                    <i class="bi bi-search"></i>
                    Search
                </button>


                @if(request()->hasAny(['search', 'blood_type', 'status']))

                    <a
                        href="{{ route('admin.requests') }}"
                        class="request-reset-btn"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset
                    </a>

                @endif

            </form>

        </div>


        {{-- STATUS TABS --}}
        <div class="request-tabs">

            <a
                href="{{ route('admin.requests') }}"
                class="request-tab {{ !request('status') ? 'active' : '' }}"
            >
                All
            </a>


            <a
                href="{{ route('admin.requests', ['status' => 'pending']) }}"
                class="request-tab {{ request('status') === 'pending' ? 'active' : '' }}"
            >
                Pending
            </a>


            <a
                href="{{ route('admin.requests', ['status' => 'approved']) }}"
                class="request-tab {{ request('status') === 'approved' ? 'active' : '' }}"
            >
                Approved
            </a>


            @if($statuses->contains('rejected'))

                <a
                    href="{{ route('admin.requests', ['status' => 'rejected']) }}"
                    class="request-tab {{ request('status') === 'rejected' ? 'active' : '' }}"
                >
                    Rejected
                </a>

            @endif

        </div>


        {{-- TABLE --}}
        <div class="request-table-wrapper">

            @if($requests->count())

                <table class="request-table">

                    <thead>

                        <tr>
                            <th>Patient</th>
                            <th>Blood Type</th>
                            <th>Units</th>
                            <th>Hospital</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($requests as $requestItem)

                            @php

                                $status = strtolower(
                                    $requestItem->status ?? 'unknown'
                                );

                                $statusClass = match($status) {

                                    'pending' =>
                                        'status-pending',

                                    'approved' =>
                                        'status-approved',

                                    'rejected' =>
                                        'status-rejected',

                                    default =>
                                        'status-default',

                                };

                                $patientName =
                                    $requestItem->patient_name ?: 'N/A';

                                $initials =
                                    collect(
                                        explode(' ', trim($patientName))
                                    )
                                    ->filter()
                                    ->take(2)
                                    ->map(
                                        fn($word) =>
                                            strtoupper(substr($word, 0, 1))
                                    )
                                    ->implode('');

                            @endphp


                            <tr>

                                {{-- PATIENT --}}
                                <td>

                                    <div class="patient-info">

                                        <div class="patient-avatar">
                                            {{ $initials ?: '?' }}
                                        </div>

                                        <div>

                                            <div class="patient-name">
                                                {{ $patientName }}
                                            </div>

                                            @if($requestItem->user)

                                                <div class="patient-email">
                                                    {{ $requestItem->user->email }}
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- BLOOD TYPE --}}
                                <td>

                                    <span class="blood-type">
                                        {{ $requestItem->blood_type ?: 'N/A' }}
                                    </span>

                                </td>


                                {{-- UNITS --}}
                                <td>

                                    <span class="units-value">

                                        {{ $requestItem->units_needed }}

                                        {{ $requestItem->units_needed == 1
                                            ? 'Unit'
                                            : 'Units'
                                        }}

                                    </span>

                                </td>


                                {{-- HOSPITAL --}}
                                <td>

                                    <div class="hospital-name">
                                        {{ $requestItem->hospital ?: 'N/A' }}
                                    </div>

                                    @if($requestItem->notes)

                                        <div
                                            class="hospital-notes"
                                            title="{{ $requestItem->notes }}"
                                        >
                                            {{ $requestItem->notes }}
                                        </div>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    <span class="status-badge {{ $statusClass }}">

                                        @if($status === 'pending')

                                            <i class="bi bi-clock"></i>

                                        @elseif($status === 'approved')

                                            <i class="bi bi-check-circle"></i>

                                        @elseif($status === 'rejected')

                                            <i class="bi bi-x-circle"></i>

                                        @else

                                            <i class="bi bi-info-circle"></i>

                                        @endif

                                        {{ $requestItem->status ?: 'Unknown' }}

                                    </span>

                                </td>


                                {{-- DATE --}}
                                <td>

                                    <div class="request-date">
                                        {{ $requestItem->created_at?->format('M d, Y') }}
                                    </div>

                                    <div class="request-time">
                                        {{ $requestItem->created_at?->format('h:i A') }}
                                    </div>

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <button
                                        type="button"
                                        class="request-view-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#requestModal{{ $requestItem->id }}"
                                        title="View Request"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </td>

                            </tr>


                            {{-- DETAILS MODAL --}}
                            <div
                                class="modal fade"
                                id="requestModal{{ $requestItem->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content border-0 shadow">

                                        <div class="modal-header request-modal-header">

                                            <div class="d-flex align-items-center">

                                                <div class="request-modal-icon">
                                                    <i class="bi bi-droplet-half"></i>
                                                </div>

                                                <div>

                                                    <h5 class="modal-title mb-0">
                                                        Blood Request
                                                    </h5>

                                                    <small class="text-muted">
                                                        Request #{{ $requestItem->id }}
                                                    </small>

                                                </div>

                                            </div>


                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                            ></button>

                                        </div>


                                        <div class="modal-body p-4">

                                            <div class="mb-4">

                                                <div class="text-muted small mb-1">
                                                    Patient
                                                </div>

                                                <h5 class="mb-0">
                                                    {{ $requestItem->patient_name ?: 'N/A' }}
                                                </h5>

                                                @if($requestItem->user)

                                                    <div class="text-muted small mt-1">
                                                        {{ $requestItem->user->email }}
                                                    </div>

                                                @endif

                                            </div>


                                            <div class="row g-3 mb-3">

                                                <div class="col-6">

                                                    <div class="detail-box">

                                                        <div class="detail-label">
                                                            Blood Type
                                                        </div>

                                                        <div class="detail-value text-danger">
                                                            {{ $requestItem->blood_type ?: 'N/A' }}
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="col-6">

                                                    <div class="detail-box">

                                                        <div class="detail-label">
                                                            Units Needed
                                                        </div>

                                                        <div class="detail-value">
                                                            {{ $requestItem->units_needed }}
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="col-6">

                                                    <div class="detail-box">

                                                        <div class="detail-label">
                                                            Status
                                                        </div>

                                                        <div class="detail-value text-capitalize">
                                                            {{ $requestItem->status ?: 'Unknown' }}
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="col-6">

                                                    <div class="detail-box">

                                                        <div class="detail-label">
                                                            Date
                                                        </div>

                                                        <div class="detail-value">
                                                            {{ $requestItem->created_at?->format('M d, Y') }}
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="detail-box mb-3">

                                                <div class="detail-label">
                                                    Hospital
                                                </div>

                                                <div class="detail-value">
                                                    {{ $requestItem->hospital ?: 'N/A' }}
                                                </div>

                                            </div>


                                            <div>

                                                <div class="detail-label mb-2">
                                                    Notes
                                                </div>

                                                <div class="notes-box">
                                                    {{ $requestItem->notes ?: 'No additional notes provided.' }}
                                                </div>

                                            </div>

                                        </div>


                                        <div class="modal-footer border-top">

                                            <button
                                                type="button"
                                                class="btn btn-light px-4"
                                                data-bs-dismiss="modal"
                                            >
                                                Close
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="request-empty">

                    <div class="request-empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <div class="request-empty-title">
                        No blood requests found
                    </div>

                    <div class="request-empty-text">
                        Try changing your search or filters.
                    </div>

                </div>

            @endif

        </div>


        {{-- FOOTER --}}
        @if($requests->count())

            <div class="request-footer">

                <div class="request-count">

                    Showing
                    <strong>{{ $requests->firstItem() }}</strong>
                    –
                    <strong>{{ $requests->lastItem() }}</strong>
                    of
                    <strong>{{ $requests->total() }}</strong>
                    requests

                </div>


                <div class="request-pagination">

                    {{ $requests->withQueryString()->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@endsection