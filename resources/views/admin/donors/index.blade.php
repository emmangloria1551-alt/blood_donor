@extends('admin.layouts.app')

@section('content')

<div class="donor-page">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="page-header-left">

            <div class="page-title">
                <div class="title-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>

                <div>
                    <h1>Donor Management</h1>
                    <p>Manage donor information, blood types, and availability.</p>
                </div>
            </div>

        </div>

    </div>


    <!-- STATISTICS -->
    <div class="donor-stats">

        <div class="donor-stat-card">

            <div class="stat-icon red">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="stat-label">Total Donors</div>
                <div class="stat-number">450</div>

                <div class="stat-info">
                    <i class="bi bi-arrow-up"></i>
                    8.4% this month
                </div>
            </div>

        </div>


        <div class="donor-stat-card">

            <div class="stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <div class="stat-label">Available Donors</div>
                <div class="stat-number">328</div>

                <div class="stat-info">
                    <i class="bi bi-check-circle"></i>
                    Ready to donate
                </div>
            </div>

        </div>


        <div class="donor-stat-card">

            <div class="stat-icon orange">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div>
                <div class="stat-label">Unavailable</div>
                <div class="stat-number">122</div>

                <div class="stat-info orange-text">
                    <i class="bi bi-exclamation-circle"></i>
                    Requires waiting
                </div>
            </div>

        </div>


        <div class="donor-stat-card">

            <div class="stat-icon purple">
                <i class="bi bi-droplet-fill"></i>
            </div>

            <div>
                <div class="stat-label">Total Donations</div>
                <div class="stat-number">850</div>

                <div class="stat-info">
                    <i class="bi bi-arrow-up"></i>
                    Total completed
                </div>
            </div>

        </div>

    </div>


    <!-- DONOR LIST -->
    <div class="donor-card">

        <div class="donor-card-header">

            <div>
                <h2>All Donors</h2>
                <p>View and manage registered blood donors.</p>
            </div>

            <span class="donor-count">
                450 Donors
            </span>

        </div>


        <!-- SEARCH AND FILTER -->
        <div class="donor-toolbar">

            <div class="donor-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    placeholder="Search donor by name or email..."
                    autocomplete="off"
                >

            </div>


            <select class="donor-filter">

                <option>All Blood Types</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>

            </select>


            <select class="donor-filter">

                <option>All Availability</option>
                <option>Available</option>
                <option>Unavailable</option>

            </select>

        </div>


        <!-- TABLE -->
        <div class="table-wrapper">

            <table class="donor-table">

                <thead>

                    <tr>
                        <th>DONOR</th>
                        <th>BLOOD TYPE</th>
                        <th>LAST DONATION</th>
                        <th>AVAILABILITY</th>
                        <th>ACTION</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($donors as $donor)

                        <tr>

                            <!-- DONOR -->
                            <td>

                                <div class="donor-profile">

                                    <div class="donor-avatar">

                                        {{ strtoupper(substr($donor->user->name, 0, 2)) }}

                                    </div>

                                    <div>

                                        <div class="donor-name">
                                            {{ $donor->user->name }}
                                        </div>

                                        <div class="donor-email">
                                            {{ $donor->user->email }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <!-- BLOOD TYPE -->
                            <td>

                                <span class="blood-badge">
                                    {{ $donor->blood_type }}
                                </span>

                            </td>


                            <!-- LAST DONATION -->
                            <td>

                                {{ $donor->last_donation
                                    ? $donor->last_donation->format('M d, Y')
                                    : 'No donation yet'
                                }}

                            </td>


                            <!-- AVAILABILITY -->
                            <td>

                                @if($donor->availability === 'available')

                                    <span class="availability available">
                                        <span></span>
                                        Available
                                    </span>

                                @else

                                    <span class="availability unavailable">
                                        <span></span>
                                        Unavailable
                                    </span>

                                @endif

                            </td>


                            <!-- ACTION -->
                            <td>

                                <div class="action-buttons">

                                    <button
                                        type="button"
                                        class="action-view"
                                        title="View donor"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="action-edit"
                                        title="Edit donor"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-droplet"></i>
                                    </div>

                                    <strong>No donors found</strong>

                                    <p>
                                        There are currently no registered donors.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->
        <div class="donor-pagination">

            <span>
                Showing 1–4 of 450 donors
            </span>

            <div class="pagination-buttons">

                <button type="button">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <button type="button" class="active-page">
                    1
                </button>

                <button type="button">
                    2
                </button>

                <button type="button">
                    3
                </button>

                <button type="button">
                    4
                </button>

                <button type="button">
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>

        </div>

    </div>


    <!-- DONOR DETAILS -->
    <div class="donor-details-card">

        <div class="details-header">

            <div class="details-icon">
                <i class="bi bi-person-heart"></i>
            </div>

            <div>
                <h2>Donor Details</h2>
                <p>Selected donor information</p>
            </div>

        </div>


        <div class="details-content">

            <div class="selected-donor">

                <div class="large-avatar">
                    JP
                </div>

                <div>

                    <h3>Josami Polestico</h3>

                    <p>
                        josami@gmail.com
                    </p>

                    <span class="availability available">
                        <span></span>
                        Available
                    </span>

                </div>

            </div>


            <div class="detail-item">

                <span>Blood Type</span>

                <strong class="detail-blood">
                    O+
                </strong>

            </div>


            <div class="detail-item">

                <span>Last Donation</span>

                <strong>
                    August 20, 2026
                </strong>

            </div>


            <div class="detail-item">

                <span>Status</span>

                <strong class="status-available">
                    Available
                </strong>

            </div>

        </div>

    </div>

</div>


<style>

/* =========================================
   DONOR PAGE
========================================= */

.donor-page {
    width: 100%;
    padding-bottom: 30px;
}


/* =========================================
   PAGE HEADER
========================================= */

.page-header {
    margin-bottom: 25px;
}

.page-title {
    display: flex;
    align-items: center;
    gap: 14px;
}

.title-icon {
    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 12px;

    font-size: 22px;
}

.page-title h1 {
    margin: 0;

    color: #172033;

    font-size: 27px;
    font-weight: 700;
}

.page-title p {
    margin: 5px 0 0;

    color: #718096;

    font-size: 13px;
}


/* =========================================
   STATISTICS
========================================= */

.donor-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;

    margin-bottom: 22px;
}

