@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')

<div class="user-management">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-people-fill"></i>
                User Management
            </h1>

            <p class="page-subtitle">
                Manage and monitor all registered users in the system.
            </p>
        </div>
    </div>


    {{-- SEARCH BAR AT THE TOP --}}
    <form method="GET"
          action="{{ url('/admin/users') }}"
          class="top-search-area">

        {{-- SEARCH --}}
        <div class="top-search-box">
            <i class="bi bi-search"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search users by name or email..."
            >
        </div>


        {{-- BLOOD TYPE --}}
        <div class="top-filter-box">
            <i class="bi bi-droplet-fill"></i>

            <select name="blood_type">
                <option value="">All Blood Types</option>

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
        </div>


        {{-- STATUS --}}
        <div class="top-filter-box">
            <i class="bi bi-funnel-fill"></i>

            <select name="status">
                <option value="">All Status</option>

                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>
                    Blocked
                </option>
            </select>
        </div>


        {{-- SEARCH BUTTON --}}
        <button type="submit" class="btn-search">
            <i class="bi bi-search"></i>
            Search
        </button>


        {{-- CLEAR BUTTON --}}
        @if(request('search') || request('blood_type') || request('status'))

            <a href="{{ url('/admin/users') }}" class="btn-clear">
                <i class="bi bi-x-lg"></i>
                Clear
            </a>

        @endif

    </form>


    {{-- STATISTICS --}}
    <div class="stats-grid">

        {{-- TOTAL USERS --}}
        <div class="stat-card">

            <div class="stat-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-info">
                <span class="stat-label">
                    Total Users
                </span>

                <h2>1,250</h2>

                <small>
                    <i class="bi bi-people"></i>
                    Registered users
                </small>
            </div>

        </div>


        {{-- ACTIVE USERS --}}
        <div class="stat-card">

            <div class="stat-icon green">
                <i class="bi bi-person-check-fill"></i>
            </div>

            <div class="stat-info">
                <span class="stat-label">
                    Active Users
                </span>

                <h2>1,185</h2>

                <small>
                    <i class="bi bi-check-circle"></i>
                    Currently active
                </small>
            </div>

        </div>


        {{-- BLOCKED USERS --}}
        <div class="stat-card">

            <div class="stat-icon red">
                <i class="bi bi-person-x-fill"></i>
            </div>

            <div class="stat-info">
                <span class="stat-label">
                    Blocked Users
                </span>

                <h2>65</h2>

                <small>
                    <i class="bi bi-exclamation-circle"></i>
                    Blocked accounts
                </small>
            </div>

        </div>


        {{-- ADMINS --}}
        <div class="stat-card">

            <div class="stat-icon purple">
                <i class="bi bi-shield-lock-fill"></i>
            </div>

            <div class="stat-info">
                <span class="stat-label">
                    Administrators
                </span>

                <h2>4</h2>

                <small>
                    <i class="bi bi-shield-check"></i>
                    Admin accounts
                </small>
            </div>

        </div>

    </div>


    {{-- USERS CARD --}}
    <div class="users-card">

        {{-- CARD HEADER --}}
        <div class="card-header">

            <div>
                <h2>
                    <i class="bi bi-person-lines-fill"></i>
                    All Users
                </h2>

                <p>
                    View and manage registered users.
                </p>
            </div>

            <div class="user-count">
                1,250 users
            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-wrapper">

            <table class="users-table">

                <thead>
                    <tr>
                        <th>USER</th>
                        <th>EMAIL</th>
                        <th>BLOOD TYPE</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th>REGISTERED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>


                <tbody>

                    {{-- MARIA --}}
                    <tr>

                        <td>
                            <div class="user-info">

                                <div class="avatar">
                                    MS
                                </div>

                                <div>
                                    <strong>Maria Santos</strong>
                                    <span>User ID: #001</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            maria@example.com
                        </td>

                        <td>
                            <span class="blood-badge">
                                A+
                            </span>
                        </td>

                        <td>
                            <span class="role-badge user">
                                User
                            </span>
                        </td>

                        <td>
                            <span class="status-badge active">
                                <span></span>
                                Active
                            </span>
                        </td>

                        <td>
                            Sep 05, 2026
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ url('/admin/users/1') }}"
                                   class="action-btn view"
                                   title="View">

                                    <i class="bi bi-eye-fill"></i>

                                </a>


                                <a href="{{ url('/admin/users/1/edit') }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>


                                <form action="{{ url('/admin/users/1') }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- JUAN --}}
                    <tr>

                        <td>
                            <div class="user-info">

                                <div class="avatar">
                                    JC
                                </div>

                                <div>
                                    <strong>Juan Cruz</strong>
                                    <span>User ID: #002</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            juan@example.com
                        </td>

                        <td>
                            <span class="blood-badge">
                                O+
                            </span>
                        </td>

                        <td>
                            <span class="role-badge user">
                                User
                            </span>
                        </td>

                        <td>
                            <span class="status-badge active">
                                <span></span>
                                Active
                            </span>
                        </td>

                        <td>
                            Sep 04, 2026
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ url('/admin/users/2') }}"
                                   class="action-btn view"
                                   title="View">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ url('/admin/users/2/edit') }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form action="{{ url('/admin/users/2') }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- ANA --}}
                    <tr>

                        <td>
                            <div class="user-info">

                                <div class="avatar">
                                    AR
                                </div>

                                <div>
                                    <strong>Ana Reyes</strong>
                                    <span>User ID: #003</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            ana@example.com
                        </td>

                        <td>
                            <span class="blood-badge">
                                B+
                            </span>
                        </td>

                        <td>
                            <span class="role-badge user">
                                User
                            </span>
                        </td>

                        <td>
                            <span class="status-badge blocked">
                                <span></span>
                                Blocked
                            </span>
                        </td>

                        <td>
                            Sep 02, 2026
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ url('/admin/users/3') }}"
                                   class="action-btn view"
                                   title="View">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ url('/admin/users/3/edit') }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form action="{{ url('/admin/users/3') }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- PEDRO --}}
                    <tr>

                        <td>
                            <div class="user-info">

                                <div class="avatar">
                                    PG
                                </div>

                                <div>
                                    <strong>Pedro Garcia</strong>
                                    <span>User ID: #004</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            pedro@example.com
                        </td>

                        <td>
                            <span class="blood-badge">
                                O-
                            </span>
                        </td>

                        <td>
                            <span class="role-badge user">
                                User
                            </span>
                        </td>

                        <td>
                            <span class="status-badge active">
                                <span></span>
                                Active
                            </span>
                        </td>

                        <td>
                            Sep 01, 2026
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ url('/admin/users/4') }}"
                                   class="action-btn view"
                                   title="View">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ url('/admin/users/4/edit') }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form action="{{ url('/admin/users/4') }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- ANNA --}}
                    <tr>

                        <td>
                            <div class="user-info">

                                <div class="avatar admin-avatar">
                                    AS
                                </div>

                                <div>
                                    <strong>Anna Smith</strong>
                                    <span>User ID: #005</span>
                                </div>

                            </div>
                        </td>

                        <td>
                            anna@example.com
                        </td>

                        <td>
                            <span class="blood-badge">
                                AB+
                            </span>
                        </td>

                        <td>
                            <span class="role-badge admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="status-badge active">
                                <span></span>
                                Active
                            </span>
                        </td>

                        <td>
                            Aug 30, 2026
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ url('/admin/users/5') }}"
                                   class="action-btn view"
                                   title="View">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="{{ url('/admin/users/5/edit') }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form action="{{ url('/admin/users/5') }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="pagination-area">

            <div class="pagination-info">
                Showing <strong>1–5</strong> of
                <strong>1,250</strong> users
            </div>

            <div class="pagination">

                <button class="page-btn disabled">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <button class="page-btn active">
                    1
                </button>

                <button class="page-btn">
                    2
                </button>

                <button class="page-btn">
                    3
                </button>

                <button class="page-btn">
                    4
                </button>

                <button class="page-btn">
                    5
                </button>

                <span class="page-dots">
                    ...
                </span>

                <button class="page-btn">
                    250
                </button>

                <button class="page-btn">
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     PAGE CSS
========================= --}}

