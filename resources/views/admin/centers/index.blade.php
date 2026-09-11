@extends('admin.layouts.app')

@section('title', 'Donation Centers')

@section('content')

<div class="donation-center-page">

    {{-- =========================
        PAGE HEADER
    ========================= --}}
    <div class="dc-header">

        <div class="dc-header-left">

            <div class="dc-header-icon">
                <i class="bi bi-building-fill"></i>
            </div>

            <div>
                <h1>Donation Centers</h1>
                <p>Manage locations where blood donations take place.</p>
            </div>

        </div>

        <a href="#" class="dc-add-btn">
            <i class="bi bi-plus-lg"></i>
            Add Center
        </a>

    </div>


    {{-- =========================
        STATISTICS
    ========================= --}}
    <div class="dc-stats">

        <div class="dc-stat-card">
            <div class="dc-stat-icon red">
                <i class="bi bi-building-fill"></i>
            </div>

            <div>
                <span>Total Centers</span>
                <strong>3</strong>
            </div>
        </div>


        <div class="dc-stat-card">
            <div class="dc-stat-icon green">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <span>Open Centers</span>
                <strong>2</strong>
            </div>
        </div>


        <div class="dc-stat-card">
            <div class="dc-stat-icon orange">
                <i class="bi bi-clock-fill"></i>
            </div>

            <div>
                <span>Closed Centers</span>
                <strong>1</strong>
            </div>
        </div>


        <div class="dc-stat-card">
            <div class="dc-stat-icon blue">
                <i class="bi bi-droplet-fill"></i>
            </div>

            <div>
                <span>Donations Today</span>
                <strong>18</strong>
            </div>
        </div>

    </div>


    {{-- =========================
        MAIN CARD
    ========================= --}}
    <div class="dc-card">

        {{-- CARD TITLE --}}
        <div class="dc-card-header">

            <div>
                <h2>All Donation Centers</h2>
                <p>View and manage registered donation locations.</p>
            </div>

            <span class="dc-count">
                3 Centers
            </span>

        </div>


        {{-- =========================
            SEARCH AREA
        ========================= --}}
        <div class="dc-search-area">

            {{-- NORMAL SEARCH BAR --}}
            <div class="dc-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="centerSearch"
                    placeholder="Search center..."
                >

            </div>


            {{-- LOCATION FILTER --}}
            <select id="locationFilter" class="dc-filter">

                <option value="">All Locations</option>
                <option value="Iloilo City">Iloilo City</option>
                <option value="Pavia">Pavia</option>

            </select>


            {{-- STATUS FILTER --}}
            <select id="statusFilter" class="dc-filter">

                <option value="">All Status</option>
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>

            </select>

        </div>


        {{-- =========================
            TABLE
        ========================= --}}
        <div class="dc-table-wrapper">

            <table class="dc-table" id="centerTable">

                <thead>
                    <tr>
                        <th>Center</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- CENTER 1 --}}
                    <tr>

                        <td>

                            <div class="dc-center-info">

                                <div class="dc-center-icon">
                                    <i class="bi bi-building-fill"></i>
                                </div>

                                <div>
                                    <strong>Red Cross Center</strong>
                                    <span>Blood Donation Center</span>
                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="dc-location">

                                <i class="bi bi-geo-alt-fill"></i>

                                <span>Iloilo City</span>

                            </div>

                        </td>


                        <td>
                            0912-345-6789
                        </td>


                        <td>

                            <span class="dc-status open">

                                <span></span>

                                Open

                            </span>

                        </td>


                        <td>

                            <div class="dc-actions">

                                <button
                                    type="button"
                                    class="dc-action edit"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <button
                                    type="button"
                                    class="dc-action delete"
                                    title="Delete"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- CENTER 2 --}}
                    <tr>

                        <td>

                            <div class="dc-center-info">

                                <div class="dc-center-icon">
                                    <i class="bi bi-hospital-fill"></i>
                                </div>

                                <div>
                                    <strong>City Hospital</strong>
                                    <span>Hospital Donation Unit</span>
                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="dc-location">

                                <i class="bi bi-geo-alt-fill"></i>

                                <span>Iloilo City</span>

                            </div>

                        </td>


                        <td>
                            0913-456-7890
                        </td>


                        <td>

                            <span class="dc-status open">

                                <span></span>

                                Open

                            </span>

                        </td>


                        <td>

                            <div class="dc-actions">

                                <button
                                    type="button"
                                    class="dc-action edit"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <button
                                    type="button"
                                    class="dc-action delete"
                                    title="Delete"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>

                        </td>

                    </tr>


                    {{-- CENTER 3 --}}
                    <tr>

                        <td>

                            <div class="dc-center-info">

                                <div class="dc-center-icon">
                                    <i class="bi bi-hospital-fill"></i>
                                </div>

                                <div>
                                    <strong>Medical Center</strong>
                                    <span>Blood Donation Unit</span>
                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="dc-location">

                                <i class="bi bi-geo-alt-fill"></i>

                                <span>Pavia</span>

                            </div>

                        </td>


                        <td>
                            0914-567-8901
                        </td>


                        <td>

                            <span class="dc-status closed">

                                <span></span>

                                Closed

                            </span>

                        </td>


                        <td>

                            <div class="dc-actions">

                                <button
                                    type="button"
                                    class="dc-action edit"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <button
                                    type="button"
                                    class="dc-action delete"
                                    title="Delete"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- =========================
            CENTER INFORMATION
        ========================= --}}
        <div class="dc-information">

            <div class="dc-information-header">

                <div>
                    <h3>Center Information</h3>
                    <p>Selected donation center details.</p>
                </div>

            </div>


            <div class="dc-information-box">

                <div class="dc-information-top">

                    <div class="dc-information-icon">
                        <i class="bi bi-building-fill"></i>
                    </div>

                    <div>
                        <h4>Red Cross Center</h4>
                        <p>Blood Donation Center</p>
                    </div>

                </div>


                <div class="dc-information-grid">

                    <div>
                        <span>Location</span>
                        <strong>Iloilo City</strong>
                    </div>

                    <div>
                        <span>Contact</span>
                        <strong>0912-345-6789</strong>
                    </div>

                    <div>
                        <span>Operating Hours</span>
                        <strong>8:00 AM - 5:00 PM</strong>
                    </div>

                    <div>
                        <span>Status</span>

                        <strong>

                            <span class="dc-status open">
                                <span></span>
                                Open
                            </span>

                        </strong>

                    </div>

                </div>


                <div class="dc-information-actions">

                    <button type="button" class="dc-delete-btn">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>

                    <button type="button" class="dc-edit-btn">
                        <i class="bi bi-pencil"></i>
                        Edit Center
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
    PAGE CSS
