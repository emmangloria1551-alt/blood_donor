@extends('admin.layouts.app')

@section('title', 'Donation Centers')

@section('content')

<div class="centers-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1 class="page-title">
                <i class="bi bi-hospital-fill"></i>
                Donation Centers
            </h1>

            <p class="page-subtitle">
                Manage and monitor all blood donation centers.
            </p>
        </div>

        <a href="{{ route('admin.centers.create') }}" class="add-center-btn">
            <i class="bi bi-plus-lg"></i>
            Add Center
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success-alert">
            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>
        </div>
    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="error-alert">

            <div class="error-title">
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following errors:
            </div>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- STATISTICS --}}
    <div class="stats-grid">

        {{-- TOTAL --}}
        <div class="stat-card">

            <div class="stat-icon total-icon">
                <i class="bi bi-hospital"></i>
            </div>

            <div>
                <div class="stat-label">
                    Total Centers
                </div>

                <div class="stat-number">
                    {{ $totalCenters }}
                </div>
            </div>

        </div>


        {{-- OPEN --}}
        <div class="stat-card">

            <div class="stat-icon open-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div>
                <div class="stat-label">
                    Open Centers
                </div>

                <div class="stat-number">
                    {{ $openCenters }}
                </div>
            </div>

        </div>


        {{-- CLOSED --}}
        <div class="stat-card">

            <div class="stat-icon closed-icon">
                <i class="bi bi-x-circle"></i>
            </div>

            <div>
                <div class="stat-label">
                    Closed Centers
                </div>

                <div class="stat-number">
                    {{ $closedCenters }}
                </div>
            </div>

        </div>

    </div>


    {{-- SEARCH AND FILTER --}}
    <div class="filter-card">

        <form
            action="{{ route('admin.centers') }}"
            method="GET"
            class="filter-form"
        >

            {{-- SEARCH --}}
            <div class="search-wrapper">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search centers by name, location, or contact..."
                >

            </div>


            {{-- STATUS --}}
            <div class="select-wrapper">

                <select name="status">

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="open"
                        {{ request('status') === 'open' ? 'selected' : '' }}
                    >
                        Open
                    </option>

                    <option
                        value="closed"
                        {{ request('status') === 'closed' ? 'selected' : '' }}
                    >
                        Closed
                    </option>

                </select>

            </div>


            {{-- SEARCH BUTTON --}}
            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i>
                Search
            </button>


            {{-- RESET --}}
            @if(request()->filled('search') || request()->filled('status'))

                <a
                    href="{{ route('admin.centers') }}"
                    class="reset-btn"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>

            @endif

        </form>

    </div>


    {{-- CENTERS TABLE --}}
    <div class="table-card">

        <div class="table-header">

            <div>
                <h2>
                    Donation Center List
                </h2>

                <p>
                    {{ $centers->total() }}
                    {{ $centers->total() === 1 ? 'center' : 'centers' }}
                    found
                </p>
            </div>

        </div>


        @if($centers->count() > 0)

            <div class="table-responsive">

                <table class="centers-table">

                    <thead>

                        <tr>

                            <th>
                                Center
                            </th>

                            <th>
                                Location
                            </th>

                            <th>
                                Contact
                            </th>

                            <th>
                                Operating Hours
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($centers as $center)

                            <tr>

                                {{-- CENTER --}}
                                <td>

                                    <div class="center-info">

                                        <div class="center-avatar">
                                            <i class="bi bi-hospital-fill"></i>
                                        </div>

                                        <div>

                                            <div class="center-name">
                                                {{ $center->name }}
                                            </div>

                                            @if($center->description)

                                                <div class="center-description">
                                                    {{ \Illuminate\Support\Str::limit($center->description, 50) }}
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- LOCATION --}}
                                <td>

                                    <div class="location-info">

                                        <i class="bi bi-geo-alt-fill"></i>

                                        <span>
                                            {{ $center->location }}
                                        </span>

                                    </div>

                                </td>


                                {{-- CONTACT --}}
                                <td>

                                    @if($center->contact_number)

                                        <div class="contact-info">

                                            <i class="bi bi-telephone-fill"></i>

                                            <span>
                                                {{ $center->contact_number }}
                                            </span>

                                        </div>

                                    @else

                                        <span class="not-provided">
                                            Not provided
                                        </span>

                                    @endif

                                </td>


                                {{-- HOURS --}}
                                <td>

                                    @if($center->opening_time && $center->closing_time)

                                        <div class="hours-info">

                                            <i class="bi bi-clock-fill"></i>

                                            <span>
                                                {{ \Carbon\Carbon::parse($center->opening_time)->format('h:i A') }}
                                                -
                                                {{ \Carbon\Carbon::parse($center->closing_time)->format('h:i A') }}
                                            </span>

                                        </div>

                                    @else

                                        <span class="not-provided">
                                            Not provided
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($center->status === 'open')

                                        <span class="status-badge status-open">

                                            <i class="bi bi-check-circle-fill"></i>

                                            Open

                                        </span>

                                    @else

                                        <span class="status-badge status-closed">

                                            <i class="bi bi-x-circle-fill"></i>

                                            Closed

                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="action-buttons">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('admin.centers.show', $center) }}"
                                            class="action-btn view-btn"
                                            title="View Center"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.centers.edit', $center) }}"
                                            class="action-btn edit-btn"
                                            title="Edit Center"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('admin.centers.destroy', $center) }}"
                                            method="POST"
                                            class="delete-form"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $center->name }}?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Delete Center"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($centers->hasPages())

                <div class="pagination-wrapper">

                    {{ $centers->links() }}

                </div>

            @endif


        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-hospital"></i>
                </div>

                <h3>
                    No Donation Centers Found
                </h3>

                <p>
                    There are currently no donation centers matching your search.
                </p>

                @if(request()->filled('search') || request()->filled('status'))

                    <a
                        href="{{ route('admin.centers') }}"
                        class="empty-reset-btn"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Clear Filters
                    </a>

                @else

                    <a
                        href="{{ route('admin.centers.create') }}"
                        class="empty-add-btn"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Add Donation Center
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>


