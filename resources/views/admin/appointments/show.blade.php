@extends('admin.layouts.app')

@section('title', 'Appointment Details')

@section('content')

<div class="appointment-details-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-calendar-check-fill"></i>
                Appointment Details
            </h1>

            <p class="page-subtitle">
                View and manage appointment information.
            </p>
        </div>

        {{-- FIXED BACK BUTTON --}}
        <a href="{{ url('/admin/appointments') }}" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back to Appointments
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if (session('error'))
        <div class="alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            <strong>Please check the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $status = strtolower($appointment->status ?? 'pending');

        $statusClass = match ($status) {
            'confirmed', 'approved' => 'status-confirmed',
            'completed' => 'status-completed',
            'cancelled', 'canceled' => 'status-cancelled',
            default => 'status-pending',
        };
    @endphp

    {{-- APPOINTMENT SUMMARY --}}
    <div class="appointment-summary-card">
        <div class="summary-icon">
            <i class="bi bi-calendar2-check-fill"></i>
        </div>

        <div class="summary-information">
            <span class="summary-label">Appointment ID</span>
            <h2>#{{ $appointment->id }}</h2>
            <span class="status-badge {{ $statusClass }}">
                {{ ucfirst($status) }}
            </span>
        </div>
    </div>

    {{-- APPOINTMENT INFORMATION --}}
    <div class="details-card">
        <div class="card-heading">
            <i class="bi bi-info-circle-fill"></i>
            <h2>Appointment Information</h2>
        </div>

        <div class="details-grid">

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-person-fill"></i>
                    User ID
                </span>
                <span class="detail-value">
                    {{ $appointment->user_id ?? 'Not assigned' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Donor ID
                </span>
                <span class="detail-value">
                    {{ $appointment->donor_id ?? 'Not assigned' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-geo-alt-fill"></i>
                    Donation Center
                </span>
                <span class="detail-value">
                    {{ $appointment->center ?: 'Not specified' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-calendar-event-fill"></i>
                    Appointment Date
                </span>
                <span class="detail-value">
                    @if ($appointment->appointment_date)
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                    @else
                        Not specified
                    @endif
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-clock-fill"></i>
                    Appointment Time
                </span>
                <span class="detail-value">
                    @if ($appointment->appointment_time)
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                    @else
                        Not specified
                    @endif
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-flag-fill"></i>
                    Current Status
                </span>
                <span class="detail-value">
                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($status) }}
                    </span>
                </span>
            </div>

            <div class="detail-item full-width">
                <span class="detail-label">
                    <i class="bi bi-card-text"></i>
                    Appointment Notes
                </span>

                <p class="notes-content">
                    {{ $appointment->notes ?: 'No notes provided.' }}
                </p>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-calendar-plus"></i>
                    Created At
                </span>
                <span class="detail-value">
                    @if ($appointment->created_at)
                        {{ $appointment->created_at->format('M d, Y h:i A') }}
                    @else
                        Not available
                    @endif
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">
                    <i class="bi bi-arrow-clockwise"></i>
                    Last Updated
                </span>
                <span class="detail-value">
                    @if ($appointment->updated_at)
                        {{ $appointment->updated_at->format('M d, Y h:i A') }}
                    @else
                        Not available
                    @endif
                </span>
            </div>

        </div>
    </div>

    {{-- UPDATE APPOINTMENT STATUS --}}
    <div class="details-card">
        <div class="card-heading">
            <i class="bi bi-pencil-square"></i>
            <h2>Manage Appointment</h2>
        </div>

        <p class="manage-description">
            Update the appointment status using the form below.
        </p>

        <form
            action="{{ url('/admin/appointments/' . $appointment->id) }}"
            method="POST"
            class="status-form"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Appointment Status</label>

                <select name="status" id="status" required>
                    <option value="pending"
                        {{ $status === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="confirmed"
                        {{ $status === 'confirmed' ? 'selected' : '' }}>
                        Confirmed
                    </option>

                    <option value="completed"
                        {{ $status === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="cancelled"
                        {{ in_array($status, ['cancelled', 'canceled']) ? 'selected' : '' }}>
                        Cancelled
                    </option>
                </select>

                @error('status')
                    <small class="validation-error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="update-button">
                <i class="bi bi-check-circle-fill"></i>
                Update Appointment
            </button>
        </form>
    </div>

</div>

<style>
    .appointment-details-page {
        padding: 24px;
        color: #1f2937;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .page-title {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-title i {
        color: #dc2626;
        margin-right: 8px;
    }

    .page-subtitle {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 18px;
        background: #ffffff;
        color: #374151;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .back-button:hover {
        background: #f3f4f6;
        color: #b91c1c;
        border-color: #b91c1c;
    }

    .appointment-summary-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
        margin-bottom: 22px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    }

    .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 65px;
        height: 65px;
        flex-shrink: 0;
        background: #fee2e2;
        color: #dc2626;
        border-radius: 14px;
        font-size: 28px;
    }

    .summary-label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .summary-information h2 {
        margin: 0 0 10px;
        font-size: 24px;
        font-weight: 700;
    }

    .details-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 25px;
        margin-bottom: 22px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    }

    .card-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 18px;
        margin-bottom: 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-heading > i {
        color: #dc2626;
        font-size: 21px;
    }

    .card-heading h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 9px;
        min-width: 0;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
    }

    .detail-label i {
        color: #dc2626;
        margin-right: 5px;
    }

    .detail-value {
        color: #111827;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .notes-content {
        padding: 15px;
        margin: 0;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        color: #4b5563;
        line-height: 1.7;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .manage-description {
        margin: -5px 0 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .status-form {
        display: flex;
        align-items: flex-end;
        gap: 15px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 220px;
    }

    .form-group label {
        display: block;
        margin-bottom: 9px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #ffffff;
        color: #111827;
        font-size: 14px;
        outline: none;
    }

    .form-group select:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .update-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 20px;
        border: none;
        border-radius: 8px;
        background: #dc2626;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .update-button:hover {
        background: #b91c1c;
    }

    .alert-success,
    .alert-error {
        padding: 14px 18px;
        margin-bottom: 20px;
        border-radius: 9px;
        font-size: 14px;
    }

    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-error ul {
        margin: 8px 0 0;
        padding-left: 22px;
    }

    .validation-error {
        display: block;
        margin-top: 6px;
        color: #dc2626;
    }

    @media (max-width: 640px) {
        .appointment-details-page {
            padding: 15px;
        }

        .page-title {
            font-size: 23px;
        }

        .details-card,
        .appointment-summary-card {
            padding: 18px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .full-width {
            grid-column: auto;
        }

        .status-form {
            align-items: stretch;
            flex-direction: column;
        }

        .update-button {
            width: 100%;
        }
    }
</style>

@endsection