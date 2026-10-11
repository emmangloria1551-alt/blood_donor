@extends('admin.layouts.app')

@section('title', 'Appointment Management')

@section('content')

<div class="appointment-page">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="page-header">

        <div class="page-title-area">
            <div class="page-icon">
                <i class="bi bi-calendar-check-fill"></i>
            </div>

            <div>
                <h1>Appointment Management</h1>
                <p>Manage donor appointments and schedules.</p>
            </div>
        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))
        <div class="alert-message success-message">
            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

            <button type="button" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}
    @if(session('error'))
        <div class="alert-message error-message">
            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

            <button type="button" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())
        <div class="alert-message error-message">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>

            <button type="button" onclick="this.parentElement.remove()">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>
    @endif


    {{-- =========================================================
         APPOINTMENT ANNOUNCEMENT
    ========================================================== --}}
    <div class="appointment-announcement">

        <div class="announcement-icon">
            <i class="bi bi-megaphone-fill"></i>
        </div>

        <div class="announcement-content">

            <div class="announcement-top">

                <span class="announcement-label">
                    IMPORTANT ANNOUNCEMENT
                </span>

                <span class="announcement-date">
                    {{ now()->format('F d, Y') }}
                </span>

            </div>

            <h3>
                Blood Donation Appointment Reminder
            </h3>

            <p>
                Donors are reminded to arrive at least
                <strong>15 minutes before their scheduled appointment</strong>.
                Please bring a valid ID and make sure you are in good health
                before donating blood.
            </p>

        </div>

    </div>


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}
    <div class="stats-grid">

        {{-- Total --}}
        <div class="stat-card">

            <div class="stat-icon total-icon">
                <i class="bi bi-calendar3"></i>
            </div>

            <div class="stat-content">

                <span class="stat-label">
                    Total Appointments
                </span>

                <strong class="stat-number">
                    {{ $totalAppointments ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- Pending --}}
        <div class="stat-card">

            <div class="stat-icon pending-icon">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div class="stat-content">

                <span class="stat-label">
                    Pending
                </span>

                <strong class="stat-number">
                    {{ $pendingAppointments ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- Confirmed --}}
        <div class="stat-card">

            <div class="stat-icon confirmed-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="stat-content">

                <span class="stat-label">
                    Confirmed
                </span>

                <strong class="stat-number">
                    {{ $confirmedAppointments ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- Completed --}}
        <div class="stat-card">

            <div class="stat-icon completed-icon">
                <i class="bi bi-check2-all"></i>
            </div>

            <div class="stat-content">

                <span class="stat-label">
                    Completed
                </span>

                <strong class="stat-number">
                    {{ $completedAppointments ?? 0 }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER SECTION
    ========================================================== --}}
    <div class="filter-card">

        <form
            action="{{ route('admin.appointments') }}"
            method="GET"
            class="filter-form"
        >

            {{-- Search --}}
            <div class="filter-group search-group">

                <label for="search">
                    Search
                </label>

                <div class="input-wrapper">

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


            {{-- Date --}}
            <div class="filter-group date-group">

                <label for="date">
                    Date
                </label>

                <div class="input-wrapper">

                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="{{ request('date') }}"
                    >

                </div>

            </div>


            {{-- Status --}}
            <div class="filter-group status-group">

                <label for="status">
                    Status
                </label>

                <div class="input-wrapper">

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

            </div>


            {{-- Buttons --}}
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


    {{-- =========================================================
         APPOINTMENTS TABLE
    ========================================================== --}}
    <div class="appointments-card">

        <div class="table-header">

            <div>

                <h2>
                    Appointments
                </h2>

                <p>
                    {{ $appointments->total() ?? 0 }}
                    appointment{{ (($appointments->total() ?? 0) == 1) ? '' : 's' }}
                    found
                </p>

            </div>

        </div>


        @if(isset($appointments) && $appointments->count() > 0)

            <div class="table-container">

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

                        @foreach($appointments as $appointment)

                            <tr>

                                {{-- USER --}}
                                <td>

                                    <div class="person-cell">

                                        <div class="person-avatar">
                                            {{ strtoupper(substr($appointment->user->name ?? 'U', 0, 1)) }}
                                        </div>

                                        <div class="person-info">

                                            <strong>
                                                {{ $appointment->user->name ?? 'Unknown User' }}
                                            </strong>

                                            @if($appointment->user)
                                                <small>
                                                    {{ $appointment->user->email }}
                                                </small>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- DONOR --}}
                                <td>

                                    @if($appointment->donor)

                                        <div class="donor-cell">

                                            <strong>
                                                {{ $appointment->donor->user->name ?? 'Donor' }}
                                            </strong>

                                            @if($appointment->donor->blood_type)
                                                <span class="blood-badge">
                                                    {{ $appointment->donor->blood_type }}
                                                </span>
                                            @endif

                                        </div>

                                    @else

                                        <span class="empty-value">
                                            No donor
                                        </span>

                                    @endif

                                </td>


                                {{-- CENTER --}}
                                <td>

                                    <div class="center-cell">

                                        <i class="bi bi-geo-alt-fill"></i>

                                        <span>
                                            {{ $appointment->center }}
                                        </span>

                                    </div>

                                </td>


                                {{-- DATE --}}
                                <td>

                                    @if($appointment->appointment_date)

                                        <div class="date-cell">

                                            <strong>
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                            </strong>

                                        </div>

                                    @else

                                        <span class="empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- TIME --}}
                                <td>

                                    @if($appointment->appointment_time)

                                        <div class="time-cell">

                                            <i class="bi bi-clock"></i>

                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                        </div>

                                    @else

                                        <span class="empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @php
                                        $status = strtolower($appointment->status ?? 'pending');
                                    @endphp

                                    <span class="status-badge status-{{ $status }}">

                                        @if($status === 'pending')
                                            <i class="bi bi-clock-fill"></i>
                                        @elseif($status === 'confirmed')
                                            <i class="bi bi-check-circle-fill"></i>
                                        @elseif($status === 'completed')
                                            <i class="bi bi-check2-all"></i>
                                        @elseif($status === 'cancelled')
                                            <i class="bi bi-x-circle-fill"></i>
                                        @else
                                            <i class="bi bi-circle-fill"></i>
                                        @endif

                                        {{ ucfirst($status) }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td>

                                    <div class="action-buttons">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.appointments.show', $appointment) }}"
                                            class="action-button view-button"
                                            title="View Appointment"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>


                                        {{-- Status --}}
                                        <button
                                            type="button"
                                            class="action-button status-button"
                                            title="Update Status"
                                            onclick="openStatusModal(
                                                {{ $appointment->id }},
                                                '{{ $status }}'
                                            )"
                                        >
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>


                                        {{-- Delete --}}
                                        <button
                                            type="button"
                                            class="action-button delete-button"
                                            title="Delete Appointment"
                                            onclick="openDeleteModal(
                                                {{ $appointment->id }}
                                            )"
                                        >
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 PAGINATION
            ====================================================== --}}
            <div class="pagination-container">

                {{ $appointments->withQueryString()->links() }}

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>

                <h3>
                    No Appointments Found
                </h3>

                <p>
                    There are currently no appointments matching your search.
                </p>

                @if(request()->hasAny(['search', 'date', 'status']))

                    <a
                        href="{{ route('admin.appointments') }}"
                        class="empty-reset-button"
                    >
                        Clear Filters
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>


