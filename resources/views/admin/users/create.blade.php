@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')

<div class="add-user-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-heading">
            <div class="heading-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <h1>Add User</h1>

            <p>Create a new user account.</p>
        </div>

        <a href="{{ route('admin.users') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Users</span>
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
            <div class="error-title">
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following errors:
            </div>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- USER FORM CARD --}}
    <div class="form-card">

        <div class="form-card-header">
            <h2>User Information</h2>
            <p>Fill in the information below to create a user account.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- FULL NAME --}}
                <div class="form-group">
                    <label for="name">
                        Full Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter full name"
                        autocomplete="name"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group">
                    <label for="email">
                        Email Address <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                        autocomplete="email"
                        maxlength="255"
                        required
                    >

                    @error('email')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group">
                    <label for="password">
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimum 8 characters"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >

                    @error('password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="form-group">
                    <label for="password_confirmation">
                        Confirm Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Enter password again"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                </div>

                {{-- BLOOD TYPE --}}
                <div class="form-group">
                    <label for="blood_type">Blood Type</label>

                    <select id="blood_type" name="blood_type">
                        <option value="">Select blood type</option>

                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                            <option
                                value="{{ $type }}"
                                @selected(old('blood_type') === $type)
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>

                    @error('blood_type')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- CONTACT NUMBER --}}
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>

                    <input
                        type="tel"
                        id="contact_number"
                        name="contact_number"
                        value="{{ old('contact_number') }}"
                        placeholder="Enter phone number"
                        autocomplete="tel"
                        maxlength="50"
                    >

                    @error('contact_number')
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
                        value="{{ old('address') }}"
                        placeholder="Enter complete address"
                        autocomplete="street-address"
                        maxlength="255"
                    >

                    @error('address')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- FORM FOOTER --}}
            <div class="form-footer">
                <a href="{{ route('admin.users') }}" class="cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="submit-btn">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Add User</span>
                </button>
            </div>

        </form>

    </div>

</div>

<style>
/* PAGE BACKGROUND AND LAYOUT */
.add-user-page {
    box-sizing: border-box;
    width: 100%;
    max-width: none;
    min-height: 100vh;
    margin: 0;
    padding: 28px;
    background: #f5f6fb;
    color: #172b45;
    font-family: inherit;
}

.add-user-page *,
.add-user-page *::before,
.add-user-page *::after {
    box-sizing: border-box;
}

/* PAGE HEADER */
.add-user-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    margin: 0 0 60px;
}

.add-user-page .page-heading {
    min-width: 0;
}

.add-user-page .heading-icon {
    color: #b50927;
    font-size: 30px;
    line-height: 1;
    margin-bottom: 12px;
}

.add-user-page .page-heading h1 {
    margin: 0;
    color: #252a30;
    font-size: 48px;
    font-weight: 500;
    line-height: 1.2;
    letter-spacing: -1px;
}

.add-user-page .page-heading p {
    margin: 14px 0 0;
    color: #172b45;
    font-size: 30px;
    font-weight: 700;
    line-height: 1.3;
}

/* BACK BUTTON */
.add-user-page .back-btn {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-height: 54px;
    padding: 14px 20px;
    border: 1px solid #d5ddeb;
    border-radius: 11px;
    background: #fff;
    color: #172b45;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    transition: background .2s ease, border-color .2s ease;
}

.add-user-page .back-btn:hover {
    background: #f9fafc;
    border-color: #b50927;
    color: #b50927;
}

/* ALERTS */
.add-user-page .error-alert,
.add-user-page .success-alert {
    margin: 0 0 22px;
    padding: 16px 20px;
    border-radius: 10px;
    font-size: 14px;
}

.add-user-page .error-alert {
    background: #fff0f1;
    border: 1px solid #f3c3ca;
    color: #842029;
}

.add-user-page .success-alert {
    background: #eafaf1;
    border: 1px solid #b7e4c7;
    color: #16834b;
}

.add-user-page .error-title {
    margin-bottom: 8px;
    font-weight: 700;
}

.add-user-page .error-alert ul {
    margin: 0;
    padding-left: 22px;
}

/* FORM CARD */
.add-user-page .form-card {
    width: 100%;
    overflow: hidden;
    border: 1px solid #e1e6ef;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(25, 42, 70, .02);
}

/* FORM CARD HEADER */
.add-user-page .form-card-header {
    padding: 28px 32px;
    border-bottom: 1px solid #e9edf4;
}

.add-user-page .form-card-header h2 {
    margin: 0;
    color: #172b45;
    font-size: 23px;
    font-weight: 500;
    line-height: 1.4;
}

.add-user-page .form-card-header p {
    margin: 8px 0 0;
    color: #718096;
    font-size: 14px;
    line-height: 1.6;
}

