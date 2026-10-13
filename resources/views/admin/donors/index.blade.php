@extends('admin.layouts.app')

@section('title', 'Donor Management')

@section('content')
<div class="donor-page">

    {{-- PAGE HEADER --}}
    <div class="page-header donor-header">
        <div class="page-title">
            <div class="title-icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <div>
                <h1>Donor Management</h1>
                <p>Manage registered blood donors and their information.</p>
            </div>
        </div>

        <a href="{{ route('admin.donors.create') }}" class="add-donor-button">
            <i class="bi bi-person-plus-fill"></i>
            Add Donor
        </a>
    </div>

    {{-- STATISTICS --}}
    <div class="donor-stats">
        <div class="donor-stat-card">
            <div class="stat-icon red">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-label">Total Donors</div>
                <div class="stat-number">
                    {{ $totalDonors ?? $donors->total() }}
                </div>
                <div class="stat-info">Registered donors</div>
            </div>
        </div>

        <div class="donor-stat-card">
            <div class="stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="stat-label">Active Donors</div>
                <div class="stat-number">
                    {{ $activeDonors ?? $donors->getCollection()->where('is_active', true)->count() }}
                </div>
                <div class="stat-info">Currently active</div>
            </div>
        </div>

        <div class="donor-stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-pause-circle-fill"></i>
            </div>
            <div>
                <div class="stat-label">Inactive Donors</div>
                <div class="stat-number">
                    {{ $inactiveDonors ?? $donors->getCollection()->where('is_active', false)->count() }}
                </div>
                <div class="stat-info orange-text">Currently inactive</div>
            </div>
        </div>

        <div class="donor-stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-droplet-fill"></i>
            </div>
            <div>
                <div class="stat-label">Blood Types</div>
                <div class="stat-number">
                    {{ $donors->getCollection()->pluck('blood_type')->unique()->count() }}
                </div>
                <div class="stat-info purple-text">Types on this page</div>
            </div>
        </div>
    </div>

    {{-- DONOR LIST --}}
    <div class="donor-card">

        <div class="donor-card-header">
            <div>
                <h2>All Donors</h2>
                <p>View and manage registered blood donors.</p>
            </div>
            <span class="donor-count">
                {{ $donors->total() }} Donors
            </span>
        </div>

        {{-- SEARCH AND FILTER --}}
        <form method="GET"
              action="{{ route('admin.donors') }}"
              class="donor-toolbar">

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

            <select name="blood_type" class="donor-filter">
                <option value="">All Blood Types</option>

                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                    <option value="{{ $type }}"
                        @selected(request('blood_type') === $type)>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="donor-filter">
                <option value="">All Status</option>
                <option value="active"
                    @selected(request('status') === 'active')>
                    Active
                </option>
                <option value="inactive"
                    @selected(request('status') === 'inactive')>
                    Inactive
                </option>
            </select>

            <button type="submit" class="donor-search-button">
                <i class="bi bi-search"></i>
                Search
            </button>

            @if(request()->hasAny(['search', 'blood_type', 'status']))
                <a href="{{ route('admin.donors') }}"
                   class="donor-clear-button">
                    Clear
                </a>
            @endif
        </form>

        {{-- DONOR TABLE --}}
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
                        <th class="actions-heading">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($donors as $donor)

                        @php
                            $donorName = $donor->user->name
                                ?? $donor->name
                                ?? 'Unknown User';

                            $donorEmail = $donor->user->email
                                ?? $donor->email
                                ?? 'No email';

                            $donorPhone = $donor->phone
                                ?? $donor->user->contact_number
                                ?? $donor->user->phone
                                ?? 'N/A';

                            $donorAddress = $donor->address
                                ?? $donor->user->address
                                ?? 'N/A';

                            $isActive = (bool) ($donor->is_active ?? false);
                        @endphp

                        <tr>

                            {{-- DONOR --}}
                            <td>
                                <div class="donor-profile">
                                    <div class="donor-avatar">
                                        {{ strtoupper(substr($donorName, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="donor-name">
                                            {{ $donorName }}
                                        </div>
                                        <div class="donor-email">
                                            {{ $donorEmail }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- BLOOD TYPE --}}
                            <td>
                                <span class="blood-badge">
                                    {{ $donor->blood_type ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- PHONE --}}
                            <td class="contact-cell">
                                @if($donorPhone !== 'N/A')
                                    <i class="bi bi-telephone"></i>
                                    {{ $donorPhone }}
                                @else
                                    <span class="muted-value">N/A</span>
                                @endif
                            </td>

                            {{-- ADDRESS --}}
                            <td class="address-cell">
                                @if($donorAddress !== 'N/A')
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $donorAddress }}
                                @else
                                    <span class="muted-value">N/A</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($isActive)
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

                            {{-- REGISTERED --}}
                            <td>
                                {{ $donor->created_at?->format('M d, Y') ?? 'N/A' }}
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="donor-actions">

                                    {{-- VIEW --}}
                                    <a
                                        href="{{ route('admin.donors.show', $donor) }}"
                                        class="action-button view"
                                        title="View donor"
                                        aria-label="View donor"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.donors.edit', $donor) }}"
                                        class="action-button edit"
                                        title="Edit donor"
                                        aria-label="Edit donor"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.donors.destroy', $donor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this donor? This action cannot be undone.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-button delete"
                                            title="Delete donor"
                                            aria-label="Delete donor"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="empty-cell">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-person-x"></i>
                                    </div>
                                    <strong>No donors found</strong>
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

        {{-- PAGINATION --}}
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

                <div class="pagination-links">
                    {{ $donors->withQueryString()->links() }}
                </div>
            </div>
        @endif

    </div>
</div>

<style>
/* MAIN PAGE */
.donor-page {
    width: 100%;
    padding-bottom: 30px;
    color: #172033;
}

/* HEADER */
.donor-page .donor-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}

