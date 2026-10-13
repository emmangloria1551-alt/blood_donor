<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Donation | Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
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
        }

        .page-subtitle {
            color: #777;
        }

        .form-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            padding: 11px 12px;
            border-radius: 7px;
        }

        .btn-maroon {
            background: #8f0d18;
            color: #fff;
            border: 1px solid #8f0d18;
            padding: 10px 20px;
        }

        .btn-maroon:hover {
            background: #650812;
            border-color: #650812;
            color: #fff;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

<div class="main-content">

    <div class="mb-4">
        <h1 class="page-title">
            <i class="bi bi-droplet-fill" style="color:#8f0d18"></i>
            Add Donation
        </h1>

        <p class="page-subtitle">
            Record a donor's blood donation.
        </p>
    </div>

    <div class="card form-card">
        <div class="card-body p-4 p-md-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.donation-records.store') }}"
                  method="POST">

                @csrf

                <div class="row g-4">

                    {{-- Select donor --}}
                    <div class="col-md-6">
                        <label for="donor_id" class="form-label">
                            Select Donor <span class="text-danger">*</span>
                        </label>

                        <select name="donor_id"
                                id="donor_id"
                                class="form-select"
                                required>

                            <option value="">-- Select a donor --</option>

                            @foreach ($donors as $donor)
                                @php
                                    $donorName = $donor->name
                                        ?? trim(
                                            ($donor->first_name ?? '') . ' ' .
                                            ($donor->last_name ?? '')
                                        );
                                @endphp

                                <option value="{{ $donor->id }}"
                                    {{ old('donor_id') == $donor->id ? 'selected' : '' }}>

                                    {{ $donorName ?: 'Donor #' . $donor->id }}
                                    (ID: {{ $donor->id }})

                                </option>
                            @endforeach

                        </select>

                        @if ($donors->isEmpty())
                            <small class="text-danger">
                                No donors found. Add a donor before recording a donation.
                            </small>
                        @endif
                    </div>

                    {{-- Blood type --}}
                    <div class="col-md-6">
                        <label for="blood_type" class="form-label">
                            Blood Type <span class="text-danger">*</span>
                        </label>

                        <select name="blood_type"
                                id="blood_type"
                                class="form-select"
                                required>

                            <option value="">-- Select blood type --</option>

                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <option value="{{ $type }}"
                                    {{ old('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Units --}}
                    <div class="col-md-6">
                        <label for="units" class="form-label">
                            Units Donated <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="units"
                               id="units"
                               class="form-control"
                               min="1"
                               max="20"
                               value="{{ old('units', 1) }}"
                               required>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Donation Status <span class="text-danger">*</span>
                        </label>

                        <select name="status"
                                id="status"
                                class="form-select"
                                required>

                            <option value="pending"
                                {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="completed"
                                {{ old('status') == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="rejected"
                                {{ old('status') == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>
                    </div>

                    {{-- Donation date --}}
                    <div class="col-12">
                        <label for="donated_at" class="form-label">
                            Donation Date and Time
                        </label>

                        <input type="datetime-local"
                               name="donated_at"
                               id="donated_at"
                               class="form-control"
                               max="{{ now()->format('Y-m-d\TH:i') }}"
                               value="{{ old('donated_at') }}">

                        <small class="text-muted">
                            Leave blank if the donation date has not been recorded.
                        </small>
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2 justify-content-end">

                    <a href="{{ route('admin.donation-records') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-maroon"
                            {{ $donors->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-save me-1"></i>
                        Save Donation
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>