{{-- =============================================================
     STATUS MODAL
============================================================= --}}
<div
    id="statusModal"
    class="modal-overlay"
>

    <div class="custom-modal">

        <div class="modal-header">

            <div class="modal-title">

                <div class="modal-icon edit-modal-icon">
                    <i class="bi bi-pencil-fill"></i>
                </div>

                <div>
                    <h3>
                        Update Appointment
                    </h3>

                    <p>
                        Change the appointment status.
                    </p>
                </div>

            </div>

            <button
                type="button"
                class="modal-close"
                onclick="closeStatusModal()"
            >
                <i class="bi bi-x-lg"></i>
            </button>

        </div>


        <form
            id="statusForm"
            method="POST"
        >

            @csrf
            @method('PATCH')

            <div class="modal-body">

                <label for="modalStatus">
                    Appointment Status
                </label>

                <select
                    id="modalStatus"
                    name="status"
                    required
                >

                    <option value="pending">
                        Pending
                    </option>

                    <option value="confirmed">
                        Confirmed
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="modal-cancel"
                    onclick="closeStatusModal()"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="modal-save"
                >
                    <i class="bi bi-check-lg"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =============================================================
     DELETE MODAL
============================================================= --}}
<div
    id="deleteModal"
    class="modal-overlay"
>

    <div class="custom-modal delete-modal">

        <div class="modal-header">

            <div class="modal-title">

                <div class="modal-icon delete-modal-icon">
                    <i class="bi bi-trash-fill"></i>
                </div>

                <div>

                    <h3>
                        Delete Appointment
                    </h3>

                    <p>
                        This action cannot be undone.
                    </p>

                </div>

            </div>

            <button
                type="button"
                class="modal-close"
                onclick="closeDeleteModal()"
            >
                <i class="bi bi-x-lg"></i>
            </button>

        </div>


        <div class="modal-body">

            <p class="delete-warning">

                Are you sure you want to delete this appointment?

                <br>

                All appointment information will be permanently removed.

            </p>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="modal-cancel"
                onclick="closeDeleteModal()"
            >
                Cancel
            </button>

            <form
                id="deleteForm"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="modal-delete"
                >
                    <i class="bi bi-trash-fill"></i>
                    Delete Appointment
                </button>

            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   MAIN PAGE
