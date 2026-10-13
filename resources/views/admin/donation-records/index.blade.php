<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donation Records | Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f5f6fa;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .main-content {
            padding: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        .btn-maroon {
            background: #8f0d18;
            color: #fff;
            border: 1px solid #8f0d18;
            padding: 10px 18px;
            border-radius: 7px;
            text-decoration: none;
        }

        .btn-maroon:hover {
            background: #650812;
            border-color: #650812;
            color: #fff;
        }

        .records-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .records-header {
            padding: 20px 24px;
            border-bottom: 1px solid #eee;
        }

        .records-header h5 {
            font-weight: 700;
            margin: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fc;
            color: #555;
            font-size: 13px;
            text-transform: uppercase;
            padding: 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
        }

        .blood-badge {
            display: inline-block;
            background: #8f0d18;
            color: white;
            padding: 6px 11px;
            border-radius: 6px;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed,
        .status-approved {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-rejected,
        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }

        .status-default {
            background: #e2e3e5;
            color: #41464b;
        }

        .empty-state {
            padding: 55px 20px !important;
            text-align: center;
            color: #777;
        }

        .empty-state i {
            font-size: 42px;
            color: #bbb;
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: #8f0d18;
        }

        .pagination .active .page-link {
            background: #8f0d18;
            border-color: #8f0d18;
            color: #fff;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }

            .page-title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="main-content">

    {{-- Page heading and Add button --}}
    <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div>
            <h1 class="page-title">
                <i class="bi bi-droplet-fill" style="color: #8f0d18;"></i>
                Donation Records
            </h1>

            <p class="page-subtitle mb-0">
                View and monitor recorded blood donations.
            </p>
        </div>

        <a href="{{ route('admin.donation-records.create') }}"
           class="btn btn-maroon">
            <i class="bi bi-plus-circle me-1"></i>
            Add Donation
        </a>

    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- Error message --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Donation records table --}}
    <div class="records-card">

        <div class="records-header d-flex justify-content-between align-items-center">
            <h5>
                <i class="bi bi-list-ul me-2"></i>
                All Donation Records
            </h5>

            <span class="text-muted small">
                Total: {{ $donations->total() }}
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Donor</th>
                        <th>Blood Type</th>
                        <th>Units</th>
                        <th>Status</th>
                        <th>Donation Date</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($donations as $donation)

                        @php
                            $donor = $donation->donor;

                            $donorName = $donor->name
                                ?? trim(
                                    ($donor->first_name ?? '') . ' ' .
                                    ($donor->last_name ?? '')
                                );

                            $status = strtolower(
                                $donation->status ?? 'pending'
                            );

                            $statusClass = match ($status) {
                                'completed' => 'status-completed',
                                'approved' => 'status-approved',
                                'pending' => 'status-pending',
                                'rejected' => 'status-rejected',
                                'cancelled' => 'status-cancelled',
                                default => 'status-default',
                            };
                        @endphp

                        <tr>
                            <td>#{{ $donation->id }}</td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $donorName ?: 'Donor #' . $donation->donor_id }}
                                </div>

                                <small class="text-muted">
                                    Donor ID: {{ $donation->donor_id }}
                                </small>
                            </td>

                            <td>
                                <span class="blood-badge">
                                    {{ $donation->blood_type }}
                                </span>
                            </td>

                            <td>
                                {{ $donation->units }}
                                {{ $donation->units == 1 ? 'unit' : 'units' }}
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                @if ($donation->donated_at)
                                    {{ $donation->donated_at->format('M d, Y') }}

                                    <br>

                                    <small class="text-muted">
                                        {{ $donation->donated_at->format('h:i A') }}
                                    </small>
                                @else
                                    <span class="text-muted">
                                        Not recorded
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="bi bi-droplet"></i>

                                <h5 class="mt-3">
                                    No Donation Records Yet
                                </h5>

                                <p class="mb-0">
                                    Click Add Donation to create your first record.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if ($donations->hasPages())
            <div class="p-3 border-top">
                {{ $donations->links() }}
            </div>
        @endif

    </div>

    {{-- Back button --}}
    <div class="mt-3">
        <a href="{{ url('/admin/dashboard') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Dashboard
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>