<style>

.user-management {
    width: 100%;
    padding: 5px;
}


/* =========================
   PAGE HEADER
========================= */

.user-management .page-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid #eeeeee;
}

.user-management .page-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
    color: #172033;
    font-size: 28px;
    font-weight: 700;
}

.user-management .page-title i {
    color: #dc2626;
    font-size: 27px;
}

.user-management .page-subtitle {
    margin: 7px 0 0;
    color: #718096;
    font-size: 14px;
}


/* =========================
   TOP SEARCH AREA
========================= */

.user-management .top-search-area {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 16px;
    margin-bottom: 22px;

    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
}


/* SEARCH */

.user-management .top-search-box {
    position: relative;
    flex: 1;
}

.user-management .top-search-box i {
    position: absolute;
    left: 15px;
    top: 50%;

    transform: translateY(-50%);

    color: #9aa4b2;
    font-size: 15px;
}

.user-management .top-search-box input {
    width: 100%;
    height: 44px;

    padding: 0 15px 0 42px;

    border: 1px solid #dfe3e8;
    border-radius: 9px;

    background: #ffffff;

    color: #172033;
    font-size: 13px;

    outline: none;
}

.user-management .top-search-box input:focus {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
}


/* FILTER */

.user-management .top-filter-box {
    position: relative;
}

