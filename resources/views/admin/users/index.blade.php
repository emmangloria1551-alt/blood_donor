@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')

<div class="user-page">

    {{-- HEADER --}}
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

        <a href="{{ route('admin.users.create') }}" class="add-user-btn">
            <i class="bi bi-plus-lg"></i>
            Add User
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="success-message">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="error-message">

            <i class="bi bi-exclamation-circle-fill"></i>

            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>

        </div>

    @endif


    {{-- SEARCH / FILTER --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.users') }}"
            class="filter-form"
        >

            <div class="search-wrapper">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search users by name or email..."
                >

            </div>


            <select name="blood_type" class="filter-select">

                <option value="">All Blood Types</option>

                @foreach([
                    'A+',
                    'A-',
                    'B+',
                    'B-',
                    'AB+',
                    'AB-',
                    'O+',
                    'O-'
                ] as $type)

                    <option
                        value="{{ $type }}"
                        {{ request('blood_type') === $type ? 'selected' : '' }}
                    >
                        {{ $type }}
                    </option>

                @endforeach

            </select>


            <select name="status" class="filter-select">

                <option value="">All Status</option>

                <option
                    value="active"
                    {{ request('status') === 'active' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="blocked"
                    {{ request('status') === 'blocked' ? 'selected' : '' }}
                >
                    Blocked
                </option>

            </select>


            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i>
                Search
            </button>


            @if(request()->filled('search') || request()->filled('blood_type') || request()->filled('status'))

                <a
                    href="{{ route('admin.users') }}"
                    class="reset-btn"
                >
                    Reset
                </a>

            @endif

        </form>

    </div>


    {{-- STATISTICS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ number_format($totalUsers) }}</div>
                <div class="stat-small">
                    <i class="bi bi-people"></i>
                    Registered users
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon green">
                <i class="bi bi-person-check-fill"></i>
            </div>

            <div>
                <div class="stat-label">Active Users</div>
                <div class="stat-value">{{ number_format($activeUsers) }}</div>
                <div class="stat-small">
                    <i class="bi bi-check-circle"></i>
                    Currently active
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon red">
                <i class="bi bi-person-x-fill"></i>
            </div>

            <div>
                <div class="stat-label">Blocked Users</div>
                <div class="stat-value">{{ number_format($blockedUsers) }}</div>
                <div class="stat-small">
                    <i class="bi bi-exclamation-circle"></i>
                    Blocked accounts
                </div>
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon purple">
                <i class="bi bi-shield-fill-check"></i>
            </div>

            <div>
                <div class="stat-label">Administrators</div>
                <div class="stat-value">{{ number_format($administrators) }}</div>
                <div class="stat-small">
                    <i class="bi bi-shield-check"></i>
                    Admin accounts
                </div>
            </div>

        </div>

    </div>


    {{-- USER TABLE --}}
    <div class="table-card">

        <div class="table-header">

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
                {{ $users->total() }}
                {{ $users->total() === 1 ? 'user' : 'users' }}
            </div>

        </div>


        @if($users->count() > 0)

            <div class="table-wrapper">

                <table class="user-table">

                    <thead>

                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Blood Type</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                {{-- USER --}}
                                <td>

                                    <div class="user-info">

                                        <div class="avatar">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>

                                        <div>
                                            <div class="user-name">
                                                {{ $user->name }}
                                            </div>

                                            <div class="user-id">
                                                ID #{{ $user->id }}
                                            </div>
                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td>
                                    <span class="email">
                                        {{ $user->email }}
                                    </span>
                                </td>


                                {{-- BLOOD TYPE --}}
                                <td>

                                    @if($user->blood_type)

                                        <span class="blood-badge">
                                            {{ $user->blood_type }}
                                        </span>

                                    @else

                                        <span class="not-set">
                                            Not set
                                        </span>

                                    @endif

                                </td>


                                {{-- ROLE --}}
                                <td>

                                    @if($user->role === 'admin')

                                        <span class="role-badge admin-role">
                                            <i class="bi bi-shield-fill-check"></i>
                                            Admin
                                        </span>

                                    @else

                                        <span class="role-badge user-role">
                                            User
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($user->status === 'active')

                                        <span class="status-badge active-status">
                                            <span class="status-dot"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="status-badge blocked-status">
                                            <span class="status-dot"></span>
                                            Blocked
                                        </span>

                                    @endif

                                </td>


                                {{-- REGISTERED --}}
                                <td>

                                    <span class="registered-date">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="action-buttons">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('admin.users.show', $user) }}"
                                            class="action-btn view-btn"
                                            title="View User"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            class="action-btn edit-btn"
                                            title="Edit User"
                                        >
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
                                            class="delete-form"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Delete User"
                                            >
                                                <i class="bi bi-trash-fill"></i>
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
            <div class="pagination-area">
                {{ $users->links() }}
            </div>


        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-people"></i>
                </div>

                <h3>No Users Found</h3>

                <p>
                    No users match your search or filters.
                </p>

                <a
                    href="{{ route('admin.users') }}"
                    class="reset-empty-btn"
                >
                    Clear Filters
                </a>

            </div>

        @endif

    </div>

</div>


<style>

/* PAGE */

.user-page {
    width: 100%;
    padding: 10px 0 40px;
}


/* HEADER */

.user-page .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.user-page .page-title {
    margin: 0;
    color: #18243b;
    font-size: 28px;
    font-weight: 700;
}

.user-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.user-page .page-subtitle {
    margin: 6px 0 0;
    color: #718096;
    font-size: 14px;
}


/* ADD BUTTON */

.user-page .add-user-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 11px 17px;
    background: #dc3545;
    color: white;
    border-radius: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.user-page .add-user-btn:hover {
    background: #bb2d3b;
    color: white;
}


/* ALERTS */

.user-page .success-message,
.user-page .error-message {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 13px 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    font-size: 14px;
}

.user-page .success-message {
    background: #eaf8ef;
    color: #18733a;
    border: 1px solid #ccebd7;
}

.user-page .error-message {
    background: #fff0f1;
    color: #b02a37;
    border: 1px solid #f3c2c7;
}


/* FILTER */

.user-page .filter-card {
    padding: 14px;
    margin-bottom: 20px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

.user-page .filter-form {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.user-page .search-wrapper {
    position: relative;
    flex: 1;
}

.user-page .search-wrapper i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.user-page .search-wrapper input {
    width: 100%;
    height: 42px;
    padding: 0 14px 0 40px;
    border: 1px solid #dbe1e8;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    box-sizing: border-box;
}

.user-page .search-wrapper input:focus {
    border-color: #dc3545;
}

.user-page .filter-select {
    width: 155px;
    height: 42px;
    padding: 0 12px;
    border: 1px solid #dbe1e8;
    border-radius: 8px;
    background: white;
    color: #4a5568;
    outline: none;
}

.user-page .search-btn {
    height: 42px;
    padding: 0 17px;
    border: none;
    border-radius: 8px;
    background: #dc3545;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

.user-page .search-btn:hover {
    background: #bb2d3b;
}

.user-page .reset-btn {
    height: 42px;
    display: inline-flex;
    align-items: center;
    padding: 0 14px;
    border: 1px solid #dbe1e8;
    border-radius: 8px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
}


/* STATS */

.user-page .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

.user-page .stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,.03);
}

.user-page .stat-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 20px;
}

.user-page .stat-icon.blue {
    background: #eaf1ff;
    color: #2864dc;
}

.user-page .stat-icon.green {
    background: #eaf8ef;
    color: #198754;
}

.user-page .stat-icon.red {
    background: #fff0f1;
    color: #dc3545;
}

.user-page .stat-icon.purple {
    background: #f2eaff;
    color: #7c3aed;
}

.user-page .stat-label {
    color: #718096;
    font-size: 13px;
}

.user-page .stat-value {
    margin-top: 2px;
    color: #18243b;
    font-size: 26px;
    font-weight: 700;
}

.user-page .stat-small {
    margin-top: 2px;
    color: #8a94a6;
    font-size: 11px;
}


/* TABLE */

.user-page .table-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.03);
}

