
<div class="sidebar">

    <!-- LOGO -->
    <div class="logo-area">
        <div class="logo-icon">
            <i class="bi bi-droplet-fill"></i>
        </div>

        <div>
            <div class="logo-title">COMMUNITY BLOOD</div>
            <div class="logo-subtitle">DONOR • ADMIN PANEL</div>
        </div>
    </div>


    <!-- MAIN MENU -->
    <div class="menu-title">MAIN MENU</div>

    <a href="{{ url('/admin/dashboard') }}"
       class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ url('/admin/users') }}"
       class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i>
        <span>User Management</span>
    </a>

    <a href="{{ url('/admin/donors') }}"
       class="sidebar-link {{ request()->is('admin/donors*') ? 'active' : '' }}">
        <i class="bi bi-heart-pulse-fill"></i>
        <span>Donor Management</span>
    </a>

    <a href="{{ url('/admin/requests') }}"
       class="sidebar-link {{ request()->is('admin/requests*') ? 'active' : '' }}">
        <i class="bi bi-droplet-half"></i>
        <span>Blood Requests</span>
    </a>

    <a href="{{ url('/admin/appointments') }}"
       class="sidebar-link {{ request()->is('admin/appointments*') ? 'active' : '' }}">
        <i class="bi bi-calendar-check-fill"></i>
        <span>Appointments</span>
    </a>

    <a href="{{ url('/admin/centers') }}"
       class="sidebar-link {{ request()->is('admin/centers*') ? 'active' : '' }}">
        <i class="bi bi-building-fill"></i>
        <span>Donation Centers</span>
    </a>


    <!-- DIVIDER -->
    <div class="sidebar-divider"></div>


    <!-- MANAGEMENT -->
    <div class="menu-title">MANAGEMENT</div>

    <a href="{{ url('/admin/reports') }}"
       class="sidebar-link {{ request()->is('admin/reports*') ? 'active' : '' }}">

        <i class="bi bi-bar-chart-fill"></i>

        <span>Reports</span>

        <!-- BADGE -->
        <span class="notification-badge">3</span>

    </a>


    <!-- DIVIDER -->
    <div class="sidebar-divider"></div>


    <!-- LOGOUT -->
    <form method="POST"
          action="{{ url('/admin/logout') }}"
          class="logout-form">

        @csrf

        <button type="submit" class="sidebar-link logout-button">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>

    </form>

</div>


<style>

* {
    box-sizing: border-box;
}


/* SIDEBAR */

.sidebar {
    position: fixed;
    top: 0;
    left: 0;

    width: 255px;
    height: 100vh;

    background: linear-gradient(
        180deg,
        #8f0d18 0%,
        #650812 100%
    );

    color: white;

    overflow-y: auto;

    z-index: 1000;
}


/* LOGO */

.logo-area {
    padding: 25px 20px;

    display: flex;
    align-items: center;

    gap: 13px;

    border-bottom: 1px solid rgba(255,255,255,.12);
}


.logo-icon {
    width: 45px;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: white;

    color: #8f0d18;

    border-radius: 12px;

    font-size: 23px;

    flex-shrink: 0;
}


.logo-title {
    font-size: 15px;
    font-weight: 700;
    letter-spacing: .4px;
}


.logo-subtitle {
    font-size: 11px;
    opacity: .7;
    margin-top: 4px;
}


/* MENU TITLE */

.menu-title {
    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.5px;

    color: rgba(255,255,255,.55);

    padding: 25px 20px 10px;
}


/* SIDEBAR LINKS */

.sidebar-link {
    display: flex;

    align-items: center;

    gap: 13px;

    margin: 5px 12px;

    padding: 12px 14px;

    width: calc(100% - 24px);

    color: rgba(255,255,255,.82);

    text-decoration: none;

    border-radius: 10px;

    font-size: 14px;

    transition: .2s;

    border: none;

    background: transparent;

    cursor: pointer;

    text-align: left;
}


.sidebar-link i {
    width: 22px;

    min-width: 22px;

    font-size: 18px;
}


/* HOVER */

.sidebar-link:hover {
    background: rgba(255,255,255,.10);

    color: white;

    transform: translateX(2px);
}


/* ACTIVE */

.sidebar-link.active {
    background: white;

    color: #8f0d18;

    font-weight: 600;

    box-shadow: 0 5px 15px rgba(0,0,0,.12);
}


.sidebar-link.active i {
    color: #8f0d18;
}


/* BADGE */

.notification-badge {
    margin-left: auto;

    min-width: 24px;
    height: 24px;

    padding: 0 7px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: white;

    color: #8f0d18;

    border-radius: 50%;

    font-size: 11px;

    font-weight: 700;
}


/* BADGE WHEN LINK IS ACTIVE */

.sidebar-link.active .notification-badge {
    background: #8f0d18;

    color: white;
}


/* DIVIDER */

.sidebar-divider {
    height: 1px;

    background: rgba(255,255,255,.13);

    margin: 20px;
}


/* LOGOUT */

.logout-form {
    margin: 0;
}


.logout-button {
    font-family: inherit;
}


.logout-button:hover {
    background: rgba(255,255,255,.10);

    color: white;
}


/* MOBILE */

@media (max-width: 768px) {

    .sidebar {
        width: 220px;
    }

}

</style>
