@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')

<div class="add-user-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-person-plus-fill"></i>
                Add User
            </h1>

            <p class="page-subtitle">
                Create a new user account.
            </p>
        </div>

        <a href="{{ route('admin.users') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Users
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

    {{-- FORM CARD --}}
    <div class="form-card">

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-card-header">
                <h2>User Information</h2>
                <p>Fields marked with <span class="required-mark">*</span> are required.</p>
            </div>

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
                        Email Address <span>*</span>
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
                        Password <span>*</span>
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
                        Confirm Password <span>*</span>
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
                        placeholder="e.g. 09123456789"
                        autocomplete="tel"
                        maxlength="30"
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

                <button type="submit" class="add-btn">
                    <i class="bi bi-person-plus-fill"></i>
                    Add User
                </button>
            </div>

        </form>

    </div>

</div>

<style>
/* PAGE */
.add-user-page {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    color: #222;
}

.add-user-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.add-user-page .page-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.add-user-page .page-title i {
    margin-right: 8px;
    color: #c8102e;
}

.add-user-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}

.add-user-page .back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 11px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fff;
    color: #444;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: .2s ease;
}

.add-user-page .back-btn:hover {
    background: #f5f5f5;
}

/* ALERTS */
.add-user-page .error-alert,
.add-user-page .success-alert {
    margin-bottom: 20px;
    padding: 15px 18px;
    border-radius: 9px;
}

.add-user-page .error-alert {
    background: #fff0f1;
    border: 1px solid #f5c2c7;
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
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, .04);
}

.add-user-page .form-card-header {
    padding: 24px 30px;
    border-bottom: 1px solid #eee;
}

.add-user-page .form-card-header h2 {
    margin: 0;
    font-size: 19px;
    font-weight: 700;
}

.add-user-page .form-card-header p {
    margin: 7px 0 0;
    font-size: 13px;
    color: #777;
}

.add-user-page .required-mark,
.add-user-page .form-group label span {
    color: #c8102e;
}

/* FORM FIELDS */
.add-user-page .form-body {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
    padding: 28px 30px;
}

.add-user-page .form-group {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.add-user-page .full-width {
    grid-column: 1 / -1;
}

.add-user-page .form-group label {
    margin-bottom: 8px;
    color: #333;
    font-size: 14px;
    font-weight: 600;
}

.add-user-page .form-group input,
.add-user-page .form-group select {
    box-sizing: border-box;
    width: 100%;
    height: 46px;
    padding: 0 13px;
    border: 1px solid #d9d9d9;
    border-radius: 8px;
    background: #fff;
    color: #333;
    font-family: inherit;
    font-size: 14px;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}

.add-user-page .form-group input::placeholder {
    color: #aaa;
}

.add-user-page .form-group input:focus,
.add-user-page .form-group select:focus {
    border-color: #c8102e;
    box-shadow: 0 0 0 3px rgba(200, 16, 46, .09);
}

.add-user-page .field-error {
    margin-top: 6px;
    color: #c8102e;
    font-size: 12px;
}

/* BUTTONS */
.add-user-page .form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    padding: 20px 30px;
    border-top: 1px solid #eee;
    background: #fafafa;
}

.add-user-page .cancel-btn,
.add-user-page .add-btn {
    min-width: 120px;
    min-height: 44px;
    box-sizing: border-box;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background .2s ease;
}

.add-user-page .cancel-btn {
    border: 1px solid #ddd;
    background: #fff;
    color: #444;
}

.add-user-page .cancel-btn:hover {
    background: #f1f1f1;
}

.add-user-page .add-btn {
    border: 1px solid #c8102e;
    background: #c8102e;
    color: #fff;
}

.add-user-page .add-btn:hover {
    border-color: #a70d26;
    background: #a70d26;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .add-user-page .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .add-user-page .form-card-header {
        padding: 22px 20px;
    }

    .add-user-page .form-body {
        grid-template-columns: 1fr;
        gap: 18px;
        padding: 22px 20px;
    }

    .add-user-page .full-width {
        grid-column: auto;
    }

    .add-user-page .form-footer {
        padding: 18px 20px;
    }

    .add-user-page .cancel-btn,
    .add-user-page .add-btn {
        flex: 1;
        min-width: 0;
    }
}
</style>

@endsection