.user-page .table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 19px 20px;
    border-bottom: 1px solid #edf0f3;
}

.user-page .table-header h2 {
    margin: 0;
    color: #18243b;
    font-size: 18px;
}

.user-page .table-header h2 i {
    color: #dc3545;
    margin-right: 6px;
}

.user-page .table-header p {
    margin: 5px 0 0;
    color: #718096;
    font-size: 13px;
}

.user-page .user-count {
    padding: 8px 13px;
    background: #f8f9fa;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #64748b;
    font-size: 13px;
}


/* TABLE CONTENT */

.user-page .table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.user-page .user-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
}

.user-page .user-table th {
    padding: 13px 17px;
    background: #fafafa;
    border-bottom: 1px solid #edf0f3;
    color: #718096;
    font-size: 11px;
    font-weight: 700;
    text-align: left;
    text-transform: uppercase;
}

.user-page .user-table td {
    padding: 15px 17px;
    border-bottom: 1px solid #f0f2f4;
    vertical-align: middle;
    font-size: 14px;
}

.user-page .user-table tbody tr:hover {
    background: #fffafa;
}


/* USER */

.user-page .user-info {
    display: flex;
    align-items: center;
    gap: 11px;
}

.user-page .avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fde8eb;
    color: #c82333;
    font-size: 12px;
    font-weight: 700;
}

