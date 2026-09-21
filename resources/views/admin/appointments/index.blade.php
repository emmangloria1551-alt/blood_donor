@extends('admin.layouts.app')

@section('title', 'Appointment Management')

@section('content')

<div class="appointment-page">

    {{-- PAGE HEADER --}}
    <div class="appointment-header">

        <div>
            <h1 class="page-title">
                <i class="bi bi-calendar-check-fill"></i>
                Appointment Management
            </h1>

            <p class="page-subtitle">
                Manage donor appointments and schedules.
            </p>
        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-box success-alert">
            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>
        </div>
    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="alert-box error-alert">
            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>
        </div>
    @endif


    {{-- STATISTICS --}}
    <div class="stats-grid">

        {{-- TOTAL --}}
        <div class="stat-card">

            <div class="stat-icon total-icon">
                <i class="bi bi-calendar3"></i>
            </div>

            <div class="stat-content">

                <div class="stat-label">
                    Total Appointments
                </div>

                <div class="stat-number">
                    {{ $totalAppointments }}
                </div>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="stat-card">

            <div class="stat-icon pending-icon">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div class="stat-content">

                <div class="stat-label">
                    Pending
                </div>

                <div class="stat-number">
                    {{ $pendingAppointments }}
                </div>

            </div>

        </div>


        {{-- CONFIRMED --}}
        <div class="stat-card">

            <div class="stat-icon confirmed-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="stat-content">

                <div class="stat-label">
                    Confirmed
                </div>

                <div class="stat-number">
                    {{ $confirmedAppointments }}
                </div>

            </div>

        </div>


        {{-- COMPLETED --}}
        <div class="stat-card">

            <div class="stat-icon completed-icon">
                <i class="bi bi-check2-all"></i>
            </div>

            <div class="stat-content">

                <div class="stat-label">
                    Completed
                </div>

                <div class="stat-number">
                    {{ $completedAppointments }}
                </div>

            </div>

        </div>

    </div>


    {{-- FILTER AREA --}}
    <div class="filter-card">

        <form
            method="GET"
            action="{{ route('admin.appointments') }}"
            class="filter-form"
        >

            {{-- SEARCH --}}
            <div class="filter-group search-group">

                <label for="search">
                    Search
                </label>

                <div class="search-wrapper">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search appointments..."
                    >

                </div>

            </div>


            {{-- DATE --}}
            <div class="filter-group">

                <label for="date">
                    Date
                </label>

                <input
                    type="date"
                    id="date"
                    name="date"
                    value="{{ request('date') }}"
                >

            </div>


            {{-- STATUS --}}
            <div class="filter-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="pending"
                        {{ request('status') === 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="confirmed"
                        {{ request('status') === 'confirmed' ? 'selected' : '' }}
                    >
                        Confirmed
                    </option>

                    <option
                        value="completed"
                        {{ request('status') === 'completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                    <option
                        value="cancelled"
                        {{ request('status') === 'cancelled' ? 'selected' : '' }}
                    >
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- BUTTONS --}}
            <div class="filter-buttons">

                <button
                    type="submit"
                    class="search-button"
                >
                    <i class="bi bi-search"></i>
                    Search
                </button>

                <a
                    href="{{ route('admin.appointments') }}"
                    class="reset-button"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- APPOINTMENTS TABLE --}}
    <div class="table-card">

        {{-- TABLE HEADER --}}
        <div class="table-header">

            <div>

                <h2>
                    Appointments
                </h2>

                <p>
                    {{ $appointments->total() }}
                    appointment{{ $appointments->total() == 1 ? '' : 's' }}
                    found
                </p>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-wrapper">

            <table class="appointments-table">

                <thead>

                    <tr>

                        <th>
                            User
                        </th>

                        <th>
                            Donor
                        </th>

                        <th>
                            Center
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Time
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

                    @forelse($appointments as $appointment)

                        <tr>

                            {{-- USER --}}
                            <td>

                                <div class="user-info">

                                    <div class="user-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $appointment->user->name ?? 'U',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div class="user-details">

                                        <div class="user-name">
                                            {{ $appointment->user->name ?? 'Unknown User' }}
                                        </div>

                                        <div class="user-email">
                                            {{ $appointment->user->email ?? 'No email' }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- DONOR --}}
                            <td>

                                @if($appointment->donor)

                                    <div class="donor-info">

                                        <span class="blood-badge">
                                            {{ $appointment->donor->blood_type }}
                                        </span>

                                        <span class="donor-phone">
                                            {{ $appointment->donor->phone ?? 'No phone' }}
                                        </span>

                                    </div>

                                @else

                                    <span class="not-available">
                                        No donor
                                    </span>

                                @endif

                            </td>


                            {{-- CENTER --}}
                            <td>

                                <div class="center-info">

                                    <i class="bi bi-geo-alt-fill"></i>

                                    <span>
                                        {{ $appointment->center }}
                                    </span>

                                </div>

                            </td>


                            {{-- DATE --}}
                            <td>

                                <div class="date-info">

                                    <strong>
                                        {{ $appointment->appointment_date->format('M d, Y') }}
                                    </strong>

                                    <span>
                                        {{ $appointment->appointment_date->format('l') }}
                                    </span>

                                </div>

                            </td>


                            {{-- TIME --}}
                            <td>

                                <div class="time-info">

                                    <i class="bi bi-clock"></i>

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </span>

                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($appointment->status === 'pending')

                                    <span class="status-badge status-pending">
                                        <i class="bi bi-clock-fill"></i>
                                        Pending
                                    </span>

                                @elseif($appointment->status === 'confirmed')

                                    <span class="status-badge status-confirmed">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Confirmed
                                    </span>

                                @elseif($appointment->status === 'completed')

                                    <span class="status-badge status-completed">
                                        <i class="bi bi-check2-all"></i>
                                        Completed
                                    </span>

                                @elseif($appointment->status === 'cancelled')

                                    <span class="status-badge status-cancelled">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Cancelled
                                    </span>

                                @else

                                    <span class="status-badge status-default">
                                        {{ ucfirst($appointment->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="appointment-actions">

                                    {{-- VIEW --}}
                                    <a
                                        href="{{ route('admin.appointments.show', $appointment) }}"
                                        class="action-btn view-btn"
                                        title="View Appointment"
                                    >
                                        <i class="bi bi-eye-fill"></i>
                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        method="POST"
                                        action="{{ route('admin.appointments.destroy', $appointment) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this appointment?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete Appointment"
                                        >
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-cell"
                            >

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <h3>
                                        No appointments found
                                    </h3>

                                    <p>
                                        There are no appointments matching your search or filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($appointments->hasPages())

            <div class="pagination-area">

                {{ $appointments->links() }}

            </div>

        @endif

    </div>

</div>


<style>

/* =========================================================
   APPOINTMENT PAGE
========================================================= */

.appointment-page {
    width: 100%;
    max-width: 100%;
    color: #172033;
}


/* =========================================================
   HEADER
========================================================= */

.appointment-header {
    margin-bottom: 24px;
}

.appointment-page .page-title {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #172033;
    display: flex;
    align-items: center;
    gap: 10px;
}

.appointment-page .page-title i {
    color: #e32929;
    font-size: 28px;
}

.appointment-page .page-subtitle {
    margin: 7px 0 0;
    color: #718096;
    font-size: 14px;
}


/* =========================================================
   ALERTS
========================================================= */

.appointment-page .alert-box {
    width: 100%;
    padding: 13px 16px;
    border-radius: 9px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.appointment-page .success-alert {
    background: #ecfdf3;
    color: #087443;
    border: 1px solid #bbf7d0;
}

.appointment-page .error-alert {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
}


/* =========================================================
   STATISTICS
========================================================= */

.appointment-page .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 22px;
}

.appointment-page .stat-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    padding: 22px;
    min-height: 112px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.appointment-page .stat-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.appointment-page .total-icon {
    color: #ef4444;
    background: #fee2e2;
}

.appointment-page .pending-icon {
    color: #ea580c;
    background: #fff7ed;
}

.appointment-page .confirmed-icon {
    color: #2563eb;
    background: #eff6ff;
}

.appointment-page .completed-icon {
    color: #059669;
    background: #ecfdf5;
}

.appointment-page .stat-label {
    color: #718096;
    font-size: 13px;
    margin-bottom: 5px;
}

.appointment-page .stat-number {
    color: #172033;
    font-size: 27px;
    font-weight: 700;
}


/* =========================================================
   FILTER
========================================================= */

.appointment-page .filter-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    padding: 22px;
    margin-bottom: 22px;
}

.appointment-page .filter-form {
    display: grid;
    grid-template-columns: minmax(260px, 1.5fr) 200px 200px auto;
    gap: 14px;
    align-items: end;
}

.appointment-page .filter-group {
    min-width: 0;
}

.appointment-page .filter-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 7px;
}

.appointment-page .search-wrapper {
    position: relative;
}

.appointment-page .search-wrapper i {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 16px;
}

.appointment-page .filter-group input,
.appointment-page .filter-group select {
    width: 100%;
    height: 46px;
    border: 1px solid #d7dce2;
    border-radius: 8px;
    background: #ffffff;
    color: #374151;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
    transition: 0.2s ease;
}

.appointment-page .search-wrapper input {
    padding: 0 14px 0 40px;
}

.appointment-page .filter-group input:not(.search-wrapper input) {
    padding: 0 13px;
}

.appointment-page .filter-group select {
    padding: 0 13px;
}

.appointment-page .filter-group input:focus,
.appointment-page .filter-group select:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08);
}