<style>

/* =========================================
   DONATION CENTERS PAGE
========================================= */

.centers-page {
    width: 100%;
}


/* =========================================
   PAGE HEADER
========================================= */

.centers-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.centers-page .page-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.centers-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.centers-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}


/* =========================================
   ADD CENTER BUTTON
========================================= */

.centers-page .add-center-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 11px 17px;
    border-radius: 8px;
    background: #dc3545;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: 0.2s ease;
}

.centers-page .add-center-btn:hover {
    background: #bb2d3b;
    color: #fff;
}


/* =========================================
   ALERTS
========================================= */

.centers-page .success-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 16px;
    margin-bottom: 20px;
    border-radius: 9px;
    background: #eaf7ef;
    border: 1px solid #b7e4c7;
    color: #146c43;
    font-size: 14px;
    font-weight: 500;
}

.centers-page .success-alert i {
    font-size: 17px;
}

.centers-page .error-alert {
    margin-bottom: 20px;
    padding: 15px 18px;
    border-radius: 9px;
    background: #fff0f1;
    border: 1px solid #f5c2c7;
    color: #842029;
}

.centers-page .error-title {
    font-weight: 700;
    margin-bottom: 8px;
}

.centers-page .error-title i {
    margin-right: 5px;
}

.centers-page .error-alert ul {
    margin: 0;
    padding-left: 20px;
}


/* =========================================
   STATISTICS
========================================= */

.centers-page .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 22px;
}

.centers-page .stat-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
}

.centers-page .stat-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 20px;
}

.centers-page .total-icon {
    background: #f1f3f5;
    color: #495057;
}

.centers-page .open-icon {
    background: #e8f7ee;
    color: #198754;
}

.centers-page .closed-icon {
    background: #fff0f1;
    color: #dc3545;
}

.centers-page .stat-label {
    margin-bottom: 3px;
    color: #777;
    font-size: 13px;
}

.centers-page .stat-number {
    color: #222;
    font-size: 24px;
    font-weight: 700;
}


/* =========================================
   FILTER
========================================= */

.centers-page .filter-card {
    margin-bottom: 22px;
    padding: 18px;
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
}

.centers-page .filter-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.centers-page .search-wrapper {
    position: relative;
    flex: 1;
}

.centers-page .search-wrapper i {
    position: absolute;
    top: 50%;
    left: 13px;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
}

.centers-page .search-wrapper input {
    width: 100%;
    height: 42px;
    padding: 0 14px 0 38px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    color: #333;
    font-size: 14px;
    box-sizing: border-box;
}

.centers-page .search-wrapper input:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08);
}

.centers-page .select-wrapper select {
    height: 42px;
    min-width: 145px;
    padding: 0 35px 0 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fff;
    color: #333;
    outline: none;
    font-size: 14px;
}

.centers-page .select-wrapper select:focus {
    border-color: #dc3545;
}

.centers-page .search-btn,
.centers-page .reset-btn {
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 0 15px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    text-decoration: none;
    cursor: pointer;
}

.centers-page .search-btn {
    border: none;
    background: #dc3545;
    color: #fff;
}

.centers-page .search-btn:hover {
    background: #bb2d3b;
}

.centers-page .reset-btn {
    background: #f1f1f1;
    color: #444;
}

.centers-page .reset-btn:hover {
    background: #e2e2e2;
    color: #222;
}


/* =========================================
   TABLE CARD
========================================= */

.centers-page .table-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.centers-page .table-header {
    padding: 20px 22px;
    border-bottom: 1px solid #eee;
}

.centers-page .table-header h2 {
    margin: 0;
    color: #222;
    font-size: 17px;
    font-weight: 700;
}

.centers-page .table-header p {
    margin: 5px 0 0;
    color: #888;
    font-size: 13px;
}


