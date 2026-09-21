@extends('admin.layouts.app')

@section('title', 'Edit Donation Center')

@section('content')

<div class="edit-center-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit Donation Center
            </h1>

            <p class="page-subtitle">
                Update the information for this donation center.
            </p>
        </div>

        <a href="{{ route('admin.centers') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Centers
        </a>
    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="error-box">
            <div class="error-title">
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following errors:
            </div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- EDIT FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <div class="header-icon">
                <i class="bi bi-hospital-fill"></i>
            </div>

            <div>
                <h2>{{ $center->name }}</h2>
                <p>Update donation center details below.</p>
            </div>
        </div>


        <form
            action="{{ route('admin.centers.update', $center) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="form-body">

                {{-- CENTER NAME --}}
                <div class="form-group full-width">
                    <label for="name">
                        Center Name
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $center->name) }}"
                        placeholder="Enter donation center name"
                        required
                    >

                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- LOCATION --}}
                <div class="form-group">
                    <label for="location">
                        Location
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location', $center->location) }}"
                        placeholder="Enter center location"
                        required
                    >

                    @error('location')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- CONTACT --}}
                <div class="form-group">
                    <label for="contact_number">
                        Contact Number
                    </label>

                    <input
                        type="text"
                        id="contact_number"
                        name="contact_number"
                        value="{{ old('contact_number', $center->contact_number) }}"
                        placeholder="e.g. 09123456789"
                    >

                    @error('contact_number')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- OPENING TIME --}}
                <div class="form-group">
                    <label for="opening_time">
                        Opening Time
                    </label>

                    <input
                        type="time"
                        id="opening_time"
                        name="opening_time"
                        value="{{ old('opening_time', $center->opening_time ? \Carbon\Carbon::parse($center->opening_time)->format('H:i') : '') }}"
                    >

                    @error('opening_time')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- CLOSING TIME --}}
                <div class="form-group">
                    <label for="closing_time">
                        Closing Time
                    </label>

                    <input
                        type="time"
                        id="closing_time"
                        name="closing_time"
                        value="{{ old('closing_time', $center->closing_time ? \Carbon\Carbon::parse($center->closing_time)->format('H:i') : '') }}"
                    >

                    @error('closing_time')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- STATUS --}}
                <div class="form-group">
                    <label for="status">
                        Status
                        <span>*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                    >
                        <option value="open"
                            {{ old('status', $center->status) === 'open' ? 'selected' : '' }}>
                            Open
                        </option>

                        <option value="closed"
                            {{ old('status', $center->status) === 'closed' ? 'selected' : '' }}>
                            Closed
                        </option>
                    </select>

                    @error('status')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>


                {{-- DESCRIPTION --}}
                <div class="form-group full-width">
                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Enter a short description about this donation center..."
                    >{{ old('description', $center->description) }}</textarea>

                    @error('description')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>


            {{-- FORM ACTIONS --}}
            <div class="form-footer">

                <a
                    href="{{ route('admin.centers') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="save-btn"
                >
                    <i class="bi bi-check-lg"></i>
                    Update Center
                </button>

            </div>

        </form>

    </div>

</div>


<style>
.edit-center-page {
    width: 100%;
}

.edit-center-page .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.edit-center-page .page-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.edit-center-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.edit-center-page .page-subtitle {
    margin: 7px 0 0;
    color: #777;
    font-size: 14px;
}

.edit-center-page .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 16px;
    background: #f1f1f1;
    color: #444;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
}

.edit-center-page .back-btn:hover {
    background: #e2e2e2;
    color: #222;
}

.edit-center-page .error-box {
    margin-bottom: 20px;
    padding: 15px 18px;
    border-radius: 10px;
    background: #fff0f1;
    border: 1px solid #f5c2c7;
    color: #842029;
}

.edit-center-page .error-title {
    font-weight: 700;
    margin-bottom: 8px;
}

.edit-center-page .error-title i {
    margin-right: 5px;
}

.edit-center-page .error-box ul {
    margin: 0;
    padding-left: 20px;
}

.edit-center-page .form-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.edit-center-page .form-card-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 24px 25px;
    border-bottom: 1px solid #eee;
}

.edit-center-page .header-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    background: #fff0f1;
    color: #dc3545;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.edit-center-page .form-card-header h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #222;
}

.edit-center-page .form-card-header p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #777;
}

.edit-center-page .form-body {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 25px;
}

.edit-center-page .form-group {
    display: flex;
    flex-direction: column;
}

.edit-center-page .full-width {
    grid-column: 1 / -1;
}

.edit-center-page .form-group label {
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.edit-center-page .form-group label span {
    color: #dc3545;
}

.edit-center-page .form-group input,
.edit-center-page .form-group select,
.edit-center-page .form-group textarea {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid #d9d9d9;
    border-radius: 8px;
    background: #fff;
    color: #333;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}

.edit-center-page .form-group input:focus,
.edit-center-page .form-group select:focus,
.edit-center-page .form-group textarea:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.10);
}

.edit-center-page .form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.edit-center-page .field-error {
    margin-top: 6px;
    color: #dc3545;
    font-size: 12px;
}

.edit-center-page .form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 20px 25px;
    background: #fafafa;
    border-top: 1px solid #eee;
}

.edit-center-page .cancel-btn,
.edit-center-page .save-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-width: 120px;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.edit-center-page .cancel-btn {
    background: #f1f1f1;
    color: #444;
}

.edit-center-page .cancel-btn:hover {
    background: #e2e2e2;
    color: #222;
}

.edit-center-page .save-btn {
    border: none;
    background: #dc3545;
    color: white;
}

.edit-center-page .save-btn:hover {
    background: #bb2d3b;
}

@media (max-width: 768px) {

    .edit-center-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .edit-center-page .form-body {
        grid-template-columns: 1fr;
    }

    .edit-center-page .full-width {
        grid-column: auto;
    }

    .edit-center-page .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .edit-center-page .cancel-btn,
    .edit-center-page .save-btn {
        width: 100%;
    }
}
</style>

@endsection