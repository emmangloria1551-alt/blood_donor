@extends('admin.layouts.app')

@section('title', 'Add Appointment')

@section('content')

<style>
    .create-appointment {
        max-width: 1000px;
        margin: 20px auto;
        padding: 25px;
        background: #f7f8fc;
        color: #253047;
    }

    .create-header {
        margin-bottom: 25px;
    }

    .create-header h2 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 700;
    }

    .create-header p {
        margin: 0;
        color: #7c879c;
    }

    .appointment-card {
        background: #fff;
        border: 1px solid #e1e6ef;
        border-radius: 10px;
        padding: 25px;
    }

    .form-section-title {
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e8ecf3;
        font-size: 18px;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 13px;
    }

    .form-control-custom {
        width: 100%;
        min-height: 43px;
        padding: 10px 12px;
        border: 1px solid #dce2ec;
        border-radius: 6px;
        background: #fff;
        color: #344158;
        font-size: 14px;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #ff2145;
        box-shadow: 0 0 0 3px rgba(255, 33, 69, .10);
    }

    textarea.form-control-custom {
        min-height: 100px;
        resize: vertical;
    }

    .required {
        color: #ff2145;
    }

    .field-error {
        margin-top: 6px;
        color: #dc3545;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        border-top: 1px solid #e8ecf3;
    }

    .btn-save {
        padding: 11px 20px;
        border: 1px solid #ff2145;
        border-radius: 6px;
        background: #ff2145;
        color: white;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save:hover {
        background: #e91c3d;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 11px 20px;
        border: 1px solid #dce2ec;
        border-radius: 6px;
        background: white;
        color: #59667c;
        text-decoration: none;
    }

    .alert-error {
        margin-bottom: 20px;
        padding: 13px 16px;
        border-radius: 6px;
        background: #fff0f2;
        color: #a51e35;
    }

    @media (max-width: 600px) {
        .create-appointment {
            padding: 12px;
        }

        .appointment-card {
            padding: 17px;
        }

        .create-header h2 {
            font-size: 23px;
        }
    }
</style>

<div class="create-appointment">

    {{-- PAGE HEADER --}}
    <div class="create-header">
        <h2>Add Appointment</h2>
        <p>Schedule a blood donation appointment for a registered donor.</p>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert-error">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- APPOINTMENT FORM --}}
    <div class="appointment-card">

        <h3 class="form-section-title">Appointment Information</h3>

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- DONOR --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="donor_id">
                            Select Donor <span class="required">*</span>
                        </label>

                        <select
                            id="donor_id"
                            name="donor_id"
                            class="form-control-custom"
                            required>

                            <option value="">-- Select a donor --</option>

                            @forelse($donors as $donor)
                                <option
                                    value="{{ $donor->id }}"
                                    @selected((string) old('donor_id') === (string) $donor->id)>

                                    {{ $donor->user->name ?? 'Unknown Donor' }}
                                    — {{ $donor->blood_type ?? 'Blood type not specified' }}

                                </option>
                            @empty
                                <option value="" disabled>No registered donors available</option>
                            @endforelse

                        </select>

                        @error('donor_id')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- DONATION CENTER --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="center">
                            Donation Center <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="center"
                            name="center"
                            class="form-control-custom"
                            placeholder="Enter donation center"
                            value="{{ old('center') }}"
                            maxlength="255"
                            required>

                        @error('center')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- DATE --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="appointment_date">
                            Appointment Date <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            id="appointment_date"
                            name="appointment_date"
                            class="form-control-custom"
                            value="{{ old('appointment_date') }}"
                            required>

                        @error('appointment_date')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- TIME --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="appointment_time">
                            Appointment Time <span class="required">*</span>
                        </label>

                        <input
                            type="time"
                            id="appointment_time"
                            name="appointment_time"
                            class="form-control-custom"
                            value="{{ old('appointment_time') }}"
                            required>

                        @error('appointment_time')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">
                            Appointment Status <span class="required">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-control-custom"
                            required>

                            <option value="pending" @selected(old('status', 'pending') === 'pending')>
                                Pending
                            </option>

                            <option value="confirmed" @selected(old('status') === 'confirmed')>
                                Confirmed
                            </option>

                            <option value="completed" @selected(old('status') === 'completed')>
                                Completed
                            </option>

                            <option value="cancelled" @selected(old('status') === 'cancelled')>
                                Cancelled
                            </option>

                        </select>

                        @error('status')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- NOTES --}}
                <div class="col-12">
                    <div class="form-group">
                        <label for="notes">Notes (Optional)</label>

                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control-custom"
                            placeholder="Enter additional information..."
                            maxlength="2000">{{ old('notes') }}</textarea>

                        @error('notes')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- BUTTONS --}}
            <div class="form-actions">

                <a href="{{ route('appointments') }}" class="btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn-save">
                    <i class="bi bi-check-lg"></i>
                    Save Appointment
                </button>

            </div>

        </form>
    </div>

</div>

@endsection