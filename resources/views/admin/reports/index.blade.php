@extends('admin.layouts.app')

@section('title', 'Reports & Statistics')

@section('content')

<style>
    .reports-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
    }

    .reports-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 25px;
        margin-bottom: 25px;
    }

    .reports-title-area {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .reports-title-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #fff0f1;
        color: #e32632;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .reports-title-area h1 {
        margin: 0;
        color: #10233f;
        font-size: 30px;
        font-weight: 750;
    }

    .reports-title-area p {
        margin: 5px 0 0;
        color: #718096;
        font-size: 14px;
    }

    .date-filter-card {
        background: #ffffff;
        border: 1px solid #e6e8ec;
        border-radius: 15px;
        padding: 15px;
        display: flex;
        align-items: flex-end;
        gap: 10px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .05);
    }

    .date-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .date-field label {
        color: #667085;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .date-field input {
        height: 46px;
        min-width: 175px;
        border: 1px solid #d8dde5;
        border-radius: 10px;
        padding: 0 12px;
        color: #344054;
        outline: none;
    }

    .date-field input:focus {
        border-color: #e32632;
        box-shadow: 0 0 0 3px rgba(227, 38, 50, .10);
    }

    .filter-btn {
        height: 46px;
        border: none;
        border-radius: 10px;
        padding: 0 20px;
        background: #e32632;
        color: white;
        font-weight: 700;
        cursor: pointer;
    }

    .filter-btn:hover {
        background: #c91d29;
    }

    .report-alert {
        background: #ecfdf3;
        border: 1px solid #abefc6;
        color: #067647;
        border-radius: 12px;
        padding: 13px 16px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .report-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 25px;
    }

    .report-stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 17px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .045);
    }

    .report-stat-label {
        color: #667085;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .report-stat-number {
        color: #10233f;
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
    }

    .report-stat-change {
        margin-top: 10px;
        color: #12a150;
        font-size: 13px;
        font-weight: 600;
    }

    .report-stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .report-stat-icon.red {
        background: #ffe3e5;
        color: #e32632;
    }

    .report-stat-icon.pink {
        background: #fff0f2;
        color: #ef4b58;
    }

    .report-stat-icon.orange {
        background: #fff4e8;
        color: #ef7d16;
    }

    .report-two-columns {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 24px;
        margin-bottom: 25px;
    }

    .report-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .045);
    }

    .report-card-header {
        padding: 23px 25px;
        border-bottom: 1px solid #edf0f3;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .report-card-header h2 {
        margin: 0;
        color: #10233f;
        font-size: 19px;
        font-weight: 750;
    }

    .report-card-header p {
        margin: 5px 0 0;
        color: #98a2b3;
        font-size: 13px;
    }

    .report-card-header i {
        color: #e32632;
        font-size: 25px;
    }

    .blood-list {
        padding: 22px 25px 25px;
    }

    .blood-row {
        margin-bottom: 21px;
    }

    .blood-row:last-child {
        margin-bottom: 0;
    }

    .blood-row-top {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .blood-name {
        color: #344054;
        font-weight: 650;
        font-size: 14px;
    }

    .blood-name::before {
        content: "";
        width: 10px;
        height: 10px;
        background: #e32632;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
    }

    .blood-count {
        color: #667085;
        font-size: 13px;
    }

    .blood-bar {
        width: 100%;
        height: 11px;
        border-radius: 20px;
        background: #edf1f5;
        overflow: hidden;
    }

    .blood-bar-fill {
        height: 100%;
        border-radius: 20px;
        background: #e32632;
        transition: width .4s ease;
    }

    .summary-list {
        padding: 22px 25px 25px;
    }

    .summary-item {
        background: #f8fafc;
        border-radius: 13px;
        padding: 17px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 13px;
    }

    .summary-item:last-child {
        margin-bottom: 0;
    }

    .summary-left {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .summary-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #fff0f1;
        color: #e32632;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .summary-text strong {
        display: block;
        color: #24334b;
        font-size: 14px;
    }

    .summary-text span {
        display: block;
        margin-top: 3px;
        color: #98a2b3;
        font-size: 12px;
    }

    .summary-value {
        color: #10233f;
        font-size: 21px;
        font-weight: 800;
    }

    .monthly-card {
        margin-bottom: 25px;
    }

    .monthly-table-wrapper {
        overflow-x: auto;
    }

    .monthly-table {
        width: 100%;
        border-collapse: collapse;
    }

    .monthly-table th {
        padding: 14px 22px;
        background: #fafbfc;
        color: #667085;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .4px;
        text-align: left;
    }

    .monthly-table td {
        padding: 16px 22px;
        border-top: 1px solid #eef0f3;
        color: #344054;
        font-size: 14px;
    }

    .monthly-table td strong {
        color: #10233f;
    }

    .report-info {
        margin-bottom: 25px;
    }

    .report-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        padding: 22px 25px;
    }

    .info-box {
        border: 1px solid #e4e7ec;
        border-radius: 12px;
        padding: 18px;
        min-height: 100px;
    }

    .info-label {
        color: #98a2b3;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .info-value {
        color: #10233f;
        font-size: 17px;
        font-weight: 750;
    }

    .report-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 0 25px 25px;
    }

    .report-action {
        border: 1px solid;
        border-radius: 10px;
        min-height: 45px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        background: white;
    }

    .report-action.generate {
        background: #e32632;
        border-color: #e32632;
        color: white;
    }

    .report-action.generate:hover {
        background: #c91d29;
        color: white;
    }

    .report-action.pdf {
        color: #e32632;
        border-color: #f2b7bc;
    }

    .report-action.pdf:hover {
        background: #fff5f5;
    }

    .report-action.excel {
        color: #087443;
        border-color: #a7e3c2;
    }

    .report-action.excel:hover {
        background: #f0fdf4;
    }

    @media (max-width: 1200px) {
        .reports-header {
            flex-direction: column;
            align-items: stretch;
        }

        .date-filter-card {
            width: fit-content;
        }

        .report-two-columns {
            grid-template-columns: 1fr;
        }

        .report-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 800px) {
        .report-stats {
            grid-template-columns: 1fr;
        }

        .date-filter-card {
            width: 100%;
            flex-wrap: wrap;
        }

        .date-field {
            flex: 1;
        }

        .date-field input {
            width: 100%;
            min-width: 0;
        }

        .filter-btn {
            width: 100%;
        }
    }

    @media (max-width: 600px) {
        .reports-title-area h1 {
            font-size: 24px;
        }

        .reports-title-icon {
            width: 48px;
            height: 48px;
        }

        .report-info-grid {
            grid-template-columns: 1fr;
        }

        .report-actions {
            flex-direction: column;
        }

        .report-action {
            justify-content: center;
            width: 100%;
        }
    }
