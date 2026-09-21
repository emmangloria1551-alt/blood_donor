@extends('admin.layouts.app')

@section('title', 'Donation Center Details')

@section('content')

<div class="center-details-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-hospital"></i>
                Donation Center Details
            </h1>

            <p class="page-subtitle">
                View the complete information about this donation center.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.centers.edit', $center) }}" class="btn-edit">
                <i class="bi bi-pencil"></i>
                Edit Center
            </a>

            <a href="{{ route('admin.centers') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
        </div>
    </div>


    {{-- CENTER INFORMATION --}}
    <div class="details-card">

        <div class="details-card-header">
            <div class="center-icon">
                <i class="bi bi-hospital-fill"></i>
            </div>

            <div>
                <h2>{{ $center->name }}</h2>

                @if($center->status === 'open')
                    <span class="status-badge status-open">
                        <i class="bi bi-check-circle-fill"></i>
                        Open
                    </span>
                @else
                    <span class="status-badge status-closed">
                        <i class="bi bi-x-circle-fill"></i>
                        Closed
                    </span>
                @endif
            </div>
        </div>


        {{-- INFORMATION GRID --}}
        <div class="info-grid">

            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-geo-alt"></i>
                    Location
                </span>

                <strong>
                    {{ $center->location }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-telephone"></i>
                    Contact Number
                </span>

                <strong>
                    {{ $center->contact_number ?: 'Not provided' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-clock"></i>
                    Opening Time
                </span>

                <strong>
                    {{ $center->opening_time
                        ? \Carbon\Carbon::parse($center->opening_time)->format('h:i A')
                        : 'Not provided' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-clock-history"></i>
                    Closing Time
                </span>

                <strong>
                    {{ $center->closing_time
                        ? \Carbon\Carbon::parse($center->closing_time)->format('h:i A')
                        : 'Not provided' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-calendar-plus"></i>
                    Date Added
                </span>

                <strong>
                    {{ $center->created_at
                        ? $center->created_at->format('M d, Y')
                        : 'Not available' }}
                </strong>
            </div>


            <div class="info-item">
                <span class="info-label">
                    <i class="bi bi-arrow-clockwise"></i>
                    Last Updated
                </span>

                <strong>
                    {{ $center->updated_at
                        ? $center->updated_at->format('M d, Y')
                        : 'Not available' }}
                </strong>
            </div>

        </div>


        {{-- DESCRIPTION --}}
        <div class="description-section">

            <h3>
                <i class="bi bi-info-circle"></i>
                Description
            </h3>

            <div class="description-box">
                {{ $center->description ?: 'No description provided for this donation center.' }}
            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="bottom-actions">

            <a href="{{ route('admin.centers.edit', $center) }}" class="btn-primary">
                <i class="bi bi-pencil"></i>
                Edit Center
            </a>

            <form
                action="{{ route('admin.centers.destroy', $center) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this donation center?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-danger">
                    <i class="bi bi-trash"></i>
                    Delete Center
                </button>
            </form>

        </div>

    </div>

</div>


<style>
.center-details-page {
    width: 100%;
}

.center-details-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.center-details-page .page-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.center-details-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.center-details-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}

.center-details-page .header-actions {
    display: flex;
    gap: 10px;
}

.center-details-page .btn-edit,
.center-details-page .btn-back,
.center-details-page .btn-primary,
.center-details-page .btn-danger {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    text-decoration: none;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.center-details-page .btn-edit {
    background: #dc3545;
    color: white;
}

.center-details-page .btn-edit:hover {
    background: #bb2d3b;
    color: white;
}

.center-details-page .btn-back {
    background: #f1f1f1;
    color: #444;
}

.center-details-page .btn-back:hover {
    background: #e2e2e2;
    color: #222;
}

.center-details-page .details-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.center-details-page .details-card-header {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 25px;
    border-bottom: 1px solid #eee;
}

.center-details-page .center-icon {
    width: 58px;
    height: 58px;
    border-radius: 12px;
    background: #fff0f1;
    color: #dc3545;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.center-details-page .details-card-header h2 {
    margin: 0 0 8px;
    font-size: 22px;
    font-weight: 700;
    color: #222;
}

.center-details-page .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.center-details-page .status-open {
    background: #e8f7ee;
    color: #198754;
}

.center-details-page .status-closed {
    background: #fce8ea;
    color: #dc3545;
}

.center-details-page .info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 25px;
}

.center-details-page .info-item {
    padding: 18px;
    border: 1px solid #eeeeee;
    border-radius: 10px;
    background: #fafafa;
}

.center-details-page .info-label {
    display: block;
    margin-bottom: 8px;
    color: #777;
    font-size: 13px;
    font-weight: 600;
}

.center-details-page .info-label i {
    color: #dc3545;
    margin-right: 5px;
}

.center-details-page .info-item strong {
    display: block;
    color: #333;
    font-size: 15px;
}

.center-details-page .description-section {
    padding: 0 25px 25px;
}

.center-details-page .description-section h3 {
    margin: 0 0 12px;
    font-size: 16px;
    font-weight: 700;
    color: #333;
}

.center-details-page .description-section h3 i {
    color: #dc3545;
    margin-right: 6px;
}

.center-details-page .description-box {
    padding: 16px;
    min-height: 80px;
    border-radius: 10px;
    background: #fafafa;
    border: 1px solid #eee;
    color: #555;
    line-height: 1.6;
}

.center-details-page .bottom-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 20px 25px;
    background: #fafafa;
    border-top: 1px solid #eee;
}

.center-details-page .btn-primary {
    background: #dc3545;
    color: white;
}

.center-details-page .btn-primary:hover {
    background: #bb2d3b;
}

.center-details-page .btn-danger {
    background: #fff;
    color: #dc3545;
    border: 1px solid #dc3545;
}

.center-details-page .btn-danger:hover {
    background: #dc3545;
    color: white;
}

@media (max-width: 768px) {

    .center-details-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .center-details-page .header-actions {
        width: 100%;
    }

    .center-details-page .header-actions a {
        flex: 1;
        justify-content: center;
    }

    .center-details-page .info-grid {
        grid-template-columns: 1fr;
    }

    .center-details-page .bottom-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .center-details-page .bottom-actions a,
    .center-details-page .bottom-actions form,
    .center-details-page .bottom-actions button {
        width: 100%;
    }

    .center-details-page .bottom-actions a,
    .center-details-page .bottom-actions button {
        justify-content: center;
    }
}
</style>

@endsection