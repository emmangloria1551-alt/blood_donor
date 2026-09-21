@extends('admin.layouts.app')

@section('title', 'Appointment Details')

@section('content')

<div class="appointment-show-page">

    {{-- HEADER --}}
    <div class="show-header">

        <div>
            <h1 class="page-title">
                <i class="bi bi-calendar-check-fill"></i>
                Appointment Details
            </h1>

            <p class="page-subtitle">
                View and manage appointment information.
            </p>
        </div>

        <a
            href="{{ route('admin.appointments') }}"
            class="back-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Appointments
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-box success-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="alert-box error-alert">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert-box error-alert">
            <i class="bi bi-exclamation-circle-fill"></i>

            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- MAIN CARD --}}
    <div class="details-card">

        {{-- CARD HEADER --}}
        <div class="details-header">

            <div class="details-title">

                <div class="calendar-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>
                    <h2>
                        Appointment #{{ $appointment->id }}
                    </h2>

                    <p>
                        Created
                        {{ $appointment->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>

            </div>


            {{-- CURRENT STATUS --}}
            <div>

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

            </div>

        </div>


        {{-- DETAILS BODY --}}
        <div class="details-body">

            {{-- USER INFORMATION --}}
            <div class="information-section">

                <div class="section-heading">
                    <i class="bi bi-person-fill"></i>
                    User Information
                </div>

                <div class="information-grid">

                    <div class="information-item">

                        <span class="information-label">
                            Name
                        </span>

                        <strong>
                            {{ $appointment->user->name ?? 'Unknown User' }}
                        </strong>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Email
                        </span>

                        <strong>
                            {{ $appointment->user->email ?? 'No email available' }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- DONOR INFORMATION --}}
            <div class="information-section">

                <div class="section-heading">
                    <i class="bi bi-droplet-fill"></i>
                    Donor Information
                </div>

                <div class="information-grid">

                    <div class="information-item">

                        <span class="information-label">
                            Blood Type
                        </span>

                        @if($appointment->donor)

                            <span class="blood-type">
                                {{ $appointment->donor->blood_type }}
                            </span>

                        @else

                            <strong>
                                No donor assigned
                            </strong>

                        @endif

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Phone
                        </span>

                        <strong>
                            {{ $appointment->donor->phone ?? 'No phone available' }}
                        </strong>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Address
                        </span>

                        <strong>
                            {{ $appointment->donor->address ?? 'No address available' }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- APPOINTMENT INFORMATION --}}
            <div class="information-section">

                <div class="section-heading">
                    <i class="bi bi-calendar-event"></i>
                    Appointment Information
                </div>

                <div class="information-grid">

                    <div class="information-item">

                        <span class="information-label">
                            Donation Center
                        </span>

                        <strong>
                            <i class="bi bi-geo-alt-fill location-icon"></i>
                            {{ $appointment->center }}
                        </strong>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Date
                        </span>

                        <strong>
                            {{ $appointment->appointment_date->format('F d, Y') }}
                        </strong>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Day
                        </span>

                        <strong>
                            {{ $appointment->appointment_date->format('l') }}
                        </strong>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Time
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- NOTES --}}
            <div class="information-section">

                <div class="section-heading">
                    <i class="bi bi-chat-left-text-fill"></i>
                    Notes
                </div>

                <div class="notes-box">

                    @if($appointment->notes)

                        {{ $appointment->notes }}

                    @else

                        <span class="no-notes">
                            No notes were added to this appointment.
                        </span>

                    @endif

                </div>

            </div>


            {{-- STATUS MANAGEMENT --}}
            <div class="status-management">

                <div class="section-heading">
                    <i class="bi bi-sliders"></i>
                    Update Appointment Status
                </div>

                <p class="status-description">
                    Select a new status for this appointment.
                </p>


                <div class="status-buttons">

                    {{-- PENDING --}}
                    <form
                        method="POST"
                        action="{{ route('admin.appointments.status', $appointment) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="pending"
                        >

                        <button
                            type="submit"
                            class="status-action status-action-pending
                            {{ $appointment->status === 'pending' ? 'active-status' : '' }}"
                        >
                            <i class="bi bi-clock-fill"></i>
                            Pending
                        </button>

                    </form>


                    {{-- CONFIRMED --}}
                    <form
                        method="POST"
                        action="{{ route('admin.appointments.status', $appointment) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="confirmed"
                        >

                        <button
                            type="submit"
                            class="status-action status-action-confirmed
                            {{ $appointment->status === 'confirmed' ? 'active-status' : '' }}"
                        >
                            <i class="bi bi-check-circle-fill"></i>
                            Confirm
                        </button>

                    </form>


                    {{-- COMPLETED --}}
                    <form
                        method="POST"
                        action="{{ route('admin.appointments.status', $appointment) }}"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="completed"
                        >

                        <button
                            type="submit"
                            class="status-action status-action-completed
                            {{ $appointment->status === 'completed' ? 'active-status' : '' }}"
                        >
                            <i class="bi bi-check2-all"></i>
                            Complete
                        </button>

                    </form>


                    {{-- CANCELLED --}}
                    <form
                        method="POST"
                        action="{{ route('admin.appointments.status', $appointment) }}"
                        onsubmit="return confirm('Are you sure you want to cancel this appointment?');"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="cancelled"
                        >

                        <button
                            type="submit"
                            class="status-action status-action-cancelled
                            {{ $appointment->status === 'cancelled' ? 'active-status' : '' }}"
                        >
                            <i class="bi bi-x-circle-fill"></i>
                            Cancel
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="details-footer">

            <a
                href="{{ route('admin.appointments') }}"
                class="footer-button back-footer-button"
            >
                <i class="bi bi-arrow-left"></i>
                Back
            </a>


            <form
                method="POST"
                action="{{ route('admin.appointments.destroy', $appointment) }}"
                onsubmit="return confirm('Are you sure you want to delete this appointment?');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="footer-button delete-footer-button"
                >
                    <i class="bi bi-trash"></i>
                    Delete Appointment
                </button>

            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.appointment-show-page {
    width: 100%;
    color: #172033;
}


