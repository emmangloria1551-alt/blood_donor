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

        <div class="error-alert">

            <div class="error-title">
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following:
            </div>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="success-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- EDIT FORM --}}
    <div class="form-card">

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
                        Full Name
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter full name"
                        required
                    >

                </div>


                {{-- EMAIL --}}
                <div class="form-group">

                    <label for="email">
                        Email Address
                        <span>*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Enter email address"
                        required
                    >

                </div>


                {{-- BLOOD TYPE --}}
                <div class="form-group">

                    <label for="blood_type">
                        Blood Type
                    </label>

                    <select
                        id="blood_type"
                        name="blood_type"
                    >

                        <option value="">
                            Select blood type
                        </option>

                        <option value="A+"
                            {{ old('blood_type', $user->blood_type) === 'A+' ? 'selected' : '' }}>
                            A+
                        </option>

                        <option value="A-"
                            {{ old('blood_type', $user->blood_type) === 'A-' ? 'selected' : '' }}>
                            A-
                        </option>

                        <option value="B+"
                            {{ old('blood_type', $user->blood_type) === 'B+' ? 'selected' : '' }}>
                            B+
                        </option>

                        <option value="B-"
                            {{ old('blood_type', $user->blood_type) === 'B-' ? 'selected' : '' }}>
                            B-
                        </option>

                        <option value="AB+"
                            {{ old('blood_type', $user->blood_type) === 'AB+' ? 'selected' : '' }}>
                            AB+
                        </option>

                        <option value="AB-"
                            {{ old('blood_type', $user->blood_type) === 'AB-' ? 'selected' : '' }}>
                            AB-
                        </option>

                        <option value="O+"
                            {{ old('blood_type', $user->blood_type) === 'O+' ? 'selected' : '' }}>
                            O+
                        </option>

                        <option value="O-"
                            {{ old('blood_type', $user->blood_type) === 'O-' ? 'selected' : '' }}>
                            O-
                        </option>

                    </select>

                </div>


                {{-- ROLE --}}
                <div class="form-group">

                    <label for="role">
                        Role
                        <span>*</span>
                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                    >

                        <option value="user"
                            {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                            User
                        </option>

                        <option value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            Administrator
                        </option>

                    </select>

                </div>


                {{-- CONTACT NUMBER --}}
                <div class="form-group">

                    <label for="contact_number">
                        Contact Number
                    </label>

                    <input
                        type="text"
                        id="contact_number"
                        name="contact_number"
                        value="{{ old('contact_number', $user->contact_number) }}"
                        placeholder="e.g. 09123456789"
                    >

                </div>


                {{-- ADDRESS --}}
                <div class="form-group">

                    <label for="address">
                        Address
                    </label>

                    <input
                        type="text"
                        id="address"
                        name="address"
                        value="{{ old('address', $user->address) }}"
                        placeholder="Enter complete address"
                    >

                </div>


                {{-- AVAILABILITY --}}
                <div class="form-group">

                    <label for="availability">
                        Availability
                        <span>*</span>
                    </label>

                    <select
                        id="availability"
                        name="availability"
                        required
                    >

                        <option value="offline"
                            {{ old('availability', $user->availability ?? 'offline') === 'offline' ? 'selected' : '' }}>
                            Offline
                        </option>

                        <option value="online"
                            {{ old('availability', $user->availability ?? 'offline') === 'online' ? 'selected' : '' }}>
                            Online
                        </option>

                    </select>

                </div>


                {{-- NEW PASSWORD --}}
                <div class="form-group">

                    <label for="password">
                        New Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                    >

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
                        placeholder="Confirm new password"
                    >

                </div>

            </div>


            {{-- FORM FOOTER --}}
            <div class="form-footer">

                <a
                    href="{{ route('admin.users') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="update-btn"
                >
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
}

.edit-user-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.edit-user-page .page-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.edit-user-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.edit-user-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}

.edit-user-page .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 16px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid #ddd;
    color: #444;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.edit-user-page .back-btn:hover {
    background: #f5f5f5;
    color: #222;
}

.edit-user-page .error-alert {
    margin-bottom: 20px;
    padding: 15px 18px;
    border-radius: 9px;
    background: #fff0f1;
    border: 1px solid #f5c2c7;
    color: #842029;
}

.edit-user-page .error-title {
    font-weight: 700;
    margin-bottom: 8px;
}

.edit-user-page .error-alert ul {
    margin: 0;
    padding-left: 20px;
}

.edit-user-page .success-alert {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    padding: 13px 16px;
    border-radius: 9px;
    background: #e8f7ee;
    border: 1px solid #b7e4c7;
    color: #146c43;
    font-size: 14px;
    font-weight: 600;
}

.edit-user-page .form-card {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
}

.edit-user-page .form-body {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
    padding: 28px 32px;
}

.edit-user-page .form-group {
    display: flex;
    flex-direction: column;
}

.edit-user-page .form-group label {
    margin-bottom: 8px;
    color: #333;
    font-size: 14px;
    font-weight: 600;
}

.edit-user-page .form-group label span {
    color: #dc3545;
}

.edit-user-page .form-group input,
.edit-user-page .form-group select {
    width: 100%;
    height: 48px;
    padding: 0 14px;
    border: 1px solid #d9d9d9;
    border-radius: 8px;
    background: #fff;
    color: #333;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
}

.edit-user-page .form-group input:focus,
.edit-user-page .form-group select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08);
}

.edit-user-page .form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 20px 32px;
    border-top: 1px solid #eee;
    background: #fafafa;
}

.edit-user-page .cancel-btn,
.edit-user-page .update-btn {
    min-width: 120px;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.edit-user-page .cancel-btn {
    background: #fff;
    border: 1px solid #ddd;
    color: #444;
}

.edit-user-page .cancel-btn:hover {
    background: #f1f1f1;
}

.edit-user-page .update-btn {
    border: none;
    background: #dc3545;
    color: #fff;
}

.edit-user-page .update-btn:hover {
    background: #bb2d3b;
}

@media (max-width: 768px) {

    .edit-user-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .edit-user-page .form-body {
        grid-template-columns: 1fr;
        padding: 20px;
    }

    .edit-user-page .form-footer {
        padding: 20px;
    }

}

</style>

@endsection