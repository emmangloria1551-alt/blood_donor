<aside class="sidebar">

    <!-- LOGO -->
    <div class="logo-area">

        <div class="logo-icon">
            <i class="bi bi-droplet-fill"></i>
        </div>

        <div>
            <div class="logo-title">
                COMMUNITY BLOOD
            </div>

            <div class="logo-subtitle">
                DONOR • ADMIN PANEL
            </div>
        </div>

    </div>


    <!-- MAIN MENU -->
    <div class="menu-title">
        MAIN MENU
    </div>


    <!-- DASHBOARD -->
     <a href="{{ route('admin.dashboard') }}"
   class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
    <i class="bi bi-grid-fill"></i>
    <span>Dashboard</span>
</a>


    <!-- USER MANAGEMENT -->
     <a href="{{ route('admin.users') }}"
   class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
    <i class="bi bi-people-fill"></i>
    <span>User Management</span>
</a>


    <!-- DONOR MANAGEMENT -->
     <a href="{{ route('admin.donors') }}"
   class="sidebar-link {{ request()->is('admin/donors*') ? 'active' : '' }}">
    <i class="bi bi-heart-pulse-fill"></i>
    <span>Donor Management</span>
</a>


    <!-- BLOOD REQUESTS -->
     <a href="{{ route('admin.requests') }}"
   class="sidebar-link {{ request()->is('admin/requests*') ? 'active' : '' }}">
    <i class="bi bi-droplet-fill"></i>
    <span>Blood Requests</span>
</a>

    <!-- APPOINTMENTS -->
     <a href="{{ route('admin.appointments') }}"
   class="sidebar-link {{ request()->is('admin/appointments*') ? 'active' : '' }}">
    <i class="bi bi-calendar-check-fill"></i>
    <span>Appointments</span>
</a>

    <!-- DONATION CENTERS -->
     <a href="{{ route('admin.centers') }}"
   class="sidebar-link {{ request()->is('admin/centers*') ? 'active' : '' }}">
    <i class="bi bi-building-fill"></i>
    <span>Donation Centers</span>
</a>


    <!-- NOTIFICATIONS -->
     <a href="{{ route('admin.notifications') }}"
   class="sidebar-link {{ request()->is('admin/notifications*') ? 'active' : '' }}">
    <i class="bi bi-bell-fill"></i>
    <span>Notifications</span>
    <span class="notification-badge">3</span>
</a>

    <!-- REPORTS -->
     <a href="{{ route('admin.reports') }}"
   class="sidebar-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
    <i class="bi bi-bar-chart-fill"></i>
    <span>Reports & Statistics</span>
</a>

    <!-- DIVIDER -->
    <div class="sidebar-divider"></div>


    <!-- SYSTEM -->
    <div class="menu-title">
        SYSTEM
    </div>


    <!-- SETTINGS -->
     <a href="{{ route('admin.settings') }}"
   class="sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
    <i class="bi bi-gear-fill"></i>
    <span>Settings</span>
</a>


    <!-- LOGOUT -->
    <a href="#"
       class="sidebar-link">

        <i class="bi bi-box-arrow-right"></i>

        <span>Logout</span>

    </a>


    <!-- ADMIN PROFILE -->
    <div class="sidebar-admin">

        <div class="sidebar-admin-avatar">
            A
        </div>

        <div class="sidebar-admin-info">

            <div class="sidebar-admin-name">
                Administrator
            </div>

            <div class="sidebar-admin-role">
                System Admin
            </div>

        </div>

        <i class="bi bi-three-dots-vertical"></i>

    </div>

</aside>


<style>

    /* =========================
       NOTIFICATION BADGE
    ========================= */

    .notification-badge {

        margin-left: auto;

        min-width: 22px;
        height: 22px;

        padding: 0 6px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #ffffff;

        color: #8f0d18;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 700;

    }


    /* =========================
       SIDEBAR ADMIN
    ========================= */

    .sidebar-admin {

        margin: 25px 12px 15px;

        padding: 14px;

        display: flex;

        align-items: center;

        gap: 10px;

        background: rgba(255,255,255,.08);

        border: 1px solid rgba(255,255,255,.10);

        border-radius: 12px;

    }


    .sidebar-admin-avatar {

        width: 38px;
        height: 38px;

        flex-shrink: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        background: white;

        color: #8f0d18;

        border-radius: 50%;

        font-weight: 700;

        font-size: 14px;

    }


    .sidebar-admin-info {

        flex: 1;

        min-width: 0;

    }


    .sidebar-admin-name {

        color: white;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

    }


    .sidebar-admin-role {

        color: rgba(255,255,255,.55);

        font-size: 10px;

        margin-top: 2px;

    }


    .sidebar-admin > i {

        color: rgba(255,255,255,.6);

        font-size: 16px;

    }


    /* =========================
       MOBILE SIDEBAR
    ========================= */

    @media (max-width: 768px) {

        .sidebar-admin {

            margin-bottom: 25px;

        }

    }

</style>