/* =========================================================
   HEADER
========================================================= */

.appointment-show-page .show-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.appointment-show-page .page-title {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #172033;
    display: flex;
    align-items: center;
    gap: 10px;
}

.appointment-show-page .page-title i {
    color: #e32929;
}

.appointment-show-page .page-subtitle {
    margin: 7px 0 0;
    color: #718096;
    font-size: 14px;
}

.appointment-show-page .back-button {
    height: 42px;
    padding: 0 15px;
    border: 1px solid #d7dce2;
    border-radius: 8px;
    background: #ffffff;
    color: #374151;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.appointment-show-page .back-button:hover {
    background: #f9fafb;
}


/* =========================================================
   ALERT
========================================================= */

.appointment-show-page .alert-box {
    padding: 13px 16px;
    border-radius: 9px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
}

.appointment-show-page .success-alert {
    background: #ecfdf3;
    color: #087443;
    border: 1px solid #bbf7d0;
}

.appointment-show-page .error-alert {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
}


/* =========================================================
   CARD
========================================================= */

.appointment-show-page .details-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    overflow: hidden;
}


/* =========================================================
   CARD HEADER
========================================================= */

.appointment-show-page .details-header {
    padding: 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.appointment-show-page .details-title {
    display: flex;
    align-items: center;
    gap: 14px;
}

.appointment-show-page .calendar-icon {
    width: 52px;
    height: 52px;
    border-radius: 10px;
    background: #fee2e2;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.appointment-show-page .details-title h2 {
    margin: 0 0 4px;
    color: #172033;
    font-size: 19px;
}

.appointment-show-page .details-title p {
    margin: 0;
    color: #8a94a3;
    font-size: 12px;
}


/* =========================================================
   BODY
========================================================= */

.appointment-show-page .details-body {
    padding: 25px;
}

.appointment-show-page .information-section {
    padding-bottom: 25px;
    margin-bottom: 25px;
    border-bottom: 1px solid #edf0f3;
}

.appointment-show-page .information-section:last-of-type {
    margin-bottom: 0;
}

.appointment-show-page .section-heading {
    color: #172033;
    font-size: 15px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
}

.appointment-show-page .section-heading i {
    color: #e32929;
}


/* =========================================================
   INFORMATION
========================================================= */

.appointment-show-page .information-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.appointment-show-page .information-item {
    padding: 15px;
    border: 1px solid #edf0f3;
    border-radius: 9px;
    background: #fafbfc;
}

.appointment-show-page .information-label {
    display: block;
    color: #8a94a3;
    font-size: 12px;
    margin-bottom: 6px;
}

.appointment-show-page .information-item strong {
    color: #374151;
    font-size: 14px;
    font-weight: 600;
}

.appointment-show-page .location-icon {
    color: #ef4444;
    margin-right: 4px;
}


/* =========================================================
   BLOOD TYPE
========================================================= */

.appointment-show-page .blood-type {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 6px;
    background: #fff1f2;
    color: #dc2626;
    font-size: 13px;
    font-weight: 700;
}


/* =========================================================
   NOTES
========================================================= */

.appointment-show-page .notes-box {
    padding: 16px;
    border: 1px solid #edf0f3;
    border-radius: 9px;
    background: #fafbfc;
    color: #4b5563;
    font-size: 14px;
    line-height: 1.6;
}

.appointment-show-page .no-notes {
    color: #9ca3af;
}


/* =========================================================
   CURRENT STATUS
========================================================= */

.appointment-show-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.appointment-show-page .status-pending {
    background: #fff7ed;
    color: #c2410c;
}

.appointment-show-page .status-confirmed {
    background: #eff6ff;
    color: #2563eb;
}

.appointment-show-page .status-completed {
    background: #ecfdf5;
    color: #047857;
}

.appointment-show-page .status-cancelled {
    background: #fef2f2;
    color: #dc2626;
}

.appointment-show-page .status-default {
    background: #f3f4f6;
    color: #4b5563;
}


/* =========================================================
   STATUS MANAGEMENT
========================================================= */

.appointment-show-page .status-management {
    margin-top: 25px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    background: #fafbfc;
}

.appointment-show-page .status-management .section-heading {
    margin-bottom: 6px;
}

.appointment-show-page .status-description {
    margin: 0 0 17px;
    color: #8a94a3;
    font-size: 13px;
}

.appointment-show-page .status-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.appointment-show-page .status-buttons form {
    margin: 0;
}

.appointment-show-page .status-action {
    min-height: 42px;
    padding: 0 15px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #ffffff;
}


/* PENDING */

.appointment-show-page .status-action-pending {
    border: 1px solid #fed7aa;
    color: #c2410c;
}

.appointment-show-page .status-action-pending:hover,
.appointment-show-page .status-action-pending.active-status {
    background: #fff7ed;
}


/* CONFIRMED */

.appointment-show-page .status-action-confirmed {
    border: 1px solid #bfdbfe;
    color: #2563eb;
}

.appointment-show-page .status-action-confirmed:hover,
.appointment-show-page .status-action-confirmed.active-status {
    background: #eff6ff;
}


/* COMPLETED */

.appointment-show-page .status-action-completed {
    border: 1px solid #a7f3d0;
    color: #047857;
}

.appointment-show-page .status-action-completed:hover,
.appointment-show-page .status-action-completed.active-status {
    background: #ecfdf5;
}


/* CANCELLED */

.appointment-show-page .status-action-cancelled {
    border: 1px solid #fecaca;
    color: #dc2626;
}

.appointment-show-page .status-action-cancelled:hover,
.appointment-show-page .status-action-cancelled.active-status {
    background: #fef2f2;
}


/* =========================================================
   FOOTER
========================================================= */

.appointment-show-page .details-footer {
    padding: 18px 25px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.appointment-show-page .details-footer form {
    margin: 0;
}

.appointment-show-page .footer-button {
    min-height: 42px;
    padding: 0 15px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
}

.appointment-show-page .back-footer-button {
    background: #ffffff;
    border: 1px solid #d7dce2;
    color: #374151;
}

.appointment-show-page .back-footer-button:hover {
    background: #f9fafb;
}

.appointment-show-page .delete-footer-button {
    background: #dc2626;
    border: 1px solid #dc2626;
    color: #ffffff;
}

.appointment-show-page .delete-footer-button:hover {
    background: #b91c1c;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .appointment-show-page .show-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .appointment-show-page .page-title {
        font-size: 24px;
    }

    .appointment-show-page .details-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .appointment-show-page .information-grid {
        grid-template-columns: 1fr;
    }

    .appointment-show-page .status-buttons {
        flex-direction: column;
    }

    .appointment-show-page .status-buttons form,
    .appointment-show-page .status-action {
        width: 100%;
    }

    .appointment-show-page .details-footer {
        align-items: stretch;
        flex-direction: column;
    }

    .appointment-show-page .footer-button {
        width: 100%;
    }

}

</style>

@endsection