========================================================= */

.appointment-page {
    width: 100%;
    max-width: 100%;
    padding: 32px 36px 50px;
    box-sizing: border-box;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 25px;
}

.page-title-area {
    display: flex;
    align-items: center;
    gap: 16px;
}

.page-icon {
    width: 48px;
    height: 48px;
    background: #ffe5e5;
    color: #e9272f;
    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 22px;
}

.page-title-area h1 {
    margin: 0;
    color: #14213d;
    font-size: 32px;
    font-weight: 700;
    line-height: 1.2;
}

.page-title-area p {
    margin: 6px 0 0;
    color: #667085;
    font-size: 16px;
}


/* =========================================================
   ALERTS
========================================================= */

.alert-message {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 14px 18px;
    margin-bottom: 20px;

    border-radius: 10px;
    font-size: 14px;
}

.alert-message button {
    margin-left: auto;
    border: 0;
    background: transparent;
    cursor: pointer;
    font-size: 14px;
}

.success-message {
    background: #ecfdf3;
    color: #027a48;
    border: 1px solid #abefc6;
}

.success-message button {
    color: #027a48;
}

.error-message {
    background: #fff1f3;
    color: #c01048;
    border: 1px solid #fecdd6;
}

.error-message button {
    color: #c01048;
}


/* =========================================================
   ANNOUNCEMENT
========================================================= */

.appointment-announcement {
    width: 100%;

    display: flex;
    align-items: flex-start;
    gap: 18px;

    margin-bottom: 28px;
    padding: 22px 24px;

    box-sizing: border-box;

    background: linear-gradient(
        135deg,
        #fff5f5,
        #ffffff
    );

    border: 1px solid #f5caca;
    border-left: 5px solid #e9272f;

    border-radius: 14px;

    box-shadow:
        0 4px 14px rgba(0, 0, 0, 0.04);
}

.announcement-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #ffe3e5;
    color: #e9272f;

    border-radius: 12px;

    font-size: 23px;
}

.announcement-content {
    flex: 1;
}

.announcement-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;
    margin-bottom: 5px;
}

.announcement-label {
    font-size: 12px;
    font-weight: 700;

    color: #e9272f;

    letter-spacing: 0.8px;
}

.announcement-date {
    font-size: 12px;
    color: #777;
}

.announcement-content h3 {
    margin: 3px 0 7px;

    color: #14213d;

    font-size: 18px;
    font-weight: 700;
}

.announcement-content p {
    margin: 0;

    color: #667085;

    font-size: 14px;
    line-height: 1.7;
}

.announcement-content strong {
    color: #14213d;
}


/* =========================================================
   STATISTICS
========================================================= */

.stats-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 22px;

    margin-bottom: 28px;
}

.stat-card {
    min-height: 120px;

    display: flex;
    align-items: center;

    gap: 20px;

    padding: 22px 28px;

    background: #ffffff;

    border: 1px solid #e4e7ec;

    border-radius: 15px;

    box-sizing: border-box;

    box-shadow:
        0 2px 7px rgba(16, 24, 40, 0.03);
}

.stat-icon {
    width: 64px;
    height: 64px;

    min-width: 64px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    font-size: 25px;
}

.total-icon {
    background: #ffe1e1;
    color: #f04444;
}

.pending-icon {
    background: #fff4e5;
    color: #ef5b00;
}

.confirmed-icon {
    background: #eaf2ff;
    color: #2864dc;
}

.completed-icon {
    background: #e9fbf3;
    color: #00a878;
}

