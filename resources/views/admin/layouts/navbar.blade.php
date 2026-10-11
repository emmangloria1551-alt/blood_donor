{{-- =========================================================
     ADMIN NAVBAR
     Community Blood Donor
     ========================================================= --}}

<nav class="admin-navbar">

    {{-- LEFT: SEARCH --}}
    <div class="navbar-search-wrapper">

        <form action="{{ url('/admin/users') }}" method="GET" class="navbar-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search anything..."
                autocomplete="off"
            >

            <button type="submit" title="Search">
                <i class="bi bi-arrow-right"></i>
            </button>

        </form>

    </div>


    {{-- RIGHT SIDE --}}
    <div class="navbar-right">

        {{-- =====================================================
             NOTIFICATIONS
             ===================================================== --}}
        <div class="navbar-item notification-wrapper">

            <button
                type="button"
                class="navbar-icon-button"
                id="notificationButton"
                title="Notifications"
            >
                <i class="bi bi-bell"></i>

                <span class="notification-dot"></span>
            </button>

            <div class="navbar-dropdown notification-dropdown" id="notificationDropdown">

                <div class="dropdown-header">

                    <div>
                        <strong>Notifications</strong>
                        <small>Recent system activity</small>
                    </div>

                    <span class="notification-count">3</span>

                </div>

                <div class="notification-list">

                    <a href="{{ url('/admin/users') }}" class="notification-item">

                        <div class="notification-icon user-notification">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>

                        <div class="notification-content">
                            <strong>New user registered</strong>
                            <span>Check the latest registered users.</span>
                            <small>Recently</small>
                        </div>

                    </a>


                    <a href="{{ url('/admin/appointments') }}" class="notification-item">

                        <div class="notification-icon appointment-notification">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>

                        <div class="notification-content">
                            <strong>Appointment activity</strong>
                            <span>Check donation appointments.</span>
                            <small>Recently</small>
                        </div>

                    </a>


                    <a href="{{ url('/admin/requests') }}" class="notification-item">

                        <div class="notification-icon request-notification">
                            <i class="bi bi-droplet-fill"></i>
                        </div>

                        <div class="notification-content">
                            <strong>Blood requests</strong>
                            <span>Review current blood requests.</span>
                            <small>Recently</small>
                        </div>

                    </a>

                </div>

                <a href="{{ url('/admin/notifications') }}" class="view-all-notifications">
                    View All Notifications
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- =====================================================
             SETTINGS
             ===================================================== --}}
        <div class="navbar-item settings-wrapper">

            <button
                type="button"
                class="navbar-icon-button"
                id="settingsButton"
                title="Settings"
            >
                <i class="bi bi-gear"></i>
            </button>

            <div class="navbar-dropdown settings-dropdown" id="settingsDropdown">

                <div class="dropdown-header">

                    <div>
                        <strong>Settings</strong>
                        <small>Admin preferences</small>
                    </div>

                </div>

                <div class="settings-list">

                    <button
                        type="button"
                        class="settings-option"
                        onclick="toggleCompactMode()"
                    >
                        <span class="settings-option-icon">
                            <i class="bi bi-layout-sidebar"></i>
                        </span>

                        <span>
                            <strong>Compact Sidebar</strong>
                            <small>Adjust sidebar display</small>
                        </span>

                        <i class="bi bi-chevron-right"></i>
                    </button>


                    <button
                        type="button"
                        class="settings-option"
                        onclick="refreshDashboard()"
                    >
                        <span class="settings-option-icon">
                            <i class="bi bi-arrow-clockwise"></i>
                        </span>

                        <span>
                            <strong>Refresh Page</strong>
                            <small>Reload dashboard data</small>
                        </span>

                        <i class="bi bi-chevron-right"></i>
                    </button>


                    <button
                        type="button"
                        class="settings-option"
                        onclick="closeNavbarDropdowns()"
                    >
                        <span class="settings-option-icon">
                            <i class="bi bi-x-circle"></i>
                        </span>

                        <span>
                            <strong>Close Menu</strong>
                            <small>Close this settings menu</small>
                        </span>

                        <i class="bi bi-chevron-right"></i>
                    </button>

                </div>

            </div>

        </div>


        {{-- DIVIDER --}}
        <div class="navbar-divider"></div>


        {{-- =====================================================
             ADMIN ACCOUNT
             ===================================================== --}}
        <div class="navbar-item admin-wrapper">

            <button
                type="button"
                class="admin-profile-button"
                id="adminProfileButton"
            >

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="admin-information">

                    <strong>
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </strong>

                    <span>
                        System Admin
                    </span>

                </div>

                <i class="bi bi-chevron-down admin-chevron"></i>

            </button>


            <div class="navbar-dropdown admin-dropdown" id="adminDropdown">

                <div class="admin-dropdown-header">

                    <div class="admin-avatar large">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div>
                        <strong>
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </strong>

                        <span>
                            {{ auth()->user()->email ?? 'admin@gmail.com' }}
                        </span>

                    </div>

                </div>


                <div class="admin-dropdown-divider"></div>


                {{-- EDIT ACCOUNT --}}
                @auth
                    <a
                        href="{{ route('admin.users.edit', auth()->user()->id) }}"
                        class="admin-dropdown-item"
                    >
                        <i class="bi bi-person"></i>

                        <span>
                            My Account
                        </span>
                    </a>
                @endauth


                {{-- SETTINGS --}}
                <button
                    type="button"
                    class="admin-dropdown-item"
                    onclick="openSettingsFromAdmin()"
                >
                    <i class="bi bi-gear"></i>

                    <span>
                        Settings
                    </span>
                </button>


                <div class="admin-dropdown-divider"></div>


                {{-- LOGOUT --}}
                <form
                    action="{{ route('admin.logout') }}"
                    method="POST"
                    class="logout-form"
                >

                    @csrf

                    <button type="submit" class="admin-dropdown-item logout-item">

                        <i class="bi bi-box-arrow-right"></i>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>


