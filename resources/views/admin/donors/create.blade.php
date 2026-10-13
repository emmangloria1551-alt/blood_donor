
@extends('admin.layouts.app')

@section('content')

<div class="donor-page">

    
<div class="page-header donor-header">
    <div class="page-title">
        <div class="title-icon donor-blood-icon">
            <i class="bi bi-droplet-fill"></i>
            <span>+</span>
        </div>

        <div>
            <h1>Add Donor</h1>
            <p>Register a new blood donor.</p>
        </div>
    </div>

    <a href="{{ route('admin.donors') }}" class="back-button">
        <i class="bi bi-arrow-left"></i>
        Back to Donors
    </a>
</div>


    <div class="donor-form-card">

        <div class="form-heading">
            <h2>Donor Information</h2>
            <p>Fill in the information below to register a donor.</p>
        </div>

        @if ($errors->any())
            <div class="form-error">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.donors.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label for="name">Full Name <span>*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter full name"
                        required
                    >
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span>*</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                        required
                    >
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="blood_type">Blood Type <span>*</span></label>
                    <select id="blood_type" name="blood_type" required>
                        <option value="">Select blood type</option>
                        @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                            <option
                                value="{{ $type }}"
                                {{ old('blood_type') == $type ? 'selected' : '' }}
                            >
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    @error('blood_type')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                    >
                    @error('phone')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter complete address"
                    >{{ old('address') }}</textarea>
                    @error('address')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_active">Donor Status <span>*</span></label>
                    <select id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('is_active')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.donors') }}" class="cancel-button">
                    Cancel
                </a>

                <button type="submit" class="save-button">
                    <i class="bi bi-person-plus-fill"></i>
                    Save Donor
                </button>
            </div>

        </form>
    </div>

</div>

<style>
    .add-donor-icon {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #de042c;
    font-size: 32px;
    margin-bottom: 8px;
}

.add-donor-icon span {
    position: absolute;
    top: -5px;
    right: -9px;
    font-size: 19px;
    font-weight: 800;
    color: #b00020;
}

.add-donor-icon + h1 {
    color: #b00020;
}

.donor-page {
    width: 100%;
    padding-bottom: 30px;
}


.donor-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 25px;
}

.donor-header .back-button {
    margin-left: auto;
    flex-shrink: 0;
}


..donor-header .donor-blood-icon {
    position: relative;
    color: #a9001f;
}

.donor-header .donor-blood-icon i,
.donor-header .donor-blood-icon span {
    color: #a9001f;
}

.donor-header .donor-blood-icon span {
    position: absolute;
    top: -5px;
    right: -8px;
    font-size: 17px;
    font-weight: 800;
}

.back-button,
.cancel-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 16px;
    border: 1px solid #d9dee7;
    border-radius: 8px;
    background: #fff;
    color: #475467;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.back-button:hover,
.cancel-button:hover {
    background: #f8f9fb;
    color: #a9001f;
}

.donor-form-card {
    background: #fff;
    border: 1px solid #e7eaf0;
    border-radius: 14px;
    box-shadow: 0 3px 12px rgba(241, 8, 8, 0.04);
    overflow: hidden;
}

.form-heading {
    padding: 22px 25px;
    border-bottom: 1px solid #eef0f4;
}

.form-heading h2 {
    margin: 0;
    font-size: 18px;
    color: #172033;
}

.form-heading p {
    margin: 6px 0 0;
    color: #718096;
    font-size: 12px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
    padding: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    color: #344054;
    font-size: 13px;
    font-weight: 600;
}

.form-group label span {
    color: #c00024;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    box-sizing: border-box;
    padding: 12px;
    border: 1px solid #d9dee7;
    border-radius: 8px;
    background: #fff;
    color: #344054;
    font-family: inherit;
    font-size: 13px;
    outline: none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #a9001f;
    box-shadow: 0 0 0 3px rgba(169, 0, 31, .07);
}

.form-group textarea {
    resize: vertical;
}

.form-group small {
    color: #d92d20;
    font-size: 12px;
}

.form-error {
    margin: 20px 25px 0;
    padding: 14px;
    border: 1px solid #fecdca;
    border-radius: 8px;
    background: #fff1f0;
    color: #b42318;
    font-size: 13px;
}

.form-error ul {
    margin-bottom: 0;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding: 18px 25px;
    border-top: 1px solid #eef0f4;
    background: #fcfcfd;
}

.save-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 18px;
    border: 1px solid #a9001f;
    border-radius: 8px;
    background: #a9001f;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.save-button:hover {
    background: #8f001a;
}

@media (max-width: 650px) {
    .donor-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .form-grid {
        grid-template-columns: 1fr;
        padding: 18px;
    }

    .form-group.full-width {
        grid-column: auto;
    }

    .form-actions {
        padding: 18px;
    }
}
</style>

@endsection