.stat-content {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.stat-label {
    color: #667085;
    font-size: 14px;
}

.stat-number {
    color: #111827;
    font-size: 32px;
    line-height: 1;
}


/* =========================================================
   FILTER CARD
========================================================= */

.filter-card {
    background: #ffffff;

    border: 1px solid #e4e7ec;

    border-radius: 15px;

    padding: 26px 28px;

    margin-bottom: 28px;

    box-shadow:
        0 2px 7px rgba(16, 24, 40, 0.03);
}

.filter-form {
    display: grid;

    grid-template-columns:
        minmax(280px, 1fr)
        250px
        250px
        auto;

    gap: 18px;

    align-items: end;
}

.filter-group {
    min-width: 0;
}

.filter-group label {
    display: block;

    margin-bottom: 8px;

    color: #344054;

    font-size: 14px;
    font-weight: 600;
}

.input-wrapper {
    position: relative;
}

.input-wrapper > i {
    position: absolute;

    left: 15px;
    top: 50%;

    transform: translateY(-50%);

    color: #98a2b3;

    pointer-events: none;
}

.input-wrapper input,
.input-wrapper select {
    width: 100%;
    height: 58px;

    padding: 0 15px;

    box-sizing: border-box;

    border: 1px solid #d0d5dd;

    border-radius: 10px;

    background: #ffffff;

    color: #344054;

    font-size: 15px;

    outline: none;

    transition: 0.2s;
}

.input-wrapper input[type="text"] {
    padding-left: 48px;
}

.input-wrapper input:focus,
.input-wrapper select:focus {
    border-color: #e9272f;

    box-shadow:
        0 0 0 3px rgba(233, 39, 47, 0.08);
}

.input-wrapper select {
    cursor: pointer;
}

.filter-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-button,
.reset-button {
    height: 58px;

    border-radius: 10px;

    padding: 0 22px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    font-size: 15px;
    font-weight: 600;

    cursor: pointer;

    text-decoration: none;

    white-space: nowrap;

    box-sizing: border-box;
}

.search-button {
    border: 1px solid #e9272f;

    background: #e9272f;

    color: #ffffff;
}

.search-button:hover {
    background: #c91e25;
    border-color: #c91e25;
}

.reset-button {
    border: 1px solid #d0d5dd;

    background: #ffffff;

    color: #344054;
}

.reset-button:hover {
    background: #f9fafb;
}


/* =========================================================
   APPOINTMENTS CARD
========================================================= */

.appointments-card {
    width: 100%;

    background: #ffffff;

    border: 1px solid #e4e7ec;

    border-radius: 15px;

    overflow: hidden;

    box-shadow:
        0 2px 7px rgba(16, 24, 40, 0.03);
}

.table-header {
    padding: 26px 28px;

    border-bottom: 1px solid #eaecf0;
}

.table-header h2 {
    margin: 0;

    color: #14213d;

    font-size: 21px;
    font-weight: 700;
}

.table-header p {
    margin: 6px 0 0;

    color: #667085;

    font-size: 14px;
}

.table-container {
    width: 100%;

    overflow-x: auto;
}

.appointments-table {
    width: 100%;

    min-width: 1050px;

    border-collapse: collapse;
}

.appointments-table thead {
    background: #f8f9fb;
}

.appointments-table th {
    padding: 18px 25px;

    text-align: left;

    color: #475467;

    font-size: 13px;
    font-weight: 700;

    white-space: nowrap;

    border-bottom: 1px solid #eaecf0;
}

.appointments-table td {
    padding: 18px 25px;

    color: #344054;

    font-size: 14px;

    border-bottom: 1px solid #f0f2f5;

    vertical-align: middle;
}

.appointments-table tbody tr {
    transition: 0.15s;
}

.appointments-table tbody tr:hover {
    background: #fcfcfd;
}

.appointments-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   PERSON
========================================================= */

.person-cell {
    display: flex;
    align-items: center;

    gap: 12px;
}

.person-avatar {
    width: 40px;
    height: 40px;

    min-width: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #ffe5e5;

    color: #d92128;

    font-size: 14px;
    font-weight: 700;
}

.person-info {
    display: flex;
    flex-direction: column;

    gap: 3px;
}

.person-info strong {
    color: #1d2939;
    font-size: 14px;
}

.person-info small {
    color: #98a2b3;
    font-size: 12px;
}


/* =========================================================
   DONOR
========================================================= */

.donor-cell {
    display: flex;
    flex-direction: column;
    align-items: flex-start;

    gap: 5px;
}

.donor-cell strong {
    color: #1d2939;
}

.blood-badge {
    display: inline-flex;

    padding: 4px 8px;

    border-radius: 6px;

    background: #fff0f0;

    color: #d92128;

    font-size: 11px;
    font-weight: 700;
}


/* =========================================================
   CENTER
========================================================= */

.center-cell {
    display: flex;
    align-items: center;

    gap: 8px;

    color: #475467;
}

.center-cell i {
    color: #e9272f;
}


/* =========================================================
   DATE / TIME
========================================================= */

.date-cell strong {
    color: #344054;
    font-weight: 600;
}

.time-cell {
    display: flex;
    align-items: center;

    gap: 7px;

    color: #475467;
}

.time-cell i {
    color: #98a2b3;
}


/* =========================================================
   STATUS
========================================================= */

.status-badge {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    border-radius: 999px;

    font-size: 12px;
    font-weight: 600;

    white-space: nowrap;
}

.status-pending {
    background: #fff4e5;
    color: #b54708;
}

.status-confirmed {
    background: #eaf2ff;
    color: #175cd3;
}

.status-completed {
    background: #e9fbf3;
    color: #027a48;
}

.status-cancelled {
    background: #fef3f2;
    color: #b42318;
}


/* =========================================================
   ACTION BUTTONS
========================================================= */

.action-buttons {
    display: flex;
    align-items: center;

    gap: 7px;
}

.action-button {
    width: 36px;
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    cursor: pointer;

    text-decoration: none;

    transition: 0.2s;
}

.view-button {
    border: 1px solid #d0d5dd;

    background: #ffffff;

    color: #475467;
}

.view-button:hover {
    background: #f2f4f7;
}

.status-button {
    border: 1px solid #d6e4ff;

    background: #f5f8ff;

    color: #2864dc;
}

.status-button:hover {
    background: #eaf2ff;
}

.delete-button {
    border: 1px solid #fecdca;

    background: #fff7f6;

    color: #d92d20;
}

.delete-button:hover {
    background: #fef3f2;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 70px 30px;

    text-align: center;
}

.empty-icon {
    width: 70px;
    height: 70px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f2f4f7;

    color: #98a2b3;

    border-radius: 50%;

    font-size: 28px;
}

.empty-state h3 {
    margin: 0 0 8px;

    color: #344054;

    font-size: 19px;
}

.empty-state p {
    margin: 0 0 20px;

    color: #98a2b3;

    font-size: 14px;
}

.empty-reset-button {
    display: inline-flex;

    padding: 10px 18px;

    border-radius: 8px;

    background: #e9272f;

    color: #ffffff;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;
}

.empty-reset-button:hover {
    background: #c91e25;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-container {
    padding: 20px 25px;

    border-top: 1px solid #eaecf0;
}


/* =========================================================
   MODAL
========================================================= */

.modal-overlay {
    position: fixed;

    inset: 0;

    z-index: 9999;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 20px;

    background: rgba(16, 24, 40, 0.55);

    backdrop-filter: blur(3px);
}

.modal-overlay.show {
    display: flex;
}

.custom-modal {
    width: 100%;
    max-width: 520px;

    background: #ffffff;

    border-radius: 16px;

    box-shadow:
        0 20px 50px rgba(16, 24, 40, 0.2);

    overflow: hidden;

    animation: modalAppear 0.18s ease;
}

@keyframes modalAppear {

    from {
        opacity: 0;
        transform: translateY(10px) scale(0.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}

.modal-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 22px 24px;

    border-bottom: 1px solid #eaecf0;
}

.modal-title {
    display: flex;

    align-items: center;

    gap: 13px;
}

.modal-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    font-size: 18px;
}

.edit-modal-icon {
    background: #eaf2ff;
    color: #2864dc;
}

.delete-modal-icon {
    background: #fef3f2;
    color: #d92d20;
}

.modal-title h3 {
    margin: 0;

    color: #1d2939;

    font-size: 17px;
}

.modal-title p {
    margin: 4px 0 0;

    color: #98a2b3;

    font-size: 12px;
}

.modal-close {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 0;

    background: transparent;

    color: #667085;

    border-radius: 7px;

    cursor: pointer;
}

.modal-close:hover {
    background: #f2f4f7;
}

.modal-body {
    padding: 24px;
}

.modal-body label {
    display: block;

    margin-bottom: 8px;

    color: #344054;

    font-size: 14px;
    font-weight: 600;
}

.modal-body select {
    width: 100%;

    height: 50px;

    padding: 0 14px;

    border: 1px solid #d0d5dd;

    border-radius: 9px;

    background: #ffffff;

    color: #344054;

    outline: none;

    font-size: 14px;
}

.modal-body select:focus {
    border-color: #e9272f;

    box-shadow:
        0 0 0 3px rgba(233, 39, 47, 0.08);
}

.delete-warning {
    margin: 0;

    color: #475467;

    font-size: 14px;

    line-height: 1.7;
}

.modal-footer {
    display: flex;

    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding: 18px 24px;

    background: #f9fafb;

    border-top: 1px solid #eaecf0;
}

.modal-cancel,
.modal-save,
.modal-delete {
    min-height: 42px;

    padding: 0 17px;

    border-radius: 8px;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
}

.modal-cancel {
    border: 1px solid #d0d5dd;

    background: #ffffff;

    color: #344054;
}

.modal-cancel:hover {
    background: #f2f4f7;
}

.modal-save {
    border: 1px solid #e9272f;

    background: #e9272f;

    color: #ffffff;
}

.modal-save:hover {
    background: #c91e25;
}

.modal-delete {
    border: 1px solid #d92d20;

    background: #d92d20;

    color: #ffffff;
}

.modal-delete:hover {
    background: #b42318;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .stats-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .filter-form {
        grid-template-columns:
            1fr 1fr;

        align-items: end;
    }

    .search-group {
        grid-column: span 2;
    }

    .filter-buttons {
        justify-content: flex-start;
    }

}


