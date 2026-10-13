@extends('admin.layouts.app')

@section('content')

<style>
    .request-page {
        padding: 25px;
        color: #263248;
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .request-title-area {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .request-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        background: #fff0f1;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .request-title {
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .request-subtitle {
        color: #8b95a7;
        margin: 0;
        font-size: 14px;
    }

    .request-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .request-stat {
        background: white;
        border: 1px solid #eceef2;
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,.025);
    }

    .request-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .icon-red { background: #fff0f1; color: #dc3545; }
    .icon-yellow { background: #fff5dc; color: #c58a00; }
    .icon-green { background: #e8f8ee; color: #198754; }
    .icon-blue { background: #eaf1ff; color: #3468ce; }

    .request-stat-label {
        color: #8b95a7;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .request-stat-value {
        color: #263248;
        font-size: 25px;
        font-weight: 700;
    }

    .request-card {
        background: #fff;
        border: 1px solid #e8ebf1;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 7px 22px rgba(0,0,0,.035);
    }

    .request-toolbar {
        padding: 20px;
    }

    .request-search-form {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .request-search {
        flex: 2 1 240px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #dfe4ec;
        border-radius: 11px;
        padding: 0 14px;
        min-height: 45px;
        color: #8b95a7;
    }

    .request-search input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: none;
        background: transparent;
        color: #263248;
    }

    .request-filter {
        flex: 1 1 145px;
        min-height: 45px;
        padding: 0 12px;
        border: 1px solid #dfe4ec;
        border-radius: 11px;
        background: white;
        color: #344054;
    }

    .request-search-btn,
    .request-reset-btn {
        min-height: 44px;
        padding: 10px 17px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .request-search-btn {
        background: #dc3545;
        color: white;
        border: 1px solid #dc3545;
    }

    .request-search-btn:hover {
        background: #bb2d3b;
        color: white;
    }

    .request-reset-btn {
        background: #f3f5f8;
        color: #475467;
        border: 1px solid #e5e7eb;
    }

    .request-tabs {
        display: flex;
        gap: 28px;
        padding: 0 25px;
        border-top: 1px solid #eceef2;
        border-bottom: 1px solid #eceef2;
        overflow-x: auto;
    }

    .request-tab {
        display: inline-block;
        padding: 17px 4px;
        border-bottom: 2px solid transparent;
        text-decoration: none;
        color: #64748b;
        white-space: nowrap;
    }

    .request-tab:hover,
    .request-tab.active {
        color: #dc3545;
        border-bottom-color: #dc3545;
    }

    .request-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .request-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .request-table th {
        background: #fafbfc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .35px;
        text-transform: uppercase;
        padding: 17px 20px;
        text-align: left;
        white-space: nowrap;
    }

    .request-table td {
        padding: 18px 20px;
        border-top: 1px solid #edf0f4;
        vertical-align: middle;
    }

    .request-table tbody tr:hover {
        background: #fffafb;
    }

    .patient-name {
        color: #263248;
        font-weight: 600;
    }

    .patient-email,
    .request-muted {
        color: #929bad;
        font-size: 12px;
        margin-top: 5px;
    }

    .blood-badge {
        display: inline-block;
        padding: 9px 13px;
        border-radius: 9px;
        background: #fff0f1;
        color: #dc3545;
        font-weight: 700;
    }

    .request-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        color: #a86b00;
        background: #fff5d9;
    }

    .status-approved {
        color: #167345;
        background: #e5f7ec;
    }

    .status-fulfilled {
        color: #225bc1;
        background: #e9f0ff;
    }

    .status-cancelled,
    .status-rejected {
        color: #b42332;
        background: #ffeaec;
    }

    .status-default {
        color: #667085;
        background: #f1f3f5;
    }

    .request-view-btn {
        width: 43px;
        height: 43px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        background: #fff;
        color: #64748b;
        font-size: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .request-view-btn:hover {
        background: #fff0f1;
        color: #dc3545;
        border-color: #f0c3c8;
    }

    .request-empty {
        padding: 55px 20px !important;
        text-align: center;
        color: #929bad;
    }

    .request-empty-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #f3f4f6;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .request-empty-title {
        font-size: 17px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    .request-footer {
        padding: 17px 22px;
        border-top: 1px solid #eceef2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .request-count {
        color: #6b7280;
        font-size: 13px;
    }

    .request-pagination .pagination {
        margin: 0;
    }

    .request-pagination .page-link {
        color: #dc3545;
        border-color: #e5e7eb;
    }

    .request-pagination .page-item.active .page-link {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .request-modal {
        border: 0;
        border-radius: 15px;
        overflow: hidden;
    }

    .request-modal-header {
        border-bottom: 1px solid #eee;
        padding: 20px 25px;
    }

    .request-modal-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #fff0f1;
        color: #dc3545;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .request-modal-body {
        padding: 25px;
    }

    .modal-patient-name {
        font-size: 23px;
        font-weight: 700;
        margin: 3px 0 5px;
        overflow-wrap: anywhere;
    }

    .modal-patient-email {
        color: #6b7280;
        overflow-wrap: anywhere;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin: 22px 0 14px;
    }

    .detail-box {
        background: #f8f9fa;
        border-radius: 11px;
        padding: 15px;
        min-width: 0;
    }

    .detail-label {
        font-size: 11px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 7px;
    }

    .detail-value {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .detail-blood {
        color: #dc3545;
    }

    .detail-wide {
        margin-bottom: 17px;
    }

    .notes-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        min-height: 50px;
    }

    .request-modal-footer {
        border-top: 1px solid #eee;
        padding: 18px 25px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .request-action-form {
        display: none;
        margin: 0;
    }

    .request-action-btn,
    .request-close-btn {
        border: 0;
        border-radius: 9px;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: 600;
    }

    .request-approve-btn {
        background: #198754;
        color: white;
    }

    .request-cancel-btn {
        background: #dc3545;
        color: white;
    }

    .request-fulfill-btn {
        background: #315fca;
        color: white;
    }

    .request-close-btn {
        background: #f3f5f8;
        color: #344054;
        padding: 11px 22px;
    }

    .request-action-btn:hover {
        filter: brightness(.93);
    }

    @media (max-width: 1100px) {
        .request-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .request-page {
            padding: 16px;
        }

        .request-title {
            font-size: 21px;
        }

        .request-toolbar {
            padding: 14px;
        }

        .request-search {
            flex-basis: 100%;
        }

        .request-filter {
            flex: 1 1 130px;
        }

        .request-tabs {
            padding: 0 15px;
            gap: 22px;
        }

        .request-modal-body {
            padding: 20px;
        }

        .request-modal-header,
        .request-modal-footer {
            padding: 16px 20px;
        }
    }

    @media (max-width: 480px) {
        .request-stats {
            grid-template-columns: 1fr;
        }

        .request-title-icon {
            width: 44px;
            height: 44px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="request-page">

    {{-- PAGE HEADER --}}
    <div class="request-header">
        <div class="request-title-area">
            <div class="request-title-icon">
                <i class="bi bi-droplet-half"></i>
            </div>

            <div>
                <h1 class="request-title">Blood Request Management</h1>
                <p class="request-subtitle">
                    Review and manage blood requests from your database.
                </p>
            </div>
        </div>
    </div>

    {{-- ALERT MESSAGES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="request-stats">

        <div class="request-stat">
            <div class="request-stat-icon icon-red">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>
            <div>
                <div class="request-stat-label">Total Requests</div>
                <div class="request-stat-value">
                    {{ number_format($totalRequests) }}
                </div>
            </div>
        </div>

        <div class="request-stat">
            <div class="request-stat-icon icon-yellow">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <div class="request-stat-label">Pending</div>
                <div class="request-stat-value">
                    {{ number_format($pendingRequests) }}
                </div>
            </div>
        </div>

        <div class="request-stat">
            <div class="request-stat-icon icon-green">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <div class="request-stat-label">Approved</div>
                <div class="request-stat-value">
                    {{ number_format($approvedRequests) }}
                </div>
            </div>
        </div>

        <div class="request-stat">
            <div class="request-stat-icon icon-blue">
                <i class="bi bi-droplet"></i>
            </div>
            <div>
                <div class="request-stat-label">Total Units Needed</div>
                <div class="request-stat-value">
                    {{ number_format($totalUnits) }}
                </div>
            </div>
        </div>

    </div>

    {{-- MAIN CARD --}}
    <div class="request-card">

        {{-- SEARCH AND FILTERS --}}
        <div class="request-toolbar">
            <form action="{{ route('admin.requests') }}"
                  method="GET"
                  class="request-search-form">

                <div class="request-search">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search patient or hospital..."
                    >
                </div>

                <select name="blood_type" class="request-filter">
                    <option value="">All Blood Types</option>

                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                        <option value="{{ $type }}"
                            {{ request('blood_type') === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>

                <select name="status" class="request-filter">
                    <option value="">All Statuses</option>

                    @foreach(['pending', 'approved', 'fulfilled', 'cancelled'] as $status)
                        <option value="{{ $status }}"
                            {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="request-search-btn">
                    <i class="bi bi-search"></i>
                    Search
                </button>

                @if(request()->hasAny(['search', 'blood_type', 'status']))
                    <a href="{{ route('admin.requests') }}" class="request-reset-btn">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- STATUS TABS --}}
        <div class="request-tabs">
            <a
                href="{{ route('admin.requests', request()->except('status', 'page')) }}"
                class="request-tab {{ !request('status') ? 'active' : '' }}">
                All
            </a>

            @foreach(['pending', 'approved', 'fulfilled', 'cancelled'] as $tab)
                <a
                    href="{{ route('admin.requests', array_merge(request()->except('status', 'page'), ['status' => $tab])) }}"
                    class="request-tab {{ request('status') === $tab ? 'active' : '' }}">
                    {{ ucfirst($tab) }}
                </a>
            @endforeach
        </div>

        {{-- REQUESTS TABLE --}}
        <div class="request-table-wrapper">

            <table class="request-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Blood Type</th>
                        <th>Units</th>
                        <th>Hospital</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($requests as $requestItem)

                        @php
                            $status = strtolower($requestItem->status ?? 'unknown');

                            $statusClass = match($status) {
                                'pending' => 'status-pending',
                                'approved' => 'status-approved',
                                'fulfilled' => 'status-fulfilled',
                                'cancelled', 'rejected' => 'status-cancelled',
                                default => 'status-default',
                            };

                            $patientName = $requestItem->patient_name ?: 'N/A';
                            $patientEmail = $requestItem->user?->email ?? 'No email available';
                            $hospital = $requestItem->hospital ?: 'Not specified';
                            $notes = $requestItem->notes ?: 'No notes provided';
                        @endphp

                        <tr>
                            <td>
                                <div class="patient-name">
                                    {{ $patientName }}
                                </div>
                                <div class="patient-email">
                                    {{ $patientEmail }}
                                </div>
                            </td>

                            <td>
                                <span class="blood-badge">
                                    {{ $requestItem->blood_type }}
                                </span>
                            </td>

                            <td>
                                {{ $requestItem->units_needed }}
                                {{ $requestItem->units_needed == 1 ? 'Unit' : 'Units' }}
                            </td>

                            <td>
                                <div>{{ $hospital }}</div>
                                @if($requestItem->notes)
                                    <div class="request-muted">
                                        {{ \Illuminate\Support\Str::limit($requestItem->notes, 35) }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <span class="request-status {{ $statusClass }}">
                                    @if($status === 'pending')
                                        <i class="bi bi-clock"></i>
                                    @elseif($status === 'approved')
                                        <i class="bi bi-check-circle"></i>
                                    @elseif($status === 'fulfilled')
                                        <i class="bi bi-check2-all"></i>
                                    @else
                                        <i class="bi bi-x-circle"></i>
                                    @endif

                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                {{ $requestItem->created_at?->format('M d, Y') ?? '—' }}
                                <div class="request-muted">
                                    {{ $requestItem->created_at?->format('h:i A') ?? '' }}
                                </div>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="request-view-btn"
                                    title="View request details"
                                    aria-label="View request details"
                                    data-bs-toggle="modal"
                                    data-bs-target="#requestDetailsModal"

                                    data-id="{{ $requestItem->id }}"
                                    data-patient="{{ $patientName }}"
                                    data-email="{{ $patientEmail }}"
                                    data-blood="{{ $requestItem->blood_type }}"
                                    data-units="{{ $requestItem->units_needed }}"
                                    data-hospital="{{ $hospital }}"
                                    data-notes="{{ $notes }}"
                                    data-status="{{ $status }}"
                                    data-date="{{ $requestItem->created_at?->format('M d, Y') ?? '—' }}"

                                    data-approve-url="{{ route('admin.requests.approve', $requestItem->id) }}"
                                    data-cancel-url="{{ route('admin.requests.reject', $requestItem->id) }}"
                                    data-fulfill-url="{{ route('admin.requests.fulfill', $requestItem->id) }}"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="request-empty">
                                <div class="request-empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <div class="request-empty-title">
                                    No blood requests found
                                </div>
                                <div>
                                    Try changing your search or filters.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- TABLE FOOTER --}}
        <div class="request-footer">
            <div class="request-count">
                Showing {{ $requests->firstItem() ?? 0 }}
                – {{ $requests->lastItem() ?? 0 }}
                of {{ $requests->total() }} requests
            </div>

            <div class="request-pagination">
                {{ $requests->links() }}
            </div>
        </div>

    </div>
</div>

{{-- REQUEST DETAILS MODAL --}}
<div
    class="modal fade"
    id="requestDetailsModal"
    tabindex="-1"
    aria-labelledby="requestDetailsModalTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content request-modal">

            <div class="modal-header request-modal-header">
                <div class="d-flex align-items-center">
                    <div class="request-modal-icon">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div>
                        <div class="request-subtitle">Request Information</div>
                        <h5 class="modal-title fw-bold" id="requestDetailsModalTitle">
                            Blood Request Details
                        </h5>
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body request-modal-body">

                <div class="mb-3">
                    <div class="detail-label">Patient</div>
                    <div class="modal-patient-name" id="detailPatient">—</div>
                    <div class="modal-patient-email" id="detailEmail">—</div>
                </div>

                <div class="detail-grid">
                    <div class="detail-box">
                        <div class="detail-label">Blood Type</div>
                        <div class="detail-value detail-blood" id="detailBlood">—</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label">Units Needed</div>
                        <div class="detail-value" id="detailUnits">—</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label">Status</div>
                        <div class="detail-value" id="detailStatus">—</div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-label">Date</div>
                        <div class="detail-value" id="detailDate">—</div>
                    </div>
                </div>

                <div class="detail-box detail-wide">
                    <div class="detail-label">Hospital</div>
                    <div class="detail-value" id="detailHospital">—</div>
                </div>

                <div>
                    <div class="detail-label">Notes</div>
                    <div class="notes-box" id="detailNotes">—</div>
                </div>

            </div>

            <div class="modal-footer request-modal-footer">

                {{-- Approve form --}}
                <form id="approveRequestForm"
                      method="POST"
                      class="request-action-form">
                    @csrf
                    @method('PATCH')

                    <button type="submit"
                            class="request-action-btn request-approve-btn">
                        <i class="bi bi-check-circle me-1"></i>
                        Approve
                    </button>
                </form>

                {{-- Cancel form --}}
                <form id="cancelRequestForm"
                      method="POST"
                      class="request-action-form"
                      onsubmit="return confirm('Are you sure you want to cancel this request?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit"
                            class="request-action-btn request-cancel-btn">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancel Request
                    </button>
                </form>

                {{-- Fulfill form --}}
                <form id="fulfillRequestForm"
                      method="POST"
                      class="request-action-form"
                      onsubmit="return confirm('Mark this request as fulfilled?')">
                    @csrf
                    @method('PATCH')

                    <button type="submit"
                            class="request-action-btn request-fulfill-btn">
                        <i class="bi bi-check2-all me-1"></i>
                        Mark Fulfilled
                    </button>
                </form>

                <button type="button"
                        class="request-close-btn"
                        data-bs-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('requestDetailsModal');

    if (!modal) {
        return;
    }

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        if (!button) {
            return;
        }

        const data = button.dataset;

        // Fill request details safely using textContent.
        document.getElementById('detailPatient').textContent =
            data.patient || 'N/A';

        document.getElementById('detailEmail').textContent =
            data.email || 'No email available';

        document.getElementById('detailBlood').textContent =
            data.blood || '—';

        const units = Number(data.units || 0);

        document.getElementById('detailUnits').textContent =
            units + (units === 1 ? ' Unit' : ' Units');

        document.getElementById('detailHospital').textContent =
            data.hospital || 'Not specified';

        document.getElementById('detailNotes').textContent =
            data.notes || 'No notes provided';

        document.getElementById('detailStatus').textContent =
            data.status
                ? data.status.charAt(0).toUpperCase() + data.status.slice(1)
                : 'Unknown';

        document.getElementById('detailDate').textContent =
            data.date || '—';

        // Connect forms to the correct Laravel routes.
        const approveForm = document.getElementById('approveRequestForm');
        const cancelForm = document.getElementById('cancelRequestForm');
        const fulfillForm = document.getElementById('fulfillRequestForm');

        approveForm.action = data.approveUrl;
        cancelForm.action = data.cancelUrl;
        fulfillForm.action = data.fulfillUrl;

        // Show only the actions allowed for the current status.
        approveForm.style.display =
            data.status === 'pending' ? 'block' : 'none';

        cancelForm.style.display =
            ['pending', 'approved'].includes(data.status) ? 'block' : 'none';

        fulfillForm.style.display =
            data.status === 'approved' ? 'block' : 'none';
    });
});
</script>

@endsection