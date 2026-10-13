@extends('admin.layouts.app')

@section('title', 'Edit Donor')

@section('content')

<div class="edit-donor-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-person-fill-gear"></i>
                Edit Donor
            </h1>
            <p class="page-subtitle">
                Update the donor's account and personal information.
            </p>
        </div>

        <a href="{{ route('admin.donors') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Donors
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="error-alert">
            <strong>
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following errors:
            </strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- EDIT DONOR FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h2>Donor Information</h2>
            <p>Update the information below to maintain the donor's record.</p>
        </div>

        <form action="{{ route('admin.donors.update', $donor->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-body">

                {{-- FULL NAME --}}
                <div class="form-group">
                    <label for="name">
                        Full Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $donor->user->name ?? '') }}"
                        placeholder="Enter full name"
                        maxlength="255"
                        autocomplete="name"
                        required
                    >

                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group">
                    <label for="email">
                        Email Address <span>*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $donor->user->email ?? '') }}"
                        placeholder="Enter email address"
                        maxlength="255"
                        autocomplete="email"
                        required
                    >

                    @error('email')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- NEW PASSWORD --}}
                <div class="form-group">
                    <label for="password">New Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                        minlength="8"
                        autocomplete="new-password"
                    >

                    <small class="field-help">
                        Leave blank to keep the current password.
                    </small>

                    @error('password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="form-group">
                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Enter password again"
                        minlength="8"
                        autocomplete="new-password"
                    >
                </div>

                {{-- BLOOD TYPE --}}
                <div class="form-group">
                    <label for="blood_type">
                        Blood Type <span>*</span>
                    </label>

                    <select id="blood_type" name="blood_type" required>
                        <option value="">Select blood type</option>

                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                            <option
                                value="{{ $type }}"
                                @selected(old('blood_type', $donor->blood_type) === $type)
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>

                    @error('blood_type')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PHONE NUMBER --}}
                <div class="form-group">
                    <label for="phone">Phone Number</label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $donor->phone) }}"
                        placeholder="Enter phone number"
                        maxlength="30"
                        autocomplete="tel"
                    >

                    @error('phone')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ADDRESS --}}
                <div class="form-group full-width">
                    <label for="address">Address</label>

                    <input
                        type="text"
                        id="address"
                        name="address"
                        value="{{ old('address', $donor->address) }}"
                        placeholder="Enter complete address"
                        maxlength="1000"
                        autocomplete="street-address"
                    >

                    @error('address')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- DONOR STATUS --}}
                <div class="form-group">
                    <label for="is_active">Donor Status</label>

                    <select id="is_active" name="is_active">
                        <option value="1"
                            @selected((string) old('is_active', (int) $donor->is_active) === '1')>
                            Active
                        </option>

                        <option value="0"
                            @selected((string) old('is_active', (int) $donor->is_active) === '0')>
                            Inactive
                        </option>
                    </select>

                    @error('is_active')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- FORM FOOTER --}}
            <div class="form-footer">
                <a href="{{ route('admin.donors') }}" class="cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="update-btn">
                    <i class="bi bi-check-lg"></i>
                    Update Donor
                </button>
            </div>

        </form>
    </div>

</div>

<style>
.edit-donor-page {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    color: #222;
}

.edit-donor-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.edit-donor-page .page-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #252525;
}

.edit-donor-page .page-title i {
    color: #e3344b;
}

.edit-donor-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 16px;
}

.edit-donor-page .back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 17px;
    border: 1px solid #ddd;
    border-radius: 9px;
    background: #fff;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    white-space: nowrap;
    transition: .2s ease;
}

.edit-donor-page .back-btn:hover {
    background: #f5f5f5;
}

.edit-donor-page .form-card {
    width: 100%;
    overflow: hidden;
    box-sizing: border-box;
    background: #fff;
    border: 1px solid #e2e2e2;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .025);
}

.edit-donor-page .form-card-header {
    padding: 30px 38px;
    border-bottom: 1px solid #eaeaea;
}

.edit-donor-page .form-card-header h2 {
    margin: 0;
    color: #222;
    font-size: 23px;
    font-weight: 700;
}

.edit-donor-page .form-card-header p {
    margin: 9px 0 0;
    color: #777;
    font-size: 15px;
}

.edit-donor-page .form-body {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    column-gap: 35px;
    row-gap: 27px;
    padding: 34px 38px;
}

.edit-donor-page .form-group {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.edit-donor-page .full-width {
    grid-column: 1 / -1;
}

.edit-donor-page .form-group label {
    margin-bottom: 12px;
    color: #222;
    font-size: 16px;
    font-weight: 600;
}

.edit-donor-page .form-group label span {
    color: #dc3545;
}

.edit-donor-page .form-group input,
.edit-donor-page .form-group select {
    display: block;
    width: 100%;
    height: 58px;
    box-sizing: border-box;
    padding: 0 20px;
    border: 1px solid #d6d6d6;
    border-radius: 13px;
    outline: none;
    background: #fff;
    color: #222;
    font-family: inherit;
    font-size: 16px;
    transition: border-color .2s, box-shadow .2s;
}

.edit-donor-page .form-group input::placeholder {
    color: #9a9a9a;
}

.edit-donor-page .form-group input:focus,
.edit-donor-page .form-group select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, .09);
}

.edit-donor-page .field-help {
    margin-top: 10px;
    color: #777;
    font-size: 13px;
}

.edit-donor-page .field-error {
    margin-top: 7px;
    color: #dc3545;
    font-size: 13px;
}

.edit-donor-page .form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
    padding: 30px 38px;
    border-top: 1px solid #eaeaea;
    background: #fff;
}

.edit-donor-page .cancel-btn,
.edit-donor-page .update-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-width: 165px;
    min-height: 60px;
    box-sizing: border-box;
    padding: 15px 24px;
    border-radius: 13px;
    font-family: inherit;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
}

.edit-donor-page .cancel-btn {
    border: 1px solid #d8d8d8;
    background: #fff;
    color: #333;
}

.edit-donor-page .cancel-btn:hover {
    background: #f5f5f5;
}

.edit-donor-page .update-btn {
    border: 1px solid #dc3545;
    background: #dc3545;
    color: #fff;
}

.edit-donor-page .update-btn:hover {
    border-color: #c82333;
    background: #c82333;
}

.edit-donor-page .success-alert,
.edit-donor-page .error-alert {
    margin-bottom: 20px;
    padding: 16px 20px;
    border-radius: 10px;
}

.edit-donor-page .success-alert {
    border: 1px solid #b7e4c7;
    background: #eafaf1;
    color: #16834b;
}

.edit-donor-page .error-alert {
    border: 1px solid #f5c2c7;
    background: #fff0f1;
    color: #842029;
}

.edit-donor-page .error-alert ul {
    margin: 10px 0 0;
    padding-left: 22px;
}

@media (max-width: 768px) {
    .edit-donor-page .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .edit-donor-page .form-card-header {
        padding: 24px 20px;
    }

    .edit-donor-page .form-body {
        grid-template-columns: 1fr;
        gap: 22px;
        padding: 25px 20px;
    }

    .edit-donor-page .full-width {
        grid-column: auto;
    }

    .edit-donor-page .form-footer {
        padding: 20px;
        gap: 10px;
    }

    .edit-donor-page .cancel-btn,
    .edit-donor-page .update-btn {
        min-width: 0;
        min-height: 50px;
        flex: 1;
        padding: 12px;
        font-size: 14px;
    }
}
</style>

@endsection