.user-management .top-filter-box i {
    position: absolute;
    left: 13px;
    top: 50%;

    transform: translateY(-50%);

    color: #9aa4b2;
    font-size: 13px;

    pointer-events: none;
}

.user-management .top-filter-box select {
    width: 165px;
    height: 44px;

    padding: 0 32px 0 35px;

    border: 1px solid #dfe3e8;
    border-radius: 9px;

    background: #ffffff;

    color: #4a5568;
    font-size: 13px;

    outline: none;
    cursor: pointer;
}

.user-management .top-filter-box select:focus {
    border-color: #dc2626;
}


/* SEARCH BUTTON */

.user-management .btn-search {
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    padding: 0 18px;

    border: none;
    border-radius: 9px;

    background: #dc2626;
    color: #ffffff;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s ease;
}

.user-management .btn-search:hover {
    background: #b91c1c;
}


/* CLEAR */

.user-management .btn-clear {
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 0 15px;

    border: 1px solid #dfe3e8;
    border-radius: 9px;

    background: #ffffff;
    color: #667085;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition: 0.2s ease;
}

.user-management .btn-clear:hover {
    border-color: #dc2626;
    color: #dc2626;
}


/* =========================
   STATISTICS
========================= */

.user-management .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;

    margin-bottom: 25px;
}

.user-management .stat-card {
    display: flex;
    align-items: center;

    min-height: 120px;

    padding: 20px;

    background: #ffffff;

    border: 1px solid #eeeeee;
    border-radius: 14px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);

    transition: 0.2s ease;
}

.user-management .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
}

.user-management .stat-icon {
    width: 50px;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 14px;

    border-radius: 12px;

    font-size: 21px;
}

.user-management .stat-icon.blue {
    background: #eaf2ff;
    color: #2563eb;
}

.user-management .stat-icon.green {
    background: #eafaf0;
    color: #16a34a;
}

.user-management .stat-icon.red {
    background: #fff0f0;
    color: #dc2626;
}

.user-management .stat-icon.purple {
    background: #f4edff;
    color: #7c3aed;
}

.user-management .stat-info {
    display: flex;
    flex-direction: column;
}

.user-management .stat-label {
    margin-bottom: 3px;
    color: #718096;
    font-size: 13px;
}

.user-management .stat-info h2 {
    margin: 0;
    color: #172033;
    font-size: 24px;
    font-weight: 700;
}

.user-management .stat-info small {
    margin-top: 4px;
    color: #8a94a6;
    font-size: 11px;
}


/* =========================
   USERS CARD
========================= */

.user-management .users-card {
    overflow: hidden;

    background: #ffffff;

    border: 1px solid #eeeeee;
    border-radius: 15px;

    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
}


/* CARD HEADER */

.user-management .card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 22px 25px;

    border-bottom: 1px solid #eeeeee;
}

.user-management .card-header h2 {
    display: flex;
    align-items: center;
    gap: 9px;

    margin: 0;

    color: #172033;
    font-size: 18px;
    font-weight: 700;
}

.user-management .card-header h2 i {
    color: #dc2626;
}

.user-management .card-header p {
    margin: 5px 0 0;

    color: #7b8798;
    font-size: 13px;
}

.user-management .user-count {
    padding: 7px 13px;

    background: #f8f9fb;

    border: 1px solid #eeeeee;
    border-radius: 8px;

    color: #667085;
    font-size: 12px;
    font-weight: 600;
}


/* =========================
   TABLE
========================= */

.user-management .table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.user-management .users-table {
    width: 100%;
    min-width: 900px;

    border-collapse: collapse;
}

.user-management .users-table thead {
    background: #fafbfc;
}

.user-management .users-table th {
    padding: 14px 20px;

    text-align: left;

    border-bottom: 1px solid #eeeeee;

    color: #7b8798;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: 0.5px;
}

.user-management .users-table td {
    padding: 16px 20px;

    border-bottom: 1px solid #f0f1f3;

    color: #4a5568;

    font-size: 13px;

    vertical-align: middle;
}

.user-management .users-table tbody tr {
    transition: 0.15s ease;
}

.user-management .users-table tbody tr:hover {
    background: #fffafa;
}


