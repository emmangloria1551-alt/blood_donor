<nav class="top-navbar">

    <!-- LEFT SIDE -->
    <div class="navbar-left">

        <!-- Mobile Menu -->
        <button class="mobile-menu-btn" type="button">
            <i class="bi bi-list"></i>
        </button>

        <!-- Search -->
        <div class="search-box">

            <i class="bi bi-search"></i>

            <input
                type="text"
                placeholder="Search anything..."
            >

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="navbar-right">

        <!-- Notification -->
        <button class="navbar-icon-btn">

            <i class="bi bi-bell"></i>

            <span class="notification-dot"></span>

        </button>


        <!-- Settings -->
        <button class="navbar-icon-btn">

            <i class="bi bi-gear"></i>

        </button>


        <!-- Divider -->
        <div class="navbar-divider"></div>


        <!-- Admin Profile -->
        <div class="admin-profile">

            <div class="admin-avatar">
                A
            </div>

            <div class="admin-details">

                <div class="admin-name">
                    Administrator
                </div>

                <div class="admin-role">
                    System Admin
                </div>

            </div>

            <i class="bi bi-chevron-down profile-arrow"></i>

        </div>

    </div>

</nav>


<style>

    /* =========================
       NAVBAR
    ========================= */

    .top-navbar {

        height: 75px;

        background: rgba(255,255,255,.95);

        backdrop-filter: blur(10px);

        border-bottom: 1px solid #eeeeee;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 0 30px;

        position: sticky;

        top: 0;

        z-index: 999;

    }


    /* =========================
       LEFT
    ========================= */

    .navbar-left {

        display: flex;

        align-items: center;

        gap: 15px;

    }


    /* =========================
       SEARCH
    ========================= */

    .search-box {

        width: 330px;

        height: 42px;

        background: #f7f7f9;

        border: 1px solid #eeeeee;

        border-radius: 11px;

        padding: 0 12px;

        display: flex;

        align-items: center;

        gap: 10px;

        transition: .2s;

    }


    .search-box:focus-within {

        background: white;

        border-color: #b51b28;

        box-shadow: 0 0 0 3px rgba(181,27,40,.08);

    }


    .search-box > i {

        color: #999;

        font-size: 15px;

    }


    .search-box input {

        border: none;

        outline: none;

        background: transparent;

        flex: 1;

        font-size: 13px;

        color: #333;

    }


    .search-box input::placeholder {

        color: #aaa;

    }


    .search-shortcut {

        background: white;

        border: 1px solid #e5e5e5;

        color: #999;

        padding: 3px 7px;

        border-radius: 5px;

        font-size: 9px;

        white-space: nowrap;

    }


    /* =========================
       RIGHT SIDE
    ========================= */

    .navbar-right {

        display: flex;

        align-items: center;

        gap: 8px;

    }


    /* =========================
       ICON BUTTON
    ========================= */

    .navbar-icon-btn {

        position: relative;

        width: 40px;

        height: 40px;

        border: none;

        background: transparent;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #666;

        cursor: pointer;

        transition: .2s;

    }


    .navbar-icon-btn:hover {

        background: #f7f7f8;

        color: #8f0d18;

    }


    .navbar-icon-btn i {

        font-size: 18px;

    }


    /* =========================
       NOTIFICATION DOT
    ========================= */

    .notification-dot {

        position: absolute;

        top: 8px;

        right: 8px;

        width: 7px;

        height: 7px;

        background: #d71920;

        border: 2px solid white;

        border-radius: 50%;

    }


    /* =========================
       DIVIDER
    ========================= */

    .navbar-divider {

        width: 1px;

        height: 32px;

        background: #eeeeee;

        margin: 0 10px;

    }


    /* =========================
       ADMIN PROFILE
    ========================= */

    .admin-profile {

        display: flex;

        align-items: center;

        gap: 10px;

        padding: 5px 8px;

        border-radius: 10px;

        cursor: pointer;

        transition: .2s;

    }


    .admin-profile:hover {

        background: #f8f8f8;

    }


    .admin-avatar {

        width: 40px;

        height: 40px;

        border-radius: 50%;

        background: linear-gradient(
            135deg,
            #a30f1c,
            #6d0812
        );

        color: white;

        display: flex;

        align-items: center;

        justify-content: center;

        font-weight: 700;

        font-size: 14px;

        box-shadow: 0 4px 10px rgba(143,13,24,.20);

    }


    .admin-details {

        min-width: 100px;

    }


    .admin-name {

        font-size: 12px;

        font-weight: 700;

        color: #333;

    }


    .admin-role {

        font-size: 10px;

        color: #999;

        margin-top: 2px;

    }


    .profile-arrow {

        font-size: 11px;

        color: #999;

        margin-left: 3px;

    }


    /* =========================
       MOBILE MENU
    ========================= */

    .mobile-menu-btn {

        display: none;

        width: 40px;

        height: 40px;

        border: none;

        background: #f7f7f8;

        border-radius: 10px;

        color: #555;

        font-size: 20px;

        cursor: pointer;

    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .top-navbar {

            height: 65px;

            padding: 0 15px;

        }


        .mobile-menu-btn {

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .search-box {

            width: 200px;

        }


        .search-shortcut {

            display: none;

        }


        .admin-details,
        .profile-arrow {

            display: none;

        }


        .navbar-divider {

            display: none;

        }

    }


    @media (max-width: 500px) {

        .search-box {

            display: none;

        }

        .navbar-right {

            margin-left: auto;

        }

    }

</style>
