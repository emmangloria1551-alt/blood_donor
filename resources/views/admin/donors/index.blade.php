@extends('admin.layouts.app')

@section('content')

<div class="donor-page">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="page-title">
            <div class="title-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>

            <div>
                <h1>Donor Management</h1>
                <p>Manage registered blood donors and their information.</p>
            </div>
        </div>

    </div>


    <!-- STATISTICS -->
    <div class="donor-stats">

        <!-- TOTAL DONORS -->
        <div class="donor-stat-card">

            <div class="stat-icon red">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="stat-label">Total Donors</div>

                <div class="stat-number">
                    {{ $totalDonors }}
                </div>

                <div class="stat-info">
                    <i class="bi bi-database"></i>
                    Registered donors
                </div>
            </div>

        </div>


        <!-- ACTIVE DONORS -->
        <div class="donor-stat-card">

            <div class="stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <div class="stat-label">Active Donors</div>

                <div class="stat-number">
                    {{ $activeDonors }}
                </div>

                <div class="stat-info">
                    <i class="bi bi-check-circle"></i>
                    Currently active
                </div>
            </div>

        </div>


        <!-- INACTIVE DONORS -->
        <div class="donor-stat-card">

            <div class="stat-icon orange">
                <i class="bi bi-pause-circle-fill"></i>
            </div>

            <div>
                <div class="stat-label">Inactive Donors</div>

                <div class="stat-number">
                    {{ $inactiveDonors }}
                </div>

                <div class="stat-info orange-text">
                    <i class="bi bi-exclamation-circle"></i>
                    Currently inactive
                </div>
            </div>

        </div>


        <!-- TOTAL BLOOD TYPES -->
        <div class="donor-stat-card">

            <div class="stat-icon purple">
                <i class="bi bi-droplet-fill"></i>
            </div>

            <div>
                <div class="stat-label">Blood Types</div>

                <div class="stat-number">
                    {{ $donors->pluck('blood_type')->unique()->count() }}
                </div>

                <div class="stat-info purple-text">
                    <i class="bi bi-droplet"></i>
                    Registered types
                </div>
            </div>

        </div>

    </div>


    <!-- DONOR LIST -->
    <div class="donor-card">

        <!-- CARD HEADER -->
        <div class="donor-card-header">

            <div>
                <h2>All Donors</h2>

                <p>
                    View and manage registered blood donors.
                </p>
            </div>

            <span class="donor-count">
                {{ $donors->total() }} Donors
            </span>

        </div>


        <!-- SEARCH AND FILTER -->
        <form
            method="GET"
            action="{{ route('admin.donors') }}"
            class="donor-toolbar"
        >

            <!-- SEARCH -->
            <div class="donor-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search donor by name or email..."
                    autocomplete="off"
                >

            </div>


            <!-- BLOOD TYPE -->
            <select
                name="blood_type"
                class="donor-filter"
            >

                <option value="">
                    All Blood Types
                </option>

                <option value="A+" {{ request('blood_type') == 'A+' ? 'selected' : '' }}>
                    A+
                </option>

                <option value="A-" {{ request('blood_type') == 'A-' ? 'selected' : '' }}>
                    A-
                </option>

                <option value="B+" {{ request('blood_type') == 'B+' ? 'selected' : '' }}>
                    B+
                </option>

                <option value="B-" {{ request('blood_type') == 'B-' ? 'selected' : '' }}>
                    B-
                </option>

                <option value="AB+" {{ request('blood_type') == 'AB+' ? 'selected' : '' }}>
                    AB+
                </option>

                <option value="AB-" {{ request('blood_type') == 'AB-' ? 'selected' : '' }}>
                    AB-
                </option>

                <option value="O+" {{ request('blood_type') == 'O+' ? 'selected' : '' }}>
                    O+
                </option>

                <option value="O-" {{ request('blood_type') == 'O-' ? 'selected' : '' }}>
                    O-
                </option>

            </select>


            <!-- STATUS -->
            <select
                name="status"
                class="donor-filter"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="active"
                    {{ request('status') == 'active' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="inactive"
                    {{ request('status') == 'inactive' ? 'selected' : '' }}
                >
                    Inactive
                </option>

            </select>


            <!-- SEARCH BUTTON -->
            <button
                type="submit"
                class="donor-search-button"
            >
                <i class="bi bi-search"></i>
                Search
            </button>


            <!-- CLEAR -->
            @if(request()->hasAny(['search', 'blood_type', 'status']))

                <a
                    href="{{ route('admin.donors') }}"
                    class="donor-clear-button"
                >
                    Clear
                </a>

            @endif

        </form>


        <!-- TABLE -->
        <div class="table-wrapper">

            <table class="donor-table">

                <thead>

                    <tr>
                        <th>DONOR</th>
                        <th>BLOOD TYPE</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>STATUS</th>
                        <th>REGISTERED</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($donors as $donor)

                        <tr>

                            <!-- DONOR -->
                            <td>

                                <div class="donor-profile">

                                    <div class="donor-avatar">

                                        {{
                                            strtoupper(
                                                substr(
                                                    $donor->user->name ?? 'U',
                                                    0,
                                                    1
                                                )
                                            )
                                        }}

                                    </div>

                                    <div>

                                        <div class="donor-name">
                                            {{ $donor->user->name ?? 'Unknown User' }}
                                        </div>

                                        <div class="donor-email">
                                            {{ $donor->user->email ?? 'No email' }}
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


                            <!-- PHONE -->
                            <td>
                                {{ $donor->phone ?? 'N/A' }}
                            </td>


                            <!-- ADDRESS -->
                            <td>
                                {{ $donor->address ?? 'N/A' }}
                            </td>


                            <!-- STATUS -->
                            <td>

                                @if($donor->is_active)

                                    <span class="status-badge active">
                                        <span></span>
                                        Active
                                    </span>

                                @else

                                    <span class="status-badge inactive">
                                        <span></span>
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <!-- REGISTERED -->
                            <td>

                                {{ $donor->created_at?->format('M d, Y') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-cell"
                            >

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-person-x"></i>
                                    </div>

                                    <strong>
                                        No donors found
                                    </strong>

                                    <p>
                                        Try changing your search or filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->
        @if($donors->hasPages())

            <div class="donor-pagination">

                <div class="pagination-info">

                    Showing
                    <strong>{{ $donors->firstItem() }}</strong>
                    to
                    <strong>{{ $donors->lastItem() }}</strong>
                    of
                    <strong>{{ $donors->total() }}</strong>
                    donors

                </div>

                <div class="pagination-links">

                    {{ $donors->withQueryString()->links() }}

                </div>

            </div>

        @else

            @if($donors->total() > 0)

                <div class="donor-pagination">

                    <div class="pagination-info">

                        Showing
                        <strong>{{ $donors->firstItem() }}</strong>
                        to
                        <strong>{{ $donors->lastItem() }}</strong>
                        of
                        <strong>{{ $donors->total() }}</strong>
                        donors

                    </div>

                </div>

            @endif

        @endif

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

.donor-page .page-header {
    margin-bottom: 25px;
}

.donor-page .page-title {
    display: flex;
    align-items: center;
    gap: 14px;
}

.donor-page .title-icon {
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

.donor-page .page-title h1 {
    margin: 0;

    color: #172033;

    font-size: 27px;
    font-weight: 700;
}

.donor-page .page-title p {
    margin: 5px 0 0;

    color: #718096;

    font-size: 13px;
}


/* =========================================
   STATISTICS
========================================= */

.donor-page .donor-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;

    margin-bottom: 22px;
}

.donor-page .donor-stat-card {
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

.donor-page .donor-stat-card:hover {
    transform: translateY(-2px);

    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
}

.donor-page .stat-icon {
    width: 50px;
    height: 50px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    font-size: 21px;
}

.donor-page .stat-icon.red {
    background: #fff0f2;
    color: #c00024;
}

.donor-page .stat-icon.green {
    background: #ecfdf3;
    color: #079455;
}

.donor-page .stat-icon.orange {
    background: #fff7ed;
    color: #ea580c;
}

.donor-page .stat-icon.purple {
    background: #f5f3ff;
    color: #7c3aed;
}

.donor-page .stat-label {
    color: #718096;
    font-size: 12px;
    margin-bottom: 3px;
}

.donor-page .stat-number {
    color: #101828;
    font-size: 26px;
    font-weight: 700;
}

.donor-page .stat-info {
    margin-top: 3px;

    color: #079455;

    font-size: 11px;
    font-weight: 500;
}

.donor-page .orange-text {
    color: #ea580c;
}

.donor-page .purple-text {
    color: #7c3aed;
}


/* =========================================
   DONOR CARD
========================================= */

.donor-page .donor-card {
    background: #ffffff;

    border: 1px solid #e7eaf0;
    border-radius: 16px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.035);

    overflow: hidden;
}

.donor-page .donor-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 22px 24px;

    border-bottom: 1px solid #eef0f4;
}

.donor-page .donor-card-header h2 {
    margin: 0;

    color: #172033;

    font-size: 18px;
    font-weight: 700;
}

.donor-page .donor-card-header p {
    margin: 5px 0 0;

    color: #718096;

    font-size: 12px;
}

.donor-page .donor-count {
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

.donor-page .donor-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 18px 24px;

    background: #ffffff;

    border-bottom: 1px solid #eef0f4;
}

.donor-page .donor-search {
    position: relative;

    width: 350px;
}

.donor-page .donor-search i {
    position: absolute;

    left: 13px;
    top: 50%;

    transform: translateY(-50%);

    color: #98a2b3;

    font-size: 14px;

    pointer-events: none;
}

.donor-page .donor-search input {
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

.donor-page .donor-search input::placeholder {
    color: #98a2b3;
}

.donor-page .donor-search input:focus {
    border-color: #a9001f;

    box-shadow: 0 0 0 3px rgba(169, 0, 31, 0.07);
}

.donor-page .donor-filter {
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

.donor-page .donor-filter:focus {
    border-color: #a9001f;

    box-shadow: 0 0 0 3px rgba(169, 0, 31, 0.07);
}


/* SEARCH BUTTON */

.donor-page .donor-search-button {
    height: 42px;

    padding: 0 17px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border: 1px solid #a9001f;
    border-radius: 8px;

    background: #a9001f;
    color: #ffffff;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s;
}

.donor-page .donor-search-button:hover {
    background: #8f001a;
    border-color: #8f001a;
}


/* CLEAR BUTTON */

.donor-page .donor-clear-button {
    height: 42px;

    padding: 0 14px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #d9dee7;
    border-radius: 8px;

    background: #ffffff;
    color: #475467;

    font-size: 13px;
    font-weight: 500;

    text-decoration: none;
}

.donor-page .donor-clear-button:hover {
    background: #f8f9fb;
    color: #344054;
}


/* =========================================
   TABLE
========================================= */

.donor-page .table-wrapper {
    width: 100%;

    overflow-x: auto;
}

.donor-page .donor-table {
    width: 100%;

    border-collapse: collapse;
}

.donor-page .donor-table th {
    padding: 13px 20px;

    background: #f8f9fb;

    color: #667085;

    text-align: left;

    font-size: 10px;
    font-weight: 700;

    letter-spacing: 0.5px;

    white-space: nowrap;
}

.donor-page .donor-table td {
    padding: 15px 20px;

    border-bottom: 1px solid #eef0f4;

    color: #475467;

    font-size: 13px;

    vertical-align: middle;
}

.donor-page .donor-table tbody tr {
    transition: 0.15s;
}

.donor-page .donor-table tbody tr:hover {
    background: #fcfcfd;
}


/* =========================================
   DONOR PROFILE
========================================= */

.donor-page .donor-profile {
    display: flex;
    align-items: center;

    gap: 11px;
}

.donor-page .donor-avatar {
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

.donor-page .donor-name {
    color: #172033;

    font-size: 13px;
    font-weight: 600;
}

.donor-page .donor-email {
    margin-top: 3px;

    color: #98a2b3;

    font-size: 11px;
}


/* =========================================
   BLOOD BADGE
========================================= */

.donor-page .blood-badge {
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
   STATUS
========================================= */

.donor-page .status-badge {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 6px 9px;

    border-radius: 7px;

    font-size: 11px;
    font-weight: 600;
}

.donor-page .status-badge span {
    width: 6px;
    height: 6px;

    border-radius: 50%;
}

.donor-page .status-badge.active {
    background: #ecfdf3;
    color: #079455;
}

.donor-page .status-badge.active span {
    background: #12b76a;
}

.donor-page .status-badge.inactive {
    background: #fff1f0;
    color: #d92d20;
}

.donor-page .status-badge.inactive span {
    background: #f04438;
}


/* =========================================
   EMPTY STATE
========================================= */

.donor-page .empty-cell {
    padding: 0 !important;
}

.donor-page .empty-state {
    padding: 50px 20px;

    text-align: center;
}

.donor-page .empty-icon {
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

.donor-page .empty-state strong {
    color: #344054;

    font-size: 14px;
}

.donor-page .empty-state p {
    margin: 5px 0 0;

    color: #98a2b3;

    font-size: 12px;
}


/* =========================================
   PAGINATION
========================================= */

.donor-page .donor-pagination {
    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 17px 24px;

    color: #667085;

    font-size: 12px;
}

.donor-page .pagination-info strong {
    color: #344054;
}

.donor-page .pagination-links nav {
    display: flex;
}

.donor-page .pagination-links svg {
    width: 18px;
    height: 18px;
}

.donor-page .pagination-links a,
.donor-page .pagination-links span {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 32px;
    height: 32px;

    margin-left: 4px;

    padding: 0 8px;

    border: 1px solid #e4e7ec;
    border-radius: 7px;

    background: #ffffff;

    color: #475467;

    font-size: 12px;

    text-decoration: none;
}

.donor-page .pagination-links a:hover {
    background: #f8f9fb;
}

.donor-page .pagination-links span[aria-current="page"] {
    background: #a9001f;
    border-color: #a9001f;

    color: #ffffff;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 1100px) {

    .donor-page .donor-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .donor-page .donor-toolbar {
        flex-wrap: wrap;
    }

}


@media (max-width: 750px) {

    .donor-page .donor-stats {
        grid-template-columns: 1fr;
    }

    .donor-page .donor-toolbar {
        flex-direction: column;
        align-items: stretch;
    }

    .donor-page .donor-search {
        width: 100%;
    }

    .donor-page .donor-filter {
        width: 100%;
    }

    .donor-page .donor-search-button,
    .donor-page .donor-clear-button {
        width: 100%;
    }

    .donor-page .donor-card-header {
        align-items: flex-start;
        gap: 10px;
    }

    .donor-page .donor-pagination {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

}


@media (max-width: 500px) {

    .donor-page .page-title h1 {
        font-size: 22px;
    }

    .donor-page .page-title p {
        font-size: 12px;
    }

}

</style>

@endsection