/* =========================================
   TABLE
========================================= */

.centers-page .table-responsive {
    width: 100%;
    overflow-x: auto;
}

.centers-page .centers-table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}

.centers-page .centers-table th {
    padding: 13px 18px;
    background: #fafafa;
    border-bottom: 1px solid #eee;
    color: #666;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    white-space: nowrap;
}

.centers-page .centers-table td {
    padding: 16px 18px;
    border-bottom: 1px solid #f0f0f0;
    color: #444;
    font-size: 14px;
    vertical-align: middle;
}

.centers-page .centers-table tbody tr:last-child td {
    border-bottom: none;
}

.centers-page .centers-table tbody tr:hover {
    background: #fcfcfc;
}


/* =========================================
   CENTER INFORMATION
========================================= */

.centers-page .center-info {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 200px;
}

.centers-page .center-avatar {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #fff0f1;
    color: #dc3545;
    font-size: 17px;
}

.centers-page .center-name {
    color: #222;
    font-weight: 700;
}

.centers-page .center-description {
    max-width: 180px;
    margin-top: 3px;
    color: #999;
    font-size: 12px;
}


/* =========================================
   LOCATION
========================================= */

.centers-page .location-info,
.centers-page .contact-info,
.centers-page .hours-info {
    display: flex;
    align-items: center;
    gap: 7px;
}

.centers-page .location-info i,
.centers-page .contact-info i,
.centers-page .hours-info i {
    color: #dc3545;
    font-size: 13px;
}

.centers-page .location-info span,
.centers-page .contact-info span,
.centers-page .hours-info span {
    white-space: nowrap;
}

.centers-page .not-provided {
    color: #999;
    font-size: 13px;
}


/* =========================================
   STATUS
========================================= */

.centers-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.centers-page .status-open {
    background: #e8f7ee;
    color: #198754;
}

.centers-page .status-closed {
    background: #fff0f1;
    color: #dc3545;
}


/* =========================================
   ACTION BUTTONS
========================================= */

.centers-page .action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
}

.centers-page .delete-form {
    display: inline;
    margin: 0;
    padding: 0;
}

.centers-page .action-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border-radius: 7px;
    border: 1px solid #e5e5e5;
    background: #fff;
    text-decoration: none;
    cursor: pointer;
    font-size: 14px;
    transition: 0.2s ease;
}

.centers-page .view-btn {
    color: #0d6efd;
}

.centers-page .view-btn:hover {
    background: #eaf2ff;
    border-color: #0d6efd;
}

.centers-page .edit-btn {
    color: #dc3545;
}

.centers-page .edit-btn:hover {
    background: #fff0f1;
    border-color: #dc3545;
}

.centers-page .delete-btn {
    color: #dc3545;
}

.centers-page .delete-btn:hover {
    background: #dc3545;
    color: #fff;
    border-color: #dc3545;
}


/* =========================================
   PAGINATION
========================================= */

.centers-page .pagination-wrapper {
    display: flex;
    justify-content: flex-end;
    padding: 18px 22px;
    border-top: 1px solid #eee;
}

.centers-page .pagination-wrapper nav {
    margin: 0;
}


/* =========================================
   EMPTY STATE
========================================= */

.centers-page .empty-state {
    padding: 60px 25px;
    text-align: center;
}

.centers-page .empty-icon {
    width: 65px;
    height: 65px;
    margin: 0 auto 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff0f1;
    color: #dc3545;
    font-size: 26px;
}

.centers-page .empty-state h3 {
    margin: 0 0 7px;
    color: #333;
    font-size: 18px;
}

.centers-page .empty-state p {
    margin: 0 0 18px;
    color: #888;
    font-size: 14px;
}

.centers-page .empty-add-btn,
.centers-page .empty-reset-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.centers-page .empty-add-btn {
    background: #dc3545;
    color: #fff;
}

.centers-page .empty-add-btn:hover {
    background: #bb2d3b;
    color: #fff;
}

.centers-page .empty-reset-btn {
    background: #f1f1f1;
    color: #444;
}

.centers-page .empty-reset-btn:hover {
    background: #e2e2e2;
    color: #222;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 900px) {

    .centers-page .stats-grid {
        grid-template-columns: 1fr;
    }

    .centers-page .filter-form {
        flex-wrap: wrap;
    }

    .centers-page .search-wrapper {
        flex: 1 1 100%;
    }

}


@media (max-width: 650px) {

    .centers-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .centers-page .add-center-btn {
        width: 100%;
        justify-content: center;
    }

    .centers-page .filter-form {
        flex-direction: column;
        align-items: stretch;
    }

    .centers-page .search-wrapper,
    .centers-page .select-wrapper,
    .centers-page .search-btn,
    .centers-page .reset-btn {
        width: 100%;
    }

    .centers-page .select-wrapper select {
        width: 100%;
    }

    .centers-page .search-btn,
    .centers-page .reset-btn {
        justify-content: center;
    }

}

</style>

@endsection