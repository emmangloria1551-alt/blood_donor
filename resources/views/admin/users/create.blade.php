@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')

<div class="user-form-page">

    <div class="form-header">

        <div>
            <h1>
                <i class="bi bi-person-plus-fill"></i>
                Add User
            </h1>

            <p>
                Create a new user account.
            </p>
        </div>

        <a href="{{ route('admin.users') }}" class="back-button">
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


    <div class="form-card">

        <form
            method="POST"
            action="{{ route('admin.users.store') }}"
        >

            @csrf


            <div class="form-grid">

                {{-- NAME --}}
                <div class="form-group">

                    <label>
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter full name"
                        required
                    >

                </div>


                {{-- EMAIL --}}
                <div class="form-group">

                    <label>
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                        required
                    >

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimum 8 characters"
                        required
                    >

                </div>


                {{-- CONFIRM PASSWORD --}}
                <div class="form-group">

                    <label>
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        required
                    >

                </div>


                {{-- BLOOD TYPE --}}
                <div class="form-group">

                    <label>
                        Blood Type
                    </label>

                    <select name="blood_type">

                        <option value="">
                            Select blood type
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
                                {{ old('blood_type') === $type ? 'selected' : '' }}
                            >
                                {{ $type }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- ROLE --}}
                <div class="form-group">

                    <label>
                        Role
                    </label>

                    <select name="role" required>

                        <option
                            value="user"
                            {{ old('role', 'user') === 'user' ? 'selected' : '' }}
                        >
                            User
                        </option>

                        <option
                            value="admin"
                            {{ old('role') === 'admin' ? 'selected' : '' }}
                        >
                            Administrator
                        </option>

                    </select>

                </div>


                {{-- STATUS --}}
                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select name="status" required>

                        <option
                            value="active"
                            {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="blocked"
                            {{ old('status') === 'blocked' ? 'selected' : '' }}
                        >
                            Blocked
                        </option>

                    </select>

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
                    Add User
                </button>

            </div>

        </form>

    </div>

</div>


<style>

.user-form-page {
    padding: 10px 0 40px;
}

.user-form-page .form-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.user-form-page h1 {
    margin: 0;
    color: #222;
    font-size: 25px;
    font-weight: 600;
}

.user-form-page h1 i {
    color: #dc3545;
}

.user-form-page .form-header p {
    margin: 5px 0 0;
    color: #777;
    font-size: 14px;
}

.user-form-page .back-button {
    padding: 9px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    color: #555;
    background: white;
    text-decoration: none;
    font-size: 14px;
}

.user-form-page .error-box {
    margin-bottom: 20px;
    padding: 14px;
    border: 1px solid #f1b5bb;
    border-radius: 7px;
    background: #fff1f2;
    color: #842029;
    font-size: 14px;
}

.user-form-page .error-box ul {
    margin: 7px 0 0;
}

.user-form-page .form-card {
    padding: 25px;
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
}

.user-form-page .form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.user-form-page .form-group label {
    display: block;
    margin-bottom: 7px;
    color: #444;
    font-size: 14px;
    font-weight: 600;
}

.user-form-page .form-group input,
.user-form-page .form-group select {
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

.user-form-page .form-group input:focus,
.user-form-page .form-group select:focus {
    border-color: #dc3545;
}

.user-form-page .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.user-form-page .cancel-button,
.user-form-page .save-button {
    padding: 9px 15px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
}

.user-form-page .cancel-button {
    border: 1px solid #ddd;
    background: white;
    color: #555;
}

.user-form-page .save-button {
    border: none;
    background: #dc3545;
    color: white;
    cursor: pointer;
}

.user-form-page .save-button:hover {
    background: #bb2d3b;
}

@media (max-width: 700px) {

    .user-form-page .form-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 12px;
    }

    .user-form-page .form-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endsection