.donor-stat-card {
    display: flex;
    align-items: center;
    gap: 16px;

    padding: 21px;

    background: #ffffff;

    border: 1px solid #e7eaf0;
    border-radius: 14px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.035);

    transition: 0.2s;
}

.donor-stat-card:hover {
    transform: translateY(-2px);

    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
}

.stat-icon {
    width: 50px;
    height: 50px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    font-size: 21px;
}

.stat-icon.red {
    background: #fff0f2;
    color: #c00024;
}

.stat-icon.green {
    background: #ecfdf3;
    color: #079455;
}

.stat-icon.orange {
    background: #fff7ed;
    color: #ea580c;
}

.stat-icon.purple {
    background: #f5f3ff;
    color: #7c3aed;
}

.stat-label {
    color: #718096;
    font-size: 12px;
    margin-bottom: 3px;
}

.stat-number {
    color: #101828;
    font-size: 26px;
    font-weight: 700;
}

.stat-info {
    margin-top: 3px;

    color: #079455;

    font-size: 11px;
    font-weight: 500;
}

.orange-text {
    color: #ea580c;
}


/* =========================================
   DONOR CARD
========================================= */

.donor-card {
    background: #ffffff;

    border: 1px solid #e7eaf0;
    border-radius: 16px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.035);

    overflow: hidden;
}

.donor-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 22px 24px;

    border-bottom: 1px solid #eef0f4;
}

.donor-card-header h2 {
    margin: 0;

    color: #172033;

    font-size: 18px;
    font-weight: 700;
}

.donor-card-header p {
    margin: 5px 0 0;

    color: #718096;

    font-size: 12px;
}

.donor-count {
    padding: 7px 12px;

    background: #f5f6f8;

    color: #667085;

    border-radius: 7px;

    font-size: 11px;
    font-weight: 600;
}


/* =========================================
   SEARCH TOOLBAR
========================================= */

.donor-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 18px 24px;

    background: #ffffff;

    border-bottom: 1px solid #eef0f4;
}

.donor-search {
    position: relative;

    width: 350px;
}

.donor-search i {
    position: absolute;

    left: 13px;
    top: 50%;

    transform: translateY(-50%);

    color: #98a2b3;

    font-size: 14px;
}

.donor-search input {
    width: 100%;
    height: 42px;

    padding: 0 13px 0 38px;

    box-sizing: border-box;

    background: #ffffff;

    border: 1px solid #d9dee7;
    border-radius: 8px;

    color: #344054;

    font-size: 13px;

    outline: none;

    transition: 0.2s;
}

.donor-search input::placeholder {
    color: #98a2b3;
}

.donor-search input:focus {
    border-color: #a9001f;

    box-shadow: 0 0 0 3px rgba(169, 0, 31, 0.07);
}

.donor-filter {
    width: 165px;
    height: 42px;

    padding: 0 12px;

    background: #ffffff;

    border: 1px solid #d9dee7;
    border-radius: 8px;

    color: #475467;

    font-size: 13px;

    outline: none;

    cursor: pointer;
}

.donor-filter:focus {
    border-color: #a9001f;

    box-shadow: 0 0 0 3px rgba(169, 0, 31, 0.07);
}


/* =========================================
   TABLE
========================================= */

.table-wrapper {
    width: 100%;

    overflow-x: auto;
}

.donor-table {
    width: 100%;

    border-collapse: collapse;
}

.donor-table th {
    padding: 13px 20px;

    background: #f8f9fb;

    color: #667085;

    text-align: left;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: 0.5px;
}

.donor-table td {
    padding: 15px 20px;

    border-bottom: 1px solid #eef0f4;

    color: #475467;

    font-size: 13px;
}

.donor-table tbody tr {
    transition: 0.15s;
}