@media (max-width: 768px) {

    .appointment-page {
        padding: 22px 16px 40px;
    }

    .page-title-area h1 {
        font-size: 25px;
    }

    .page-title-area p {
        font-size: 14px;
    }

    .appointment-announcement {
        padding: 18px;

        gap: 13px;
    }

    .announcement-top {
        align-items: flex-start;

        flex-direction: column;

        gap: 4px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .search-group {
        grid-column: auto;
    }

    .filter-buttons {
        width: 100%;
    }

    .search-button,
    .reset-button {
        flex: 1;
    }

    .modal-footer {
        flex-direction: column;
    }

    .modal-footer button,
    .modal-footer form {
        width: 100%;
    }

    .modal-footer form button {
        width: 100%;
    }

}


@media (max-width: 480px) {

    .appointment-announcement {
        flex-direction: column;
    }

    .page-title-area {
        align-items: flex-start;
    }

    .page-icon {
        width: 42px;
        height: 42px;
    }

    .page-title-area h1 {
        font-size: 22px;
    }

}

</style>


<script>

/* =========================================================
   STATUS MODAL
========================================================= */

function openStatusModal(id, currentStatus) {

    const modal = document.getElementById('statusModal');

    const form = document.getElementById('statusForm');

    const select = document.getElementById('modalStatus');

    form.action =
        "{{ url('/admin/appointments') }}/"
        + id
        + "/status";

    select.value = currentStatus;

    modal.classList.add('show');

    document.body.style.overflow = 'hidden';
}


function closeStatusModal() {

    const modal = document.getElementById('statusModal');

    modal.classList.remove('show');

    document.body.style.overflow = '';

}


/* =========================================================
   DELETE MODAL
========================================================= */

function openDeleteModal(id) {

    const modal = document.getElementById('deleteModal');

    const form = document.getElementById('deleteForm');

    form.action =
        "{{ url('/admin/appointments') }}/"
        + id;

    modal.classList.add('show');

    document.body.style.overflow = 'hidden';
}


function closeDeleteModal() {

    const modal = document.getElementById('deleteModal');

    modal.classList.remove('show');

    document.body.style.overflow = '';

}


/* =========================================================
   CLOSE MODALS WHEN CLICKING BACKDROP
========================================================= */

document.addEventListener('click', function(event) {

    const statusModal =
        document.getElementById('statusModal');

    const deleteModal =
        document.getElementById('deleteModal');


    if (event.target === statusModal) {

        closeStatusModal();

    }


    if (event.target === deleteModal) {

        closeDeleteModal();

    }

});


/* =========================================================
   ESCAPE KEY
========================================================= */

document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {

        closeStatusModal();

        closeDeleteModal();

    }

});

</script>

@endsection