/* FORM GRID */
.add-user-page .form-body {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    column-gap: 28px;
    row-gap: 30px;
    padding: 32px;
}

.add-user-page .form-group {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.add-user-page .full-width {
    grid-column: 1 / -1;
}

/* LABELS */
.add-user-page .form-group label {
    margin: 0 0 11px;
    color: #172b45;
    font-size: 15px;
    font-weight: 500;
    line-height: 1.4;
}

.add-user-page .required {
    color: #c8102e;
}

/* INPUTS AND SELECTS */
.add-user-page .form-group input,
.add-user-page .form-group select {
    display: block;
    width: 100%;
    height: 57px;
    margin: 0;
    padding: 0 15px;
    border: 1px solid #d3dce9;
    border-radius: 11px;
    outline: none;
    background: #fff;
    color: #172b45;
    font-family: inherit;
    font-size: 14px;
    font-weight: 400;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.add-user-page .form-group input::placeholder {
    color: #8b98aa;
    opacity: 1;
}

.add-user-page .form-group input:focus,
.add-user-page .form-group select:focus {
    border-color: #b50927;
    box-shadow: 0 0 0 3px rgba(181, 9, 39, .08);
}

.add-user-page .field-error {
    margin-top: 7px;
    color: #b50927;
    font-size: 12px;
}

/* FOOTER */
.add-user-page .form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 14px;
    padding: 24px 32px;
    border-top: 1px solid #e9edf4;
    background: #fafafa;
}

/* CANCEL BUTTON */
.add-user-page .cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 150px;
    min-height: 55px;
    padding: 14px 24px;
    border: 1px solid #d7dce4;
    border-radius: 12px;
    background: #fff;
    color: #172b45;
    font-size: 16px;
    font-weight: 500;
    text-decoration: none;
    transition: background .2s ease;
}

.add-user-page .cancel-btn:hover {
    background: #f1f3f7;
    color: #172b45;
}

/* RED ADD USER BUTTON */
.add-user-page .submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-width: 150px;
    min-height: 55px;
    padding: 14px 24px;
    border: 1px solid #b50927;
    border-radius: 12px;
    background: #b50927;
    color: #fff;
    font-family: inherit;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.2;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
}

.add-user-page .submit-btn i {
    font-size: 16px;
}

.add-user-page .submit-btn:hover {
    border-color: #97071f;
    background: #97071f;
    color: #fff;
}

.add-user-page .submit-btn:active {
    transform: translateY(1px);
}

.add-user-page .submit-btn:focus-visible,
.add-user-page .cancel-btn:focus-visible,
.add-user-page .back-btn:focus-visible {
    outline: 3px solid rgba(181, 9, 39, .25);
    outline-offset: 3px;
}

/* MEDIUM SCREENS */
@media (max-width: 900px) {
    .add-user-page {
        padding: 22px;
    }

    .add-user-page .page-header {
        margin-bottom: 40px;
    }

    .add-user-page .page-heading h1 {
        font-size: 40px;
    }

    .add-user-page .page-heading p {
        font-size: 23px;
    }

    .add-user-page .form-body {
        gap: 24px;
        padding: 26px;
    }

    .add-user-page .form-card-header {
        padding: 25px 26px;
    }

    .add-user-page .form-footer {
        padding: 22px 26px;
    }
}

/* MOBILE */
@media (max-width: 600px) {
    .add-user-page {
        padding: 18px 14px;
    }

    .add-user-page .page-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 32px;
    }

    .add-user-page .heading-icon {
        font-size: 26px;
    }

    .add-user-page .page-heading h1 {
        font-size: 36px;
    }

    .add-user-page .page-heading p {
        margin-top: 9px;
        font-size: 20px;
    }

    .add-user-page .back-btn {
        min-height: 48px;
    }

    .add-user-page .form-card {
        border-radius: 14px;
    }

    .add-user-page .form-card-header {
        padding: 22px 20px;
    }

    .add-user-page .form-card-header h2 {
        font-size: 21px;
    }

    .add-user-page .form-body {
        grid-template-columns: minmax(0, 1fr);
        gap: 22px;
        padding: 24px 20px;
    }

    .add-user-page .full-width {
        grid-column: auto;
    }

    .add-user-page .form-group input,
    .add-user-page .form-group select {
        height: 53px;
    }

    .add-user-page .form-footer {
        gap: 10px;
        padding: 18px 20px;
    }

    .add-user-page .cancel-btn,
    .add-user-page .submit-btn {
        flex: 1;
        min-width: 0;
        min-height: 50px;
        padding: 12px 10px;
        font-size: 14px;
    }
}
</style>

@endsection