.user-page .user-name {
    color: #202938;
    font-weight: 600;
}

.user-page .user-id {
    margin-top: 2px;
    color: #9aa3af;
    font-size: 11px;
}

.user-page .email {
    color: #526071;
}

.user-page .blood-badge {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 6px;
    background: #fff0f1;
    color: #dc3545;
    font-size: 12px;
    font-weight: 700;
}

.user-page .not-set {
    color: #aaa;
    font-size: 12px;
}


/* ROLE */

.user-page .role-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.user-page .admin-role {
    background: #f1eaff;
    color: #7041d8;
}

.user-page .user-role {
    background: #eaf1ff;
    color: #2864dc;
}


/* STATUS */

.user-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.user-page .active-status {
    background: #eaf8ef;
    color: #198754;
}

.user-page .blocked-status {
    background: #fff0f1;
    color: #dc3545;
}

.user-page .status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}


/* ACTIONS */

.user-page .action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
}

.user-page .delete-form {
    margin: 0;
}

.user-page .action-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e0e4e8;
    border-radius: 7px;
    background: white;
    text-decoration: none;
    cursor: pointer;
}

.user-page .view-btn {
    color: #0d6efd;
}

.user-page .edit-btn {
    color: #e09b00;
}

.user-page .delete-btn {
    color: #dc3545;
}

.user-page .action-btn:hover {
    background: #f8f9fa;
}


/* EMPTY */

.user-page .empty-state {
    padding: 60px 20px;
    text-align: center;
}

.user-page .empty-icon {
    width: 65px;
    height: 65px;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fff0f1;
    color: #dc3545;
    font-size: 26px;
}

.user-page .empty-state h3 {
    margin: 0 0 7px;
    color: #333;
}

.user-page .empty-state p {
    margin: 0 0 17px;
    color: #888;
}

.user-page .reset-empty-btn {
    display: inline-block;
    padding: 9px 15px;
    background: #dc3545;
    color: white;
    border-radius: 7px;
    text-decoration: none;
    font-size: 13px;
}


/* PAGINATION */

.user-page .pagination-area {
    padding: 18px 20px;
}


/* RESPONSIVE */

@media (max-width: 900px) {

    .user-page .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .user-page .filter-form {
        flex-wrap: wrap;
    }

    .user-page .search-wrapper {
        width: 100%;
        flex-basis: 100%;
    }

}

@media (max-width: 600px) {

    .user-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .user-page .stats-grid {
        grid-template-columns: 1fr;
    }

    .user-page .filter-form {
        flex-direction: column;
        align-items: stretch;
    }

    .user-page .filter-select,
    .user-page .search-btn,
    .user-page .reset-btn {
        width: 100%;
    }

}

</style>

@endsection