.donor-page .page-title {
    display: flex;
    align-items: center;
    gap: 16px;
}

.donor-page .title-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 56px;
    height: 56px;
    background: #fff0f2;
    color: #a9001f;
    border-radius: 14px;
    font-size: 24px;
}

.donor-page .page-title h1 {
    margin: 0;
    font-size: 28px;
    line-height: 1.3;
    font-weight: 700;
    color: #172033;
}

.donor-page .page-title p {
    margin: 5px 0 0;
    font-size: 13px;
    color: #718096;
}

.donor-page .add-donor-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    background: #a80d24;
    color: #fff;
    border: 1px solid #a80d24;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: .2s;
}

.donor-page .add-donor-button:hover {
    background: #85091b;
    color: #fff;
}

/* STATISTICS */
.donor-page .donor-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 22px;
}

.donor-page .donor-stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 21px;
    background: #fff;
    border: 1px solid #e7eaf0;
    border-radius: 14px;
    box-shadow: 0 3px 12px rgba(0,0,0,.035);
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

/* DONOR CARD */
.donor-page .donor-card {
    background: #fff;
    border: 1px solid #e7eaf0;
    border-radius: 16px;
    box-shadow: 0 3px 12px rgba(0,0,0,.035);
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
    white-space: nowrap;
}

/* SEARCH AND FILTERS */
.donor-page .donor-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 18px 24px;
    background: #fff;
    border-bottom: 1px solid #eef0f4;
}

.donor-page .donor-search {
    position: relative;
    flex: 1;
    min-width: 220px;
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
    background: #fff;
    border: 1px solid #d9dee7;
    border-radius: 8px;
    color: #344054;
    font-size: 13px;
    outline: none;
}

.donor-page .donor-search input:focus,
.donor-page .donor-filter:focus {
    border-color: #a9001f;
    box-shadow: 0 0 0 3px rgba(169,0,31,.07);
}

.donor-page .donor-filter {
    width: 165px;
    height: 42px;
    padding: 0 12px;
    background: #fff;
    border: 1px solid #d9dee7;
    border-radius: 8px;
    color: #475467;
    font-size: 13px;
    outline: none;
    cursor: pointer;
}

.donor-page .donor-search-button,
.donor-page .donor-clear-button {
    height: 42px;
    padding: 0 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border: 1px solid #a9001f;
    border-radius: 8px;
    background: #a9001f;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
}

.donor-page .donor-search-button:hover {
    background: #8f001a;
}

.donor-page .donor-clear-button {
    border-color: #d9dee7;
    background: #fff;
    color: #475467;
}

/* TABLE */
.donor-page .table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.donor-page .donor-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: collapse;
}

.donor-page .donor-table th {
    padding: 13px 16px;
    background: #f8f9fb;
    color: #667085;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .5px;
    white-space: nowrap;
}

.donor-page .donor-table td {
    padding: 15px 16px;
    border-bottom: 1px solid #eef0f4;
    color: #475467;
    font-size: 13px;
    vertical-align: middle;
}

.donor-page .donor-table tbody tr {
    transition: background .15s;
}

.donor-page .donor-table tbody tr:hover {
    background: #fcfcfd;
}

/* DONOR PROFILE */
.donor-page .donor-profile {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 190px;
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

/* BLOOD TYPE */
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

/* PHONE AND ADDRESS */
.donor-page .contact-cell,
.donor-page .address-cell {
    min-width: 130px;
    max-width: 220px;
    overflow-wrap: anywhere;
}

.donor-page .contact-cell i,
.donor-page .address-cell i {
    color: #98a2b3;
    margin-right: 4px;
}

.donor-page .muted-value {
    color: #98a2b3;
}

/* STATUS */
.donor-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
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

/* VIEW, EDIT, DELETE BUTTONS */
.donor-page .actions-heading {
    text-align: center;
}

.donor-page .donor-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    white-space: nowrap;
}

.donor-page .donor-actions form {
    display: inline-flex;
    margin: 0;
}

.donor-page .action-button {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    transition: .18s;
}

.donor-page .action-button.view {
    background: #eff8ff;
    color: #1570ef;
    border-color: #d1e9ff;
}

.donor-page .action-button.view:hover {
    background: #d1e9ff;
}

.donor-page .action-button.edit {
    background: #ecfdf3;
    color: #027a48;
    border-color: #abefc6;
}

.donor-page .action-button.edit:hover {
    background: #d1fadf;
}

.donor-page .action-button.delete {
    background: #fff1f0;
    color: #d92d20;
    border-color: #fecdca;
}

.donor-page .action-button.delete:hover {
    background: #fee4e2;
}

/* EMPTY STATE */
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

/* PAGINATION */
.donor-page .donor-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
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
    background: #fff;
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
    color: #fff;
}

/* RESPONSIVE */
@media (max-width: 1100px) {
    .donor-page .donor-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
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

    .donor-page .donor-search,
    .donor-page .donor-filter,
    .donor-page .donor-search-button,
    .donor-page .donor-clear-button {
        width: 100%;
        box-sizing: border-box;
    }

    .donor-page .donor-card-header {
        align-items: flex-start;
        gap: 10px;
    }

    .donor-page .donor-pagination {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 500px) {
    .donor-page .donor-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .donor-page .page-title h1 {
        font-size: 22px;
    }

    .donor-page .page-title p {
        font-size: 12px;
    }
}
</style>
@endsection