.appointment-page .filter-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}

.appointment-page .search-button,
.appointment-page .reset-button {
    height: 46px;
    border-radius: 8px;
    padding: 0 17px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
}

.appointment-page .search-button {
    border: 1px solid #e32929;
    background: #e32929;
    color: #ffffff;
}

.appointment-page .search-button:hover {
    background: #c91f1f;
    border-color: #c91f1f;
}

.appointment-page .reset-button {
    border: 1px solid #d7dce2;
    background: #ffffff;
    color: #374151;
}

.appointment-page .reset-button:hover {
    background: #f9fafb;
}


/* =========================================================
   TABLE CARD
========================================================= */

.appointment-page .table-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    overflow: hidden;
}

.appointment-page .table-header {
    padding: 21px 22px;
    border-bottom: 1px solid #e5e7eb;
}

.appointment-page .table-header h2 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #172033;
}

.appointment-page .table-header p {
    margin: 5px 0 0;
    font-size: 13px;
    color: #718096;
}


/* =========================================================
   TABLE
========================================================= */

.appointment-page .table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.appointment-page .appointments-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: collapse;
}

.appointment-page .appointments-table th {
    background: #f8fafc;
    color: #5b6472;
    font-size: 12px;
    font-weight: 700;
    text-align: left;
    padding: 14px 20px;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}