========================= --}}
<style>

    .donation-center-page {
        width: 100%;
        padding: 5px 0;
    }


    /* HEADER */

    .dc-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .dc-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .dc-header-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fff1f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        flex-shrink: 0;
    }

    .dc-header h1 {
        margin: 0;
        color: #101828;
        font-size: 28px;
        font-weight: 700;
    }

    .dc-header p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 14px;
    }

    .dc-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 9px;
        background: #dc2626;
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .dc-add-btn:hover {
        background: #b91c1c;
        color: white;
    }


    /* STATISTICS */

    .dc-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .dc-stat-card {
        min-height: 105px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        background: white;
        border: 1px solid #eaecf0;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(16, 24, 40, .04);
    }

    .dc-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .dc-stat-icon.red {
        background: #fff1f2;
        color: #dc2626;
    }

    .dc-stat-icon.green {
        background: #ecfdf3;
        color: #039855;
    }

    .dc-stat-icon.orange {
        background: #fff7ed;
        color: #ea580c;
    }

    .dc-stat-icon.blue {
        background: #eff6ff;
        color: #2563eb;
    }

    .dc-stat-card span {
        display: block;
        color: #667085;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .dc-stat-card strong {
        display: block;
        color: #101828;
        font-size: 24px;
    }


    /* MAIN CARD */

    .dc-card {
        background: white;
        border: 1px solid #eaecf0;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(16, 24, 40, .04);
        overflow: hidden;
    }


    /* CARD HEADER */

    .dc-card-header {
        padding: 22px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #eaecf0;
    }

    .dc-card-header h2 {
        margin: 0;
        color: #101828;
        font-size: 18px;
        font-weight: 700;
    }

    .dc-card-header p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .dc-count {
        padding: 6px 11px;
        border-radius: 7px;
        background: #f8f9fb;
        border: 1px solid #eaecf0;
        color: #667085;
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================
       NORMAL SEARCH BAR
    ========================= */

    .dc-search-area {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1px solid #eaecf0;
    }

    .dc-search {
        position: relative;
        width: 320px;
    }

    .dc-search i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: 14px;
        pointer-events: none;
    }

    .dc-search input {
        width: 100%;
        height: 40px;
        padding: 0 12px 0 38px;
        border: 1px solid #d0d5dd;
        border-radius: 8px;
        background: white;
        color: #344054;
        font-size: 13px;
        outline: none;
    }

    .dc-search input::placeholder {
        color: #98a2b3;
    }

    .dc-search input:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, .08);
    }

    .dc-filter {
        width: 160px;
        height: 40px;
        padding: 0 12px;
        border: 1px solid #d0d5dd;
        border-radius: 8px;
        background: white;
        color: #344054;
        font-size: 13px;
        outline: none;
        cursor: pointer;
    }

    .dc-filter:focus {
        border-color: #dc2626;
    }


    /* TABLE */

    .dc-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .dc-table {
        width: 100%;
        min-width: 750px;
        border-collapse: collapse;
    }

    .dc-table th {
        padding: 13px 20px;
        background: #f8f9fb;
        border-bottom: 1px solid #eaecf0;
        color: #667085;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .dc-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f0f1f3;
        color: #475467;
        font-size: 13px;
        vertical-align: middle;
    }

    .dc-table tbody tr:hover {
        background: #fffafa;
    }


    /* CENTER */

    .dc-center-info {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .dc-center-icon {
        width: 40px;
        height: 40px;
        border-radius: 9px;
        background: #fff1f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dc-center-info strong {
        display: block;
        color: #101828;
        font-size: 13px;
        font-weight: 650;
    }

    .dc-center-info span {
        display: block;
        margin-top: 3px;
        color: #98a2b3;
        font-size: 11px;
    }


    /* LOCATION */

    .dc-location {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .dc-location i {
        color: #dc2626;
        font-size: 13px;
    }


    /* STATUS */

    .dc-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .dc-status > span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .dc-status.open {
        background: #ecfdf3;
        color: #027a48;
    }

    .dc-status.closed {
        background: #fff1f2;
        color: #b42318;
    }


    /* ACTIONS */

    .dc-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dc-action {
        width: 32px;
        height: 32px;
        border: 1px solid #eaecf0;
        border-radius: 7px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .2s;
    }

    .dc-action.edit {
        color: #2563eb;
    }

    .dc-action.edit:hover {
        background: #eff6ff;
    }

    .dc-action.delete {
        color: #dc2626;
    }

    .dc-action.delete:hover {
        background: #fff1f2;
    }


    /* INFORMATION */

    .dc-information {
        padding: 24px;
    }

    .dc-information-header {
        margin-bottom: 14px;
    }

    .dc-information-header h3 {
        margin: 0;
        color: #101828;
        font-size: 17px;
        font-weight: 700;
    }

    .dc-information-header p {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 12px;
    }

    .dc-information-box {
        padding: 20px;
        border: 1px solid #eaecf0;
        border-radius: 12px;
        background: #fcfcfd;
    }

    .dc-information-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .dc-information-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #fff1f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .dc-information-top h4 {
        margin: 0;
        color: #101828;
        font-size: 15px;
    }

    .dc-information-top p {
        margin: 3px 0 0;
        color: #667085;
        font-size: 11px;
    }

    .dc-information-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .dc-information-grid span {
        display: block;
        margin-bottom: 5px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .dc-information-grid strong {
        color: #101828;
        font-size: 13px;
    }

    .dc-information-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 20px;
    }

    .dc-delete-btn,
    .dc-edit-btn {
        padding: 9px 15px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .dc-delete-btn {
        border: 1px solid #fda4af;
        background: white;
        color: #dc2626;
    }

    .dc-edit-btn {
        border: none;
        background: #dc2626;
        color: white;
    }

    .dc-edit-btn:hover {
        background: #b91c1c;
    }


    /* RESPONSIVE */

    @media (max-width: 1100px) {

        .dc-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .dc-information-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }


    @media (max-width: 700px) {

        .dc-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .dc-add-btn {
            width: 100%;
            justify-content: center;
        }

        .dc-stats {
            grid-template-columns: 1fr;
        }

        .dc-card-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .dc-search-area {
            flex-direction: column;
            align-items: stretch;
        }

        .dc-search {
            width: 100%;
        }

        .dc-filter {
            width: 100%;
        }

        .dc-information-grid {
            grid-template-columns: 1fr;
        }

        .dc-information-actions {
            flex-direction: column;
        }

        .dc-delete-btn,
        .dc-edit-btn {
            width: 100%;
        }

    }

</style>


{{-- =========================
    SEARCH FUNCTION
========================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const search = document.getElementById('centerSearch');
    const locationFilter = document.getElementById('locationFilter');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('#centerTable tbody tr');

    function filterCenters() {

        const searchValue = search.value.toLowerCase();
        const locationValue = locationFilter.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            const matchesSearch =
                text.includes(searchValue);

            const matchesLocation =
                !locationValue ||
                text.includes(locationValue);

            const matchesStatus =
                !statusValue ||
                text.includes(statusValue);

            if (
                matchesSearch &&
                matchesLocation &&
                matchesStatus
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    }

    search.addEventListener('input', filterCenters);
    locationFilter.addEventListener('change', filterCenters);
    statusFilter.addEventListener('change', filterCenters);

});

</script>

@endsection