{{-- =========================================================
     NAVBAR CSS
     ========================================================= --}}

<style>

    /* =========================================================
       MAIN NAVBAR
       ========================================================= */

    .admin-navbar {
        width: 100%;
        height: 90px;

        background: #ffffff;

        border-bottom: 1px solid #eeeeee;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 32px;

        position: sticky;
        top: 0;

        z-index: 1000;

        box-sizing: border-box;
    }


    /* =========================================================
       SEARCH
       ========================================================= */

    .navbar-search-wrapper {
        flex: 1;

        max-width: 600px;
    }


    .navbar-search {
        width: 100%;
        height: 52px;

        background: #f7f7f8;

        border: 1px solid #eeeeee;

        border-radius: 14px;

        display: flex;
        align-items: center;

        padding: 0 8px 0 18px;

        box-sizing: border-box;

        transition: 0.2s ease;
    }


    .navbar-search:focus-within {
        background: #ffffff;

        border-color: #d91f3d;

        box-shadow: 0 0 0 3px rgba(217, 31, 61, 0.08);
    }


    .navbar-search > i {
        color: #777777;

        font-size: 19px;

        flex-shrink: 0;
    }


    .navbar-search input {
        width: 100%;

        height: 100%;

        border: none;

        outline: none;

        background: transparent;

        padding: 0 12px;

        font-size: 15px;

        color: #222222;

        box-sizing: border-box;
    }


    .navbar-search input::placeholder {
        color: #999999;
    }


    .navbar-search button {
        width: 38px;
        height: 38px;

        border: none;

        border-radius: 10px;

        background: #d91f3d;

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        opacity: 0;

        pointer-events: none;

        transition: 0.2s ease;
    }


    .navbar-search:focus-within button {
        opacity: 1;

        pointer-events: auto;
    }


    .navbar-search button:hover {
        background: #b91530;
    }


    /* =========================================================
       RIGHT SIDE
       ========================================================= */

    .navbar-right {
        display: flex;

        align-items: center;

        gap: 8px;

        margin-left: 25px;
    }


    .navbar-item {
        position: relative;
    }


    /* =========================================================
       ICON BUTTONS
       ========================================================= */

    .navbar-icon-button {
        width: 46px;
        height: 46px;

        border: none;

        background: transparent;

        border-radius: 12px;

        color: #666666;

        display: flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        font-size: 22px;

        transition: 0.2s ease;

        position: relative;
    }


    .navbar-icon-button:hover,
    .navbar-icon-button.active {
        background: #f7f0f1;

        color: #c91534;
    }


    /* =========================================================
       NOTIFICATION DOT
       ========================================================= */

    .notification-dot {
        width: 7px;
        height: 7px;

        background: #e31837;

        border-radius: 50%;

        position: absolute;

        top: 9px;
        right: 9px;

        border: 2px solid #ffffff;
    }


    /* =========================================================
       DIVIDER
       ========================================================= */

    .navbar-divider {
        width: 1px;

        height: 42px;

        background: #e4e4e4;

        margin: 0 12px;
    }


    /* =========================================================
       ADMIN PROFILE
       ========================================================= */

    .admin-profile-button {
        border: none;

        background: transparent;

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 7px 8px;

        border-radius: 12px;

        cursor: pointer;

        min-width: 210px;

        text-align: left;

        transition: 0.2s ease;
    }


    .admin-profile-button:hover,
    .admin-profile-button.active {
        background: #f8f8f8;
    }


    .admin-avatar {
        width: 48px;
        height: 48px;

        border-radius: 50%;

        background: #a80d24;

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 18px;

        font-weight: 700;

        flex-shrink: 0;
    }


    .admin-avatar.large {
        width: 44px;
        height: 44px;

        font-size: 16px;
    }


    .admin-information {
        display: flex;

        flex-direction: column;

        min-width: 0;

        flex: 1;
    }


    .admin-information strong {
        color: #222222;

        font-size: 15px;

        font-weight: 700;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    .admin-information span {
        color: #999999;

        font-size: 12px;

        margin-top: 3px;
    }


    .admin-chevron {
        color: #888888;

        font-size: 14px;

        transition: 0.2s ease;
    }


    .admin-profile-button.active .admin-chevron {
        transform: rotate(180deg);
    }


    /* =========================================================
       DROPDOWN
       ========================================================= */

    .navbar-dropdown {
        position: absolute;

        top: calc(100% + 12px);

        right: 0;

        background: #ffffff;

        border: 1px solid #eeeeee;

        border-radius: 15px;

        box-shadow:
            0 12px 35px rgba(0, 0, 0, 0.12);

        display: none;

        overflow: hidden;

        z-index: 2000;
    }


    .navbar-dropdown.show {
        display: block;

        animation: dropdownShow 0.15s ease;
    }


    @keyframes dropdownShow {

        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /* =========================================================
       DROPDOWN HEADER
       ========================================================= */

    .dropdown-header {
        padding: 17px 18px;

        display: flex;

        justify-content: space-between;

        align-items: center;

        border-bottom: 1px solid #eeeeee;
    }


    .dropdown-header div {
        display: flex;

        flex-direction: column;
    }


    .dropdown-header strong {
        font-size: 15px;

        color: #222222;
    }


    .dropdown-header small {
        font-size: 12px;

        color: #999999;

        margin-top: 3px;
    }


    .notification-count {
        min-width: 24px;
        height: 24px;

        padding: 0 7px;

        background: #d91f3d;

        color: #ffffff;

        border-radius: 20px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 11px;

        font-weight: 700;
    }


    /* =========================================================
       NOTIFICATION DROPDOWN
       ========================================================= */

    .notification-dropdown {
        width: 370px;
    }


    .notification-item {
        display: flex;

        gap: 12px;

        padding: 15px 18px;

        text-decoration: none;

        color: inherit;

        border-bottom: 1px solid #f1f1f1;

        transition: 0.2s ease;
    }


    .notification-item:hover {
        background: #fafafa;
    }


    .notification-icon {
        width: 38px;
        height: 38px;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;

        font-size: 16px;
    }


    .user-notification {
        background: #fff0f3;

        color: #d91f3d;
    }


    .appointment-notification {
        background: #fff5e8;

        color: #e78b00;
    }


    .request-notification {
        background: #fff0f2;

        color: #d91f3d;
    }


    .notification-content {
        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    .notification-content strong {
        font-size: 13px;

        color: #222222;
    }


    .notification-content span {
        font-size: 12px;

        color: #888888;

        margin-top: 3px;

        line-height: 1.4;
    }


    .notification-content small {
        font-size: 11px;

        color: #aaaaaa;

        margin-top: 5px;
    }


    .view-all-notifications {
        display: flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 14px;

        color: #d91f3d;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;
    }


    .view-all-notifications:hover {
        background: #fff7f8;
    }


    /* =========================================================
       SETTINGS
       ========================================================= */

    .settings-dropdown {
        width: 320px;
    }


    .settings-list {
        padding: 7px 0;
    }


    .settings-option {
        width: 100%;

        border: none;

        background: transparent;

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 13px 17px;

        cursor: pointer;

        text-align: left;

        transition: 0.2s ease;
    }


    .settings-option:hover {
        background: #f8f8f8;
    }


    .settings-option-icon {
        width: 36px;
        height: 36px;

        background: #f8f0f2;

        color: #c91534;

        border-radius: 9px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-shrink: 0;
    }


    .settings-option > span:nth-child(2) {
        flex: 1;

        display: flex;

        flex-direction: column;
    }


    .settings-option strong {
        color: #333333;

        font-size: 13px;
    }


    .settings-option small {
        color: #999999;

        font-size: 11px;

        margin-top: 2px;
    }


    .settings-option > i {
        color: #aaaaaa;

        font-size: 12px;
    }


    /* =========================================================
       ADMIN DROPDOWN
       ========================================================= */

    .admin-dropdown {
        width: 290px;
    }


    .admin-dropdown-header {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 17px;
    }


    .admin-dropdown-header > div:last-child {
        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    .admin-dropdown-header strong {
        font-size: 14px;

        color: #222222;
    }


    .admin-dropdown-header span {
        font-size: 11px;

        color: #999999;

        margin-top: 3px;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    .admin-dropdown-divider {
        height: 1px;

        background: #eeeeee;

        margin: 0;
    }


    .admin-dropdown-item {
        width: 100%;

        min-height: 45px;

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 11px 17px;

        border: none;

        background: transparent;

        color: #444444;

        text-decoration: none;

        font-size: 13px;

        cursor: pointer;

        box-sizing: border-box;

        text-align: left;

        transition: 0.2s ease;
    }


    .admin-dropdown-item:hover {
        background: #f8f8f8;

        color: #c91534;
    }


    .admin-dropdown-item i {
        width: 20px;

        font-size: 17px;

        color: #777777;

        text-align: center;
    }


    .admin-dropdown-item:hover i {
        color: #c91534;
    }


    .logout-item {
        color: #d91f3d;
    }


    .logout-item i {
        color: #d91f3d;
    }


    .logout-item:hover {
        background: #fff1f3;

        color: #b91530;
    }


    .logout-form {
        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 1000px) {

        .admin-navbar {
            padding: 0 20px;
        }

        .navbar-search-wrapper {
            max-width: 420px;
        }

        .admin-information {
            display: none;
        }

        .admin-profile-button {
            min-width: auto;
        }

        .admin-chevron {
            display: none;
        }

    }


    @media (max-width: 700px) {

        .admin-navbar {
            height: 75px;

            padding: 0 12px;

            gap: 8px;
        }

        .navbar-search-wrapper {
            max-width: none;

            flex: 1;
        }

        .navbar-search {
            height: 45px;

            padding-left: 13px;
        }

        .navbar-search input {
            font-size: 13px;
        }

        .navbar-search button {
            display: none;
        }

        .navbar-divider {
            display: none;
        }

        .navbar-icon-button {
            width: 40px;
            height: 40px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
        }

        .notification-dropdown {
            position: fixed;

            top: 75px;

            left: 10px;
            right: 10px;

            width: auto;
        }

        .settings-dropdown {
            position: fixed;

            top: 75px;

            left: 10px;
            right: 10px;

            width: auto;
        }

        .admin-dropdown {
            right: 5px;

            width: 280px;
        }

    }

</style>


{{-- =========================================================
     NAVBAR JAVASCRIPT
     ========================================================= --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const notificationButton =
            document.getElementById('notificationButton');

        const notificationDropdown =
            document.getElementById('notificationDropdown');


        const settingsButton =
            document.getElementById('settingsButton');

        const settingsDropdown =
            document.getElementById('settingsDropdown');


        const adminProfileButton =
            document.getElementById('adminProfileButton');

        const adminDropdown =
            document.getElementById('adminDropdown');


        /* =====================================================
           NOTIFICATIONS
           ===================================================== */

        if (notificationButton) {

            notificationButton.addEventListener('click', function (event) {

                event.stopPropagation();

                closeAllDropdowns('notification');

                notificationDropdown.classList.toggle('show');

                notificationButton.classList.toggle(
                    'active',
                    notificationDropdown.classList.contains('show')
                );

            });

        }


        /* =====================================================
           SETTINGS
           ===================================================== */

        if (settingsButton) {

            settingsButton.addEventListener('click', function (event) {

                event.stopPropagation();

                closeAllDropdowns('settings');

                settingsDropdown.classList.toggle('show');

                settingsButton.classList.toggle(
                    'active',
                    settingsDropdown.classList.contains('show')
                );

            });

        }


        /* =====================================================
           ADMIN PROFILE
           ===================================================== */

        if (adminProfileButton) {

            adminProfileButton.addEventListener('click', function (event) {

                event.stopPropagation();

                closeAllDropdowns('admin');

                adminDropdown.classList.toggle('show');

                adminProfileButton.classList.toggle(
                    'active',
                    adminDropdown.classList.contains('show')
                );

            });

        }


        /* =====================================================
           CLICK OUTSIDE
           ===================================================== */

        document.addEventListener('click', function () {

            closeAllDropdowns();

        });


        /* =====================================================
           PREVENT DROPDOWN CLOSING INSIDE
           ===================================================== */

        if (notificationDropdown) {

            notificationDropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );

        }


        if (settingsDropdown) {

            settingsDropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );

        }


        if (adminDropdown) {

            adminDropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );

        }

    });


    /* =========================================================
       CLOSE DROPDOWNS
       ========================================================= */

    function closeAllDropdowns(exception = '') {

        const notificationDropdown =
            document.getElementById('notificationDropdown');

        const settingsDropdown =
            document.getElementById('settingsDropdown');

        const adminDropdown =
            document.getElementById('adminDropdown');


        const notificationButton =
            document.getElementById('notificationButton');

        const settingsButton =
            document.getElementById('settingsButton');

        const adminProfileButton =
            document.getElementById('adminProfileButton');


        if (exception !== 'notification') {

            if (notificationDropdown) {
                notificationDropdown.classList.remove('show');
            }

            if (notificationButton) {
                notificationButton.classList.remove('active');
            }

        }


        if (exception !== 'settings') {

            if (settingsDropdown) {
                settingsDropdown.classList.remove('show');
            }

            if (settingsButton) {
                settingsButton.classList.remove('active');
            }

        }


        if (exception !== 'admin') {

            if (adminDropdown) {
                adminDropdown.classList.remove('show');
            }

            if (adminProfileButton) {
                adminProfileButton.classList.remove('active');
            }

        }

    }


    /* =========================================================
       SETTINGS FUNCTIONS
       ========================================================= */

    function toggleCompactMode() {

        document.body.classList.toggle('compact-sidebar');

        localStorage.setItem(
            'compactSidebar',
            document.body.classList.contains('compact-sidebar')
                ? '1'
                : '0'
        );

        closeAllDropdowns();

    }


    function refreshDashboard() {

        closeAllDropdowns();

        window.location.reload();

    }


    function openSettingsFromAdmin() {

        closeAllDropdowns('settings');

        const settingsDropdown =
            document.getElementById('settingsDropdown');

        const settingsButton =
            document.getElementById('settingsButton');

        if (settingsDropdown) {
            settingsDropdown.classList.add('show');
        }

        if (settingsButton) {
            settingsButton.classList.add('active');
        }

    }


    function closeNavbarDropdowns() {

        closeAllDropdowns();

    }


    /* =========================================================
       REMEMBER COMPACT SIDEBAR SETTING
       ========================================================= */

    document.addEventListener('DOMContentLoaded', function () {

        const compactMode =
            localStorage.getItem('compactSidebar');

        if (compactMode === '1') {

            document.body.classList.add('compact-sidebar');

        }

    });

</script>