.appointment-page .appointments-table td {
    padding: 17px 20px;
    border-bottom: 1px solid #edf0f3;
    vertical-align: middle;
}

.appointment-page .appointments-table tbody tr:last-child td {
    border-bottom: none;
}

.appointment-page .appointments-table tbody tr:hover {
    background: #fafafa;
}


/* =========================================================
   USER
========================================================= */

.appointment-page .user-info {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 190px;
}

.appointment-page .user-avatar {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    background: #fee2e2;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}

.appointment-page .user-name {
    color: #172033;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 3px;
}

.appointment-page .user-email {
    color: #8a94a3;
    font-size: 12px;
}


/* =========================================================
   DONOR
========================================================= */

.appointment-page .donor-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.appointment-page .blood-badge {
    display: inline-flex;
    width: fit-content;
    padding: 4px 8px;
    border-radius: 6px;
    background: #fff1f2;
    color: #dc2626;
    font-size: 12px;
    font-weight: 700;
}

.appointment-page .donor-phone {
    color: #8a94a3;
    font-size: 12px;
}

.appointment-page .not-available {
    color: #9ca3af;
    font-size: 13px;
}


/* =========================================================
   CENTER
========================================================= */

.appointment-page .center-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #4b5563;
    font-size: 13px;
    white-space: nowrap;
}

