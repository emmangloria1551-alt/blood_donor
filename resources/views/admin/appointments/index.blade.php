@extends('admin.layouts.app')

@section('title', 'Appointment Management')

@section('content')

<style>
    .appointment-page {
        padding: 20px;
        background: #f5f6fa;
        min-height: 100vh;
        color: #172033;
    }

    .appointment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .appointment-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        font-weight: 700;
    }

    .appointment-header p {
        margin: 0;
        color: #77839a;
    }

    .btn-add-appointment {
        display: inline-block;
        padding: 13px 18px;
        background: #ff2145;
        color: #fff;
        text-decoration: none;
        border-radius: 7px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-add-appointment:hover {
        background: #e9183b;
        color: #fff;
    }

    .appointment-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: #fff;
        border: 1px solid #e0e6f0;
        border-radius: 9px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 50%;
        background: #ffe8ed;
        color: #ff2145;
        font-size: 21px;
    }

    .stat-label {
        color: #77839a;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 25px;
        font-weight: 700;
    }

    .appointment-panel {
        background: #fff;
        border: 1px solid #e0e6f0;
        border-radius: 9px;
        padding: 20px;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .panel-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .appointment-filters {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(140px, .8fr) minmax(150px, .9fr) auto auto;
        gap: 10px;
        margin-bottom: 20px;
    }

    .appointment-filters input,
    .appointment-filters select {
        width: 100%;
        min-width: 0;
        height: 39px;
        padding: 0 11px;
        border: 1px solid #dce3ee;
        border-radius: 6px;
        background: #fff;
        color: #49566d;
    }

    .btn-search,
    .btn-reset {
        height: 39px;
        padding: 0 15px;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .btn-search {
        border: 1px solid #ff2145;
        background: #ff2145;
        color: #fff;
    }

    .btn-reset {
        border: 1px solid #dce3ee;
        background: #fff;
        color: #536078;
    }

    .appointment-table-wrapper {
        overflow-x: auto;
        border: 1px solid #e0e6f0;
        border-radius: 7px;
    }

    .appointment-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .appointment-table th {
        padding: 14px 12px;
        background: #f4f6fb;
        color: #71809a;
        font-size: 12px;
        text-align: left;
        border-bottom: 1px solid #e0e6f0;
        white-space: nowrap;
    }

    .appointment-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #edf0f5;
        font-size: 13px;
        vertical-align: middle;
    }

    .appointment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .donor-name {
        font-weight: 600;
        color: #344158;
    }

    .small-text {
        display: block;
        margin-top: 5px;
        color: #8591a5;
        font-size: 11px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-pending {
        background: #fff1d6;
        color: #986400;
    }

    .status-confirmed {
        background: #def7eb;
        color: #087c50;
    }

    .status-completed {
        background: #e4efff;
        color: #245bb5;
    }

    .status-cancelled {
        background: #edf0f4;
        color: #687386;
    }

    .appointment-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .appointment-actions form {
        margin: 0;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dce3ee;
        border-radius: 5px;
        background: #fff;
        color: #586780;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-action:hover {
        color: #ff2145;
        border-color: #ff2145;
    }

    .status-select {
        width: 112px;
        height: 32px;
        padding: 0 5px;
        border: 1px solid #dce3ee;
        border-radius: 5px;
        background: #fff;
        font-size: 11px;
    }

    .empty-state {
        padding: 45px 15px !important;
        text-align: center;
        color: #8591a5;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding-top: 18px;
        color: #77839a;
        font-size: 12px;
    }

    .alert-message {
        padding: 12px 15px;
        margin-bottom: 18px;
        border-radius: 6px;
    }

    .alert-success {
        color: #087c50;
        background: #def7eb;
    }

    .alert-error {
        color: #a51e35;
        background: #ffe8ed;
    }

    @media (max-width: 1000px) {
        .appointment-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .appointment-filters {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .appointment-page {
            padding: 12px;
        }

        .appointment-header,
        .panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .appointment-header h1 {
            font-size: 24px;
        }

        .appointment-stats {
            grid-template-columns: 1fr;
        }

        .appointment-filters {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="appointment-page">

    {{-- PAGE HEADER --}}
    <div class="appointment-header">
        <div>
            <h1>Appointment Management</h1>
            <p>Manage donation activities and reservations.</p>
        </div>

        <a href="{{ route('appointments.create') }}"
           class="btn-add-appointment">
            <i class="bi bi-plus-lg"></i>
            Add Donation Activity
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-message alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert-message alert-error">
            <strong>Please correct these errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="appointment-stats">

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div>
                <div class="stat-label">Total Appointments</div>
                <div class="stat-number">
                    {{ number_format($totalAppointments ?? 0) }}
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-label">Total Reservations</div>
                <div class="stat-number">
                    {{ number_format($totalReservations ?? 0) }}
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-calendar2-week"></i>
            </div>
            <div>
                <div class="stat-label">Available Slots</div>
                <div class="stat-number">—</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clock"></i>
            </div>
            <div>
                <div class="stat-label">Pending Appointments</div>
                <div class="stat-number">
                    {{ number_format($pendingAppointments ?? 0) }}
                </div>
            </div>
        </div>

    </div>

    {{-- APPOINTMENTS TABLE --}}
    <div class="appointment-panel">

        <div class="panel-header">
            <h2>
                <i class="bi bi-calendar-event text-danger"></i>
                Appointments
            </h2>
        </div>

        {{-- SEARCH AND FILTERS --}}
        <form method="GET"
              action="{{ route('appointments') }}"
              class="appointment-filters">

            <input
                type="search"
                name="search"
                placeholder="Search appointments..."
                value="{{ request('search') }}">

            <select name="status">
                <option value="">All Statuses</option>
                <option value="pending" @selected(request('status') === 'pending')>
                    Pending
                </option>
                <option value="confirmed" @selected(request('status') === 'confirmed')>
                    Confirmed
                </option>
                <option value="completed" @selected(request('status') === 'completed')>
                    Completed
                </option>
                <option value="cancelled" @selected(request('status') === 'cancelled')>
                    Cancelled
                </option>
            </select>

            <input
                type="date"
                name="date"
                value="{{ request('date') }}">

            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i> Search
            </button>

            <a href="{{ route('appointments') }}" class="btn-reset">
                Reset
            </a>

        </form>

        {{-- TABLE --}}
        <div class="appointment-table-wrapper">
            <table class="appointment-table">

                <thead>
                    <tr>
                        <th>Donor</th>
                        <th>Date &amp; Time</th>
                        <th>Location</th>
                        <th>Blood Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($appointments as $appointment)

                    @php
                        $status = strtolower($appointment->status ?? 'pending');

                        $statusClass = in_array(
                            $status,
                            ['pending', 'confirmed', 'completed', 'cancelled']
                        ) ? $status : 'pending';
                    @endphp

                    <tr>
                        <td>
                            <span class="donor-name">
                                {{ $appointment->user->name
                                    ?? $appointment->donor->user->name
                                    ?? 'Unknown Donor' }}
                            </span>

                            <span class="small-text">
                                {{ $appointment->user->email
                                    ?? $appointment->donor->user->email
                                    ?? '' }}
                            </span>
                        </td>

                        <td>
                            {{ $appointment->appointment_date
                                ? \Illuminate\Support\Carbon::parse($appointment->appointment_date)->format('M d, Y')
                                : '—' }}

                            <span class="small-text">
                                {{ $appointment->appointment_time
                                    ? \Illuminate\Support\Carbon::parse($appointment->appointment_time)->format('h:i A')
                                    : 'Time not set' }}
                            </span>
                        </td>

                        <td>{{ $appointment->center ?? '—' }}</td>

                        <td>{{ $appointment->donor->blood_type ?? '—' }}</td>

                        <td>
                            <span class="status-badge status-{{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td>
                            <div class="appointment-actions">

                                {{-- VIEW --}}
                                <a href="{{ route('appointments.show', $appointment) }}"
                                   class="btn-action"
                                   title="View appointment">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- CHANGE STATUS --}}
                                <form method="POST"
                                      action="{{ route('appointments.status', $appointment) }}">
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        class="status-select"
                                        aria-label="Change status"
                                        onchange="this.form.submit()">

                                        <option value="pending" @selected($status === 'pending')>
                                            Pending
                                        </option>

                                        <option value="confirmed" @selected($status === 'confirmed')>
                                            Confirmed
                                        </option>

                                        <option value="completed" @selected($status === 'completed')>
                                            Completed
                                        </option>

                                        <option value="cancelled" @selected($status === 'cancelled')>
                                            Cancelled
                                        </option>
                                    </select>
                                </form>

                                {{-- DELETE --}}
                                <form method="POST"
                                      action="{{ route('appointments.destroy', $appointment) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this appointment?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-action"
                                            title="Delete appointment">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="bi bi-calendar-x"
                               style="font-size:28px;display:block;margin-bottom:10px"></i>

                            No appointments found. Try changing your search or filters.
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="table-footer">
            <span>
                Showing {{ $appointments->count() }}
                of {{ $appointments->total() }} appointments
            </span>

            {{ $appointments->withQueryString()->links() }}
        </div>

    </div>

</div>

@endsection