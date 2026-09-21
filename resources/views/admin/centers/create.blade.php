@extends('admin.layouts.app')

@section('title', 'Add Donation Center')

@section('content')

<div class="center-form-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">

        <div>
            <h1 class="page-title">
                <i class="bi bi-hospital-fill"></i>
                Add Donation Center
            </h1>

            <p class="page-subtitle">
                Add a new blood donation center to the system.
            </p>
        </div>

        <a href="{{ route('admin.centers') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Centers
        </a>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="error-box">

            <div class="error-title">
                <i class="bi bi-exclamation-circle-fill"></i>
                Please fix the following errors:
            </div>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- FORM CARD --}}
    <div class="form-card">

        <div class="form-card-header">

            <div>
                <h2>Center Information</h2>

                <p>
                    Enter the details of the donation center.
                </p>
            </div>

            <div class="header-icon">
                <i class="bi bi-hospital-fill"></i>
            </div>

        </div>


        <form
            method="POST"
            action="{{ route('admin.centers.store') }}"
            class="center-form"
        >

            @csrf


            {{-- CENTER NAME --}}
            <div class="form-group">

                <label for="name">
                    Hospital Name
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Red Cross Center"
                    required
                >

                @error('name')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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
                    value="{{ old('location') }}"
                    placeholder="e.g. Iloilo City"
                    required
                >

                @error('location')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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
                    value="{{ old('contact_number') }}"
                    placeholder="e.g. 09123456789"
                >

                @error('contact_number')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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

                    <option value="">
                        Select Status
                    </option>

                    <option
                        value="open"
                        {{ old('status') === 'open' ? 'selected' : '' }}
                    >
                        Open
                    </option>

                    <option
                        value="closed"
                        {{ old('status') === 'closed' ? 'selected' : '' }}
                    >
                        Closed
                    </option>

                </select>

                @error('status')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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
                    value="{{ old('opening_time') }}"
                >

                @error('opening_time')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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
                    value="{{ old('closing_time') }}"
                >

                @error('closing_time')
                    <small class="field-error">
                        {{ $message }}
                    </small>
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
                    rows="4"
                    placeholder="Enter a short description about this donation center..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <small class="field-error">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- BUTTONS --}}
            <div class="form-actions">

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
                    Save Center
                </button>

            </div>

        </form>

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.center-form-page {
    width: 100%;
    padding: 10px 0 40px;
}


/* =========================================================
   HEADER
========================================================= */

.center-form-page .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.center-form-page .page-title {
    margin: 0;
    color: #222;
    font-size: 27px;
    font-weight: 700;
}

.center-form-page .page-title i {
    color: #dc3545;
    margin-right: 8px;
}

.center-form-page .page-subtitle {
    margin: 6px 0 0;
    color: #777;
    font-size: 14px;
}


/* =========================================================
   BACK BUTTON
========================================================= */

.center-form-page .back-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 10px 15px;

    border: 1px solid #ddd;
    border-radius: 7px;

    background: #fff;
    color: #555;

    text-decoration: none;

    font-size: 14px;
    font-weight: 500;

    white-space: nowrap;

    transition: 0.2s;
}

.center-form-page .back-btn:hover {
    background: #f7f7f7;
    color: #333;
}


/* =========================================================
   ERROR BOX
========================================================= */

.center-form-page .error-box {
    margin-bottom: 20px;
    padding: 14px 16px;

    border: 1px solid #f1b0b7;
    border-radius: 8px;

    background: #fcebed;
    color: #842029;

    font-size: 14px;
}

.center-form-page .error-title {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 7px;

    font-weight: 600;
}

.center-form-page .error-box ul {
    margin: 0;
    padding-left: 25px;
}


/* =========================================================
   FORM CARD
========================================================= */

.center-form-page .form-card {
    width: 100%;

    background: #fff;

    border: 1px solid #eee;
    border-radius: 10px;

    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.04);

    overflow: hidden;
}


/* =========================================================
   FORM HEADER
========================================================= */

.center-form-page .form-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 20px;

    border-bottom: 1px solid #eee;
}

.center-form-page .form-card-header h2 {
    margin: 0;

    color: #222;

    font-size: 18px;
    font-weight: 600;
}

.center-form-page .form-card-header p {
    margin: 5px 0 0;

    color: #888;

    font-size: 13px;
}

.center-form-page .header-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #fcebed;
    color: #dc3545;

    font-size: 19px;
}


/* =========================================================
   FORM
========================================================= */

.center-form-page .center-form {
    display: grid;

    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 20px;

    padding: 22px;
}

.center-form-page .form-group {
    min-width: 0;
}

.center-form-page .full-width {
    grid-column: 1 / -1;
}


/* =========================================================
   LABEL
========================================================= */

.center-form-page .form-group label {
    display: block;

    margin-bottom: 7px;

    color: #333;

    font-size: 13px;
    font-weight: 600;
}

.center-form-page .form-group label span {
    color: #dc3545;
}


/* =========================================================
   INPUT / SELECT / TEXTAREA
========================================================= */

.center-form-page .form-group input,
.center-form-page .form-group select,
.center-form-page .form-group textarea {

    display: block;

    width: 100%;

    box-sizing: border-box;

    border: 1px solid #dcdcdc;
    border-radius: 7px;

    background: #fff;

    color: #333;

    font-family: inherit;
    font-size: 14px;

    outline: none;

    transition:
        border-color 0.2s,
        box-shadow 0.2s;
}

.center-form-page .form-group input,
.center-form-page .form-group select {
    height: 42px;

    padding: 0 12px;
}

.center-form-page .form-group textarea {
    padding: 11px 12px;

    resize: vertical;
}

.center-form-page .form-group input::placeholder,
.center-form-page .form-group textarea::placeholder {
    color: #999;
}

.center-form-page .form-group input:focus,
.center-form-page .form-group select:focus,
.center-form-page .form-group textarea:focus {

    border-color: #dc3545;

    box-shadow:
        0 0 0 2px rgba(220, 53, 69, 0.08);
}


/* =========================================================
   FIELD ERROR
========================================================= */

.center-form-page .field-error {
    display: block;

    margin-top: 5px;

    color: #dc3545;

    font-size: 12px;
}


/* =========================================================
   FORM ACTIONS
========================================================= */

.center-form-page .form-actions {

    grid-column: 1 / -1;

    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding-top: 5px;

    border-top: 1px solid #eee;
}


/* =========================================================
   CANCEL
========================================================= */

.center-form-page .cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 40px;

    padding: 0 17px;

    border: 1px solid #dcdcdc;
    border-radius: 7px;

    background: #fff;
    color: #555;

    text-decoration: none;

    font-size: 14px;
    font-weight: 500;
}

.center-form-page .cancel-btn:hover {
    background: #f5f5f5;
    color: #333;
}


/* =========================================================
   SAVE
========================================================= */

.center-form-page .save-btn {

    height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 0 18px;

    border: none;
    border-radius: 7px;

    background: #dc3545;
    color: #fff;

    font-family: inherit;
    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s;
}

.center-form-page .save-btn:hover {
    background: #bb2d3b;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .center-form-page .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .center-form-page .center-form {
        grid-template-columns: 1fr;
    }

    .center-form-page .full-width {
        grid-column: auto;
    }

    .center-form-page .form-actions {
        grid-column: auto;

        justify-content: stretch;

        flex-direction: column;
    }

    .center-form-page .cancel-btn,
    .center-form-page .save-btn {
        width: 100%;
    }

}

</style>

@endsection