@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="edit-user-page">

    <div class="edit-header">

        <div>
            <h1>
                <i class="bi bi-pencil-square"></i>
                Edit User
            </h1>

            <p>
                Update this user's information.
            </p>
        </div>

        <a
            href="{{ route('admin.users') }}"
            class="back-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Users
        </a>

    </div>


    @if($errors->any())

        <div class="error-box">

            <strong>Please fix the following:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <div class="edit-card">

        <form
            method="POST"
            action="{{ route('admin.users.update', $user) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-grid">

                <div class="form-group">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Blood Type</label>

                    <select name="blood_type">

                        <option value="">
                            No blood type
                        </option>

                        @foreach([
                            'A+',
                            'A-',
                            'B+',
                            'B-',
                            'AB+',
                            'AB-',
                            'O+',
                            'O-'
                        ] as $type)

                            <option
                                value="{{ $type }}"
                                {{ old('blood_type', $user->blood_type) === $type ? 'selected' : '' }}
                            >
                                {{ $type }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label>Role</label>

                    <select name="role" required>

                        <option
                            value="user"
                            {{ old('role', $user->role) === 'user' ? 'selected' : '' }}
                        >
                            User
                        </option>

                        <option
                            value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                        >
                            Administrator
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Status</label>

                    <select name="status" required>

                        <option
                            value="active"
                            {{ old('status', $user->status) === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="blocked"
                            {{ old('status', $user->status) === 'blocked' ? 'selected' : '' }}
                        >
                            Blocked
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                    >

                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('admin.users') }}"
                    class="cancel-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="save-button"
                >
                    <i class="bi bi-check-lg"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


<style>

.edit-user-page {
    padding: 10px 0 40px;
}

.edit-user-page .edit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.edit-user-page h1 {
    margin: 0;
    color: #222;
    font-size: 25px;
}

.edit-user-page h1 i {
    color: #dc3545;
}

.edit-user-page .edit-header p {
    margin: 5px 0 0;
    color: #777;
    font-size: 14px;
}

.edit-user-page .back-button {
    padding: 9px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: white;
    color: #555;
    text-decoration: none;
    font-size: 14px;
}

.edit-user-page .error-box {
    margin-bottom: 20px;
    padding: 14px;
    border: 1px solid #f1b5bb;
    border-radius: 7px;
    background: #fff1f2;
    color: #842029;
    font-size: 14px;
}

.edit-user-page .error-box ul {
    margin: 7px 0 0;
}

.edit-user-page .edit-card {
    padding: 25px;
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
}

.edit-user-page .form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.edit-user-page .form-group label {
    display: block;
    margin-bottom: 7px;
    color: #444;
    font-size: 14px;
    font-weight: 600;
}

.edit-user-page .form-group input,
.edit-user-page .form-group select {
    width: 100%;
    height: 40px;
    box-sizing: border-box;
    padding: 0 12px;
    border: 1px solid #d8d8d8;
    border-radius: 6px;
    outline: none;
    background: white;
    color: #333;
    font-size: 14px;
}

.edit-user-page .form-group input:focus,
.edit-user-page .form-group select:focus {
    border-color: #dc3545;
}

.edit-user-page .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.edit-user-page .cancel-button,
.edit-user-page .save-button {
    padding: 9px 15px;
    border-radius: 6px;
    font-size: 14px;
}

.edit-user-page .cancel-button {
    border: 1px solid #ddd;
    background: white;
    color: #555;
    text-decoration: none;
}

.edit-user-page .save-button {
    border: none;
    background: #dc3545;
    color: white;
    cursor: pointer;
}

@media (max-width: 700px) {

    .edit-user-page .edit-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 12px;
    }

    .edit-user-page .form-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endsection