.donor-table tbody tr:hover {
    background: #fcfcfd;
}


/* =========================================
   DONOR PROFILE
========================================= */

.donor-profile {
    display: flex;
    align-items: center;
    gap: 11px;
}

.donor-avatar {
    width: 39px;
    height: 39px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 50%;

    font-size: 11px;
    font-weight: 700;
}

.donor-name {
    color: #172033;

    font-size: 13px;
    font-weight: 600;
}

.donor-email {
    margin-top: 3px;

    color: #98a2b3;

    font-size: 11px;
}


/* =========================================
   BLOOD BADGE
========================================= */

.blood-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 38px;
    height: 30px;

    padding: 0 8px;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 7px;

    font-size: 12px;
    font-weight: 700;
}


/* =========================================
   AVAILABILITY
========================================= */

.availability {
    display: inline-flex;

    align-items: center;
    gap: 7px;

    font-size: 12px;
    font-weight: 600;
}

.availability span {
    width: 7px;
    height: 7px;

    border-radius: 50%;
}

.availability.available {
    color: #079455;
}

.availability.available span {
    background: #12b76a;
}

.availability.unavailable {
    color: #d92d20;
}

.availability.unavailable span {
    background: #f04438;
}


/* =========================================
   ACTION BUTTONS
========================================= */

.action-buttons {
    display: flex;
    gap: 6px;
}

.action-buttons button {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    cursor: pointer;

    transition: 0.2s;
}

.action-view {
    background: #f2f4f7;
    color: #475467;

    border: 1px solid #e4e7ec;
}

.action-edit {
    background: #fff0f2;
    color: #a9001f;

    border: 1px solid #ffd6dc;
}

.action-buttons button:hover {
    transform: translateY(-1px);
}


/* =========================================
   EMPTY STATE
========================================= */

.empty-state {
    padding: 45px 20px;

    text-align: center;
}

.empty-icon {
    width: 50px;
    height: 50px;

    margin: 0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 50%;

    font-size: 22px;
}

.empty-state strong {
    color: #344054;

    font-size: 14px;
}

.empty-state p {
    margin: 5px 0 0;

    color: #98a2b3;

    font-size: 12px;
}


/* =========================================
   PAGINATION
========================================= */

.donor-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 17px 24px;

    color: #667085;

    font-size: 11px;
}

.pagination-buttons {
    display: flex;
    gap: 4px;
}

.pagination-buttons button {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #ffffff;

    border: 1px solid #e4e7ec;
    border-radius: 7px;

    color: #475467;

    font-size: 12px;

    cursor: pointer;
}

.pagination-buttons button:hover,
.pagination-buttons .active-page {
    background: #a9001f;

    border-color: #a9001f;

    color: #ffffff;
}


/* =========================================
   DONOR DETAILS
========================================= */

.donor-details-card {
    margin-top: 22px;

    padding: 24px;

    background: #ffffff;

    border: 1px solid #e7eaf0;
    border-radius: 16px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.035);
}

.details-header {
    display: flex;
    align-items: center;
    gap: 12px;

    margin-bottom: 22px;
}

.details-icon {
    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 11px;

    font-size: 19px;
}

.details-header h2 {
    margin: 0;

    color: #172033;

    font-size: 18px;
}

.details-header p {
    margin: 4px 0 0;

    color: #98a2b3;

    font-size: 11px;
}

.details-content {
    display: grid;

    grid-template-columns: 1.5fr 1fr 1fr 1fr;

    gap: 20px;

    align-items: center;
}

.selected-donor {
    display: flex;
    align-items: center;
    gap: 13px;
}

.large-avatar {
    width: 54px;
    height: 54px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fff0f2;
    color: #a9001f;

    border-radius: 50%;

    font-size: 15px;
    font-weight: 700;
}

.selected-donor h3 {
    margin: 0;

    color: #172033;

    font-size: 14px;
}

.selected-donor p {
    margin: 4px 0 7px;

    color: #98a2b3;

    font-size: 11px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 6px;

    padding-left: 20px;

    border-left: 1px solid #eaecf0;
}

.detail-item span {
    color: #98a2b3;

    font-size: 11px;
}

.detail-item strong {
    color: #172033;

    font-size: 13px;
}

.detail-blood {
    color: #a9001f !important;

    font-size: 19px !important;
}

.status-available {
    color: #079455 !important;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 1100px) {

    .donor-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .details-content {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 750px) {

    .donor-stats {
        grid-template-columns: 1fr;
    }

    .donor-toolbar {
        flex-direction: column;
        align-items: stretch;
    }

    .donor-search {
        width: 100%;
    }

    .donor-filter {
        width: 100%;
    }

    .donor-card-header {
        align-items: flex-start;
        gap: 10px;
    }

    .details-content {
        grid-template-columns: 1fr;
    }

    .detail-item {
        padding: 15px 0 0;

        border-left: none;
        border-top: 1px solid #eaecf0;
    }

}


@media (max-width: 500px) {

    .page-title h1 {
        font-size: 22px;
    }

    .donor-pagination {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

}

</style>

@endsection