@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="edit-user-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit User
            </h1>
            <p class="page-subtitle">
                Update this user's information.
            </p>
        </div>

        <a href="{{ route('admin.users') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Users
        </a>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert alert-error">
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

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- USER INFORMATION CARD --}}
    <div class="user-card">

        {{-- CARD HEADER --}}
        <div class="card-header">
            <h2>User Information</h2>
            <p>Fields marked with <span>*</span> are required.</p>
        </div>

        {{-- EDIT FORM --}}
        <form
            action="{{ route('admin.users.update', $user) }}"
            method="POST"
        >
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
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter full name"
                        autocomplete="name"
                        required
                    >
                </div>

                {{-- EMAIL ADDRESS --}}
                <div class="form-group">
                    <label for="email">
                        Email Address <span>*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Enter email address"
                        autocomplete="email"
                        required
                    >
                </div>

                {{-- NEW PASSWORD --}}
                <div class="form-group">
                    <label for="password">New Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                        autocomplete="new-password"
                    >

                    <small>
                        Leave blank to keep the current password.
                    </small>
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
                        autocomplete="new-password"
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
                                {{ old('blood_type', $user->blood_type) === $type ? 'selected' : '' }}
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- CONTACT NUMBER --}}
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>

                    <input
                        type="tel"
                        id="contact_number"
                        name="contact_number"
                        value="{{ old('contact_number', $user->contact_number) }}"
                        placeholder="e.g. 09123456789"
                        autocomplete="tel"
                    >
                </div>

                {{-- ADDRESS --}}
                <div class="form-group full-width">
                    <label for="address">Address</label>

                    <input
                        type="text"
                        id="address"
                        name="address"
                        value="{{ old('address', $user->address) }}"
                        placeholder="Enter complete address"
                        autocomplete="street-address"
                    >
                </div>

            </div>

            {{-- FORM ACTIONS --}}
            <div class="form-footer">
                <a
                    href="{{ route('admin.users') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button type="submit" class="update-btn">
                    <i class="bi bi-check-lg"></i>
                    Update User
                </button>
            </div>

        </form>
    </div>

</div>

<style>
    .edit-user-page {
        width: 100%;
        color: #172033;
    }

    .edit-user-page * {
        box-sizing: border-box;
    }

    /* PAGE HEADER */
    .edit-user-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
    }

    .edit-user-page .page-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        color: #172033;
        font-size: 30px;
        font-weight: 700;
    }

    .edit-user-page .page-title i {
        color: #dc3545;
    }

    .edit-user-page .page-subtitle {
        margin: 8px 0 0;
        color: #6b7280;
        font-size: 16px;
    }

    .edit-user-page .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        border: 1px solid #dedede;
        border-radius: 10px;
        background: #fff;
        color: #263244;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: background .2s;
    }

    .edit-user-page .back-btn:hover {
        background: #f3f4f6;
    }

    /* USER INFORMATION CARD */
    .edit-user-page .user-card {
        width: 100%;
        overflow: hidden;
        border: 1px solid #e2e2e2;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .035);
    }

    .edit-user-page .card-header {
        padding: 32px 38px;
        border-bottom: 1px solid #ededed;
    }

    .edit-user-page .card-header h2 {
        margin: 0;
        color: #172033;
        font-size: 23px;
        font-weight: 700;
    }

    .edit-user-page .card-header p {
        margin: 12px 0 0;
        color: #6b7280;
        font-size: 15px;
    }

    .edit-user-page .card-header p span {
        color: #dc3545;
    }

    /* FORM GRID */
    .edit-user-page .form-body {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px;
        padding: 38px;
    }

    .edit-user-page .form-group {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .edit-user-page .form-group.full-width {
        grid-column: 1 / -1;
    }

    .edit-user-page .form-group label {
        margin-bottom: 12px;
        color: #172033;
        font-size: 16px;
        font-weight: 600;
    }

    .edit-user-page .form-group label span {
        color: #dc3545;
    }

    .edit-user-page .form-group input,
    .edit-user-page .form-group select {
        width: 100%;
        height: 58px;
        padding: 0 16px;
        border: 1px solid #d6d6d6;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: #172033;
        font-family: inherit;
        font-size: 16px;
        transition: border-color .2s, box-shadow .2s;
    }

    .edit-user-page .form-group input::placeholder {
        color: #9ca3af;
    }

    .edit-user-page .form-group input:focus,
    .edit-user-page .form-group select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, .10);
    }

    .edit-user-page .form-group small {
        margin-top: 8px;
        color: #777;
        font-size: 12px;
        line-height: 1.5;
    }

    /* FORM FOOTER */
    .edit-user-page .form-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding: 24px 38px;
        border-top: 1px solid #ededed;
        background: #fff;
    }

    .edit-user-page .cancel-btn,
    .edit-user-page .update-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 130px;
        min-height: 48px;
        padding: 12px 20px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .edit-user-page .cancel-btn {
        border: 1px solid #d6d6d6;
        background: #fff;
        color: #374151;
    }

    .edit-user-page .cancel-btn:hover {
        background: #f3f4f6;
    }

    .edit-user-page .update-btn {
        border: 1px solid #dc3545;
        background: #dc3545;
        color: #fff;
    }

    .edit-user-page .update-btn:hover {
        background: #bb2d3b;
    }

    /* ALERTS */
    .edit-user-page .alert {
        margin-bottom: 22px;
        padding: 16px 20px;
        border-radius: 10px;
        font-size: 14px;
    }

    .edit-user-page .alert-error {
        border: 1px solid #fecdd3;
        background: #fff1f2;
        color: #9f1239;
    }

    .edit-user-page .alert-error ul {
        margin: 10px 0 0;
        padding-left: 22px;
    }

    .edit-user-page .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #bbf7d0;
        background: #ecfdf3;
        color: #166534;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .edit-user-page .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .edit-user-page .page-title {
            font-size: 25px;
        }

        .edit-user-page .card-header {
            padding: 25px 22px;
        }

        .edit-user-page .form-body {
            grid-template-columns: 1fr;
            gap: 22px;
            padding: 24px 22px;
        }

        .edit-user-page .form-group.full-width {
            grid-column: auto;
        }

        .edit-user-page .form-footer {
            padding: 20px 22px;
        }
    }

    @media (max-width: 420px) {
        .edit-user-page .form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .edit-user-page .cancel-btn,
        .edit-user-page .update-btn {
            width: 100%;
        }

        .edit-user-page .form-group input,
        .edit-user-page .form-group select {
            height: 52px;
            font-size: 14px;
        }
    }
</style>

@endsection