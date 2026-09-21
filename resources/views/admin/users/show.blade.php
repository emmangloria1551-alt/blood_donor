@extends('admin.layouts.app')

@section('title', 'View User')

@section('content')

<div class="user-show-page">

    <div class="show-header">

        <div>
            <h1>
                <i class="bi bi-person-fill"></i>
                User Details
            </h1>

            <p>
                View information about this user.
            </p>
        </div>

        <a href="{{ route('admin.users') }}" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back to Users
        </a>

    </div>


    <div class="user-card">

        <div class="profile-section">

            <div class="profile-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>

                <h2>
                    {{ $user->name }}
                </h2>

                <p>
                    {{ $user->email }}
                </p>

            </div>

        </div>


        <div class="details-grid">

            <div class="detail">
                <span>Name</span>
                <strong>{{ $user->name }}</strong>
            </div>

            <div class="detail">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>

            <div class="detail">
                <span>Blood Type</span>
                <strong>{{ $user->blood_type ?? 'Not provided' }}</strong>
            </div>

            <div class="detail">
                <span>Role</span>
                <strong>
                    {{ $user->role === 'admin' ? 'Administrator' : 'User' }}
                </strong>
            </div>

            <div class="detail">
                <span>Status</span>

                @if($user->status === 'active')
                    <span class="status active">
                        Active
                    </span>
                @else
                    <span class="status blocked">
                        Blocked
                    </span>
                @endif
            </div>

            <div class="detail">
                <span>Registered</span>
                <strong>
                    {{ $user->created_at?->format('M d, Y') }}
                </strong>
            </div>

        </div>


        <div class="user-actions">

            <a
                href="{{ route('admin.users.edit', $user) }}"
                class="edit-button"
            >
                <i class="bi bi-pencil"></i>
                Edit User
            </a>

            <form
                method="POST"
                action="{{ route('admin.users.destroy', $user) }}"
                onsubmit="return confirm('Are you sure you want to delete this user?');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="delete-button"
                >
                    <i class="bi bi-trash"></i>
                    Delete User
                </button>

            </form>

        </div>

    </div>

</div>


<style>

.user-show-page {
    padding: 10px 0 40px;
}

.user-show-page .show-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.user-show-page h1 {
    margin: 0;
    font-size: 25px;
    color: #222;
}

.user-show-page h1 i {
    color: #dc3545;
}

.user-show-page .show-header p {
    margin: 5px 0 0;
    color: #777;
    font-size: 14px;
}

.user-show-page .back-button {
    padding: 9px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: white;
    color: #555;
    text-decoration: none;
    font-size: 14px;
}

.user-show-page .user-card {
    padding: 25px;
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
}

.user-show-page .profile-section {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-bottom: 22px;
    border-bottom: 1px solid #eee;
}

.user-show-page .profile-avatar {
    width: 58px;
    height: 58px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #fcebed;
    color: #dc3545;
    font-size: 23px;
    font-weight: 600;
}

.user-show-page .profile-section h2 {
    margin: 0;
    font-size: 20px;
    color: #222;
}

.user-show-page .profile-section p {
    margin: 4px 0 0;
    color: #777;
}

.user-show-page .details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 25px 0;
}

.user-show-page .detail span:first-child {
    display: block;
    margin-bottom: 5px;
    color: #888;
    font-size: 13px;
}

.user-show-page .detail strong {
    color: #333;
    font-size: 14px;
}

.user-show-page .status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.user-show-page .status.active {
    background: #eaf7ef;
    color: #198754;
}

.user-show-page .status.blocked {
    background: #fcebed;
    color: #dc3545;
}

.user-show-page .user-actions {
    display: flex;
    gap: 10px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.user-show-page .edit-button,
.user-show-page .delete-button {
    padding: 9px 15px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
}

.user-show-page .edit-button {
    background: #dc3545;
    color: white;
}

.user-show-page .delete-button {
    border: none;
    background: #fff1f2;
    color: #dc3545;
    cursor: pointer;
}

@media (max-width: 700px) {

    .user-show-page .show-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 12px;
    }

    .user-show-page .details-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endsection