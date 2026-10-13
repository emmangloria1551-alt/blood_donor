@extends('admin.layouts.app')

@section('title', 'Donor Details')

@section('content')
<div class="donor-details-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-person-fill"></i>
                Donor Details
            </h1>
            <p class="page-subtitle">
                View information about this donor.
            </p>
        </div>

        <a href="{{ route('admin.donors') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Donors
        </a>
    </div>

    {{-- DONOR DETAILS CARD --}}
    <div class="details-card">

        {{-- DONOR PROFILE --}}
        <div class="profile-header">
            <div class="avatar">
                {{ strtoupper(substr($donor->user->name ?? 'D', 0, 1)) }}
            </div>

            <div class="profile-info">
                <h2>{{ $donor->user->name ?? 'Unknown Donor' }}</h2>
                <p>{{ $donor->user->email ?? 'No email available' }}</p>
            </div>
        </div>

        <div class="details-divider"></div>

        {{-- DONOR INFORMATION --}}
        <div class="details-grid">

            <div class="detail-item">
                <span class="detail-label">Full Name</span>
                <strong>{{ $donor->user->name ?? 'Not set' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email Address</span>
                <strong>{{ $donor->user->email ?? 'Not set' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Blood Type</span>
                <strong>{{ $donor->blood_type ?? 'Not set' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone Number</span>
                <strong>{{ $donor->phone ?? 'Not set' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Address</span>
                <strong>{{ $donor->address ?? 'Not set' }}</strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Date Registered</span>
                <strong>
                    {{ $donor->created_at
                        ? $donor->created_at->format('M d, Y')
                        : 'Not available' }}
                </strong>
            </div>

            <div class="detail-item">
                <span class="detail-label">Status</span>
                <strong>
                    <span class="status-badge {{ $donor->is_active ? 'active' : 'inactive' }}">
                        {{ $donor->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </strong>
            </div>

        </div>

        <div class="details-divider bottom-divider"></div>

        {{-- ACTION BUTTONS --}}
        <div class="action-buttons">
            <a href="{{ route('admin.donors.edit', $donor->id) }}"
               class="edit-btn">
                <i class="bi bi-pencil-square"></i>
                Edit Donor
            </a>

            <form action="{{ route('admin.donors.destroy', $donor->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this donor profile?');">
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-btn">
                    <i class="bi bi-trash"></i>
                    Delete Donor
                </button>
            </form>
        </div>

    </div>
</div>

<style>
.donor-details-page {
    width: 100%;
    color: #222;
    padding: 0;
}

.donor-details-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.donor-details-page .page-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
    font-size: 30px;
    font-weight: 600;
    color: #252525;
}

.donor-details-page .page-title i {
    color: #e3344b;
    font-size: 27px;
}

.donor-details-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 16px;
}

.donor-details-page .back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
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

.donor-details-page .back-btn:hover {
    background: #f5f5f5;
    border-color: #ccc;
}

.donor-details-page .details-card {
    width: 100%;
    box-sizing: border-box;
    padding: 30px 32px;
    background: #fff;
    border: 1px solid #e2e2e2;
    border-radius: 10px;
}

.donor-details-page .profile-header {
    display: flex;
    align-items: center;
    gap: 19px;
    padding-bottom: 27px;
}

.donor-details-page .avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #fdebed;
    color: #e3344b;
    font-size: 28px;
    font-weight: 500;
}

.donor-details-page .profile-info h2 {
    margin: 0 0 7px;
    color: #222;
    font-size: 25px;
    font-weight: 600;
}

.donor-details-page .profile-info p {
    margin: 0;
    color: #777;
    font-size: 17px;
    overflow-wrap: anywhere;
}

.donor-details-page .details-divider {
    width: 100%;
    height: 1px;
    background: #e9e9e9;
    margin-bottom: 27px;
}

.donor-details-page .details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    column-gap: 35px;
    row-gap: 28px;
    padding-bottom: 29px;
}

.donor-details-page .detail-item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    min-width: 0;
}

.donor-details-page .detail-label {
    color: #858585;
    font-size: 14px;
}

.donor-details-page .detail-item strong {
    color: #292929;
    font-size: 16px;
    font-weight: 700;
    overflow-wrap: anywhere;
}

.donor-details-page .status-badge {
    display: inline-block;
    padding: 8px 13px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.donor-details-page .status-badge.active {
    background: #e7f7ee;
    color: #168653;
}

.donor-details-page .status-badge.inactive {
    background: #fdebed;
    color: #c6283d;
}

.donor-details-page .bottom-divider {
    margin: 0 0 25px;
}

.donor-details-page .action-buttons {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
}

.donor-details-page .action-buttons form {
    margin: 0;
}

.donor-details-page .edit-btn,
.donor-details-page .delete-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 46px;
    box-sizing: border-box;
    padding: 12px 18px;
    border: none;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
}

.donor-details-page .edit-btn {
    background: #e3344b;
    color: #fff;
}

.donor-details-page .edit-btn:hover {
    background: #c9273d;
    color: #fff;
}

.donor-details-page .delete-btn {
    background: #fff0f1;
    color: #e3344b;
}

.donor-details-page .delete-btn:hover {
    background: #fbdfe2;
}

@media (max-width: 700px) {
    .donor-details-page .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .donor-details-page .details-card {
        padding: 22px 18px;
    }

    .donor-details-page .details-grid {
        grid-template-columns: 1fr;
        row-gap: 22px;
    }

    .donor-details-page .profile-info h2 {
        font-size: 21px;
    }

    .donor-details-page .action-buttons {
        align-items: stretch;
        flex-direction: column;
    }

    .donor-details-page .action-buttons form,
    .donor-details-page .edit-btn,
    .donor-details-page .delete-btn {
        width: 100%;
    }
}
</style>
@endsection