/* =========================
   USER INFO
========================= */

.user-management .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-management .avatar {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 50%;

    background: #fee2e2;
    color: #dc2626;

    font-size: 12px;
    font-weight: 700;
}

.user-management .admin-avatar {
    background: #ede9fe;
    color: #7c3aed;
}

.user-management .user-info strong {
    display: block;

    color: #172033;

    font-size: 13px;
    font-weight: 600;
}

.user-management .user-info span {
    display: block;

    margin-top: 3px;

    color: #98a2b3;

    font-size: 11px;
}


/* =========================
   BLOOD TYPE
========================= */

.user-management .blood-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 40px;

    padding: 5px 9px;

    border-radius: 6px;

    background: #fff1f2;
    color: #dc2626;

    font-size: 12px;
    font-weight: 700;
}


/* =========================
   ROLE
========================= */

.user-management .role-badge {
    display: inline-flex;

    padding: 5px 10px;

    border-radius: 6px;

    font-size: 11px;
    font-weight: 600;
}

.user-management .role-badge.user {
    background: #eef4ff;
    color: #2563eb;
}

.user-management .role-badge.admin {
    background: #f3e8ff;
    color: #7c3aed;
}


/* =========================
   STATUS
========================= */

.user-management .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 5px 10px;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 600;
}

.user-management .status-badge span {
    width: 6px;
    height: 6px;

    border-radius: 50%;
}

.user-management .status-badge.active {
    background: #ecfdf3;
    color: #15803d;
}

.user-management .status-badge.active span {
    background: #22c55e;
}

.user-management .status-badge.blocked {
    background: #fff1f2;
    color: #dc2626;
}

.user-management .status-badge.blocked span {
    background: #ef4444;
}


/* =========================
   ACTION BUTTONS
========================= */

.user-management .action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
}

.user-management .action-buttons form {
    margin: 0;
    padding: 0;
}

.user-management .action-btn {
    width: 33px;
    height: 33px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: none;
    border-radius: 7px;

    text-decoration: none;

    cursor: pointer;

    font-size: 13px;

    transition: 0.2s ease;
}

.user-management .action-btn.view {
    background: #eef4ff;
    color: #2563eb;
}

.user-management .action-btn.view:hover {
    background: #dbeafe;
}

.user-management .action-btn.edit {
    background: #fff7ed;
    color: #ea580c;
}

.user-management .action-btn.edit:hover {
    background: #ffedd5;
}

.user-management .action-btn.delete {
    background: #fff1f2;
    color: #dc2626;
}

.user-management .action-btn.delete:hover {
    background: #fee2e2;
}


/* =========================
   PAGINATION
========================= */

.user-management .pagination-area {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 18px 25px;
}

.user-management .pagination-info {
    color: #7b8798;
    font-size: 12px;
}

.user-management .pagination-info strong {
    color: #4a5568;
}

.user-management .pagination {
    display: flex;
    align-items: center;
    gap: 5px;
}

.user-management .page-btn {
    min-width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0 8px;

    border: 1px solid #e1e5ea;
    border-radius: 7px;

    background: #ffffff;
    color: #667085;

    font-size: 12px;

    cursor: pointer;
}

.user-management .page-btn:hover {
    border-color: #dc2626;
    color: #dc2626;
}

.user-management .page-btn.active {
    border-color: #dc2626;
    background: #dc2626;
    color: #ffffff;
}

.user-management .page-btn.disabled {
    opacity: 0.45;
    cursor: not-allowed;
}

.user-management .page-dots {
    padding: 0 3px;
    color: #98a2b3;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1100px) {

    .user-management .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .user-management .top-search-area {
        flex-wrap: wrap;
    }

    .user-management .top-search-box {
        flex: 1 1 100%;
    }

}


@media (max-width: 700px) {

    .user-management {
        padding: 0;
    }

    .user-management .page-title {
        font-size: 23px;
    }

    .user-management .page-title i {
        font-size: 22px;
    }

    .user-management .top-search-area {
        flex-direction: column;
        align-items: stretch;
    }

    .user-management .top-search-box {
        width: 100%;
    }

    .user-management .top-filter-box {
        width: 100%;
    }

    .user-management .top-filter-box select {
        width: 100%;
    }

    .user-management .btn-search,
    .user-management .btn-clear {
        width: 100%;
    }

    .user-management .stats-grid {
        grid-template-columns: 1fr;
    }

    .user-management .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .user-management .pagination-area {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .user-management .pagination {
        width: 100%;
        overflow-x: auto;
    }

}

</style>

@endsection