</style>


<div class="reports-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="reports-header">

        <div class="reports-title-area">

            <div class="reports-title-icon">
                <i class="bi bi-bar-chart-fill"></i>
            </div>

            <div>
                <h1>Reports & Statistics</h1>

                <p>
                    Monitor blood donations, donors, and blood requests.
                </p>
            </div>

        </div>


        {{-- DATE FILTER --}}

        <form
            action="{{ route('admin.reports') }}"
            method="GET"
            class="date-filter-card"
        >

            <div class="date-field">
                <label for="from">From</label>

                <input
                    type="date"
                    id="from"
                    name="from"
                    value="{{ $from }}"
                    required
                >
            </div>


            <div class="date-field">
                <label for="to">To</label>

                <input
                    type="date"
                    id="to"
                    name="to"
                    value="{{ $to }}"
                    required
                >
            </div>


            <button
                type="submit"
                class="filter-btn"
            >
                <i class="bi bi-funnel-fill"></i>
                Filter
            </button>

        </form>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="report-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>

    @endif


    @if(isset($generated) && $generated)

        <div class="report-alert">
            <i class="bi bi-check-circle-fill"></i>
            Report generated successfully for
            <strong>
                {{ \Carbon\Carbon::parse($from)->format('F d, Y') }}
                -
                {{ \Carbon\Carbon::parse($to)->format('F d, Y') }}
            </strong>.
        </div>

    @endif


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="report-stats">

        {{-- DONATIONS --}}

        <div class="report-stat-card">

            <div>

                <div class="report-stat-label">
                    Total Donations
                </div>

                <div class="report-stat-number">
                    {{ number_format($totalDonations) }}
                </div>

                <div class="report-stat-change">
                    <i class="bi bi-check-circle-fill"></i>
                    Completed donations
                </div>

            </div>

            <div class="report-stat-icon red">
                <i class="bi bi-droplet-fill"></i>
            </div>

        </div>


        {{-- DONORS --}}

        <div class="report-stat-card">

            <div>

                <div class="report-stat-label">
                    Registered Donors
                </div>

                <div class="report-stat-number">
                    {{ number_format($totalDonors) }}
                </div>

                <div class="report-stat-change">
                    <i class="bi bi-arrow-up"></i>
                    {{ number_format($newDonors) }} new in period
                </div>

            </div>

            <div class="report-stat-icon pink">
                <i class="bi bi-people-fill"></i>
            </div>

        </div>


        {{-- REQUESTS --}}

        <div class="report-stat-card">

            <div>

                <div class="report-stat-label">
                    Blood Requests
                </div>

                <div class="report-stat-number">
                    {{ number_format($totalRequests) }}
                </div>

                <div class="report-stat-change">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                    {{ number_format($completedRequests) }} completed
                </div>

            </div>

            <div class="report-stat-icon orange">
                <i class="bi bi-clipboard2-pulse-fill"></i>
            </div>

        </div>

    </div>


    {{-- =====================================================
         BLOOD TYPES + MONTHLY SUMMARY
    ====================================================== --}}

    <div class="report-two-columns">

        {{-- BLOOD TYPE --}}

        <div class="report-card">

            <div class="report-card-header">

                <div>
                    <h2>Donations by Blood Type</h2>

                    <p>
                        Distribution of donations for the selected period
                    </p>
                </div>

                <i class="bi bi-droplet-fill"></i>

            </div>


            <div class="blood-list">

                @foreach($bloodTypeStats as $bloodType => $count)

                    @php
                        $percentage = $maxBloodTypeValue > 0
                            ? ($count / $maxBloodTypeValue) * 100
                            : 0;
                    @endphp

                    <div class="blood-row">

                        <div class="blood-row-top">

                            <span class="blood-name">
                                {{ $bloodType }}
                            </span>

                            <span class="blood-count">
                                {{ number_format($count) }}
                                {{ $count == 1 ? 'donation' : 'donations' }}
                            </span>

                        </div>

                        <div class="blood-bar">

                            <div
                                class="blood-bar-fill"
                                style="width: {{ $percentage }}%;"
                            ></div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- MONTHLY SUMMARY --}}

        <div class="report-card">

            <div class="report-card-header">

                <div>
                    <h2>Monthly Summary</h2>

                    <p>
                        Selected reporting period
                    </p>
                </div>

                <i class="bi bi-graph-up-arrow"></i>

            </div>


            <div class="summary-list">

                <div class="summary-item">

                    <div class="summary-left">

                        <div class="summary-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>

                        <div class="summary-text">

                            <strong>
                                Successful Donations
                            </strong>

                            <span>
                                Completed donations
                            </span>

                        </div>

                    </div>

                    <div class="summary-value">
                        {{ number_format($totalDonations) }}
                    </div>

                </div>


                <div class="summary-item">

                    <div class="summary-left">

                        <div class="summary-icon">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>

                        <div class="summary-text">

                            <strong>
                                New Donors
                            </strong>

                            <span>
                                Newly registered
                            </span>

                        </div>

                    </div>

                    <div class="summary-value">
                        {{ number_format($newDonors) }}
                    </div>

                </div>


                <div class="summary-item">

                    <div class="summary-left">

                        <div class="summary-icon">
                            <i class="bi bi-clipboard2-pulse-fill"></i>
                        </div>

                        <div class="summary-text">

                            <strong>
                                Blood Requests
                            </strong>

                            <span>
                                Total requests
                            </span>

                        </div>

                    </div>

                    <div class="summary-value">
                        {{ number_format($totalRequests) }}
                    </div>

                </div>


                <div class="summary-item">

                    <div class="summary-left">

                        <div class="summary-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                        <div class="summary-text">

                            <strong>
                                Completed Requests
                            </strong>

                            <span>
                                Successfully fulfilled
                            </span>

                        </div>

                    </div>

                    <div class="summary-value">
                        {{ number_format($completedRequests) }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MONTHLY BREAKDOWN
    ====================================================== --}}

    <div class="report-card monthly-card">

        <div class="report-card-header">

            <div>
                <h2>Monthly Breakdown</h2>

                <p>
                    Activity during the selected reporting period
                </p>
            </div>

            <i class="bi bi-calendar3"></i>

        </div>


        <div class="monthly-table-wrapper">

            <table class="monthly-table">

                <thead>

                    <tr>
                        <th>Month</th>
                        <th>Donations</th>
                        <th>New Donors</th>
                        <th>Blood Requests</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($monthlyStats as $month)

                        <tr>

                            <td>
                                <strong>
                                    {{ $month['month'] }}
                                </strong>
                            </td>

                            <td>
                                {{ number_format($month['donations']) }}
                            </td>

                            <td>
                                {{ number_format($month['new_donors']) }}
                            </td>

                            <td>
                                {{ number_format($month['requests']) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                style="text-align:center;padding:30px;"
                            >
                                No data available for this period.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =====================================================
         REPORT INFORMATION
    ====================================================== --}}

    <div class="report-card report-info">

        <div class="report-card-header">

            <div>
                <h2>Report Information</h2>

                <p>
                    Details of the currently selected report period
                </p>
            </div>

            <i class="bi bi-file-earmark-bar-graph"></i>

        </div>


        <div class="report-info-grid">

            <div class="info-box">

                <div class="info-label">
                    Report Period
                </div>

                <div class="info-value">

                    {{ \Carbon\Carbon::parse($from)->format('M d, Y') }}

                    -

                    {{ \Carbon\Carbon::parse($to)->format('M d, Y') }}

                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Total Donations
                </div>

                <div class="info-value">
                    {{ number_format($totalDonations) }}
                    Donations
                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Total Donors
                </div>

                <div class="info-value">
                    {{ number_format($totalDonors) }}
                    Donors
                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Total Requests
                </div>

                <div class="info-value">
                    {{ number_format($totalRequests) }}
                    Requests
                </div>

            </div>

        </div>


        {{-- ACTIONS --}}

        <div class="report-actions">

            {{-- GENERATE --}}

            <a
                href="{{ route('admin.reports.generate', [
                    'from' => $from,
                    'to' => $to
                ]) }}"
                class="report-action generate"
            >
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                Generate Report
            </a>


            {{-- PDF --}}

            <a
                href="{{ route('admin.reports.pdf', [
                    'from' => $from,
                    'to' => $to
                ]) }}"
                target="_blank"
                class="report-action pdf"
            >
                <i class="bi bi-file-earmark-pdf"></i>
                Export PDF
            </a>


            {{-- EXCEL --}}

            <a
                href="{{ route('admin.reports.excel', [
                    'from' => $from,
                    'to' => $to
                ]) }}"
                class="report-action excel"
            >
                <i class="bi bi-file-earmark-excel"></i>
                Export Excel
            </a>

        </div>

    </div>

</div>

@endsection