.appointment-page .center-info i {
    color: #ef4444;
}


/* =========================================================
   DATE
========================================================= */

.appointment-page .date-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
    white-space: nowrap;
}

.appointment-page .date-info strong {
    color: #172033;
    font-size: 13px;
}

.appointment-page .date-info span {
    color: #8a94a3;
    font-size: 12px;
}


/* =========================================================
   TIME
========================================================= */

.appointment-page .time-info {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #374151;
    font-size: 13px;
    white-space: nowrap;
}

.appointment-page .time-info i {
    color: #9ca3af;
}


/* =========================================================
   STATUS
========================================================= */

.appointment-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.appointment-page .status-pending {
    background: #fff7ed;
    color: #c2410c;
}

.appointment-page .status-confirmed {
    background: #eff6ff;
    color: #2563eb;
}

.appointment-page .status-completed {
    background: #ecfdf5;
    color: #047857;
}

.appointment-page .status-cancelled {
    background: #fef2f2;
    color: #dc2626;
}

.appointment-page .status-default {
    background: #f3f4f6;
    color: #4b5563;
}


/* =========================================================
   ACTION BUTTONS
========================================================= */

.appointment-page .appointment-actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

.appointment-page .appointment-actions form {
    margin: 0;
    padding: 0;
}

.appointment-page .action-btn {
    width: 36px;
    height: 36px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

.appointment-page .view-btn {
    color: #2563eb;
}

.appointment-page .view-btn:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
}

.appointment-page .delete-btn {
    color: #dc2626;
}

.appointment-page .delete-btn:hover {
    background: #fef2f2;
    border-color: #fecaca;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.appointment-page .empty-cell {
    padding: 0 !important;
}

.appointment-page .empty-state {
    padding: 60px 20px;
    text-align: center;
}

.appointment-page .empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 14px;
    border-radius: 50%;
    background: #f3f4f6;
    color: #9ca3af;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.appointment-page .empty-state h3 {
    margin: 0 0 6px;
    font-size: 17px;
    color: #374151;
}

.appointment-page .empty-state p {
    margin: 0;
    color: #9ca3af;
    font-size: 13px;
}


/* =========================================================
   PAGINATION
========================================================= */

.appointment-page .pagination-area {
    padding: 18px 22px;
    border-top: 1px solid #e5e7eb;
}

.appointment-page .pagination-area nav {
    display: flex;
    justify-content: flex-end;
}

.appointment-page .pagination-area .pagination {
    margin: 0;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .appointment-page .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .appointment-page .filter-form {
        grid-template-columns: 1fr 1fr;
    }

    .appointment-page .search-group {
        grid-column: 1 / -1;
    }

}

@media (max-width: 700px) {

    .appointment-page .stats-grid {
        grid-template-columns: 1fr;
    }

    .appointment-page .filter-form {
        grid-template-columns: 1fr;
    }

    .appointment-page .search-group {
        grid-column: auto;
    }

    .appointment-page .filter-buttons {
        width: 100%;
    }

    .appointment-page .search-button,
    .appointment-page .reset-button {
        flex: 1;
    }

    .appointment-page .page-title {
        font-size: 24px;
    }

}

</style>

@endsection